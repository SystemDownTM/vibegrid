setTimeout(() => {
    document.getElementById("Loading").style.display = "none";
    document.getElementById("Page").style.visibility = "visible";
}, 500);
function searchPrograms() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var programList = document.getElementById("programList");
    var programs = programList.getElementsByTagName("li");
    for (var i = 0; i < programs.length; i++) {
        var programName = programs[i].textContent || programs[i].innerText;
        if (programName.toUpperCase().indexOf(input) > -1) {
            programs[i].style.display = "";
        } else {
            programs[i].style.display = "none";
        }
    }
}
