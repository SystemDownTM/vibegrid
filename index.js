//
var Mobile = false;
function checkWindowWidth() {
    var windowWidth = window.innerWidth;

    // اگر عرض صفحه کمتر از 800px باشد
    if (windowWidth < 800) {
        Mobile = true;
    }
}
if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
        navigator.serviceWorker
            .register("serviceWorker.js")
            .then(res => console.log("service worker registered"))
            .catch(err => console.log("service worker not registered", err))
    })
}
function getCookie(c_name) {
    var c_value = " " + document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) {
        c_value = null;
    }
    else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}
function Load() {
    checkWindowWidth();
    if (getCookie("Login") !== "true") {
        window.location.hash = "Login"
        LPage(page = window.location.hash.replace("#", ""))
        document.getElementById("Menu-Mobile").style.display = "none"
    }
    else {
        ShowMess("Logined");
        if (window.location.hash.replace("#", "") == "Login" || window.location.hash.replace("#", "") == "") {
            LPage(page = "Home")
        }
        else {
            LPage(page = window.location.hash.replace("#", ""))
        }
    }
}
function RPage(page) {
    document.getElementById("titlepage").innerText = page + " - Vibe Grid";
    var RPageReq = new XMLHttpRequest();
    RPageReq.open("GET", "Pages/" + page + "/index.php", true);
    RPageReq.send();
    RPageReq.onreadystatechange = function () {
        if (RPageReq.readyState == 4 && RPageReq.status == 200) {
            document.getElementById("Page").innerHTML = RPageReq.responseText;
            document.getElementById("CustomCss").href = "Pages/" + page + "/index.css";
            var newScript = document.createElement('script');
            document.getElementById("Scripts").remove();
            newScript.type = 'text/javascript';
            newScript.src = "Pages/" + page + "/index.js";
            newScript.id = "Scripts";
            document.head.appendChild(newScript);
        }
    }
}
var Pageed;
function LPage(page) {
    Pageed = page;
    document.getElementById("Page").style.visibility = "hidden";
    if (Mobile == true && page != "Login") {
        document.getElementById(page + "Mo").click();
    }
    document.getElementById("Loading").style.display = "block";
    window.location.hash = page;
    RPage(page = page);
    document.getElementsByTagName("html").classList = "";
}
var Mode = "load";
function CharCount(mode = "load") {
    if (Mode == "load") {
        Mode = "ref";
        document.getElementById("TextPost").innerHTML = "";
    }
    document.getElementById("CharC").innerHTML = document.getElementById("TextPost").innerText.length + " / 450";
}
function PostNew() {
    if (document.getElementById("PostNewForm").style.display == "block") {
        document.getElementById("PostNewForm").style.display = "none"
    }
    else {
        document.getElementById("PostNewForm").style.display = "block";
    }
}
function Post(mode = "") {
    if (document.getElementById("TextPost").innerText.length <= 15 && document.getElementById("TextPostHome").value.length <= 15) {
        ShowMess("Type Text");
        return "";
    }
    var Text = document.getElementById("TextPost").innerHTML;
    if (mode == "home") {
        Text = document.getElementById("TextPostHome").value;
    }
    var PostReq = new XMLHttpRequest();
    PostReq.open("GET", "api/Post.php?Text=" + Text, true);
    PostReq.send();
    PostReq.onreadystatechange = function () {
        if (PostReq.readyState == 4 && PostReq.status == 200) {
            ShowMess("Post created");
            document.getElementById("TextPost").innerHTML = "";
            CharCount("ref");
            console.log(PostReq.responseText);
            if (mode != "home") {
                PostNew();
            }
        }
    }
}
function ShowMess(Text) {
    if (getCookie("theme") != "dark") {
        document.getElementById("MessAlert").style.color = "black"
        document.getElementById("MessAlert").style.backgroundColor = "aliceblue";
    }
    document.getElementById("MessAlert").innerHTML = Text;
    document.getElementById("MessAlert").style.visibility = "visible";
    document.getElementById("MessAlert").style.transition = "1.5s";
    document.getElementById("MessAlert").style.width = "";
    setTimeout(function () {
        document.getElementById("MessAlert").style.visibility = "hidden";
        document.getElementById("MessAlert").style.width = "0%";
    }, 3500);
}
window.addEventListener("blur", function () {
    this.document.title = "Where did you go .";
});
window.addEventListener("focus", function () {
    this.document.title = Pageed + " - Vibe Grid";
})
function Onload() {
    const list = document.querySelectorAll(".list");
    function activeLink() {
        list.forEach((item) => item.classList.remove("active"));
        this.classList.add("active");
    }
    list.forEach((item) => item.addEventListener("click", activeLink));
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");
    if (getCookie("theme") == "dark") {
        body.classList.toggle("dark");
        if (body.classList.contains("dark")) {
            document.cookie = "theme=dark;";
            modeText.innerText = "Light mode";
        } else {
            document.cookie = "theme=light;";
            modeText.innerText = "Dark mode";
        }
    }
    else {
        document.getElementById("indicator").id = "DARK";
    }
    encodeURIComponent
    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    })
    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");
        if (body.classList.contains("dark")) {
            document.cookie = "theme=dark;";
            modeText.innerText = "Light mode";
            document.getElementById("indicator").id = "DARK";
        } else {
            document.cookie = "theme=light;";
            modeText.innerText = "Dark mode";
        }
    });
}
Onload();