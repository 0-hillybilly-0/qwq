<?php 
require_once("includes/config.php"); 
require_once("includes/classes/ButtonProvider.php"); 
require_once("includes/classes/User.php"); 
require_once("includes/classes/Video.php"); 
require_once("includes/classes/VideoGrid.php"); 
require_once("includes/classes/VideoGridItem.php");
require_once("includes/classes/SubscriptionsProvider.php"); 
require_once("includes/classes/NavigationMenuProvider.php"); 

$usernameLoggedIn = User::isLoggedIn() ? $_SESSION["userLoggedIn"] : "";
$userLoggedInObj = new User($con, $usernameLoggedIn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>www.qwq.移动</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    <script src="assets/js/commonActions.js"></script>
    <script src="assets/js/userActions.js"></script>

</head>

<header>
    <img
      src="assets/images/icons/banner.jpg"
      alt="banner" class="banner" width="100%" height="200">
  </header>

<style>
    html,
    body {
        height: 100%;
        padding: 0;
        margin: 0;
        background-color: #3f3f3f;
    }

    a:hover {
        text-decoration: none;
    }

    #pageContainer {
        width: 100%;
        height: 100%;
        background-color: #fafafa;
    }

    #mastHeadContainer {
        width: 100%;
        height: 56px;
        position: fixed;
        top: 0;
        left: 0;
        padding: 7px 16px;
        box-sizing: border-box;
        border-bottom: 1px solid #e8e8e8;
        background-color: transparent;
        z-index: 1;
        display: flex;
        align-items: center;
    }

    #mastHeadContainer button:not(.searchButton),
    #mastHeadContainer .rightIcons img {
        cursor: pointer;
        width: 40px;
        height: 40px;
        padding: 8px;
        box-sizing: border-box;
        border: none;
        background-color: transparent;
    }

    #mastHeadContainer .rightIcons {
        height: 100%;
    }

    #mastHeadContainer button img {
        width: 100%;
    }

    #mastHeadContainer .logoContainer {
        width: 150px;
    }

    #mastHeadContainer .logoContainer img {
        height: 25px;
        margin-left: 8px;
    }

    #sideNavContainer {
        width: 240px;
        background-color: #000;
        padding-top: 56px;
        position: fixed;
        top: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
    }

    #mainSectionContainer {
        padding-top: 56px;
        display: flex;
    }

    #mainSectionContainer.leftPadding {
        padding-left: 240px;
    }

    #mainContentContainer {
        padding: 10px 30px;
        display: flex;
        flex: 1;
        background-color: #fafafa;
        box-sizing: border-box;
    }

    #mastHeadContainer .searchBarContainer {
        margin: 0 40px;
        flex: 1;
        display: flex;
    }

    #mastHeadContainer .searchBarContainer form {
        flex: 1;
        display: flex;
    }

    #mastHeadContainer .searchBarContainer .searchBar {
        flex: 1;
        max-width: 600px;
        color: #111;
        padding: 2px 6px;
        font-size: 14px;
        font-weight: 100;
        border: 1px solid #ccc;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
        border-right: none;
        height: 32px;
        box-shadow: #eee 0px 1px 2px 0px inset;
    }

    #mastHeadContainer .searchBarContainer .searchButton {
        height: 32px;
        background-color: #f8f8f8;
        border: 1px solid #d3d3d3;
        border-bottom-right-radius: 2px;
        border-top-right-radius: 2px;
        cursor: pointer;
        width: 65px;
    }

    #mastHeadContainer .searchBarContainer .searchButton img {
        height: 20px;
        width: 20px;
    }

    .column {
        flex-grow: 1;
        background-color: #fff;
        min-height: 300px;
        padding: 20px;
        box-shadow: rgba(0, 0, 0, 0.1) 0 1px 2px;
    }

    .signInContainer {
        background-color: #efefee;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .signInContainer .column .header img {
        width: 100px;
    }

    .signInContainer .column {
        flex-grow: 0;
        width: 450px;
        padding: 20px 35px;
        max-height: 100%;
        overflow-y: auto;
    }

    .signInContainer .column .header {
        padding: 20px 0;
        color: #fff;
    }

    .signInContainer .column .header h3 {
        font-size: 24px;
        font-weight: 400;
        line-height: 32px;
        margin: 0;
        padding-bottom: 0;
        padding-top: 16px;
        color: #fff;
    }

    .signInContainer .column .header span {
        font-size: 14px;
    }

    .signInContainer .column .loginForm {
        padding-top: 24px;
    }

    .signInContainer .column form {
        display: flex;
        flex-direction: column;
        color: #000;
    }

    .signInContainer .column form input[type="text"],
    .signInContainer .column form input[type="email"],
    .signInContainer .column form input[type="password"] {
        font-size: 14px;
        margin: 10px 0;
        border: none;
        border-bottom: 1px solid #dedede;
        color: #000;
    }

    .signInContainer .column form input[type="submit"] {
        background: #4285f4;
        color: #fff;
        height: 36px;
        width: 88px;
        border: none;
        border-radius: 3px;
        font-weight: 500;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .signInMessage {
        font-size: 14px;
        font-weight: 400;
        color: #212529;
    }

    .errorMessage {
        color: #f00;
        font-size: 14px;
        font-weight: 400;
        text-align: center;
    }

    .watchLeftColumn {
        flex: 1;
    }

    .watchLeftColumn .videoPlayer {
        width: 100%;
    }

    .suggestions {
        max-width: 425px;
        flex-grow: 1;
        height: 100%;
        padding-left: 24px;
    }

    .videoInfo {
        width: 100%;
        padding: 20px 0 8px 0;
    }

    .videoInfo h1 {
        display: block;
        overflow: hidden;
        font-size: 18px;
        font-weight: 400;
        line-height: 24px;
    }

    .videoInfo .bottomSection {
        display: flex;
    }

    .videoInfo .bottomSection .viewCount {
        color: rgba(17, 17, 17, 0.6);
        font-size: 16px;
        flex: 1;
    }

    .videoInfo .bottomSection .controls {
        flex: 1;
        text-align: right;
    }

    .videoInfo .bottomSection .controls button {
        padding: 0;
        background-color: transparent;
        border: none;
        color: rgba(17, 17, 17, 0.4);
        font-weight: 500;
        font-size: 13px;
        cursor: pointer;
    }

    .videoInfo .bottomSection .controls button img {
        height: 20px;
        width: 20px;
        margin: 4px 8px 8px 8px;
    }

    .secondaryInfo .topRow {
        display: flex;
        margin-bottom: 12px;
    }

    .profilePicture {
        height: 100%;
    }

    .secondaryInfo .topRow .profilePicture {
        margin-right: 16px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
    }

    .secondaryInfo .topRow .uploadInfo {
        flex: 1;
        display: flex;
        flex-direction: column;
        margin-right: 10px;
    }

    .secondaryInfo .topRow .uploadInfo .date {
        color: rgba(17,17,17,0.6);
        font-size: 13px;
        font-weight: 400;
    }

    .secondaryInfo .descriptionContainer {
        margin-left: 64px;
        max-width: 615px;
        font-size: 14px;
        font-weight: 400;
        line-height: 21px;
    }

    .secondaryInfo {
        border-bottom: 1px solid #dedede;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .secondaryInfo .topRow .button {
        padding: 6px 15px;
        cursor: pointer;
        font-weight: 500;
        border-radius: 2px;
        border: none;
        font-size: 14px;
    }

    .secondaryInfo .topRow .subscribeButtonContainer,
    .secondaryInfo .topRow .editVideoButtonContainer {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .subscribeButtonContainer .subscribe {
        background-color: #f00;
        color: #fff;
    }

    .subscribeButtonContainer .unsubscribe {
        background-color: #eee;
        color: rgba(17,17,17,0.6);
    }

    .editVideoButtonContainer .edit {
        background-color: #2692e6;
        color: #fff;
    }

    .secondaryInfo .topRow .uploadInfo .owner a {
        font-size: 14px;
        font-weight: 500;
        color: #000;
    }

    .commentSection .header {
        margin-top: 24px;
        margin-bottom: 32px;
        display: flex;
        flex-direction: column;
    }

    .commentSection .header .commentForm .profilePicture,
    .commentSection .comment .profilePicture,
    .commentForm .profilePicture {
        margin-right: 16px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
    }

    .commentSection .header .commentCount {
        margin-bottom: 24px;
    }

    .commentSection .header .commentForm,
    .itemContainer .commentForm {
        display: flex;
    }

    .commentSection .header .commentForm textarea,
    .itemContainer .commentForm textarea {
        flex: 1;
        border: none;
        background-color: transparent;
        font-size: 14px;
        color: #111;
        resize: none;
    }

    .itemContainer .commentForm textarea {
        height: 30px;
    }

    .commentSection .header .commentForm .postComment,
    .itemContainer .commentForm .postComment,
    .itemContainer .commentForm .cancelComment {
        height: 36px;
        background-color: #2692e6;
        color: #fff;
        font-weight: 500;
        border: none;
        padding: 0 15px;
        border-radius: 2px;
    }

    .itemContainer .commentForm .cancelComment {
        background-color: transparent;
        color: rgba(17,17,17,0.6);
    }

    .itemContainer .commentForm .cancelComment:hover {
        color:#000;
    }

    .commentSection .itemContainer {
        margin-bottom: 16px;
    }

    .commentSection .comment {
        display: flex;
    }

    .commentSection .commentHeader {
        margin-bottom: 2px;
    }

    .commentSection .comment .username {
        margin-right: 8px;
        color: #111;
        font-size: 13px;
        font-weight:500;
    }

    .commentSection .comment .body {
        font-size: 14px;
        font-weight: 400;
        line-height: 20px;
    }

    .itemContainer .controls {
        margin-left: 64px
    }

    .itemContainer .controls button,
    .itemContainer .controls .likesCount {
        height: 32px;
        background-color: transparent;
        border: none;
        font-size: 13px;
        font-weight: 500;
        color: rgba(17,17,17,0.6);
    }

    .itemContainer .controls button {
        cursor: pointer;
    }

    .itemContainer .controls .likesCount {
        margin: 0 5px;
    }

    .itemContainer .controls button img {
        height: 16px;
    }

    .itemContainer .commentForm .profilePicture {
        width: 30px;
        height: 30px;
    }

    .commentSection .comment .timestamp {
        color: #888;
        font-size: 13px;
        font-weight: 400;
        line-height: 18px;
    }

    .hidden {
        display: none !important;
    }

    .comments .repliesSection {
        padding-left: 64px;
        margin-top : 16px;
    }

    .commentSection .itemContainer .viewReplies {
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
    }

    .videoGrid {
        display: flex;
        flex-wrap: wrap;
    }

    .suggestions .videoGridItem {
        display: flex;
        height: auto;
    }

    .videoGridItem {
        height: 200px;
        margin-right: 4px;
        margin-bottom: 24px;
    }

    .videoGridItem .thumbnail {
        width: 210px;
        height: 118px;
        position: relative;
    }

    .suggestions .videoGridItem .thumbnail {
        margin-right: 8px;
    }

    .videoGridItem .thumbnail img {
        width: 100%;
        height: 100%;
    }

    .videoGridItem .thumbnail .duration {
        bottom: 0;
        right: 0;
        position: absolute;
        margin: 4px;
        color: #fff;
        background-color: rgba(17,17,17,0.8);
        opacity: 0.8;
        padding: 2px 4px;
        border-radius: 2px;
        letter-spacing: 0.5px;
        font-size: 12px;
        font-weight: 500;
        line-height: 12px;
        Font-family: MS Sans Serif, sans-serif;
    }

    .videoGridItem .details {
        padding-right: 24px;
        position: relative;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        width: 210px;
        color: #fff;
        Font-family: MS Sans Serif, sans-serif;
    }

    .suggestions .videoGridItem .details {
        padding-right: 0;
        flex: 1;
        Font-family: MS Sans Serif, sans-serif;
    }

    .videoGridItem .details .title {
        margin: 8px 0;
        max-height: 32px;
        overflow: hidden;
        font-size: 14px;
        font-weight: 500;
        line-height: 16px;
        color: #fff;
        font-family: Papyrus, fantasy;
    }

    .videoGridItem .details .username,
    .videoGridItem .details .stats {
        color: #fff;
        font-size: 13px;
        overflow-x: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: Papyrus, fantasy;
    }

    .videoGridHeader {
        display: flex;
        margin: 10px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    .videoGridHeader div {
        flex: 1;
        color: #fff;
    }

    .videoGrid.large {
        flex-direction: column;
        flex: 1;
    }

    .videoGrid.large .videoGridItem {
        height: auto;
        display: flex;
    }

    .videoGrid.large .videoGridItem .thumbnail {
        width: 266px;
        height: 138px;
        margin-right: 16px;
    }

    .videoGrid.large .videoGridItem .details {
        max-width: 600px;
        flex: 1;
    }

    .videoGrid.large .videoGridItem .details .title {
        font-size: 18px;
        line-height: 24px;
    }

    .videoGridItem .details .description {
        color: rgba(17,17,17,0.6);
        font-size: 13px;
        font-weight: 500;
    }

    .largeVideoGridContainer {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .videoGridHeader .right {
        text-align: right;
    }

    .videoGridHeader a {
        color: #fff;
    }

    .videoGridHeader a:after {
        content: ' |'
    }

    .videoGridHeader a:last-child:after {
        content: ''
    }

    .signInLink {
        color: #f00;
        margin-left: 15px;
    }

    #sideNavContainer .navigationItems {
        overflow-y: auto;
        color: #fff;
    }

    #sideNavContainer .navigationItem {
        height: 40px;
        display: flex;
        color: #fff;
    }

    #sideNavContainer .navigationItem img {
        height: 18px;
        margin-right: 27px;
        color: #fff;
    }

    #sideNavContainer .navigationItem span {
        flex: 1;
        color: #fff;
        font-size: 14px;
    }

    #sideNavContainer .navigationItem a {
        flex: 1;
        display: flex;
        align-items: center;
        padding: 0 24px;
        color: #fff;
    }

    #sideNavContainer .navigationItem a:hover {
        background-color: rgba(0,0,0, 0.04);
    }

    #sideNavContainer .heading {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
        padding: 10px 24px 0;
        border-top: 1px solid #ededed;
        display: block;
    }

    .profileContainer {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .coverPhotoContainer {
        height: 200px;
        flex: 1;
        position: relative;
    }

    .coverPhotoContainer .coverPhoto {
        width: 100%;
        object-fit: cover;
        max-height: 100%;
        vertical-align: middle;
    }

    .coverPhotoContainer .channelName {
        position: absolute;
        top: calc(50% - 40px);
        font-size: 50px;
        color: #fff;
        text-align: center;
        width: 100%;
        letter-spacing: 5px;
    }

    .profileHeader {
        padding: 15px 100px 0 100px;
        display: flex;
        height: 100px;
    }

    .userInfoContainer {
        flex: 1;
        display: flex;
    }

    .profileHeader .userInfoContainer .profileImage {
        height: 80px;
        width: 80px;
    }

    .profileHeader .userInfo {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .profileHeader .userInfo .title {
        font-size: 24px;
        font-weight: 400;
        color: #111;
    }

    .profileHeader .userInfo .subscriberCount {
        font-size: 14px;
        color: rgba(17,17,17,0.6);
    }

    .profileHeader .buttonContainer {
        flex: 1;
        display: flex;
        justify-content: flex-end;
    }

    .profileHeader .buttonContainer .buttonItem {
        align-items: center;
        display: flex;
    }

    .profileHeader .buttonContainer .buttonItem button {
        padding: 10px 15px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        border-radius: 2px;
        cursor: pointer;
    }

    .profileContainer .channelContent {
        padding: 20px;
        background-color: #3b3b3b;
        border: 1px solid #3b3b3b;
        border-top: none;
    }

    .nav-item a {
        color: rgba(17,17,17,0.6);
    }

    .channelContent .section .values {
        color: rgba(17,17,17,0.6);
        display: flex;
        flex-direction: column;
    }

    .formSection:not(:last-child) {
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #dedede
    }

    .settingsContainer form {
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .editVideoContainer {
        display: flex;
        flex-direction: column;
    }

    .editVideoContainer .topSection {
        display: flex;
    }

    .topSection .videoPlayer {
    max-height: 300px;
    flex: 1;
    }

    .editVideoContainer .topSection .thumbnailItemsContainer {
        display: flex;
        flex-direction: column;
        margin: 0 10px;
        width: 210px;
    }

    .editVideoContainer .topSection .thumbnailItemsContainer .thumbnailItem {
        margin-bottom: 10px;
        padding: 2px;
    }

    .editVideoContainer .topSection .thumbnailItemsContainer .thumbnailItem.selected {
    border: 3px solid #828282;
    }

    .editVideoContainer .topSection .thumbnailItemsContainer .thumbnailItem img {
        width: 100%;
        cursor: pointer;
    }

    #footerDiv {
      clear: both;
      width: 875px;
      margin-top: 12px;
      padding-bottom: 12px;
      font-size: 11px;
    }

    #ad-container {
      position: fixed;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);

      padding: 10px;
      width: 300px;
      text-align: center;
    }

    #ad-container img {
      max-width: 100%;
      max-height: 100px;
    }
</style>


<body>
    
    <div id="pageContainer" style="background-color: #3f3f3f;">

        <div id="mastHeadContainer" style="background-color: #000; border-bottom: 1px solid #000;">
            <button class="navShowHide">
                <img src="assets/images/icons/menu.png">
            </button>

            <a class="logoContainer" href="index.php">
                <img src="assets/images/icons/bruh.png" title="logo" alt="Site logo" style="width: 40px; height: 40px;">
            </a>

            <div class="searchBarContainer">
                <form action="search.php" method="GET">
                    <input type="text" class="searchBar" name="term" placeholder="Search...">
                    <button class="searchButton">
                        <img src="assets/images/icons/search.png">
                    </button>
                </form>
            </div>

            <div class="rightIcons">
                <a href="upload.php">
                    <img class="upload" src="assets/images/icons/upload1.png" style="width: 50px; height: 50px;">
                </a>
                <?php echo ButtonProvider::createUserProfileNavigationButton($con, $userLoggedInObj->getUsername()); ?>
            </div>

        </div>

        <div id="sideNavContainer" style="display:none;">
            <?php
            $navigationProvider = new NavigationMenuProvider($con, $userLoggedInObj);
            echo $navigationProvider->create();
            ?>
        </div>

        <div id="mainSectionContainer" style="background-color: #3f3f3f;">
            <div id="mainContentContainer" style="background-color: #3f3f3f">