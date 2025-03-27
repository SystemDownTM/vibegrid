// Var Global
var response = {};

function Search() {
    try {
        var TextSearch = document.getElementById("TextSearch").value;
        var url = "Pages/Explore/api/" + "search.php";
        var ReqSearch = new XMLHttpRequest();
        ReqSearch.open("POST", url, true);
        ReqSearch.setRequestHeader('Content-Type', 'application/json');
        ReqSearch.onload = function () {
            if (ReqSearch.readyState == 4 && ReqSearch.status == 200) {
                document.getElementById("Posts").innerHTML = "";
                if (ReqSearch.responseText.trim() == "") {
                    ShowMess("Error Server");
                } else {
                    response = JSON.parse(ReqSearch.responseText);
                    document.getElementById("infoUser").innerHTML = "<img src='" + response["UserPic"] + "'>";
                    document.getElementById("infoUser").innerHTML += "<p>" + response["UserT"] + "</p>";
                    UserPic = response["UserPic"];
                    UserT = response["UserT"];
                    response["UserPic"] = null;
                    response["UserT"] = null;
                }
                if (response["notfound"] == "true") {
                    ShowMess("Not Found User");
                } else if (response["error"] == "true" || ReqSearch.responseText.trim() == "") {
                    ShowMess("Error Server");
                } else if (Array.isArray(Object.values(response))) {
                    response = Object.values(response);
                    for (const key in response) {
                        if (response[key].trim() != "") {
                            var Post = document.createElement("div");
                            Post.innerHTML = "<img src='" + UserPic + "'>"+"<b>"+UserT+"</b>";
                            Post.innerHTML += "<p>"+response[key]+"</p>";
                            Post.id = "post";
                            document.getElementById("Posts").appendChild(Post);
                        }
                    }
                    response.forEach(element => {

                    });
                }
            }
        }
        ReqSearch.send(JSON.stringify({ "TextSearch": btoa(TextSearch) }));
    } catch (error) {
        ShowMess("Error");
    }

}

setTimeout(() => {
    document.getElementById("Loading").style.display = "none";
    document.getElementById("Page").style.visibility = "visible";
}, 500);
if (getCookie("theme") !== "dark") {
    document.getElementById("Explore").style.backgroundColor = "#F9FAFC";
    document.getElementById("Explore").style.color = "#4A4B4C";
    document.getElementById("search").style.backgroundColor = "#F9FAFC";
    document.getElementById("Posts").style.backgroundColor = "#F9FAFC";
    document.getElementById("infoUser").classList = "dark";
    document.getElementById("Posts").classList = "dark";
}