<?php

?>
<!DOCTYPE html>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div id="Group">
    <div id="Groups">
        <div id="Searcher"><input type="text" id="TextSearch" placeholder="Type .."><i class='bx bx-search-alt' id="Search" onclick="Search()"></i></div>
        <button id="NewGroup" onclick="ShowMenu('JoinNew')"></button>
    </div>
    <div id="menuJoinNew">
        <button id="ShowNGro" onclick="ShowMenu('New')">Create Group</button>
        <br>
        <button id="ShowJGro" onclick="ShowMenu('Join')">Join Group</button>
    </div>
    <div id="NewGroupPanel">
        <input id="NGroupN" required placeholder="Name Group" minlength="5" maxlength="15">
        <input id="BGroupB" required placeholder="Bio Group" maxlength="25">
        <button id="Submit" onclick="NewGroup()" type="submit">Create</button>
        <button onclick="ShowMenu('New')">Cancel</button>
    </div>
    <div id="JoinPanel">
        <input id="NGroupN" required placeholder="Name Group" minlength="5" maxlength="15">
        <input id="BGroupB" required placeholder="Bio Group" maxlength="25">
        <button id="Submit" onclick="NewGroup()" type="submit">Join</button>
        <button onclick="ShowMenu('Join')">Cancel</button>
    </div>
    <div id="Chat">
        <div id="PanelSend">
            <textarea id="MessForSend" cols="30" rows="10" placeholder="Type Message ..."></textarea>
            <i class='bx bxs-send' id="Send"></i>
            <i class='bx bx-happy' id="StickerShow"></i>
            <div id="Stickers"></div>
        </div>
        <div id="info">
            <img src="" id="ProfileGrp" alt="">
            <pre id="NameGrp"></pre>
        </div>
        <div id="infoFull">
            <img src="" id="ProfileGrpF" alt="">
            <pre id="NameGrpF"></pre>
            <pre id="BioGrpF"></pre>
            <div id="MembersGrpF"></div>
        </div>
    </div>
</div>