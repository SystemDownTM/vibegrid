//
var Page = "Pages/Chat/"
var UserT = "";
var Flag = "<img id='FlagIran' width='16px' height='16px' src='ico/sticker/iran.png'";
var Mobile = false;
var Cleared = "false";
//;Var Global
var ResponseText = ""
var ProfilePage = "Pages/Chat/";
function RequestApi(api, mode, Data = "?") {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", ProfilePage + "api/" + api, true);
    xhr.send();
    xhr.onload = function () {
        ResponseText = xhr.responseText;
        if (mode == "ReciveProf") {
            document.getElementById("ProfImg").src = ResponseText;
            document.getElementById("ProfImg").style.visibility = "visible";
            document.getElementById("NameUser").innerText = UserT;
            document.getElementById("NameUser").style.visibility = "visible";
        }
    }
}
function checkWindowWidth() {
    var windowWidth = window.innerWidth;
    if (windowWidth < 800) {
        console.log("Window width is less than 800px.");
        Mobile = true;
    }
}

window.addEventListener("resize", checkWindowWidth);
function addstk(id) {
    document.getElementById("MessForSend").innerText += (id);
}
function ShowSticker() {
    if (document.getElementById("Stickers").style.visibility == "visible") {
        document.getElementById("Stickers").style.visibility = "hidden";
    }
    else {
        document.getElementById("Stickers").style.visibility = "visible";
    }
}
function SendMess() {
    var Mess = document.getElementById("MessForSend").innerText;
    if ((Mess.length > 3 & Mess.length < 450) | (Cleared == "true")) {
        var xhr = new XMLHttpRequest();
        xhr.timeout = 6000;
        const fileInput = document.getElementById('file-input');
        const formData = new FormData();
        formData.append('file', fileInput.files[0]);
        xhr.open("POST", Page + "api/" + "SendMess.php?" + "UserT=" + UserT + "&message=" + Mess + "&Clear=" + Cleared, true);
        xhr.send(formData);
        xhr.onload = function () {
            if (xhr.status == 200) {
                document.getElementById("MessForSend").innerText = "";
                document.getElementById("file-input").value = "";
                document.getElementById("ImageList").style.display = "none";
                document.getElementById("ImageList").innerHTML = "";
                var response = JSON.parse(xhr.responseText);
                if (response["Error"] == "excet") {
                    ShowMess("Not File Send . Only .png")
                }
            }
        }
        Cleared = "false";
    }
    else {
        ShowMess("Type Text Min Length : 3")
    }
}
document.getElementById("file-input").addEventListener('change', () => {
    document.getElementById("ImageList").style.display = "flex";
    var img = document.createElement('img');
    var files = document.getElementById('file-input').files;
    for (var file of files) {
        var Name = document.createElement('p');
        var img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        document.getElementById("ImageList").appendChild(img);
        Name.textContent = file.name;
        document.getElementById("ImageList").appendChild(Name);
    }
    console.log(document.getElementById('file-input'));
});
function Clear() {
    Cleared = "true";
    SendMess();
    ReciveUsersChat();
    document.getElementById("ProfImg").style.visibility = "hidden";
    document.getElementById("NameUser").innerText = "";
    document.getElementById("Messages").innerHTML = "";
    document.getElementById("InfoUser").style.display = "none";
}
function ReciveUsersSearch() {

}
function Search() {
    // Local Search Users


    //;
}
function CheckUserT() {
    var User = document.getElementById("SearchText").value;
    var xhr = new XMLHttpRequest();
    xhr.timeout = 6000;
    xhr.open("GET", Page + "api/" + "CheckUserT.php?" + "UserT=" + User, true);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status == 200) {
            //;
            if (xhr.responseText.trim() == "true") {
                ReciveMess(user = User, mode = "load");
                ReciveUsersChat();
            }
        }
    }
}
function truncateText(text, maxLength) {
    if (text.length > maxLength) {
        return text.slice(0, maxLength) + '...';
    } else {
        return text;
    }
}
function ReciveUsersChat() {
    var xhr = new XMLHttpRequest();
    xhr.timeout = 6000;
    xhr.open("GET", Page + "api/" + "ReciveUsers.php", true);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status == 200) {
            document.getElementById("UsersT").innerHTML = xhr.responseText;
            var elements = document.querySelectorAll("#UsersT > [id^='UserT'] > [id^='UsernameT'] ");
            elements.forEach(function (element) {
                element.innerHTML = truncateText(element.innerHTML, 15);
            });
            if (getCookie("theme") !== "dark") {
                document.getElementById("UsersT").style.backgroundColor = "#F9FAFC";
                document.getElementById("PanelUsers").style.backgroundColor = "#F9FAFC";
                var elements = document.querySelectorAll("#UsersT > [id^='UserT']");
                elements.forEach(function (element) {
                    element.style.backgroundColor = "#F9FAFC";
                    element.style.color = "#4A4B4C";
                    element.style.borderBottom = "none";
                    var elements = document.querySelectorAll("#UserT > [id^='UsernameT']");
                    elements.forEach(function (element) {
                        element.style.color = "black";
                    });
                });
            }
            var divs = document.querySelectorAll("[id^='UserT']");
            divs.forEach(function (div) {
                div.addEventListener("contextmenu", function (event) {
                    showContextMenu(event, div.title);
                });
                div.addEventListener("click", function (event) {
                    var divs = document.querySelectorAll(".UserT");
                    divs.forEach(function (div) {
                        div.classList.remove("showbefore");
                    });
                    div.classList.add("showbefore");
                });
                console.log("clicked");
            });
            document.body.addEventListener("click", hideContextMenu);
        }
    }
}
function ShowInfoUser(mode) {
    if (mode == "close") {
        document.getElementById("InfoUser").style.display = "none";
    }
    else {
        document.getElementById("ProfPicInfo").src = document.getElementById("ProfImg").src;
        document.getElementById("UserShowInfo").innerText = document.getElementById("NameUser").innerText;
        document.getElementById("InfoUser").style.display = "grid";
        var ReciveBioReq = new XMLHttpRequest();
        ReciveBioReq.open("GET", Page + "api/ReciveBio.php?mode=desktop&Username=" + document.getElementById("UserShowInfo").innerText, true);
        ReciveBioReq.send();
        ReciveBioReq.onload = function () {
            if (ReciveBioReq.status >= 200 && ReciveBioReq.status < 400) {
                document.getElementById("BioInfoUser").innerText = ReciveBioReq.responseText;
            }
        }
    }
}
function showContextMenu(event, divId) {
    event.preventDefault();
    UserT = divId;
    var contextMenu = document.getElementById("contextMenu");
    contextMenu.style.display = "flex";
    contextMenu.style.left = event.pageX + "px";
    contextMenu.style.top = event.pageY + "px";
}
function hideContextMenu() {
    var contextMenu = document.getElementById("contextMenu");
    contextMenu.style.display = "none";
}
function ImageLoad(event) {
    event.src = event.dataset.src;
    console.log(event);
}
function ReciveMess(user = UserT, mode = 'ref') {
    if (user == '') {
        return "";
    }
    if (mode == "load") {
        document.getElementById("Messages").innerHTML = "";
    }
    UserT = user;
    var xhr = new XMLHttpRequest();
    xhr.timeout = 3000;
    xhr.open("GET", Page + "api/" + "ReciveMess.php?" + "UserT=" + UserT + "&mode=" + mode, true);
    xhr.send();
    xhr.onload = function () {
        if (xhr.status == 200) {
            if (xhr.responseText.trim() !== "" && xhr.responseText.trim() != "null") {
                var response = JSON.parse(xhr.responseText);
                function htmlspecialchars(str, mode) {
                    var map = {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    };
                    try {
                        if (mode == "not") {
                            return str.replace(/[&<>"']/g, function (m) { return map[m]; });
                        }
                        else {
                            return str.replace(/[&<>"']/g, function (m) { return map[m]; });
                        }
                    }
                    catch {
                        return str;
                    }
                }
                var id = response['id'];
                response['id'] = null;
                if (Array.isArray(Object.values(response))) {
                    response = Object.values(response);
                    for (const key in response) {
                        if (response[key] != null) {
                            var message = (response[key]);
                            var MessageRe = document.createElement('div');
                            if (id == message["sender_id"]) {
                                MessageRe.id = "m";
                            }
                            else {
                                MessageRe.id = "t";
                            }
                            var day = message.timestamp;
                            var clock = new Date(day);
                            var hour = clock.getHours();
                            var minute = clock.getMinutes();
                            var second = clock.getSeconds();
                            var timeString = "18:04:15";
                            var period = (hour >= 12) ? "PM" : "AM";
                            hour -= 12;
                            if (message.type == "text") {
                                MessageRe.innerHTML = "<pre>" + htmlspecialchars(message.message) + "</pre>"
                                    + "<p>" + hour + ":" + minute + period + "</p>"
                                    + "";
                                MessageRe.title = message.timestamp;
                            }
                            else {
                                MessageRe.innerHTML = "<a href='data:application/octet-stream;base64," + htmlspecialchars(message.message) + "' download='file.png'>Download</a>"
                                    + "<p>" + hour + ":" + minute + period + "</p>"
                                    + "";
                                MessageRe.title = message.timestamp;
                            }
                            document.getElementById("Messages").appendChild(MessageRe);
                        }

                    }
                }
                if (mode == 'load') {
                    var Messscroll = document.getElementById("Messages").scrollHeight;
                    document.getElementById("Messages").scrollTop = Messscroll;
                    RequestApi("ReciveProf.php?UserT=" + UserT, "ReciveProf");
                }
                if (Mobile == true && mode == "load") {
                    document.getElementById("Search").style.transition = "0.5s";
                    document.getElementById("PanelUsers").style.transition = "0.5s";
                    document.getElementById("UsersT").style.transition = "0.5s";
                    document.getElementById("Back").style.visibility = "visible";
                    document.getElementById("PanelUsers").style.width = "0";
                    document.getElementById("UsersT").style.width = "0";
                    document.getElementById("UsersT").style.visibility = "hidden";
                    document.getElementById("Search").style.width = "0";
                    document.getElementById("Search").style.visibility = "hidden";
                }
            }
        }
    }

}
function Back() {
    document.getElementById("Back").style.visibility = "hidden";
    document.getElementById("Search").style.transition = "0.5s";
    document.getElementById("PanelUsers").style.transition = "0.5s";
    document.getElementById("UsersT").style.transition = "0.5s";
    document.getElementById("Back").style.visibility = "hidden";
    document.getElementById("PanelUsers").style.width = "";
    document.getElementById("UsersT").style.width = "";
    document.getElementById("UsersT").style.visibility = "visible";
    document.getElementById("Search").style.width = "";
    document.getElementById("Search").style.visibility = "visible";
}
function Onload() {
    ReciveUsersChat();
    setInterval(ReciveUsersChat, 30000);
    setInterval(ReciveMess, 3000);
    checkWindowWidth();
    setTimeout(() => {
        document.getElementById("Loading").style.display = "none";
        document.getElementById("Page").style.visibility = "visible";
    }, 500);
    if (getCookie("theme") !== "dark") {
        document.getElementById("Messages").style.backgroundColor = "#F9FAFC";
        document.getElementById("Info").style.backgroundColor = "#F9FAFC";
        document.getElementById("NameUser").style.color = "#4A4B4C";
        document.getElementById("PanelSend").style.color = "#4A4B4C";
        document.getElementById("PanelSend").style.backgroundColor = "#F9FAFC";
        document.getElementById("PanelMess").style.backgroundColor = "#F9FAFC";
        document.getElementById("Trash").style.backgroundColor = "#F9FAFC";
        document.getElementById("Messages").classList = "dark";
        document.getElementById("Messages").classList = "dark";
        document.getElementById("Stickers").style.backgroundColor = "#F9FAFC";
        document.getElementById("MessForSend").style.color = "#4A4B4C";
        document.getElementById("Search").style.color = "#4A4B4C";
        document.getElementById("Search").style.backgroundColor = "#F9FAFC";
        document.getElementById("SearchText").style.color = "#4A4B4C";
        document.getElementById("SearchBtn").style.color = "black";
        document.getElementById("Back").style.color = "#4A4B4C";
        document.getElementById("contextMenu").style.classList = "light";
    }
    // Theme Load 
}
Onload();