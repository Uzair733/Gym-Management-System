<!DOCTYPE html>
<html>
<head>
    <title>Gym Management System Login</title>
    <style>
        body {
            background-color: aqua;
            background: no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
            text-align: center;
        }
        
        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            margin: 10% auto;
            padding: 20px;
            width: 300px;
        }

        .login-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Gym Management System</h2>
        
    <input type="text" id="adminid" placeholder="Admin ID" required>
    <br><br>
    <input type="password" id="password" placeholder="Password" required>
    <br><br>
    <button type="button" onclick="Verify()" >Login</button>
    <p id="result"></p>
    
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function Verify()
        {
            var adminID = $('#adminid').val();
            var password = $('#password').val();

      
        $.ajax({
            type: 'POST', 
            url: 'LoginController/performLoginAjax', 
            data: {
                adminID: adminID,
                password: password
            },
            dataType: 'json',
            success: function(response) {
                
                if (response) {
                    document.getElementById("result").innerHTML = "Login Succesful!";
                    document.getElementById("result").style.color = "Green";
                    window.location.href = 'DashboardView.php';
                    // ADD Redirect to a Dashborad for future reference.
                } else {
                    document.getElementById("result").innerHTML = "Wrong Email or Password";
                    document.getElementById("result").style.color = "red";
                   
                }
            }
        });}
    
</script>
</body>
</html>
