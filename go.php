<?php
require_once("config.php");
require_once("user/protect.php");
?>
<!doctype HTML>
<html>
  <head>
    <title><?php echo($sitename); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  </head>
  <body>
	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="navbar-brand ml-6">
		<a class="navbar-item" href="https://toolkitsforsuccess.com">
			<img src="img/logo.png" alt="Toolkits For Success: Content that starts Conversations that puts Cash in your pocket." width="200" height="30">
		</a>
		</div>
		<div class="navbar-end mr-6">
		<div class="navbar-item">
		<div class="buttons">
			<button type="button" class="button is-small is-dark" id="modebutton">DARK MODE</button>
			<?php if ($masterkeymode==false && $runbutton==true) {echo('<button type="button" class="button is-small is-info" id="apibutton">API KEY</button>');} ?>
			<button type="button" class="button is-small is-danger" id="logoutbutton">LOGOUT</button>
		</div>
		</div>
		</div>
	</nav>
    <section class="section">
      <div class="container">
		<div class="column is-three-fifths is-offset-one-fifth">
			<div class="box">
				<div class="loader-wrapper">
					<div class="loader is-loading"></div>
				</div>
				<div class="logo-section has-text-centered">
				<figure class="image mb-5">
					<img class="logo-image" src="<?php echo($logo); ?>">
				</figure>
				<input type="input" style="display:none;" id="apikeystorage" value="<?php if ($masterkeymode==true){echo($masterapikey);}else{echo($_SESSION["user"]["user_apikey"]);} ?>" />
				</div>
				<div class="prompt-selector-section">
				<div class="columns">
					<div class="column">
					<div class="select is-fullwidth">
						<select id="promptselector" class="promptselector" autocomplete="off"></select>
					</div>
					</div>
					<div class="column is-narrow">
					</div>
				</div>
				</div>
				<div class="prompt-display-section mt-3">
				<div id="promptdata" class="content" >
					<div contentEditable="true" id="innerprompt" class="innerprompt" >I want you to act as an academician. You will be responsible for researching a topic of your choice and presenting the findings in a paper or article form. Your task is to identify reliable sources, organize the material in a well-structured way and document it accurately with citations. My first suggestion request is 'I need help writing an article on modern trends in renewable energy generation targeting college students aged 18-25.'</div>
				</div>
				<div class="buttons">
					<button type="button" class="button is-primary" id="copybutton">COPY PROMPT</button>
					<?php if ($runbutton==true){echo('<button type="button" class="button is-success" id="runbutton">RUN PROMPT</button>');}  ?>
				</div>
				</div>
				
			</div>  <!-- Box END -->
		</div>  <!-- Column END -->
      </div> <!-- Container END -->
    </section>
			
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
			document.getElementById('logoutbutton').disabled=false;
			document.getElementById('modebutton').disabled=false;
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
			document.getElementById('logoutbutton').disabled=true;
			document.getElementById('modebutton').disabled=true;
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

			if (event.target.matches('#apibutton')) {
				userapikey=document.getElementById('apikeystorage').value;
				var apiPopup = new smq.Popup({
				title: 'OpenAI API Key',
				innerHtml: '<div style="font-size:18px; text-align:center"><span style="min-width:30%">Set Key </span><input type="text" class="inputbox" id="apikey" style="width:50%" value="'+userapikey+'" /> <button type="button" class="custom-save-button" style="height:40x" id="savekeybutton">SAVE</button></div>'
				});
				apiPopup.show();		
				
			}

			if (event.target.matches('#savekeybutton')) {
					var proposedkey=document.getElementById('apikey').value;
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
								document.getElementById('apikeystorage').value=proposedkey
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
					
					xhr.send("apikey="+encodeURIComponent(document.getElementById('apikey').value));
					
			}

			if (event.target.matches('#logoutbutton')) {
				window.location.assign('logout.php');
			}
			if (event.target.matches('#modebutton')) {
				
				if (event.target.innerText=="DARK MODE"){
						event.target.innerText="LIGHT MODE";
						document.body.style.background="#444444";
						localStorage.setItem("promptmodeZNWEBCH29T", "DARK");
					} else {
						event.target.innerText="DARK MODE";
						document.body.style.background="#FFFFFF";
						localStorage.setItem("promptmodeZNWEBCH29T", "LIGHT");
					}
				
			}					
			
			if (event.target.matches('#copybutton')) { 
				var promptindex = document.getElementById('promptselector').value;
				if (!navigator.clipboard || promptindex==-1) {return;} 
				navigator.clipboard.writeText(document.getElementById('innerprompt').textContent);
				var copyPopup = new smq.Popup({
				title: 'Copied',
				innerHtml: '<div style="font-size:18px; text-align:center">Copied to clipboard!</div>'
				});
				copyPopup.show();
			} 
			if (event.target.matches('#responsebutton')) { 
				if (!navigator.clipboard) {return;} 
				navigator.clipboard.writeText(document.getElementById('responsedata').textContent);
				var responsecopyPopup = new smq.Popup({
				title: 'Copied',
				innerHtml: '<div style="font-size:18px; text-align:center">Copied to clipboard!</div>'
				});
				responsecopyPopup.show();
			} 					
			if (event.target.matches('#runbutton')) {
				console.log("Run Prompt Button Pressed");
				var apikey=document.getElementById('apikeystorage').value;
				
				var prompt=document.getElementById('innerprompt').textContent;
				var promptindex = document.getElementById('promptselector').value;
				console.log("Prompt: " + prompt);
				console.log("API Key: " + apikey);
				if (promptindex!=-1 && apikey.length>45){
					
					disableselect();
					//document.getElementById('page-overlay').style.display='block';

					var xhr = new XMLHttpRequest();
					xhr.open("POST", 'prompts.php', true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
						if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
							const typ = document.querySelector("#innerprompt");
							const airesp = JSON.parse(this.responseText);
							const content = airesp.choices[0].message.content;
							var runPopup = new smq.Popup({
							title: 'AI Response for '+document.getElementById('promptselector').selectedOptions[0].text,
							innerHtml: '<div class="innerresponse" id="responsedata">'+content+'</div><div style="margin:0 auto; text-align:center; padding-top:15px;"><button type="button" class="custom-button" id="responsebutton">COPY & CLOSE</button></div>'
							});
							enableselect();
							runPopup.show();									
							
						}
					}
					prompt=prompt.replace(/"/gi, "'");
					xhr.send("promptindex="+encodeURIComponent(prompt)+"&mode=2");

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
			
			if (mode!=null){
				if (mode=="LIGHT") {
					document.getElementById("modebutton").innerText="DARK MODE";
					document.body.style.background="#FFFFFF";
				} else {
					document.getElementById("modebutton").innerText="LIGHT MODE";
					document.body.style.background="#444444";
				}
			}
		});

		jQuery(document).ready(function() {
			jQuery('#runbutton').on('click', function() {
				console.log("run prompt button clicked");
				jQuery('.loader-wrapper').addClass('is-active');
				setTimeout(function() {
					jQuery('.loader-wrapper').removeClass('is-active');
				},3000)
			})
		});

	</script>
	</body>
</html>