<?php
require_once("config.php");
require_once("user/protect.php");
?>

<!doctype HTML>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo($sitename); ?></title>
    <!-- Bulma is included -->
    <link rel="stylesheet" href="css/main.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> 
    <!-- <script src="admintable.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  </head>
  <body>
    <div id="app">
      <nav id="navbar-main" class="navbar is-fixed-top is-dark">
        <div class="navbar-brand">
          <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
            <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
          </a>
        </div>
        <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
		<div class="navbar-end is-flex justify-content-center">
			<a href="https://toolkitsforsuccess.com" title="About" class="navbar-item has-divider is-desktop-icon-only">
			<span class="icon"><i class="mdi mdi-help-circle-outline"></i></span>
			<span>About</span>
			</a>
			<hr class="navbar-divider">
            <a href="logout.php" class="navbar-item">
              <span class="icon"><i class="mdi mdi-logout"></i></span>
              <span>Log Out</span>
            </a>
		</div>
		</div>
      </nav> <!-- END NAV -->
      <aside class="aside is-placed-left is-expanded is-dark">
        <div class="aside-tools">
          <div class="aside-tools-label mt-2">
            <img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
          </div>
        </div>
        <div class="menu is-menu-main">
          <p class="menu-label">Admin</p>
          <ul class="menu-list">
            <li>
              <a href="admin.php" class="has-icon is-active">
                <span class="icon has-update-mark"><i class="mdi mdi-account-multiple"></i></span>
                <span class="menu-item-label">Awesome Prompts</span>
              </a>
            </li>
            <li>
              <a href="login.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-login"></i></span>
                <span class="menu-item-label">User Login</span>
              </a>
            </li>
          </ul>
          <p class="menu-label">About</p>
          <ul class="menu-list">
            <li>
              <a href="https://toolkitsforsuccess.com" target="_blank" class="has-icon">
                <span class="icon"><i class="mdi mdi-web"></i></span>
                <span class="menu-item-label">Toolkits For Success</span>
              </a>
            </li>
            <li>
              <a href="https://toolkitsforsuccess.com" class="has-icon">
                <span class="icon"><i class="mdi mdi-help-circle"></i></span>
                <span class="menu-item-label">About</span>
              </a>
            </li>
            <hr>
            <li>
              <a href="logout.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-logout"></i></span>
                <span class="menu-item-label">Logout User</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>
      <section class="section">
			<div class="container">
				<div class="columns">
				<div class="column is-6 is-offset-3">
					<div class="box">
					<div class="loader-wrapper" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background: rgba(255, 255, 255, 0.5); display: none; justify-content: center; align-items: center; z-index: 1;">
					<div class="loader is-loading" style="height: 80px; width: 80px;"></div>
					</div>
						<div class="logo-section has-text-centered">
							<figure class="image mb-5 has-text-centered is-inline-flex">
								<img class="logo-image" src="<?php echo($logo); ?>">
							</figure>
						</div>
						<div class="prompt-selector-section">
							<div class="columns">
								<div class="column">
									<div class="select is-9">
										<select id="promptselector" class="promptselector" autocomplete="off"></select>
									</div>
								</div>
								<div class="column is-narrow">
									<?php if ($masterkeymode==false && $runbutton==true) {echo('<button type="button" class="button is-small is-info jb-modal" data-target="api-key-modal" id="apibutton">API KEY</button>');} ?>
								</div>
							</div>
							
						</div>
						<div>
							<input type="input" style="display:none;" id="apikeystorage" value="<?php if ($masterkeymode==true){echo($masterapikey);}else{echo($_SESSION["user"]["user_apikey"]);} ?>" />
						</div>
						<div class="prompt-display-section mt-3">
							<div id="promptdata" class="content" >
								<div contentEditable="true" id="innerprompt" class="innerprompt" style="border: 1px solid #b5b5b5; padding: 1rem;">I want you to act as an academician. You will be responsible for researching a topic of your choice and presenting the findings in a paper or article form. Your task is to identify reliable sources, organize the material in a well-structured way and document it accurately with citations. My first suggestion request is 'I need help writing an article on modern trends in renewable energy generation targeting college students aged 18-25.'</div>
							</div>
							<div id="copy-prompt-message" class="copy-prompt-message has-text-success has-text-weight-bold has-text-centered mb-3"></div>
							<div class="buttons">
								<button type="button" class="button is-primary" id="copybutton">COPY PROMPT</button>
								<?php if ($runbutton==true){echo('<button type="button" class="button is-success" id="runbutton">RUN PROMPT</button>');}  ?>
							</div>
						</div>
						
					</div>  <!-- Box END -->
				</div>  <!-- Column END -->
				</div> <!-- Columns END -->
			</div> <!-- Container END -->
		</section>
      
      <footer class="footer">
        <div class="container-fluid">
          <div class="level">
            <div class="level-left">
              <div class="level-item">
                © 2023, ToolkitsForSuccess.com
              </div>
              <div class="level-item">
                <a href="https://toolkitsforsuccess.com" style="height: 20px">
                  <img src="https://img.shields.io/badge/release-v1.0.0-lightgrey">
                </a>
              </div>
            </div>
            <div class="level-right">
              <div class="level-item">
                <div class="logo">
                  <a href="https://toolkitsforsuccess.com"><img src="img/ToolkitsForSuccess_logo.png" alt="ToolkitsForSuccess.com"></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>

    <!-- Modal View -->
	<div id="api-key-modal" class="modal">
		<div class="modal-background jb-modal-close"></div>
		<div class="modal-card">
			<header class="modal-card-head">
			<p class="modal-card-title">OpenAI API Key</p>
			<button class="delete jb-modal-close" aria-label="close"></button>
			</header>
			<section class="modal-card-body">
			<label for="apikeystorage-modal">Set Key:</label>
			<input type="input" id="apikeystorage-modal" class="inputbox" style="width:50%" value="<?php if ($masterkeymode==true){echo($masterapikey);}else{echo($_SESSION["user"]["user_apikey"]);} ?>" />
			</section>
			<footer class="modal-card-foot">
			<button class="button jb-modal-close">Cancel</button>
			<button class="button is-success" id="savekeybutton">Save</button>
			</footer>
		</div>
		<button class="modal-close is-large jb-modal-close" aria-label="close"></button>
	</div>
		
	<!-- Scripts below are for demo only -->
    <script type="text/javascript" src="js/main.min.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
	<script>

		var smq = {
			Popup: function(config) {

				this.conf = config || {};

				this.init = function() {
				var conf = config || {};
				
				var existingNodes = document.getElementsByTagName("smq-popup");
				if(existingNodes && existingNodes.length > 0) {
					for(var i = 0; i<existingNodes.length; i++) {
					document.body.removeChild(existingNodes[i]);
					}
				}

				
				this.nodePopup = document.createElement("smq-popup");
				this.nodePopup.innerHTML = '<div class="window"><a class="close">x</a class="close"><header class="api-header"><h1 class="api-title"></h1></header><div class="api-content"></div></div>';
				this.nodePopup.getElementsByClassName("api-title")[0].innerHTML = this.conf.title || "";
				this.nodePopup.getElementsByClassName("api-content")[0].innerHTML = this.conf.innerHtml || "";

				
				this.nodeClose = this.nodePopup.getElementsByClassName("close")[0];
				this.nodeClose.addEventListener("click", function() {
					this.close();
				}.bind(this), false);
				};

				this.show = function() {
				
				document.body.appendChild(this.nodePopup);
				};

				this.close = function() {
				this.nodePopup ? document.body.removeChild(this.nodePopup) : null;
				this.nodePopup = undefined;
				};

				this.init(config);

			}
		};

					
		function enableselect(){
			document.getElementById('promptselector').disabled=false; 
			document.getElementById('copybutton').disabled=false;
			document.getElementById('runbutton').disabled=false; 
			//document.getElementById('logoutbutton').disabled=false;
			//document.getElementById('modebutton').disabled=false;
			var apielement =  document.getElementById('apibutton');
			if (typeof(apielement) != 'undefined' && apielement != null)
			{
			apielement.disabled=false;	
			}	

			document.getElementById('page-overlay').style.display='none';
		}

		function disableselect(){
			document.getElementById('promptselector').disabled=true;
			document.getElementById('copybutton').disabled=true;
			document.getElementById('runbutton').disabled=true;
			//document.getElementById('logoutbutton').disabled=true;
			//document.getElementById('modebutton').disabled=true;
			var apielement =  document.getElementById('apibutton');
			if (typeof(apielement) != 'undefined' && apielement != null)
			{
			apielement.disabled=true;	
			}	
			
		}

		!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e="undefined"!=typeof globalThis?globalThis:e||self).tint=t()}(this,(function(){"use strict";return function(e,{items:t=[],typeSpeed:n=100,deleteSpeed:o=50,delayBetweenItems:i=2e3,loop:r=!0,startDelay:s=0,startsAtIndex:l=0,cursor:d=!0,cursorChar:c="|",cursorCharBlinkSpeed:u=500,cursorCharBlinkTransitionSpeed:a=.15,startOnView:f=!0,startOnViewOffset:p=0}={}){if(!t.length)throw new Error("tint: No items option was provided");let m,y,w,g,h=!1,T=l,C=t[T],b=e.getBoundingClientRect();const v=document.createElement("span");function x(s){const l=s.length,d=t[T%l];if(h?(m=o,C=d.substring(0,C.length-1)):C=d.substring(0,C.length+1),e.textContent=`${C}`,!r&&C===s[l-1])return enableselect(),clearTimeout(w),clearTimeout(y),void clearInterval(g);h||C!==d?h&&""===C&&(h=!1,T++,m=n):(h=!0,m=i),w=setTimeout((function(){x(t)}),m)}v.textContent=c,d&&(e.insertAdjacentElement("afterend",v),v.style.transition=`opacity ${a}s`,g=setInterval((()=>{v.style.opacity="0"===v.style.opacity?"1":"0"}),u)),e.textContent=t[0],!f||b.bottom<=window.innerHeight&&b.top>=0?y=setTimeout((function(){x(t)}),s-i):window.addEventListener("scroll",(function n(){b=e.getBoundingClientRect(),b.bottom<=window.innerHeight-p&&b.top>=0+p&&(y=setTimeout((function(){x(t)}),s-i),window.removeEventListener("scroll",n))}),!1)}}));				
					
		document.getElementById('promptselector').addEventListener('change', function() {
			var promptindex=document.getElementById('promptselector').value;
			
			if (promptindex==-1){

				return;
			} else {
				var promptindex=document.getElementById('promptselector').value;
				disableselect();
				var data = {"prompt": promptindex};
				var xhr = new XMLHttpRequest();
				xhr.open("POST", 'prompts.php', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
					if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
						const typ = document.querySelector("#innerprompt");
						tint(typ, {
							items: ['Thinking...', this.responseText],
							typeSpeed:0,
							delayBetweenItems:600,
							loop:false,
							cursorChar:""
						});
						
					}
				}
				
				xhr.send("promptindex="+promptindex+"&mode=1");
			}
		});

		document.addEventListener('click', function (event) {

			// if (event.target.matches('#apibutton')) {
			// 	userapikey=document.getElementById('apikeystorage').value;
			// 	var apiPopup = new smq.Popup({
			// 	title: 'OpenAI API Key',
			// 	innerHtml: '<div style="font-size:18px; text-align:center"><span style="min-width:30%">Set Key </span><input type="text" class="inputbox" id="apikey" style="width:50%" value="'+userapikey+'" /> <button type="button" class="custom-save-button" style="height:40x" id="savekeybutton">SAVE</button></div>'
			// 	});
			// 	apiPopup.show();		
				
			// }

			if (event.target.matches('#savekeybutton')) {
					var proposedkey=document.getElementById('apikeystorage-modal').value;
					var xhr = new XMLHttpRequest();
					xhr.open("POST", 'savekey.php', true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
						if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
							var resp=this.responseText;
							
							if (resp=="nokey") {
								var apinokeyPopup = new smq.Popup({
								title: 'Error!',
								innerHtml: '<div style="font-size:18px; text-align:center">You need to enter a key!</div>'
								});
								apinokeyPopup.show();
							} else if (resp=="invalid") {
								var apinotvalidPopup = new smq.Popup({
								title: 'Error!',
								innerHtml: '<div style="font-size:18px; text-align:center">That key is not valid!</div>'
								});
								apinotvalidPopup.show();
							} else if (resp=="saved") {
								var apisavedPopup = new smq.Popup({
								title: 'Saved',
								innerHtml: '<div style="font-size:18px; text-align:center">Your OpenAI API Key has been saved!</div>'
								});
								document.getElementById('apikeystorage-modal').value=proposedkey
								apisavedPopup.show();
							} else {
								var apierrorPopup = new smq.Popup({
								title: 'Error!',
								innerHtml: '<div style="font-size:18px; text-align:center">Unknown Error - Your API Key has not been saved!</div>'
								});
								apierrorPopup.show();
							}
						}
					}
					
					xhr.send("apikey="+encodeURIComponent(document.getElementById('apikeystorage-modal').value));
					
			}

			if (event.target.matches('#logoutbutton')) {
				window.location.assign('logout.php');
			}
			// if (event.target.matches('#modebutton')) {
				
			// 	if (event.target.innerText=="DARK MODE"){
			// 			event.target.innerText="LIGHT MODE";
			// 			document.body.style.background="#444444";
			// 			localStorage.setItem("promptmodeZNWEBCH29T", "DARK");
			// 		} else {
			// 			event.target.innerText="DARK MODE";
			// 			document.body.style.background="#FFFFFF";
			// 			localStorage.setItem("promptmodeZNWEBCH29T", "LIGHT");
			// 		}
				
			// }					
			
			// if (event.target.matches('#copybutton')) { 
			// 	var promptindex = document.getElementById('promptselector').value;
			// 	if (!navigator.clipboard || promptindex==-1) {return;} 
			// 	navigator.clipboard.writeText(document.getElementById('innerprompt').textContent);
			// 	var copyPopup = new smq.Popup({
			// 	title: 'Copied',
			// 	innerHtml: '<div style="font-size:18px; text-align:center">Copied to clipboard!</div>'
			// 	});
			// 	copyPopup.show();
			// } 
			if (event.target.matches('#responsebutton')) { 
				if (!navigator.clipboard) {return;} 
				navigator.clipboard.writeText(document.getElementById('responsedata').value).then(() => {
					var copyMessage = document.getElementById('copy-message');
					copyMessage.innerText = 'Copied to clipboard!';

					// Optionally, hide the message after a few seconds
					setTimeout(() => {
					copyMessage.innerText = '';
					}, 3000);
				});
			}		
			
			if (event.target.matches('#copybutton')) { 
				if (!navigator.clipboard) {return;} 
				navigator.clipboard.writeText(document.getElementById('innerprompt').innerText).then(() => {
					var copyMessage = document.getElementById('copy-prompt-message');
					copyMessage.innerText = 'Copied to clipboard!';

					// Optionally, hide the message after a few seconds
					setTimeout(() => {
						copyMessage.innerText = '';
					}, 3000);
				});
			}


			if (event.target.matches('#runbutton')) {
			console.log("Run Prompt Button Pressed");
			var apikey = document.getElementById('apikeystorage-modal').value;
			var runButton = document.getElementById('runbutton');

			// Show the loader
			var loaderWrapper = document.querySelector('.loader-wrapper');
      		loaderWrapper.classList.add('is-active');

			var prompt = document.getElementById('innerprompt').textContent;
			var promptindex = document.getElementById('promptselector').value;
			console.log("Prompt: " + prompt);
			console.log("API Key: " + apikey);
			if (promptindex != -1 && apikey.length > 45) {

				disableselect();

				var xhr = new XMLHttpRequest();
				xhr.open("POST", 'prompts.php', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onreadystatechange = function () {
					if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
						const typ = document.querySelector("#innerprompt");
						const airesp = JSON.parse(this.responseText);
						const content = airesp.choices[0].message.content;

						var modalContent = '<div class="innerresponse" id="responsedata">' + content + '</div><div style="margin:0 auto; text-align:center; padding-top:15px;"><button type="button" class="custom-button" id="responsebutton">COPY & CLOSE</button></div>';
						loaderWrapper.classList.remove('is-active');
						showModal('AI Response for ' + document.getElementById('promptselector').selectedOptions[0].text, content);

						enableselect();
					}
				}
				prompt = prompt.replace(/"/gi, "'");
				xhr.send("promptindex=" + encodeURIComponent(prompt) + "&mode=2");
			}
			}
		},false);

		document.addEventListener("DOMContentLoaded", function() {
			var mode=localStorage.getItem("promptmodeZNWEBCH29T");

			var xhr = new XMLHttpRequest();
			xhr.open("POST", 'prompts.php', true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
				if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
					document.getElementById('promptselector').innerHTML=this.responseText;
				}
			}
			xhr.send("mode=3");	
			
			// if (mode!=null){
			// 	if (mode=="LIGHT") {
			// 		document.getElementById("modebutton").innerText="DARK MODE";
			// 		document.body.style.background="#FFFFFF";
			// 	} else {
			// 		document.getElementById("modebutton").innerText="LIGHT MODE";
			// 		document.body.style.background="#444444";
			// 	}
			// }
		});

		$(document).ready(function(){
  $('.button').on('click', function(){
    $('.loader-wrapper').css('display', 'flex');
    // setTimeout(function(){
    //   $('.loader-wrapper').css('display', 'none');
    // }, 3000)
  })
})



		function showModal(title, content,) {
			// Hide the loader when the modal is created
  			jQuery('.loader-wrapper').css('display', 'none');
			var modal = document.createElement('div');
			modal.className = 'modal is-active';
			modal.innerHTML = `
				<div class="modal-background jb-modal-close"></div>
				<div class="modal-card">
				<header class="modal-card-head">
					<p class="modal-card-title">${title}</p>
					<button class="delete jb-modal-close" aria-label="close"></button>
				</header>
				<section class="modal-card-body">
					<textarea class="textarea" rows="15" id="responsedata">${content}</textarea>
					<div id="copy-message" class="copy-message has-text-success has-text-weight-bold has-text-centered"></div>
				</section>
				<footer class="modal-card-foot">
					<button class="button is-success" id="responsebutton">Copy</button>
					<button class="button jb-modal-close is-danger">Close</button>
				</footer>
				</div>
				<button class="modal-close is-large jb-modal-close" aria-label="close"></button>
			`;

			document.body.appendChild(modal);

			Array.from(modal.getElementsByClassName('jb-modal-close')).forEach(function (el) {
				el.addEventListener('click', function (e) {
				e.currentTarget.closest('.modal').classList.remove('is-active');
				document.documentElement.classList.remove('is-clipped');
				document.body.removeChild(modal);
				});
			});
			
		}

	</script>
	</body>
</html>