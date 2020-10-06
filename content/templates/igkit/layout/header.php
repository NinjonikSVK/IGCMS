<?php 
	require_once("../../../config/config.php");
	
	$file = $_SERVER['PHP_SELF'];
	$info = pathinfo($file);
	$file_name =  basename($file,'.'.$info['extension']);
?>
<!-- Start of navbar -->
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?php echo $siteTitle; ?> · <?php echo $file_name; ?></title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">

	<script src="../ckeditor/ckeditor.js"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
	
    <!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	
	<!-- Icons -->
	<link href="../icons/css/all.css" rel="stylesheet">


    <style>
	
	
	
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700,300);
body {
    font: 12px 'Open Sans';
}
.form-control, .thumbnail {
    border-radius: 2px;
}
.btn-danger {
    background-color: #B73333;
}

/* File Upload */
.fake-shadow {
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload #logo-id {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 33px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.img-preview {
    max-width: 100%;
}

body
{
    font-family: 'Open Sans', sans-serif;
}

.fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
}

.fb-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
}

@media (max-width:768px)
{
    
.fb-profile-text>h1{
    font-weight: 700;
    font-size:16px;
}

.fb-image-profile
{
    margin: -45px 10px 0px 25px;
    z-index: 9;
    width: 20%; 
}
}
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

.white-bg {
    background-color: #ffffff;
}
.page-heading {
    border-top: 0;
    padding: 0 10px 20px 10px;
}

.forum-post-container .media {
  margin: 10px 10px 10px 10px;
  padding: 20px 10px 20px 10px;
  border-bottom: 1px solid #f1f1f1;
}
.forum-avatar {
  float: left;
  margin-right: 20px;
  text-align: center;
  width: 110px;
}
.forum-avatar .img-circle {
  height: 48px;
  width: 48px;
}
.author-info {
  color: #676a6c;
  font-size: 11px;
  margin-top: 5px;
  text-align: center;
}
.forum-post-info {
  padding: 9px 12px 6px 12px;
  background: #f9f9f9;
  border: 1px solid #f1f1f1;
}
.media-body > .media {
  background: #f9f9f9;
  border-radius: 3px;
  border: 1px solid #f1f1f1;
}
.forum-post-container .media-body .photos {
  margin: 10px 0;
}
.forum-photo {
  max-width: 140px;
  border-radius: 3px;
}
.media-body > .media .forum-avatar {
  width: 70px;
  margin-right: 10px;
}
.media-body > .media .forum-avatar .img-circle {
  height: 38px;
  width: 38px;
}
.mid-icon {
  font-size: 66px;
}
.forum-item {
  margin: 10px 0;
  padding: 10px 0 20px;
  border-bottom: 1px solid #f1f1f1;
}
.views-number {
  font-size: 24px;
  line-height: 18px;
  font-weight: 400;
}
.forum-container,
.forum-post-container {
  padding: 30px !important;
}
.forum-item small {
  color: #999;
}
.forum-item .forum-sub-title {
  color: #999;
  margin-left: 50px;
}
.forum-title {
  margin: 15px 0 15px 0;
}
.forum-info {
  text-align: center;
}
.forum-desc {
  color: #999;
}
.forum-icon {
  float: left;
  width: 30px;
  margin-right: 20px;
  text-align: center;
}
a.forum-item-title {
  color: inherit;
  display: block;
  font-size: 18px;
  font-weight: 600;
}
a.forum-item-title:hover {
  color: inherit;
}
.forum-icon .fa {
  font-size: 30px;
  margin-top: 8px;
  color: #9b9b9b;
}
.forum-item.active .fa {
  color: #1ab394;
}
.forum-item.active a.forum-item-title {
  color: #1ab394;
}
@media (max-width: 992px) {
  .forum-info {
    margin: 15px 0 10px 0;
    /* Comment this is you want to show forum info in small devices */
    display: none;
  }
  .forum-desc {
    float: none !important;
  }
}





.ibox {
  clear: both;
  margin-bottom: 25px;
  margin-top: 0;
  padding: 0;
}
.ibox.collapsed .ibox-content {
  display: none;
}
.ibox.collapsed .fa.fa-chevron-up:before {
  content: "\f078";
}
.ibox.collapsed .fa.fa-chevron-down:before {
  content: "\f077";
}
.ibox:after,
.ibox:before {
  display: table;
}
.ibox-title {
  -moz-border-bottom-colors: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  background-color: #ffffff;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 3px 0 0;
  color: inherit;
  margin-bottom: 0;
  padding: 14px 15px 7px;
  min-height: 48px;
}
.ibox-content {
  background-color: #ffffff;
  color: inherit;
  padding: 15px 20px 20px 20px;
  border-color: #e7eaec;
  border-image: none;
  border-style: solid solid none;
  border-width: 1px 0;
}
.ibox-footer {
  color: inherit;
  border-top: 1px solid #e7eaec;
  font-size: 90%;
  background: #ffffff;
  padding: 10px 15px;
}

.message-input {
    height: 90px !important;
}
.form-control, .single-line {
    background-color: #FFFFFF;
    background-image: none;
    border: 1px solid #e5e6e7;
    border-radius: 1px;
    color: inherit;
    display: block;
    padding: 6px 12px;
    transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    width: 100%;
    font-size: 14px;
}
.text-navy {
    color: #1ab394;
}
.mid-icon {
    font-size: 66px !important;
}
.m-b-sm {
    margin-bottom: 10px;
}




.contacts li > .info-combo > h3.name{
    font-size:12px;    
}

.contacts li .message-time {
    text-align: right;
    display: block;
    margin-left: -15px;
    width: 70px;
    height: 25px;
    line-height: 28px;
    font-size: 14px;
    font-weight: 600;
    padding-right: 5px;
}
.contacts li > .info-combo > h5 {
    width: 180px;
    font-size: 12px;
    height: 28px;
    font-weight: 500;
    overflow: hidden;
    white-space: normal;
    text-overflow: ellipsis;
}

.contacts li > .info-combo > h3 {
    width: 167px;
    height: 20px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.info-combo > h3 {
    margin: 3px 0;
}

.no-margin-bottom {
    margin-bottom: 0 !important;
}

.info-combo > h5 {
    margin: 2px 0 6px 0;
}
/* Messages */
.messages-panel img.img-circle {
    border: 1px solid rgba(0,0,0,0.1);
}

.medium-image {
    width: 45px;
    height: 45px;
    margin-right: 5px;
}

.img-circle {
    border-radius: 50%;
}
.messages-panel {
  width: 100%;
  height: calc(100vh - 150px);
  min-height: 460px;
  background-color: #fbfcff;
  display: inline-block;
  border-top-left-radius: 5px;
  margin-bottom: 0;
}

.messages-panel img.img-circle {
  border: 1px solid rgba(0,0,0,0.1);
}

.messages-panel .tab-content {
  border: none;
  background-color: transparent;
}

.contacts-list {
  background-color: #fff;
  border-right: 1px solid #cfdbe2;
  width: 305px;
  height: 100%;
  border-top-left-radius: 5px;
  float: left;
}

.contacts-list .inbox-categories {
  width: 100%;
  padding: 0;
  margin-left: 0;
}

.contacts-list .inbox-categories > div {
  float: left;
  width: 76px;
  padding: 15px 5px;
  font-size: 14px;
  text-align: center;
  border-right: 1px solid rgba(0,0,0,0.1);
  background-color: rgba(255,255,255,0.75);
  cursor: pointer;
  font-weight: 700;
}

.contacts-list .inbox-categories > div:nth-child(1) {
  color: #2da9e9;
  border-right-color: rgba(45,129,233,0.06);
  border-bottom: 4px solid #2da9e9;
  border-top-left-radius: 5px;
}

.contacts-list .inbox-categories > div:nth-child(1).active {
  color: #fff;
  background-color: #2da9e9;
  border-bottom: 4px solid rgba(0,0,0,0.15);
}

.contacts-list .inbox-categories > div:nth-child(2) {
  color: #0ec8a2;
  border-right-color: rgba(14,200,162,0.06);
  border-bottom: 4px solid #0ec8a2;
}

.contacts-list .inbox-categories > div:nth-child(2).active {
  color: #fff;
  background-color: #0ec8a2;
  border-bottom: 4px solid rgba(0,0,0,0.15);
}

.contacts-list .inbox-categories > div:nth-child(3) {
  color: #ff9e2a;
  border-right-color: rgba(255,152,14,0.06);
  border-bottom: 4px solid #ff9e2a;
}

.contacts-list .inbox-categories > div:nth-child(3).active {
  color: #fff;
  background-color: #ff9e2a;
  border-bottom: 4px solid rgba(0,0,0,0.15);
}

.contacts-list .inbox-categories > div:nth-child(4) {
  color: #314557;
  border-bottom: 4px solid #314557;
  border-right-color: transparent;
}

.contacts-list .inbox-categories > div:nth-child(4).active {
  color: #fff;
  background-color: #314557;
  border-bottom: 4px solid rgba(0,0,0,0.35);
}

.contacts-list .panel-search > input {
  margin-left: 5px;
  background-color: rgba(0,0,0,0);
}

.contacts-outter-wrapper {
  position: relative;
  width: 305px;
  direction: rtl;
  min-height: 405px;
  overflow: hidden;
}

.contacts-outter-wrapper:after, .contacts-outter-wrapper:nth-child(1):after {
  content: "";
  position: absolute;
  width: 100%;
  height: 5px;
  bottom: 0;
  background-color: #2da9e9;
  border-bottom-left-radius: 4px;
}

.contacts-outter-wrapper:nth-child(2):after {
  background-color: #0ec8a2;
}

.contacts-outter-wrapper:nth-child(3):after {
  background-color: #ff9e2a;
}

.contacts-outter-wrapper:nth-child(4):after {
  background-color: #314557;
}

.contacts-outter {
  position: relative;
  height: calc(100vh - 278px);
  width: 325px;
  direction: rtl;
  overflow-y: scroll;
  padding-left: 20px;
}

@media screen and (min-color-index:0) and(-webkit-min-device-pixel-ratio:0) {
  @media {
    .contacts-outter-wrapper {
      direction: ltr;
    }

    .contacts-outter{
      direction: ltr;
      padding-left: 0;
    }
  }
}

.contacts {
  direction: ltr;
  width: 305px;
  margin-top: 0px;
}

.contacts li {
  width: 100%;
  border-top: 1px solid transparent;
  border-bottom: 1px solid rgba(205,211,237,0.2);
  border-left: 4px solid rgba(255,255,255,0);
  padding: 8px 12px;
  position: relative;
  background-color: rgba(255,255,255,0);
}

.contacts li:first-child {
  border-top: 1px solid rgba(205,211,237,0.2);
}

.contacts li:first-child.active {
  border-top: 1px solid rgba(205,211,237,0.75);
}

.contacts li:hover {
  background-color: rgba(255,255,255,0.25);
}

.contacts li.active, .contacts.info li.active {
  border-left: 4px solid #2da9e9;
  border-top-color: rgba(205,211,237,0.75);
  border-bottom-color: rgba(205,211,237,0.75);
  background-color: #fbfcff;
}

.contacts.success li.active {
  border-left: 4px solid #0ec8a2;
}

.contacts.warning li.active {
  border-left: 4px solid #ff9e2a;
}

.contacts.danger li.active {
  border-left: 4px solid #f95858;
}

.contacts.dark li.active {
  border-left: 4px solid #314557;
}

.contacts li > .info-combo {
  width: 172px;
  cursor: pointer;
}

.contacts li > .info-combo > h3 {
  width: 167px;
  height: 20px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.contacts li .contacts-add {
  width: 50px;
  float: right;
  z-index: 23299;
}

.contacts li .message-time {
  text-align: right;
  display: block;
  margin-left: -15px;
  width: 70px;
  height: 25px;
  line-height: 28px;
  font-size: 14px;
  font-weight: 600;
  padding-right: 5px;
}

.contacts li .contacts-add .fa-trash-o {
  position: absolute;
  font-size: 14px;
  right: 12px;
  bottom: 15px;
  color: #a6a6a6;
  cursor: pointer;
}

.contacts li .contacts-add .fa-paperclip {
  position: absolute;
  font-size: 14px;
  right: 34px;
  bottom: 15px;
  color: #a6a6a6;
  cursor: pointer;
}

.contacts li .contacts-add .fa-trash-o:hover {
  color: #f95858;
}

.contacts li .contacts-add .fa-paperclip:hover {
  color: #ff9e2a;
}

.contacts li > .info-combo > h5 {
  width: 180px;
  font-size: 12px;
  height: 28px;
  font-weight: 500;
  overflow: hidden;
  white-space: normal;
  text-overflow: ellipsis;
}

.contacts li .message-count {
  position: absolute;
  top: 8px;
  left: 5px;
  width: 20px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  background-color: #ff9e2a;
  border-radius: 50%;
  color: #fff;
  font-weight: 600;
  font-size: 10px;
}

.message-body {
  background-color: #fbfcff;
  height: 100%;
  width: calc(100% - 305px);
  float: right;
}

.message-body .message-top {
  display: inline-block;
  width: 100%;
  position: relative;
  min-height: 53px;
  height: auto;
  background-color: #fff;
  border-bottom: 1px solid rgba(205,211,237,0.5);
}

.message-body .message-top .new-message-wrapper {
  width: 100%;
}

.message-body .message-top .new-message-wrapper > .form-group {
  width: 100%;
  padding: 10px 10px 0 10px;
  height: 50px;
}

.message-body .message-top .new-message-wrapper .form-group .form-control {
  width: calc(100% - 50px);
  float: left;
}

.message-body .message-top .new-message-wrapper .form-group a {
  width: 40px;
  padding: 6px 6px 6px 6px;
  text-align: center;
  display: block;
  float: right;
  margin: 0;
}

.message-body .message-top > .btn {
  height: 53px;
  line-height: 53px;
  padding: 0 20px;
  float: right;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  margin: 0;
  font-size: 15px;
  opacity: 0.9;
}

.message-body .message-top > .btn:hover,
.message-body .message-top > .btn:focus,
.message-body .message-top > .btn.active {
  opacity: 1;
}

.message-body .message-top > .btn > i {
  margin-right: 5px;
  font-size: 18px;
}

.new-message-wrapper {
  position: absolute;
  max-height: 400px;
  top: 53px;
  background-color: #fff;
  z-index: 105;
  padding: 20px 15px 30px 15px;
  border-bottom: 1px solid #cfdbe2;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  box-shadow: 0 7px 10px rgba(0,0,0,0.25);
  transition: 0.5s;
  display: none;
}

.new-message-wrapper.closed {
  opacity: 0;
  max-height: 0;
}

.chat-footer.new-message-textarea {
  display: block;
  position: relative;
  padding: 0 10px;
}

.chat-footer.new-message-textarea .send-message-button {
  right: 35px;
}

.chat-footer.new-message-textarea .upload-file {
  right: 85px;
}

.chat-footer.new-message-textarea .send-message-text {
  padding-right: 100px;
  height: 90px;
}

.message-chat {
  width: 100%;
  overflow: hidden;
}

.chat-body {
  width: calc(100% + 17px);
  min-height: 290px;
  height: calc(100vh - 320px);
  background-color: #fbfcff;
  margin-bottom: 30px;
  padding: 30px 5px 5px 5px;
  overflow-y: scroll;
}

.message {
  position: relative;
  width: 100%;
}

.message br {
  clear: both;
}

.message .message-body {
  position: relative;
  width: auto;
  max-width: calc(100% - 150px);
  float: left;
  background-color: #fff;
  border-radius: 4px;
  border: 1px solid #dbe3e8;
  margin: 0 5px 20px 15px;
  color: #788288;
}

.message:after {
  content: "";
  position: absolute;
  top: 11px;
  left: 63px;
  float: left;
  z-index: 100;
  border-top: 10px solid transparent;
  border-left: none;
  border-bottom: 10px solid transparent;
  border-right: 13px solid #fff;
}

.message:before {
  content: "";
  position: absolute;
  top: 10px;
  left: 62px;
  float: left;
  z-index: 99;
  border-top: 11px solid transparent;
  border-left: none;
  border-bottom: 11px solid transparent;
  border-right: 13px solid #dbe3e8;
}

.message .medium-image {
  float: left;
  margin-left: 10px;
}

.message .message-info {
  width: 100%;
  height: 22px;
}

.message .message-info > h5 > i {
  font-size: 11px;
  font-weight: 700;
  margin: 0 2px 0 0;
  color: #a2b8c5;
}

.message .message-info > h5 {
  color: #a2b8c5;
  margin: 8px 0 0 0;
  font-size: 12px;
  float: right;
  padding-right: 10px;
}

.message .message-info > h4 {
  font-size: 14px;
  font-weight: 600;
  margin: 7px 13px 0 10px;
  color: #65addd;
  float: left;
}

.message hr {
  margin: 4px 2%;
  width: 96%;
  opacity: 0.75;
}

.message .message-text {
  text-align: left;
  padding: 3px 13px 10px 13px;
  font-size: 14px;
}

.message.my-message .message-body {
  float: right;
  margin: 0 15px 20px 5px;
}

.message.my-message:after {
  content: "";
  position: absolute;
  top: 11px;
  left: auto;
  right: 63px;
  float: left;
  z-index: 100;
  border-top: 10px solid transparent;
  border-left: 13px solid #fff;
  border-bottom: 10px solid transparent;
  border-right: none;
}

.message.my-message:before {
  content: "";
  position: absolute;
  top: 10px;
  left: auto;
  right: 62px;
  float: left;
  z-index: 99;
  border-top: 11px solid transparent;
  border-left: 13px solid #dbe3e8;
  border-bottom: 11px solid transparent;
  border-right: none;
}

.message.my-message .medium-image {
  float: right;
  margin-left: 5px;
  margin-right: 10px;
}

.message.my-message .message-info > h5 {
  float: left;
  padding-left: 10px;
  padding-right: 0;
}

.message.my-message .message-info > h4 {
  float: right;
}

.message.info .message-body {
  background-color: #2da9e9;
  border: 1px solid #2da9e9;
  color: #fff;
}

.message.info:after, .message.info:before {
  border-right: 13px solid #2da9e9;
}

.message.success .message-body {
  background-color: #0ec8a2;
  border: 1px solid #0ec8a2;
  color: #fff;
}

.message.success:after, .message.success:before {
  border-right: 13px solid #0ec8a2;
}

.message.warning .message-body {
  background-color: #ff9e2a;
  border: 1px solid #ff9e2a;
  color: #fff;
}

.message.warning:after, .message.warning:before {
  border-right: 13px solid #ff9e2a;
}

.message.danger .message-body {
  background-color: #f95858;
  border: 1px solid #f95858;
  color: #fff;
}

.message.danger:after, .message.danger:before {
  border-right: 13px solid #f95858;
}

.message.dark .message-body {
  background-color: #314557;
  border: 1px solid #314557;
  color: #fff;
}

.message.dark:after, .message.dark:before {
  border-right: 13px solid #314557;
}

.message.info .message-info > h4, .message.success .message-info > h4,
.message.warning .message-info > h4, .message.danger .message-info > h4,
.message.dark .message-info > h4 {
  color: #fff;
}

.message.info .message-info > h5, .message.info .message-info > h5 > i,
.message.success .message-info > h5, .message.success .message-info > h5 > i,
.message.warning .message-info > h5, .message.warning .message-info > h5 > i,
.message.danger .message-info > h5, .message.danger .message-info > h5 > i,
.message.dark .message-info > h5, .message.dark .message-info > h5 > i {
  color: #fff;
  opacity: 0.9;
}

.chat-footer {
  position: relative;
  width: 100%;
  padding: 0 80px;
}

.chat-footer .send-message-text {
  position: relative;
  display: block;
  width: 100%;
  min-height: 55px;
  max-height: 75px;
  background-color: #fff;
  border-radius: 5px;
  padding: 5px 95px 5px 10px;
  font-size: 13px;
  resize: vertical;
  outline: none;
  border: 1px solid #e0e6eb;
}

.chat-footer .send-message-button {
  display: block;
  position: absolute;
  width: 35px;
  height: 35px;
  right: 100px;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 1px solid rgba(0,0,0,0.05);
  outline: none;
  font-weight: 600;
  border-radius: 50%;
  padding: 0;
}

.chat-footer .send-message-button > i {
  font-size: 16px;
  margin: 0 0 0 -2px;
}

.chat-footer label.upload-file input[type="file"] {
  position: fixed;
  top: -1000px;
}

.chat-footer .upload-file {
  display: block;
  position: absolute;
  right: 150px;
  height: 30px;
  font-size: 20px;
  top: 0;
  bottom: 0;
  margin: auto;
  opacity: 0.25;
}

.chat-footer .upload-file:hover {
  opacity: 1;
}

@media screen and (max-width: 767px) {
  .messages-panel {
    min-width: 0;
    display: inline-block;
  }

  .contacts-list, .contacts-list .inbox-categories > div:nth-child(4) {
    border-top-right-radius: 5px;
    border-right: none;
  }

  .contacts-list, .contacts-outter-wrapper, .contacts-outter, .contacts {
    width: 100%;
    direction: ltr;
    padding-left: 0;
  }

  .contacts-list .inbox-categories > div {
    width: 25%;
  }

  .message-body {
    width: 100%;
    margin: 20px 0;
    border: 1px solid #dce2e9;
    background-color: #fff;
  }

  .message .message-body {
    max-width: calc(100% - 85px);
  }

  .message-body .chat-body {
    background-color: #fff;
    width: 100%;
  }

  .chat-footer {
    margin-bottom: 20px;
    padding: 0 20px;
  }

  .chat-footer .send-message-button {
    right: 40px;
  }

  .chat-footer .upload-file {
    right: 90px;
  }

  .message-body .message-top > .btn {
    border-radius: 0;
    width: 100%;
  }

  .contacts-add {
    display: none;
  }
}

/* Profile page */

.profile-main {
  background-color: #fff;
  border: 1px solid #dce2e9;
  border-radius: 3px;
  position: relative;
  margin-bottom: 20px;
}

.profile-main .profile-background {
  background-image: url('../images/samples/forest.png');
  background-repeat: no-repeat;
  background-size: 100%;
  background-position: center;
  width: 100%;
  height: 260px;
}

.profile-main .profile-info {
  width: calc(100% - 380px);
  max-width: 1100px;
  margin: 0 auto;
  background-color: #fff;
  height: 70px;
  border-radius: 0 0 3px 3px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.profile-main .profile-info > div {
  margin: 0 10px;
}

.profile-main .profile-info > div:last-child {
  padding-right: 25px;
}

.profile-main .profile-info > div h4 {
  font-size: 16px;
  margin-bottom: 0;
}

.profile-main .profile-info > div h5 {
  margin-top: 5px;
  font-weight: 500;
}

.profile-main .profile-button {
  padding: 8px 0;
  position: absolute;
  right: 25px;
  bottom: 16px;
  width: 150px;
}

.profile-main .profile-picture {
  width: 150px;
  height: 150px;
  border: 4px solid #fff;
  position: absolute;
  left: 25px;
  bottom: 14px;
}

@media screen and (max-width: 767px) {
  .profile-main .profile-info .profile-status,
  .profile-main .profile-info .profile-posts,
  .profile-main .profile-info .profile-date {
    display: none;
  }
}

.contacts li > .info-combo {
   display:inline-block;
}
    </style>
    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="index"><?php echo $siteTitle; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
			  <li class="nav-item">
				<a class="nav-link" href="index"><?php echo $l["home"]; ?></a>
			  </li>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <?php echo $l["sites"]; ?>
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="posts"><?php echo $l["news"]; ?></a>
				  <a class="dropdown-item" href="downloads"><?php echo $l["to_download"]; ?></a>
				  <a class="dropdown-item" href="chat"><?php echo $l["chat"]; ?></a>
				  <div class="dropdown-divider"></div>
				  <?php

					$stmtp = $db->prepare('SELECT pageID, pageTitle FROM pages');
					$stmtp->execute(array());
					$rowp = $stmtp->fetch(PDO::FETCH_ASSOC);

					if (!$stmtp->execute()) {
						print_r($stmt->errorInfo());
					}

					while ($rowp = $stmtp->fetch(PDO::FETCH_ASSOC)) {
							echo '
							<a class="dropdown-item" href="viewpage?id='.$rowp["pageID"].'">'.$rowp["pageTitle"].'</a>
							';
					}

					?>
				</div>
			  </li>
			  <?php if($user->is_logged_in())
				{
				echo('
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  '.$l["support"].'
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="mytickets">'.$l["my_tickets"].'</a>
				  <a class="dropdown-item" href="addticket">'.$l["add_new_ticket"].'</a>
				</div>
			  </li>');
				}
			?>
			  <li class="nav-item">
				<a href="forums" class="nav-link">
					<?php echo $mk["forum"]; ?>
				</a>
			</li>
			<?php

			if(!$user->is_logged_in())
			{
			echo('
			 <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  '.$l["profile"].'
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="register">'.$l["registerpage"].'</a>
				  <a class="dropdown-item" href="login">'.$l["login"].'</a>
				  <a class="dropdown-item" href="reset">'.$l["resetpass"].'</a>
				</div>
			  </li>
			');
			} else {

				$pocetno = $db->query("SELECT count(*) FROM notifications WHERE notUser='".$_SESSION["username"]."'")->fetchColumn();

			echo ('
				<li class="nav-item">
					<a class="nav-link" href="notifications"><i class="fas fa-bell"></i> '.$pocetno.'</a>
				</li>
				 <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  <img src="'.$grav_urls.'" alt="Circle Image" class="thumbnail rounded-circle" height="15" widht="15"> '.$l["profile"].'
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					  <a class="dropdown-item" href="profile?id='.$_SESSION["memberID"].'">'.$l["my_profile"].'</a>
					  <a class="dropdown-item" href="editprofile">'.$l["edit_profile"].'</a>
					  <a class="dropdown-item" href="logout">'.$l["log_out"].'</a>
					</div>
				  </li>
			');
			};

			$rowg = getperm('canviewdashboard')["canviewdashboard"];
			if ($rowg == 0) {
				echo '';
			} else if ($rowg == 1) {
				echo '
					<li class="nav-item">
						<a class="nav-link" href="../../adminlte/pages/index">'.$l["administration"].'</a>
					</li>
				';
			} else {
				echo 'Error, group permission error.';
			}

			?>
        </ul>
      </div>
    </nav>
	<?php 
		$action = $_GET["action"];
		
		if ($action == 'fffffff' ){
			echo '';
		} else if ($action == 'joined' ){
			echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <b>'.$mk["alert_success"].':</b> '.$mk["alert_registration"].'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			';
		} else if ($action == 'invalidresolution' ){
			echo '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <b>'.$mk["alert_error"].':</b> '.$mk["alert_image"].' '.$_GET['width'].'x'.$_GET['height'].'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			';
		} else if ($action == 'installed' ){
			unlink("install.php");
		} else if ($action == 'fileisnotanimage' ){
			echo '
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <b>'.$mk["alert_error"].':</b> '.$mk["alert_image2"].' .'.$_GET['filetype'].'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			';
		} else if ($action == 'loggedout' ){
			echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				 <b>'.$mk["alert_success"].':</b> '.$mk["logged_off"].'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			';
		} else if ($action == 'loggedin' ){
			echo '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				 <b>'.$mk["alert_success"].':</b> '.$mk["logged_in"].'
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			';
		} else if ($action == 'eeeeeeeeee' ){
			echo '';
		}
	?>
<!-- End of navbar -->