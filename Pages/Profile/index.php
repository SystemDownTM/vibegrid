<?php

?>
<!DOCTYPE html>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div id="Profile" onload="Onload()">
    <div id="UserBioImg">
        <pre id="Username"></pre>
        <pre id="Bio">This is Bio</pre>
        <img src="//1ico/profile.png" id="ProfImg" alt="">
    </div>
    <label for="Feed" id="LFeed">Feed</label>
    <div id="FeedDiv"></div>
    <label for="PostsDiv" id="LPosts">Posts Me</label>
    <div id="PostsDiv">
        <br><br>
    </div>
    <i class='bx bxs-cog' id="Settingbtn" onclick="Setting()"></i>
</div>
<div id="Setting">
    <button class="SignOutProf" onclick="location.href = './SignOut.php'">SignOut</button>
    <label for="ProfEditPic">
        <i id="ProfImgEditIcon" class='bx bx-camera' style='color:#ffffff'></i>
        <img src="ico/profile.png" id="ProfImgEdit" alt="">
    </label>
    <input type="file" id="ProfEditPic" accept="image/*">
    <label id="BioEditL" for="BioEdit">
        <p>Bio : </p>
    </label>
    <input type="text" maxlength="50" id="BioEdit">
    <label for="mode">Dark Mode</label>
    <input type="checkbox" id="mode" onclick="mode()">
    <button id="Save" onclick="Save()">Save</button>
</div>