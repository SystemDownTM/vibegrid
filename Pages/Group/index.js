var on = false;
var Page = "Pages/Group/api/"
function clearMess() {
    if (on == false) {
        document.getElementById("MessForSend").style.color = "white";
        document.getElementById("MessForSend").innerHTML = "";
        on = true;
    }
}
function Onload() {
    ReciveUsers()
    setTimeout(() => {
        document.getElementById("Loading").style.display = "none";
        document.getElementById("Page").style.visibility = "visible";
    }, 500);
    if (getCookie("theme") !== "dark") {
        document.body.id = "light";
    }
}
function ShowMenu(menu) {
    if (menu == "JoinNew") {
        document.getElementById('menuJoinNew').style.transition = '0.5s';
        document.getElementById('menuJoinNew').style.scale = '0.5';
        if (document.getElementById('menuJoinNew').style.visibility == 'visible') {
            document.getElementById('menuJoinNew').style.visibility = 'hidden';
        }
        else {
            document.getElementById('menuJoinNew').style.scale = '1';
            document.getElementById('menuJoinNew').style.visibility = 'visible';
        }
    }
    else if (menu == "New") {
        if (document.getElementById('JoinPanel').style.visibility == 'visible') {
            ShowMenu("Join");
        }
        document.getElementById('NewGroupPanel').style.transition = '0.5s';
        document.getElementById('NewGroupPanel').style.scale = '0.5';
        if (document.getElementById('NewGroupPanel').style.visibility == 'visible') {
            document.getElementById('NewGroupPanel').style.visibility = 'hidden';
        }
        else {
            document.getElementById('NewGroupPanel').style.scale = '1';
            document.getElementById('NewGroupPanel').style.visibility = 'visible';
        }
    }
    else if (menu == "Join") {
        if (document.getElementById('NewGroupPanel').style.visibility == 'visible') {
            ShowMenu("New");
        }
        document.getElementById('JoinPanel').style.transition = '0.5s';
        document.getElementById('JoinPanel').style.scale = '0.5';
        if (document.getElementById('JoinPanel').style.visibility == 'visible') {
            document.getElementById('JoinPanel').style.visibility = 'hidden';
        }
        else {
            document.getElementById('JoinPanel').style.scale = '1';
            document.getElementById('JoinPanel').style.visibility = 'visible';
        }
    }
}
function ReciveUsers() {
    var ReciveUsersReq = new XMLHttpRequest();
    ReciveUsersReq.open("GET", Page + "ReciveGroup.php");
    ReciveUsersReq.send();
    ReciveUsersReq.responseType = "text";
    ReciveUsersReq.onload = function () {
        if (this.status >= 200 && this.status < 300) {
            var Response = JSON.parse(this.response);
            if (this.response.trim() === "") {
                ShowMess("Error Server");
                return;
            }
            if (Response["notfound"] === "true") {
                ShowMess("Not Found User");
                return;
            } else if (Response["error"] === "true") {
                ShowMess("Error Server");
                return;
            }
            if (Response["UserPass"] === "true") {
                Response["UserPass"] = null;
            } else if (Response["UserPass"] === "false") {
                LPage("Login");
                Response["UserPass"] = null;
                return;
            }
            Response["on"] = "";
            for (var index = 0; index < 100;) {
                console.log(Response[index.toString()])
                index++;
            }
        }
    };
}
function NewGroup() {
    var Group = document.getElementById("NGroupN").value;
    var GroupNewReq = new XMLHttpRequest();
    GroupNewReq.open("POST", Page + "/NewOrJoin.php", true);
    GroupNewReq.setRequestHeader("Content-type", "application/json");
    GroupNewReq.send(JSON.stringify({
        "Group": Group,
        "New": "true",
        "Join": "false"
    }));
    GroupNewReq.onreadystatechange = function () {
        if (GroupNewReq.readyState === 4 && GroupNewReq.status === 200) {
            var Response = JSON.parse(GroupNewReq.responseText);
            if (Response["error"] == "false") {
                console.log(Response["error"]);
            }
        }
    }
}
Onload()