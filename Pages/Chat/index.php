<?php

?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<div id="Search">
    <button class='bx bx-search-alt-2 bx-rotate-90' id="SearchBtn" style='color:#f7f2f2'
        onclick="CheckUserT()"></button>
    <input type="text" id="SearchText" placeholder="Search ..." onchange="Search()">
</div>
<div id="PanelUsers">
    <div id="UsersT"></div>
</div>
<div id="contextMenu" style="display: none;">
    <button onclick="Clear()">Delete Chat</button>
    <button>Coming Soon</button>
    <button>Coming Soon</button>
</div>
<div id="InfoUser">
    <i class="bi bi-x" id="Close" onclick="ShowInfoUser('close')"></i>
    <img src="ico/profile.png" id="ProfPicInfo" alt="Profile">
    <p id="UserShowInfo">Username</p>
    <p id="BioInfoUser">This Is Bio</p>
</div>
<div id="Info" onclick="ShowInfoUser()">
    <i class='bx bx-left-arrow-alt' id="Back" onclick="Back()"></i>
    <img src="ico/profile.png" id="ProfImg" alt="Profile">
    <p id="NameUser">Username</p>
    <button id="Trash" onclick="Clear()"></button>
</div>
<div id="PanelMess">
    <div id="Messages">
    </div>
    <div id="Stickers">
        <p style="flex:100%; margin-left: 7%;">Smileys : </p>
        <p id="stickerm" onclick="addstk('&#128512;')" title="GRINNING FACE">&#128512;</p>
        <p id="stickerm" onclick="addstk('&#128513;')" title="GRINNING FACE WITH SMILING EYES">&#128513;</p>
        <p id="stickerm" onclick="addstk('&#128514;')" title="FACE WITH TEARS OF JOY">&#128514;</p>
        <p id="stickerm" onclick="addstk('&#128515;')" title="SMILING FACE WITH OPEN MOUTH">&#128515;</p>
        <p id="stickerm" onclick="addstk('&#128516;')" title="SMILING FACE WITH OPEN MOUTH AND SMILING EYES">&#128516;
        </p>
        <p id="stickerm" onclick="addstk('&#128517;')" title="SMILING FACE WITH OPEN MOUTH AND COLD SWEAT">&#128517;</p>
        <p id="stickerm" onclick="addstk('&#128518;')" title="SMILING FACE WITH OPEN MOUTH AND TIGHTLY-CLOSED EYES">
            &#128518;
        </p>
        <p id="stickerm" onclick="addstk('&#128519;')" title="SMILING FACE WITH HALO">&#128519;</p>
        <p id="stickerm" onclick="addstk('&#128520;')" title="SMILING FACE WITH HORNS">&#128520;</p>
        <p id="stickerm" onclick="addstk('&#128521;')" title="WINKING FACE">&#128521;</p>
        <p id="stickerm" onclick="addstk('&#128522;')" title="SMILING FACE WITH SMILING EYES">&#128522;</p>
        <p id="stickerm" onclick="addstk('&#128523;')" title="FACE SAVOURING DELICIOUS FOOD">&#128523;</p>
        <p id="stickerm" onclick="addstk('&#128524;')" title="RELIEVED FACE">&#128524;</p>
        <p id="stickerm" onclick="addstk('&#128525;')" title="SMILING FACE WITH HEART-SHAPED EYES">&#128525;</p>
        <p id="stickerm" onclick="addstk('&#128526;')" title="SMILING FACE WITH SUNGLASSES">&#128526;</p>
        <p id="stickerm" onclick="addstk('&#128527;')" title="SMIRKING FACE">&#128527;</p>
        <p id="stickerm" onclick="addstk('&#128528;')" title="NEUTRAL FACE">&#128528;</p>
        <p id="stickerm" onclick="addstk('&#128529;')" title="EXPRESSIONLESS FACE">&#128529;</p>
        <p id="stickerm" onclick="addstk('&#128530;')" title="UNAMUSED FACE">&#128530;</p>
        <p id="stickerm" onclick="addstk('&#128531;')" title="FACE WITH COLD SWEAT">&#128531;</p>
        <p id="stickerm" onclick="addstk('&#128532;')" title="PENSIVE FACE">&#128532;</p>
        <p id="stickerm" onclick="addstk('&#128533;')" title="CONFUSED FACE">&#128533;</p>
        <p id="stickerm" onclick="addstk('&#128534;')" title="CONFOUNDED FACE">&#128534;</p>
        <p id="stickerm" onclick="addstk('&#128535;')" title="KISSING FACE">&#128535;</p>
        <p id="stickerm" onclick="addstk('&#128536;')" title="FACE THROWING A KISS">&#128536;</p>
        <p id="stickerm" onclick="addstk('&#128537;')" title="KISSING FACE WITH SMILING EYES">&#128537;</p>
        <p id="stickerm" onclick="addstk('&#128538;')" title="KISSING FACE WITH CLOSED EYES">&#128538;</p>
        <p id="stickerm" onclick="addstk('&#128539;')" title="FACE WITH STUCK-OUT TONGUE">&#128539;</p>
        <p id="stickerm" onclick="addstk('&#128540;')" title="FACE WITH STUCK-OUT TONGUE AND WINKING EYE">&#128540;</p>
        <p id="stickerm" onclick="addstk('&#128541;')" title="FACE WITH STUCK-OUT TONGUE AND TIGHTLY-CLOSED EYES">
            &#128541;</p>
        <p id="stickerm" onclick="addstk('&#128542;')" title="DISAPPOINTED FACE">&#128542;</p>
        <p id="stickerm" onclick="addstk('&#128543;')" title="WORRIED FACE">&#128543;</p>
        <p id="stickerm" onclick="addstk('&#128544;')" title="ANGRY FACE">&#128544;</p>
        <p id="stickerm" onclick="addstk('&#128545;')" title="POUTING FACE">&#128545;</p>
        <p id="stickerm" onclick="addstk('&#128546;')" title="CRYING FACE">&#128546;</p>
        <p id="stickerm" onclick="addstk('&#128547;')" title="PERSEVERING FACE">&#128547;</p>
        <p id="stickerm" onclick="addstk('&#128548;')" title="FACE WITH LOOK OF TRIUMPH">&#128548;</p>
        <p id="stickerm" onclick="addstk('&#128549;')" title="DISAPPOINTED BUT RELIEVED FACE">&#128549;</p>
        <p id="stickerm" onclick="addstk('&#128550;')" title="FROWNING FACE WITH OPEN MOUTH">&#128550;</p>
        <p id="stickerm" onclick="addstk('&#128551;')" title="ANGUISHED FACE">&#128551;</p>
        <p id="stickerm" onclick="addstk('&#128552;')" title="FEARFUL FACE">&#128552;</p>
        <p id="stickerm" onclick="addstk('&#128553;')" title="WEARY FACE">&#128553;</p>
        <p id="stickerm" onclick="addstk('&#128554;')" title="SLEEPY FACE">&#128554;</p>
        <p id="stickerm" onclick="addstk('&#128555;')" title="TIRED FACE">&#128555;</p>
        <p id="stickerm" onclick="addstk('&#128556;')" title="GRIMACING FACE">&#128556;</p>
        <p id="stickerm" onclick="addstk('&#128557;')" title="LOUDLY CRYING FACE">&#128557;</p>
        <p id="stickerm" onclick="addstk('&#128558;')" title="FACE WITH OPEN MOUTH">&#128558;</p>
        <p id="stickerm" onclick="addstk('&#128559;')" title="HUSHED FACE">&#128559;</p>
        <p id="stickerm" onclick="addstk('&#128560;')" title="FACE WITH OPEN MOUTH AND COLD SWEAT">&#128560;</p>
        <p id="stickerm" onclick="addstk('&#128561;')" title="FACE SCREAMING IN FEAR">&#128561;</p>
        <p id="stickerm" onclick="addstk('&#128562;')" title="ASTONISHED FACE">&#128562;</p>
        <p id="stickerm" onclick="addstk('&#128563;')" title="FLUSHED FACE">&#128563;</p>
        <p id="stickerm" onclick="addstk('&#128564;')" title="SLEEPING FACE">&#128564;</p>
        <p id="stickerm" onclick="addstk('&#128565;')" title="DIZZY FACE">&#128565;</p>
        <p id="stickerm" onclick="addstk('&#128566;')" title="FACE WITHOUT MOUTH">&#128566;</p>
        <p id="stickerm" onclick="addstk('&#128567;')" title="FACE WITH MEDICAL MASK">&#128567;</p>
        <!-- Start Smileys Supplements-->
        <p id="stickerm" onclick="addstk('&#128577;')" title="">&#128577;</p>
        <p id="stickerm" onclick="addstk('&#128578;')" title="">&#128578;</p>
        <p id="stickerm" onclick="addstk('&#128579;')" title="">&#128579;</p>
        <p id="stickerm" onclick="addstk('&#128580;')" title="">&#128580;</p>
        <p id="stickerm" onclick="addstk('&#129296;')" title="">&#129296;</p>
        <p id="stickerm" onclick="addstk('&#129297;')" title="">&#129297;</p>
        <p id="stickerm" onclick="addstk('&#129298;')" title="">&#129298;</p>
        <p id="stickerm" onclick="addstk('&#129299;')" title="">&#129299;</p>
        <p id="stickerm" onclick="addstk('&#129300;')" title="">&#129300;</p>
        <p id="stickerm" onclick="addstk('&#129301;')" title="">&#129301;</p>
        <p id="stickerm" onclick="addstk('&#129303;')" title="">&#129303;</p>
        <p id="stickerm" onclick="addstk('&#129312;')" title="">&#129312;</p>
        <p id="stickerm" onclick="addstk('&#129314;')" title="">&#129314;</p>
        <p id="stickerm" onclick="addstk('&#129315;')" title="">&#129315;</p>
        <p id="stickerm" onclick="addstk('&#129316;')" title="">&#129316;</p>
        <p id="stickerm" onclick="addstk('&#129317;')" title="">&#129317;</p>
        <p id="stickerm" onclick="addstk('&#129319;')" title="">&#129319;</p>
        <p id="stickerm" onclick="addstk('&#129320;')" title="">&#129320;</p>
        <p id="stickerm" onclick="addstk('&#129321;')" title="">&#129321;</p>
        <p id="stickerm" onclick="addstk('&#129322;')" title="">&#129322;</p>
        <p id="stickerm" onclick="addstk('&#129323;')" title="">&#129323;</p>
        <p id="stickerm" onclick="addstk('&#129325;')" title="">&#129325;</p>
        <p id="stickerm" onclick="addstk('&#129326;')" title="">&#129326;</p>
        <p id="stickerm" onclick="addstk('&#129327;')" title="">&#129327;</p>
        <p id="stickerm" onclick="addstk('&#129392;')" title="">&#129392;</p>
        <p id="stickerm" onclick="addstk('&#129393;')" title="">&#129393;</p>
        <p id="stickerm" onclick="addstk('&#129395;')" title="">&#129395;</p>
        <p id="stickerm" onclick="addstk('&#129396;')" title="">&#129396;</p>
        <p id="stickerm" onclick="addstk('&#129397;')" title="">&#129397;</p>
        <p id="stickerm" onclick="addstk('&#129398;')" title="">&#129398;</p>
        <p id="stickerm" onclick="addstk('&#129324;')" title="">&#129324;</p>
        <p id="stickerm" onclick="addstk('&#129488;')" title="">&#129488;</p>
        <p id="stickerm" onclick="addstk('&#128127;')" title="">&#128127;</p>
        <p id="stickerm" onclick="addstk('&#128128;')" title="">&#128128;</p>
        <!-- End Smileys -->
        <p style="flex:100%; margin-left: 7%;">Cat Faces : </p>
        <p id="stickerm" onclick="addstk('&#128568;')" title="">&#128568;</p>
        <p id="stickerm" onclick="addstk('&#128569;')" title="">&#128569;</p>
        <p id="stickerm" onclick="addstk('&#128570;')" title="">&#128570;</p>
        <p id="stickerm" onclick="addstk('&#128571;')" title="">&#128571;</p>
        <p id="stickerm" onclick="addstk('&#128572;')" title="">&#128572;</p>
        <p id="stickerm" onclick="addstk('&#128573;')" title="">&#128573;</p>
        <p id="stickerm" onclick="addstk('&#128574;')" title="">&#128574;</p>
        <p id="stickerm" onclick="addstk('&#128575;')" title="">&#128575;</p>
        <p id="stickerm" onclick="addstk('&#128576;')" title="">&#128576;</p>
        <p id="stickerm" onclick="addstk('&#128584;')" title="">&#128584;</p>
        <p id="stickerm" onclick="addstk('&#128585;')" title="">&#128585;</p>
        <p id="stickerm" onclick="addstk('&#128586;')" title="">&#128586;</p>
        <!-- End Cat Faces -->
        <p style="flex:100%;margin-left: 7%;">Hands : </p>
        <p id="stickerm" onclick="addstk('&#9995;')" title="">&#9995;</p>
        <p id="stickerm" onclick="addstk('&#128075;')" title="">&#128075;</p>
        <p id="stickerm" onclick="addstk('&#128400;')" title="">&#128400;</p>
        <p id="stickerm" onclick="addstk('&#128406;')" title="">&#128406;</p>
        <p id="stickerm" onclick="addstk('&#129306;')" title="">&#129306;</p>
        <p id="stickerm" onclick="addstk('&#9757;')" title="">&#9757;</p>
        <p id="stickerm" onclick="addstk('&#128070;')" title="">&#128070;</p>
        <p id="stickerm" onclick="addstk('&#128071;')" title="">&#128071;</p>
        <p id="stickerm" onclick="addstk('&#128072;')" title="">&#128072;</p>
        <p id="stickerm" onclick="addstk('&#128073;')" title="">&#128073;</p>
        <p id="stickerm" onclick="addstk('&#128405;')" title="">&#128405;</p>
        <p id="stickerm" onclick="addstk('&#9994;')" title="">&#9994;</p>
        <p id="stickerm" onclick="addstk('&#128074;')" title="">&#128074;</p>
        <p id="stickerm" onclick="addstk('&#128077;')" title="">&#128077;</p>
        <p id="stickerm" onclick="addstk('&#128078;')" title="">&#128078;</p>
        <p id="stickerm" onclick="addstk('&#129307;')" title="">&#129307;</p>
        <p id="stickerm" onclick="addstk('&#129308;')" title="">&#129308;</p>
        <p id="stickerm" onclick="addstk('&#9996;')" title="">&#9996;</p>
        <p id="stickerm" onclick="addstk('&#128076;')" title="">&#128076;</p>
        <p id="stickerm" onclick="addstk('&#129295;')" title="">&#129295;</p>
        <p id="stickerm" onclick="addstk('&#129304;')" title="">&#129304;</p>
        <p id="stickerm" onclick="addstk('&#129305;')" title="">&#129305;</p>
        <p id="stickerm" onclick="addstk('&#129310;')" title="">&#129310;</p>
        <p id="stickerm" onclick="addstk('&#129311;')" title="">&#129311;</p>
        <p id="stickerm" onclick="addstk('&#9997;')" title="">&#9997;</p>
        <p id="stickerm" onclick="addstk('&#128079;')" title="">&#128079;</p>
        <p id="stickerm" onclick="addstk('&#128080;')" title="">&#128080;</p>
        <p id="stickerm" onclick="addstk('&#128133;')" title="">&#128133;</p>
        <p id="stickerm" onclick="addstk('&#129309;')" title="">&#129309;</p>
        <p id="stickerm" onclick="addstk('&#129309;')" title="">&#129309;</p>
        <p id="stickerm" onclick="addstk('&#129330;')" title="">&#129330;</p>
        <p id="stickerm" onclick="addstk('&#129331;')" title="">&#129331;</p>
        <!-- End Hands-->
        <p style="flex:100%;margin-left: 7%;">Flag : </p>
        <img id="FlagIran" src="ico/sticker/iran.png" onclick="addstk('🇮🇷')" title="">

    </div>
    <div id="PanelSend">
        <i id="StickersShow" onclick="ShowSticker()" class='bx bx-happy'></i>
        <div id="MessForSend" contenteditable="true" placeholder="Message">
        </div>
        <label for="file-input">
            <i class='bx bxs-file-image' title="Only PNG" id="Media"> </i>
        </label>
        <div id="ImageList"></div>
        <input type="file" id="file-input" style="display: none;" accept="image/png">
        <i id="SendMess" class='bx bxs-send' onclick="SendMess()"></i>
    </div>
</div>