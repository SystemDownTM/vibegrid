var PageLoc = "Pages/Login/"
function SignUp() {
    if (document.getElementById("UsernameS").value.trim().length >= 5 && document.getElementById("PasswordS").value.trim().length >= 8) {
        var xhr = new XMLHttpRequest();
        document.getElementById("Loading").style.display = "block";
        var Email = btoa(document.getElementById("Email").value.replace("#", "").replace("&", ""));
        xhr.open("GET", PageLoc + "api/Register.php?Username=" + document.getElementById("UsernameS").value.replace("#", "").replace("&", "") + "&Password=" + btoa(document.getElementById("PasswordS").value) + "&Email=" + Email, true);
        document.getElementById("Password").value = document.getElementById("PasswordS").value;
        document.getElementById("Username").value = document.getElementById("UsernameS").value;
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var Reponse = JSON.parse(xhr.responseText);
                if (Reponse["success"] == "true" | Reponse["success"] == true) {
                    Login();
                }
                else if (Reponse["success"] == "false" | Reponse["success"] == false && Reponse["message"] == "lenght") {
                    ShowMess("Error length Username Or Passowrd \n" +
                        "Password Length : 8 \n Username Lenght : 5 ")
                }
                else if (Reponse["success"] == "false" | Reponse["success"] == false && Reponse["message"] == "email") {
                    ShowMess("Error Email Invalid");
                }
                else if (Reponse["success"] == "false" | Reponse["success"] == false && Reponse["message"] == "AlerUser") {
                    ShowMess("Username already Exists");
                    Login();
                }
                else if (Reponse["success"] == "false" | Reponse["success"] == false && Reponse["message"] == "error") {
                    ShowMess("An unknown error has occurred. Please contact support");
                } else {
                    ShowMess("Something went wrong");
                    console.log(xhr.responseText)
                }
            }
        }
        xhr.send();
    }
    else {
        ShowMess("Error length Username Or Passowrd \n" +
            "Password Length : 8 \n Username Lenght : 5 ")
    }
}
function Login() {
    try {
        document.getElementById("Loading").style.display = "block";
        const xhr = new XMLHttpRequest();
        try {
            xhr.open("GET", PageLoc + "api/Login.php?Username=" + document.getElementById("Username").value.replace("#", "").replace("&", "") + "&Password=" + btoa(document.getElementById("Password").value), true);
        }
        catch {
            ShowMess("Please enter your Username and Password in English");
        }
        xhr.onreadystatechange = function () {
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    if (xhr.responseText.trim() == "true") {
                        document.cookie = "Login=true;";
                        ShowMess("Logined");
                        location.reload();
                    }
                    else if (xhr.responseText.trim() == "Wrong") {
                        ShowMess("Username Or Password Wrong");
                    }
                    else {
                        ShowMess("Error Server");
                    }
                }
            };
        }
        xhr.send();
    }
    catch (e) { ShowMess("Error Unknow"); }
}
setTimeout(() => {
    document.getElementById("Loading").style.display = "none";
    document.getElementById("MenuNav").style.display = "none";
    document.getElementById("Page").style.left = "1%";
    document.getElementById("Page").style.width = "99%";
    document.getElementById("Page").style.visibility = "visible";
}, 500);
