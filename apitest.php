#!usr/bin/php
<?php

class GoodReads
{
    
    const API_URL = 'https://www.goodreads.com';
   
    const CACHE_TTL = 3600;
   
    const SLEEP_BETWEEN_REQUESTS = 1000;
    
    protected $apiKey = 'vkocu8cqXPKDJc7wnPw';
    
    protected $cacheDir = 'cache';
    
    protected $lastRequestTime = 0;
    
    public function __construct($apiKey, $cacheDirectory = '')
    {
        $this->apiKey = (string)$apiKey;
        $this->cacheDir = (string)$cacheDirectory;
        $this->clearExpiredCache();
    }
    
    public function getAuthor($authorId)
    {
        return $this->request(
            'author/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$authorId
            )
        );
    }
    
    public function getBooksByAuthor($authorId, $page = 1)
    {
        return $this->request(
            'author/list',
            array(
                'key' => $this->apiKey,
                'id' => (int)$authorId,
                'page' => (int)$page
            )
        );
    }
    
    public function getBook($bookId)
    {
        return $this->request(
            'book/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$bookId
            )
        );
    }
   
    public function getBookByISBN($isbn)
    {
        return $this->request(
            'book/isbn/' . urlencode($isbn),
            array(
                'key' => $this->apiKey
            )
        );
    }
    /**
     * Get details for a given book by title.
     *
     * @param  string $title
     * @param  string $author Optionally provide this for more accuracy.
     * @return array
     */
    public function getBookByTitle($title, $author = '')
    {
        return $this->request(
            'book/title',
            array(
                'key' => $this->apiKey,
                'title' => urlencode($title),
                'author' => $author
            )
        );
    }
    /**
     * Get details for a given user.
     *
     * @param  integer $userId
     * @return array
     */
    public function getUser($userId)
    {
        return $this->request(
            'user/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$userId
            )
        );
    }
    
    public function getReview($reviewId, $page = 1)
    {
        return $this->request(
            'review/show',
            array(
                'key' => $this->apiKey,
                'id' => (int)$reviewId,
                'page' => (int)$page
            )
        );
    }
   
    public function getShelf($userId, $shelf, $sort = 'title', $limit = 100, $page = 1)
    {
        return $this->request(
            'review/list',
            array(
                'v' => 2,
                'format' => 'xml',     // :( GoodReads still doesn't support JSON for this endpoint
                'key' => $this->apiKey,
                'id' => (int)$userId,
                'shelf' => $shelf,
                'sort' => $sort,
                'page' => $page,
                'per_page' => $limit
            )
        );
    }
    
    public function getAllBooks($userId, $sort = 'title', $limit = 100, $page = 1)
    {
        return $this->request(
            'review/list',
            array(
                'v' => 2,
                'format' => 'xml',     // :( GoodReads still doesn't support JSON for this endpoint
                'key' => $this->apiKey,
                'id' => (int)$userId,
                'sort' => $sort,
                'page' => $page,
                'per_page' => $limit
            )
        );
    }
    
    public function showAuthor($authorId)
    {
        return $this->getAuthor($authorId);
    }
    
    public function showUser($userId)
    {
        return $this->getUser($userId);
    }
    
    public function getLatestReads($userId, $sort = 'date_read', $limit = 100, $page = 1)
    {
        return $this->getShelf($userId, 'read', $sort, $limit, $page);
    }
    
    private function request($endpoint, array $params = array())
    {
        // Check the cache
        $cachedData = $this->getCache($endpoint, $params);
        if($cachedData !== false) {
            return $cachedData;
        }
        // Prepare the URL and headers
        $url = self::API_URL .'/'. $endpoint . '?' . ((!empty($params)) ? http_build_query($params, '', '&') : '');
        $headers = array(
            'Accept: application/xml',
        );
        if(isset($params['format']) && $params['format'] === 'json') {
            $headers = array(
                'Accept: application/json',
            );
        }
        // Execute via CURL
        $response = null;
        if(extension_loaded('curl')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            usleep(self::SLEEP_BETWEEN_REQUESTS);
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $headerSize);
            $body = substr($response, $headerSize);
            $errorNumber = curl_errno($ch);
            $errorMessage = curl_error($ch);
            if($errorNumber > 0)
            {
                throw new Exception('Method failed: ' . $endpoint . ': ' . $errorMessage);
            }
            curl_close($ch);
        } else {
            throw new Exception('CURL library not loaded!');
        }
        // Try and cadge the results into a half-decent array
        $results = null;
        if(isset($params['format']) && $params['format'] === 'json') {
            $results = json_decode($body);
        } else {
            $results = json_decode(json_encode((array)simplexml_load_string($body, 'SimpleXMLElement', LIBXML_NOCDATA)), 1); // I know, I'm a terrible human being
        }
        if($results !== null) {
            // Cache & return results
            $this->addCache($endpoint, $params, $results);
            return $results;
        } else {
            throw new Exception('Server error on "' . $url . '": ' . $response);
        }
    }
    /**
     * Attempt to get something from the cache.
     *
     * @param  string $endpoint
     * @param  array  $params
     * @return array|false
     */
    private function getCache($endpoint, array $params = array())
    {
        if (file_exists($this->cacheDir) && is_writable($this->cacheDir)) {
            $filename = str_replace('/', '_', $endpoint) . '-' . md5(serialize($params));
            $filename = $this->cacheDir . '/' . $filename;
            if(file_exists($filename)) {
                $contents = unserialize(file_get_contents($filename));
                if(!is_array($contents) || $contents['cache_expiry'] <= time()) {
                    unlink($filename);
                    return false;
                } else {
                    unset($contents['cache_expiry']);
                    return $contents;
                }
            }
            return false;
        } else {
            throw new Exception('Cache directory not writable.');
        }
    }
    
    private function addCache($endpoint, array $params = array(), array $contents)
    {
        if (file_exists($this->cacheDir) && is_writable($this->cacheDir)) {
            $filename = str_replace('/', '_', $endpoint) . '-' . md5(serialize($params));
            $filename = $this->cacheDir . '/' . $filename;
            $contents['cache_expiry'] = time() + self::CACHE_TTL;
            return file_put_contents($filename, serialize($contents));
        } else {
            throw new Exception('Cache directory not writable.');
        }
    }
    /**
     * Remove old cache items.
     */
    private function clearExpiredCache()
    {
        if (file_exists($this->cacheDir) && is_writable($this->cacheDir)) {
            foreach (new DirectoryIterator($this->cacheDir) as $file) {
                if ($file->isDot()) {
                    continue;
                }
                if (time() - $file->getCTime() >= self::CACHE_TTL) {
                    unlink($file->getRealPath());
                }
            }
        } else {
            throw new Exception('Cache directory not writable.');
        }
    }
}
?>
