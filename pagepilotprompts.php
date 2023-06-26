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
		  	<div class="navbar-item has-text-centered">
            	<h1>Fun Prompts</h1>
        	</div>
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
          <p class="menu-label">PROMPTS</p>
          <ul class="menu-list">
            <li>
              <a href="awesomeprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-lightbulb-on"></i></span>
                <span class="menu-item-label">Awesome</span>
              </a>
            </li>
			<li>
              <a href="marketingprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-bullhorn"></i></span>
                <span class="menu-item-label">Marketing</span>
              </a>
            </li>
			<li>
              <a href="contenttoolsprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-pencil"></i></span>
                <span class="menu-item-label">Content Tools</span>
              </a>
            </li>
			<li>
              <a href="answerthepeopleprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-comment-question-outline"></i></span>
                <span class="menu-item-label">Answer The People</span>
              </a>
            </li>
			<li>
              <a href="funprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-creation"></i></span>
                <span class="menu-item-label">Fun</span>
              </a>
            </li>
			<li>
              <a href="pagepilotprompts.php" class="has-icon is-active">
                <span class="icon has-update-mark"><i class="mdi mdi-book-open-variant"></i></span>
                <span class="menu-item-label">PagePilot</span>
              </a>
            </li>
          </ul>
		  <p class="menu-label">IMAGE PROMPTS</p>
          <ul class="menu-list">
		  	<li>
              <a href="imagegenerationprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-emoticon-cool"></i></span>
                <span class="menu-item-label">Vibes</span>
              </a>
            </li>
			<li>
              <a href="photographyprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-camera"></i></span>
                <span class="menu-item-label">Photography</span>
              </a>
            </li>
			<li>
              <a href="photographyprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-spotlight-beam"></i></span>
                <span class="menu-item-label">Lighting</span>
              </a>
            </li>
			<li>
              <a href="filmprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-filmstrip"></i></span>
                <span class="menu-item-label">Film</span>
              </a>
            </li>
			<li>
              <a href="illustrationprompts.php" class="has-icon">
                <span class="icon"><i class="mdi mdi-marker"></i></span>
                <span class="menu-item-label">Illustration</span>
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
				<div class="columns is-flex is-justify-content-center">
				<div class="column is-6-desktop is-8-tablet is-12-mobile">
					<div class="box">
					<div class="loader-wrapper" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background: rgba(255, 255, 255, 0.5); display: none; justify-content: center; align-items: center; z-index: 1;">
						<div class="loader is-loading" style="height: 80px; width: 80px;"></div>
					</div>
					<div class="loader-text-wrapper" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background: rgba(255, 255, 255, 0.5); display: none; justify-content: center; align-items: center; z-index: 1;">
						<p class="loader-text">Loading...</p>
					</div>
						<div class="logo-section has-text-centered">
							<figure class="image mb-5 has-text-centered is-inline-flex">
								<img class="logo-image" src="<?php echo($logo); ?>">
							</figure>
						</div>
						<div class="prompt-selector-section">
							<div class="columns is-multiline">
								<div class="column is-narrow">
									<?php if ($masterkeymode==false && $runbutton==true) {echo('<button type="button" class="button is-small is-info jb-modal" data-target="api-key-modal" id="apibutton">API KEY</button>');} ?>
								</div>
							</div>
						</div>
						<div>
							<input type="input" style="display:none;" id="apikeystorage" value="<?php if ($masterkeymode==true){echo($masterapikey);}else{echo($_SESSION["user"]["user_apikey"]);} ?>" />
						</div>
						<form class="box">
							<!-- eBook Topic -->
							<div class="field">
								<div class="field-label is-normal">
									<label class="label" style="text-align:left;">eBook Topic:</label>
								</div>
								<div class="field-body">
									<div class="field">
										<p class="control is-normal has-icons-left">
											<input class="input" type="text" id="ebookTopic" name="bookTopicInput" value="" placeholder="How to make money online" required>
											<span class="icon is-small is-left"><i class="mdi mdi-lead-pencil"></i></span>
										</p>
									</div>
								</div>
							</div>
							<!-- Submit eBook Topic -->
							<div class="buttons">
								<button type="button" class="button is-success" id="bookTopicInputButton" onclick="submitBookTopic()">Create Book Outline</button>
							</div>

							<!-- Book Titles -->
							<section class="sectionWithBorder" id="bookTitlesSection" style="display: none;">
								<label class="label">Book Titles:</label>	
							</section>
							<div class="contentWrapper content" id="bookTitleContent"></div>

							<!-- Book Outline -->
							<section class="sectionWithBorder" id="bookOutlineSection" style="display: none;">
								<label class="label">Book Outline</label>
							</section>
							<div class="contentWrapper content" id="bookOutlineContent"></div>

							<!-- CHAPTER ONE -->
							<section class="sectionWithBorder" id="chapter1Section" style="display: none;">
								<label class="label">Chapter One</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter1Button"  style="display: none;" onclick="displayChapterOutput(1)">Write Chapter One</button>
							</div>
							<div class="contentWrapper content" id="chapterOneContent"></div>

							<!-- CHAPTER TWO -->
							<section class="sectionWithBorder" id="chapter2Section" style="display: none;">
								<label class="label">Chapter Two</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter2Button" style="display: none;" onclick="displayChapterOutput(2)">Write Chapter Two</button>
							</div>
							<div class="contentWrapper content" id="chapterTwoContent"></div>
							
							<!-- CHAPTER THREE -->

							<section class="sectionWithBorder" id="chapter3Section" style="display: none;">
								<label class="label">Chapter THREE</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter3Button" style="display: none;" onclick="displayChapterOutput(3)">Write Chapter Three</button>
							</div>
							<div class="contentWrapper content" id="chapterThreeContent"></div>

							<!-- CHAPTER FOUR -->
							<section class="sectionWithBorder" id="chapter4Section" style="display: none;">
								<label class="label">Chapter Four</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter4Button" style="display: none;" onclick="displayChapterOutput(4)">Write Chapter Four</button>
							</div>
							<div class="contentWrapper content" id="chapterFourContent"></div>

							<!-- CHAPTER FIVE -->
							<section class="sectionWithBorder" id="chapter5Section" style="display: none;">
								<label class="label">Chapter Five</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter5Button" style="display: none;" onclick="displayChapterOutput(5)">Write Chapter Five</button>
							</div>
							<div class="contentWrapper content" id="chapterFiveContent"></div>

							<!-- CHAPTER SIX -->
							<section class="sectionWithBorder" id="chapter6Section" style="display: none;">
								<label class="label">Chapter Six</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter6Button" style="display: none;" onclick="displayChapterOutput(6)">Write Chapter Six</button>
							</div>
							<div class="contentWrapper content" id="chapterSixContent"></div>

							<!-- CHAPTER SEVEN -->
							<section class="sectionWithBorder" id="chapter7Section" style="display: none;">
								<label class="label">Chapter Seven</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter7Button" style="display: none;" onclick="displayChapterOutput(7)">Write Chapter Seven</button>
							</div>
							<div class="contentWrapper content" id="chapterSevenContent"></div>

							<!-- CHAPTER EIGHT -->
							<section class="sectionWithBorder" id="chapter8Section" style="display: none;">
								<label class="label">Chapter Eight</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter8Button" style="display: none;" onclick="displayChapterOutput(8)">Write Chapter Eight</button>
							</div>
							<div class="contentWrapper content" id="chapterEightContent"></div>

							<!-- CHAPTER NINE -->
							<section class="sectionWithBorder" id="chapter9Section" style="display: none;">
								<label class="label">Chapter Nine</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter9Button" style="display: none;" onclick="displayChapterOutput(9)">Write Chapter Nine</button>
							</div>
							<div class="contentWrapper content" id="chapterNineContent"></div>

							<!-- CHAPTER TEN -->
							<section class="sectionWithBorder" id="chapter10Section" style="display: none;">
								<label class="label">Chapter Ten</label>
							</section>
							<div class="buttons">
								<button type="button" class="button is-primary" id="chapter10Button" style="display: none;" onclick="displayChapterOutput(10)">Write Chapter Ten</button>
							</div>
							<div class="contentWrapper content" id="chapterTenContent"></div>

						</form>
					</div>  <!-- Box END -->
					<article class="message is-dark" style="box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2), 0 2px 4px rgba(0, 0, 0, 0.1);">
						<div class="message-body">
							<!-- Your content here -->
							The above prompt can be edited.  Please replace with your topic, target audience, and query where appropriate.
						</div>
					</article>
				</div>  <!-- Column END -->
				</div> <!-- Columns END -->
			</div> <!-- Container END -->
		</section>
      
      <!-- Footer -->
		<?php echo($footer); ?>


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
    <script type="text/javascript" src="js/main.js"></script>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
	<script>

		function displayBookData(titles, outline) {
			document.getElementById("bookTitleContent").innerHTML = titles.map(title => `<li>${title}</li>`).join("");
			document.getElementById("bookOutline").value = outline;
		}

		function displayChapterOutput(chapter) {
			// Replace the code below with your logic to generate chapter output
			let chapterOutput = "Output for Chapter " + chapter;
			document.getElementById(`chapter${chapter}Output`).value = chapterOutput;
		}

		// Old javascript code
					
		function enableselect(){
			//document.getElementById('promptselector').disabled=false; 
			//document.getElementById('copybutton').disabled=false;
			//document.getElementById('runbutton').disabled=false; 
			var apielement =  document.getElementById('apibutton');
			if (typeof(apielement) != 'undefined' && apielement != null)
			{
			apielement.disabled=false;	
			}	

			//document.getElementById('page-overlay').style.display='none';
		}

		function disableselect(){
			//document.getElementById('promptselector').disabled=true;
			//document.getElementById('copybutton').disabled=true;
			//document.getElementById('runbutton').disabled=true;
			var apielement =  document.getElementById('apibutton');
			if (typeof(apielement) != 'undefined' && apielement != null)
			{
			apielement.disabled=true;	
			}	
			
		}
		

		document.addEventListener('click', function (event) {


			if (event.target.matches('#savekeybutton')) {
					var proposedkey=document.getElementById('apikeystorage-modal').value;
					var xhr = new XMLHttpRequest();
					xhr.open("POST", 'savekey.php', true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
						if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
							var resp=this.responseText;
							
							if (resp=="nokey") {
								var copyMessage = document.getElementById('copy-prompt-message');
								copyMessage.innerText = 'You need to enter an API Key!';
								document.getElementById('apikeystorage-modal').value = '';

								// Add the has-text-danger class to change the text color
								copyMessage.classList.add('has-text-danger');

								// Optionally, hide the message after a few seconds
								setTimeout(() => {
									copyMessage.innerText = '';
								}, 3000);

								jQuery('.loader-wrapper').css('display', 'none');
							} else if (resp=="invalid") {
								var copyMessage = document.getElementById('copy-prompt-message');
								copyMessage.innerText = 'That API Key is not valid!';
								document.getElementById('apikeystorage-modal').value = '';

								copyMessage.classList.add('has-text-danger');

								// Optionally, hide the message after a few seconds
								setTimeout(() => {
									copyMessage.innerText = '';
								}, 3000);

								jQuery('.loader-wrapper').css('display', 'none');
							} else if (resp=="saved") {
								var copyMessage = document.getElementById('copy-prompt-message');
								copyMessage.innerText = 'API Key Saved!';
								copyMessage.classList.remove('has-text-danger');
								copyMessage.classList.add('has-text-success');

								// Optionally, hide the message after a few seconds
								setTimeout(() => {
									copyMessage.innerText = '';
								}, 3000);
								
								document.getElementById('apikeystorage-modal').value=proposedkey
								jQuery('.loader-wrapper').css('display', 'none');
							} else {
								var copyMessage = document.getElementById('copy-prompt-message');
								copyMessage.innerText = 'Unknown Error - Your API Key has not been saved!';
								document.getElementById('apikeystorage-modal').value = '';

								copyMessage.classList.add('has-text-danger');

								// Optionally, hide the message after a few seconds
								setTimeout(() => {
									copyMessage.innerText = '';
								}, 3000);

								jQuery('.loader-wrapper').css('display', 'none');
							}
						}
					}
					
					xhr.send("apikey="+encodeURIComponent(document.getElementById('apikeystorage-modal').value));
					
			}

			if (event.target.matches('#logoutbutton')) {
				window.location.assign('logout.php');
			}
			
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
				jQuery('.loader-wrapper').css('display', 'none');
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


		},false);


		//Create Book Titles
		function submitBookTopic() {

			console.log("Book Topic Button Pressed");
				var apikey = document.getElementById('apikeystorage-modal').value;
				var bookTopicButton = document.getElementById('bookTopicInputButton');
				var ebookTopic = document.getElementById('ebookTopic').value;
				var bookTitleText;

				//Show the loader
				//var loaderWrapper = document.querySelector('.loader-wrapper');
				//var loader = document.querySelector('.loader');
				//loaderWrapper.classList.add('is-active');
				bookTopicButton.classList.add('is-loading');

				console.log('Book Topic: ', ebookTopic);
				console.log('API key: ', apikey);

				if(ebookTopic.length > 0 && apikey.length > 45) {

					console.log("Making OpenAI API Request");

					var xhr = new XMLHttpRequest();
					xhr.open("POST", 'promptsebook.php', true);
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					xhr.onreadystatechange = function() {
						if ( this.readyState === XMLHttpRequest.DONE && this.status === 200) {
							//const typ = document.querySelector("");
							var bookTitlesSection = document.getElementById('bookTitlesSection');
							bookTitlesSection.style.display = 'block';

							console.log('Response: ', JSON.parse(this.responseText));
							const airesponse = JSON.parse(this.responseText);

							// This needs to be udated to return an array of book titles
							const bookTitles = airesponse.bookTitles;
							console.log('BookTitles: ', airesponse.bookTitles);
							// Get the textarea element by its id
							bookTitleText = document.getElementById('bookTitleContent');
							var modifiedBookTitles = bookTitles.replace
							bookTitleText.insertAdjacentHTML('beforeend', bookTitles);

							// This needs to be updated to return the book outline content
							//const bookOutline = airesponse.choices[0].message.content;

							// Hide the loader-wrapper and loader by setting their display property to "none"
							bookTopicButton.classList.remove('is-loading');
							bookTopicButton.disabled = true;

							showBookOutline(ebookTopic, bookTitles);
						}
					}

					xhr.send("bookTopic=" + ebookTopic)

					
				} else if ( apikey.length < 45 ) {
					showPromptAPIKeyErrorModal('API Key Error', 'Invalid API Key.  Please enter a valid API Key.');
					enableselect();
				} else {
					showPromptAPIKeyErrorModal('Prompt Error', 'Invalid Prompt.  Please enter a valid prompt and try again.');
					enableselect();
				}

				console.log("Checking Book Titles After: ", bookTitleText);
		}


		//Write Chapters 
		function displayChapterOutput(chapter) {
			console.log("Write Chapter " + chapter + " Button Pressed");
			var apikey = document.getElementById('apikeystorage-modal').value;
			var ebookTopic = document.getElementById('ebookTopic').value;
			var bookOutlineContent = document.getElementById('bookOutlineContent').textContent;
			var buttonName = "chapter"+chapter+"Button";
			var button = document.getElementById(buttonName);
			console.log('Book Outline Content:  ', bookOutlineContent);

			// Show the loader
			button.classList.add('is-loading');

			if (bookOutlineContent.length > 10 && ebookTopic.length > 3 && apikey.length > 45) {
				console.log("Making OpenAI API Request");

				var xhr = new XMLHttpRequest();
				xhr.open("POST", 'promptsebookchapter.php', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onreadystatechange = function() {
				if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
					console.log('Response: ', JSON.parse(this.responseText));
					const airesponse = JSON.parse(this.responseText);
					const bookChapter = airesponse.bookChapter;
					console.log('Chapter: ', bookChapter);	

					switch (chapter) {
						case 1:
							var chapterOneContent = document.getElementById('chapterOneContent');
							chapterOneContent.innerHTML = bookChapter;
							break;
						case 2:
							var chapterTwoContent = document.getElementById('chapterTwoContent');
							var modifiedBookChapter = bookChapter.replace(/<h1>/g, '<h1 class="is-large">');
							chapterTwoContent.insertAdjacentHTML('beforeend', modifiedBookChapter);
							//chapterTwoContent.innerHTML = bookChapter;
							break;
						case 3:
							var chapterThreeContent = document.getElementById('chapterThreeContent');
							chapterThreeContent.innerHTML = bookChapter;
							break;
						case 4:
							var chapterFourContent = document.getElementById('chapterFourContent');
							chapterFourContent.innerHTML = bookChapter;
							break;
						case 5:
							var chapterFiveContent = document.getElementById('chapterFiveContent');
							chapterFiveContent.innerHTML = bookChapter;
							break;
						case 6:
							var chapterSixContent = document.getElementById('chapterSixContent');
							chapterSixContent.innerHTML = bookChapter;
							break;
						case 7:
							var chapterSevenContent = document.getElementById('chapterSevenContent');
							chapterSevenContent.innerHTML = bookChapter;
							break;
						case 8:
							var chapterEightContent = document.getElementById('chapterEightContent');
							chapterEightContent.innerHTML = bookChapter;
							break;
						case 9:
							var chapterNineContent = document.getElementById('chapterNineContent');
							chapterNineContent.innerHTML = bookChapter;
							break;
						case 10:
							var chapterTenContent = document.getElementById('chapterTenContent');
							chapterTenContent.innerHTML = bookChapter;
							break;
						default:
							// Code to execute if chapter number doesn't match any case
							break;
					}

					chapter = chapter + 1
					
					var sectionName = "chapter"+chapter+"Section";
					var buttonName = "chapter"+chapter+"Button";

					var chapterSection = document.getElementById(sectionName);
					chapterSection.style.display = 'block';

					var chapterButton = document.getElementById(buttonName);
					chapterButton.style.display = 'block';
						

					// Hide the loader-wrapper and loader by setting their display property to "none"
					if (chapter == 11) {
						document.getElementById('chapter10Button').classList.remove('is-loading');
						document.getElementById('chapter10Button').disabled = true;
					} else {
						button.classList.remove('is-loading');
						button.disabled = true;
					}
					
				}
			}

				const data = "chapter=" + encodeURIComponent(chapter) + "&ebookTopic=" + encodeURIComponent(ebookTopic) + "&bookOutlineText=" + encodeURIComponent(bookOutlineContent);
				console.log('Data: ', data);
				xhr.send(data);

			} else if (apikey.length < 45) {
				showPromptAPIKeyErrorModal('API Key Error', 'Invalid API Key.  Please enter a valid API Key.');
				enableselect();
			} else if (bookOutlineText.length < 1) {
				showPromptAPIKeyErrorModal('Book Outline Error', 'No Book Outline.  Please enter an eBook Topic to generate an outline.');
				enableselect();
			} else if (ebookTopic.length < 1) {
				showPromptAPIKeyErrorModal('eBook Topic Error', 'No eBook Topic entered.  Please enter an eBook Topic, and generate titles and outline.');
			} else {
				showPromptAPIKeyErrorModal('Prompt Error', 'Invalid Prompt.  Please enter a valid prompt and try again.');
				enableselect();
			}

		}


		document.addEventListener("DOMContentLoaded", function() {
			var mode=localStorage.getItem("promptmodeZNWEBCH29T");

			var xhr = new XMLHttpRequest();
			xhr.open("POST", 'promptrequest.php', true);
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");xhr.onreadystatechange = function() {
				if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
					//document.getElementById('promptselector').innerHTML=this.responseText;
				}
			}
			var datafile = "funpromptdata.php";
			xhr.send("datafile="+datafile+"&mode=3");	
			
		});

		$(document).ready(function(){
			$('.button').on('click', function(){
				//$('.loader-wrapper').css('display', 'flex');
			})
		})


		function showBookOutline(bookTopic, bookTitles) {
			if (bookTitles.length > 1) {
				//console.log("ShowBookOutline -> bookTopic: " + bookTopic + "  bookTitle: " + bookTitles);
				// Get the loader-wrapper element
				const loaderTextWrapper = document.querySelector('.loader-text-wrapper');

				// Show the loader-wrapper by setting its display property to "flex"
				loaderTextWrapper.style.display = 'flex';

				var xhr = new XMLHttpRequest();
				xhr.open("POST", 'promptsbookoutline.php', true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.onreadystatechange = function () {
					if (this.readyState === XMLHttpRequest.DONE) {
						if (this.status === 200) {
							try {
								console.log("STATUS = 200");
								console.log('Response: ', this.responseText);

								var bookOutlineSection = document.getElementById('bookOutlineSection');
								bookOutlineSection.style.display = 'block';

								var chapter1Section = document.getElementById('chapter1Section');
								chapter1Section.style.display = 'block';

								var chapter1Button = document.getElementById('chapter1Button');
								chapter1Button.style.display = 'block';
							
								const airesponse = JSON.parse(this.responseText);
								const bookOutline = airesponse.bookOutline;
								//console.log('BookOutline: ', airesponse.bookOutline);

								// Get the textarea element by its id
								bookOutlineText = document.getElementById('bookOutlineContent');

								// Set the value of the textarea to the bookOutline
								bookOutlineText.innerHTML = bookOutline;

								// Hide the loader-wrapper and loader by setting their display property to "none"
								loaderTextWrapper.style.display = 'none';

								document.getElementById('chapter10Button').classList.remove('is-loading');
								document.getElementById('chapter10Button').classList.add('disabled');

							} catch (error) {
								console.error('Error parsing JSON response:', error);
							}
						} else {
							console.error('Error:', this.status);
						}
					}
				};

				// Create a data string with the bookTopic and bookTitles parameters
				const data = "bookTopic=" + encodeURIComponent(bookTopic) + "&bookTitles=" + encodeURIComponent(bookTitles);

				// Send the POST request with the data
				xhr.send(data);
			}
		}





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
			})	
		}

		function showPromptAPIKeyErrorModal(title, content,) {
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
 				 	<p class="has-text-danger has-text-weight-bold">
  					${content}
  					</p>
  				</section>
  				<footer class="modal-card-foot">
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
  			})	
  		}

		$(document).ready(function() {
			$('.jb-modal-close').on('click', function() {
				$('.modal').removeClass('is-active');
				hideLoader();
			});

			$('#apibutton').on('click', function() {
				$('#api-key-modal').addClass('is-active');
			});

			$('#savekeybutton').on('click', function() {
				let apiKey = $('#apikeystorage-modal').val();
				$('#apikeystorage').val(apiKey);
				$('#api-key-modal').removeClass('is-active');
				hideLoader();
			});

			function hideLoader() {
				$('.loader-wrapper').hide();
			}
		});

		

	</script>
	</body>
</html>