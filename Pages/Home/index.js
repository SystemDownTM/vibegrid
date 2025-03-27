function Onload() {
    RecivePost();
    setTimeout(() => {
        document.getElementById("Loading").style.display = "none";

    }, 500);
    document.getElementById("Page").style.visibility = "visible";
}
// var global
var page = 30;
function RecivePost() {
    var RecivePostReq = new XMLHttpRequest();
    RecivePostReq.open("GET", "Pages/Home/api/RecivePostsEx.php?mode=home&page=" + page, true);
    RecivePostReq.send();
    RecivePostReq.onreadystatechange = function () {
        if (RecivePostReq.readyState == 4 && RecivePostReq.status == 200) {
            document.getElementById("ExplorePost").innerHTML = "";
            var data = JSON.parse(RecivePostReq.responseText);
            data.forEach(post => {
                document.getElementById("ExplorePost").innerHTML += "<div id='post' >" + post + "</div>";
            });
            page += 30;
        }
    }

}
function Follow() {

}
Onload();
if (getCookie("theme") !== "dark") {
    document.getElementById("Home").classList = "light";
}