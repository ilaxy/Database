function myFunction()			
		{
			var fname = document.getElementById("firstname").value;
			var lname = document.getElementById("lastname").value;
			var email = document.getElementById("email").value;
			var pw = document.getElementById("password").value;
			var cpw = document.getElementById("confirmpassword").value; 
			var username = document.getElementById("username").value;
			
			if (fname == ""){
				window.alert("Please enter First name");
        return false;
       
			}

			else if (lname == ""){
				window.alert("Please enter Last name");
        return false;
	
			}
			
			else if (username == password){
				window.alert("Username and password cannot be same"); 
        return false;
			}

			else if (pw != cpw)
			{
				window.alert ("Password doesn't match");
        
				return false;
			}

			else
			{
				return true;
			}
		}
	
				


