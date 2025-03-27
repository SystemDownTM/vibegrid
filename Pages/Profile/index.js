var ResponseText = ""
var ProfilePage = "Pages/Profile/";
function RequestApi(api, mode, Data = "?") {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", ProfilePage + "api/" + api + Data, true);
    xhr.send();
    xhr.onload = function () {
        ResponseText = xhr.responseText;
        if (mode == "ReciveUser") {
            document.getElementById("Username").innerHTML = ResponseText;
        }
        else if (mode == "ReciveProf") {
            document.getElementById("ProfImg").src = ResponseText;
            document.getElementById("ProfImgEdit").src = ResponseText;

        }
        else if (mode == "ReciveBio") {
            document.getElementById("Bio").innerHTML = ResponseText;
            document.getElementById("BioEdit").value = ResponseText;
        }
        else if (mode == "RecivePost") {
            var Response = JSON.parse(ResponseText);
            Response.forEach(element => {
                var elementp = document.createElement("p");
                elementp.id = "post";
                elementp.innerText = element;
                document.getElementById("PostsDiv").appendChild(elementp);
            });
        }
    }
}
function mode() {
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");
    body.classList.toggle("dark");
    if (body.classList.contains("dark")) {
        document.cookie = "theme=dark;";
        modeText.innerText = "Light mode";
    } else {
        document.cookie = "theme=light;";
        modeText.innerText = "Dark mode";
    }
}
function Onload() {
    RequestApi("ReciveUsername.php", "ReciveUser");
    RequestApi("ReciveProf.php", "ReciveProf");
    RequestApi("ReciveBio.php", "ReciveBio");
    RecivePosts();
    setTimeout(() => {
        document.getElementById("Loading").style.display = "none";

    }, 500);
    if (getCookie("theme") == "dark") {
        document.getElementById("mode").checked = true;
    }
    document.getElementById("Page").style.visibility = "visible";
}
Onload();
function Setting() {
    document.getElementById("Profile").style.visibility = "hidden";
    document.getElementById("Setting").style.display = "block";
}
function Save() {
    var fileInput = document.getElementById('ProfImgEdit');
    var maxSizeInBytes = 1048576; // حداکثر حجم مجاز (در اینجا 1 مگابایت)
    try {
        if (fileInput.files.length > 0) {
            var fileSize = fileInput.files[0].size;

            if (fileSize > maxSizeInBytes) {
                alert('Max Size File 1.0MB .');
                fileInput.value = '';
                return "";

            }
        }
    }
    catch {

    }

    const input = document.getElementById('ProfEditPic');
    const file = input.files[0];

    const formData = new FormData();
    formData.append('image', file);
    formData.append("Bio", document.getElementById("BioEdit").value)

    fetch(ProfilePage + 'api/UpdateProf.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            alert('Update Profile');
            Onload();
        })
        .catch(error => {
            console.error('Error : Upload Picture', error);
            Onload();
        });
}
if (getCookie("theme") !== "dark") {
    document.getElementById("ProfImgEditIcon").style = "";
    document.getElementById("Profile").classList = "light";
    document.getElementById("Setting").classList = "light";
}
function RecivePosts() {
    try {
        var url = "Pages/Profile/api/" + "RecivePosts.php";
        var ReqSearch = new XMLHttpRequest();
        ReqSearch.open("POST", url, true);
        ReqSearch.setRequestHeader('Content-Type', 'application/json');
        ReqSearch.onload = function () {
            if (ReqSearch.readyState == 4 && ReqSearch.status == 200) {
                if (ReqSearch.responseText.trim() == "") {
                    ShowMess("Error Server");
                } else {
                    response = JSON.parse(ReqSearch.responseText);
                }
                if (response["notfound"] == "true") {
                    ShowMess("Not Found User");
                } else if (response["error"] == "true" || ReqSearch.responseText.trim() == "") {
                    ShowMess("Error Server");
                } else if (Array.isArray(Object.values(response))) {
                    response = Object.values(response);
                    for (const key in response) {
                        if (response[key] != "") {
                            var Post = document.createElement("div");
                            Post.innerHTML += "<p>" + response[key] + "</p>";
                            Post.id = "post";
                            document.getElementById("PostsDiv").appendChild(Post);
                        }
                    }
                    response.forEach(element => {

                    });
                }
            }
        }
        ReqSearch.send();
    } catch (error) {
        ShowMess("Error");
    }

}
