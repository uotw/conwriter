<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Cache-control" content="private,max-age:3600">
  <meta charset="UTF-8">
  <title>CON Writer</title>
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
  <link rel='stylesheet' href='./css/jquery.modal.min.css'>
  <link rel="stylesheet" href="./css/style.css?1778374860">
<style>

#aboutdialogue{
	max-height: 260px;
}
body{
	overflow-x:hidden;
}
a{
	color:#4678b3;
}
.btn{
	background-color:#4678b3;
	width: 100%;
}
.btn:hover{
	opacity:0.8;
	background-color:#4678b3;
}

#about{
	margin-left:5px;
}
#otherlinks{
	font-size:10px;
}

/* ============================================
   Donate post-CON modal (every 10th CON)
   ============================================ */
.donate-overlay {
	position: fixed;
	inset: 0;
	background: rgba(20, 30, 50, 0.65);
	backdrop-filter: blur(4px);
	-webkit-backdrop-filter: blur(4px);
	display: flex;
	align-items: center;
	justify-content: center;
	z-index: 99999;
	opacity: 0;
	pointer-events: none;
	transition: opacity 0.35s ease;
	font-family: sans-serif;
	padding: 20px;
	box-sizing: border-box;
}
.donate-overlay.visible {
	opacity: 1;
	pointer-events: auto;
}
.donate-modal {
	background: #fff;
	border-radius: 14px;
	max-width: 460px;
	width: 100%;
	box-shadow: 0 20px 60px rgba(0,0,0,0.35);
	overflow: hidden;
	transform: translateY(20px) scale(0.96);
	transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
	position: relative;
}
.donate-overlay.visible .donate-modal {
	transform: translateY(0) scale(1);
}
.donate-hero {
	background: linear-gradient(135deg, #F9D423 0%, #ff9a44 100%);
	padding: 28px 32px 22px;
	text-align: center;
	position: relative;
}
.donate-hero .donate-icon {
	margin: 0 auto 12px;
	display: flex;
	align-items: center;
	justify-content: center;
	color: #2c1810;
}
.donate-hero h2 {
	margin: 0;
	font-size: 22px;
	font-weight: 700;
	color: #343434;
	letter-spacing: -0.3px;
}
.donate-hero .donate-sub {
	margin-top: 6px;
	font-size: 14px;
	color: #5a4a00;
	font-weight: 500;
}
.donate-body {
	padding: 22px 32px 26px;
	text-align: center;
}
.donate-body p {
	font-size: 15px;
	line-height: 1.55;
	color: #444;
	margin: 0 0 8px;
}
.donate-body p.lead {
	font-size: 16px;
	color: #2c3e50;
	font-weight: 500;
	margin-bottom: 12px;
}
.donate-actions {
	margin-top: 20px;
	display: flex;
	flex-direction: column;
	gap: 10px;
	align-items: center;
}
.donate-modal .donate-btn-primary {
	display: inline-block;
	background: #343434;
	color: #F9D423;
	padding: 13px 40px;
	border-radius: 8px;
	font-weight: 700;
	font-size: 16px;
	text-decoration: none;
	border: 2px solid #343434;
	transition: transform 0.2s, box-shadow 0.2s;
	letter-spacing: 0.3px;
}
.donate-modal .donate-btn-primary:hover {
	transform: translateY(-1px);
	box-shadow: 0 4px 12px rgba(0,0,0,0.2);
	color: #F9D423;
	text-decoration: none;
}
.donate-modal .donate-btn-secondary {
	background: none;
	border: none;
	color: #888;
	font-size: 13px;
	cursor: pointer;
	padding: 6px 12px;
	font-family: sans-serif;
	transition: color 0.2s;
}
.donate-modal .donate-btn-secondary:hover {
	color: #444;
	text-decoration: underline;
}
.donate-modal .donate-close-x {
	position: absolute;
	top: 14px;
	right: 14px;
	width: 30px;
	height: 30px;
	border-radius: 50%;
	background: rgba(255,255,255,0.7);
	color: #444;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 20px;
	cursor: pointer;
	line-height: 1;
	border: none;
	padding: 0;
	font-family: sans-serif;
	transition: background 0.2s;
	z-index: 2;
}
.donate-modal .donate-close-x:hover {
	background: rgba(255,255,255,0.95);
}

@media (max-width: 480px) {
	.donate-hero { padding: 22px 20px 18px; }
	.donate-hero h2 { font-size: 19px; }
	.donate-body { padding: 20px; }
}
</style>
</head>
<body>

<h1>CON Writer</h1>
<h6>©2026 <a href="/cdn-cgi/l/email-protection#f193949f829c988599df9c95b1969c90989ddf929e9c">Ben Smith, MD, FACEP</a><span id=about><a href="#aboutdialogue" data-modal>[about]</a>  </span><a href="/stats/">[stats]</a></h6>
<h6 id=otherlinks>this is for licensed physicians, need the <a href=le.php>LE/6401 version</a> or the <a href=mpa.php>MPA version</a>?</h6>

<div id=aboutdialogue>
  About
  <ul>
    <li>This tool generates a TN Certificate of Need for involuntary psychiatric commitment.</li>
    <li>This is an in-browser PDF generator, no PHI is stored or transmitted.</li>
    <li>In the interest of transparency, CON Writer is <a href='https://github.com/uotw/conwriter'>open source.</a> Licensed under <a href="https://www.gnu.org/licenses/gpl-3.0.html">GPL-3.0</a>.</li>
    <li>No patient-specific information typed in here is sent to the web.</li>
    <li>Destination, Transport method, and County will be logged.</li>
    <li>Provider Phone, County, Transport Method, and Destination will be stored in your browser for the next time you visit this page.</li>
    <li>This use of this tool does not constitiute any form of medical advice.</li>
    <li>Hand-and-clock icon by <a href="https://thenounproject.com/" target="_blank">Noun Project</a>.</li>
  </ul>
</div>

<form action="" id=conform autocomplete="off">
  <div class="row">
    <div class="column">
      <div class="form-group">
        <label for="pt_name">Patient Name</label>
        <input type="text" class="form-control" id=pt name="pt" placeholder="Enter patient name" required="true" oninvalid="this.setCustomValidity('Please enter a patient name')" oninput="setCustomValidity('')">
      </div>
      <div class="form-group">
        <label for="md_name">Provider Name</label>
        <input type="text" class="form-control" id=md name="md" placeholder="Enter provider name" required="true" oninvalid="this.setCustomValidity('Please enter a provider\'s name')" oninput="setCustomValidity('')">
      </div>
      <div class="form-group">
        <label for="md_name">Provider Phone</label>
        <input type="tel" class="form-control" id=phone name="phone" placeholder="Enter phone number" required="true" oninvalid="this.setCustomValidity('Please enter a phone number')" oninput="setCustomValidity('')">
      </div>
      <div class="form-group">
        <label for="county">County</label>
        <select class=form-control id=county data-live-search="true" required="true">
          <option>Anderson </option>
          <option>Bedford </option>
          <option>Benton </option>
          <option>Bledsoe </option>
          <option>Blount </option>
          <option>Bradley </option>
          <option>Campbell </option>
          <option>Cannon </option>
          <option>Carroll </option>
          <option>Carter </option>
          <option>Cheatham </option>
          <option>Chester </option>
          <option>Claiborne </option>
          <option>Clay </option>
          <option>Cocke </option>
          <option>Coffee </option>
          <option>Crockett </option>
          <option>Cumberland </option>
          <option>Davidson </option>
          <option>Decatur </option>
          <option>DeKalb </option>
          <option>Dickson </option>
          <option>Dyer </option>
          <option>Fayette </option>
          <option>Fentress </option>
          <option>Franklin </option>
          <option>Gibson </option>
          <option>Giles </option>
          <option>Grainger </option>
          <option>Greene </option>
          <option>Grundy </option>
          <option>Hamblen </option>
          <option>Hamilton </option>
          <option>Hancock </option>
          <option>Hardeman </option>
          <option>Hardin </option>
          <option>Hawkins </option>
          <option>Haywood </option>
          <option>Henderson </option>
          <option>Henry </option>
          <option>Hickman </option>
          <option>Houston </option>
          <option>Humphreys </option>
          <option>Jackson </option>
          <option>Jefferson </option>
          <option>Johnson </option>
          <option>Knox </option>
          <option>Lake </option>
          <option>Lauderdale </option>
          <option>Lawrence </option>
          <option>Lewis </option>
          <option>Lincoln </option>
          <option>Loudon </option>
          <option>Macon </option>
          <option>Madison </option>
          <option>Marion </option>
          <option>Marshall </option>
          <option>Maury </option>
          <option>McMinn </option>
          <option>McNairy </option>
          <option>Meigs </option>
          <option>Monroe </option>
          <option>Montgomery </option>
          <option>Moore </option>
          <option>Morgan </option>
          <option>Obion </option>
          <option>Overton </option>
          <option>Perry </option>
          <option>Pickett </option>
          <option>Polk </option>
          <option>Putnam </option>
          <option>Rhea </option>
          <option>Roane </option>
          <option>Robertson </option>
          <option>Rutherford </option>
          <option>Scott </option>
          <option>Sequatchie </option>
          <option>Sevier </option>
          <option>Shelby </option>
          <option>Smith </option>
          <option>Stewart </option>
          <option>Sullivan </option>
          <option>Sumner </option>
          <option>Tipton </option>
          <option>Trousdale </option>
          <option>Unicoi </option>
          <option>Union </option>
          <option>Van Buren </option>
          <option>Warren </option>
          <option>Washington </option>
          <option>Wayne </option>
          <option>Weakley </option>
          <option>White </option>
          <option>Williamson </option>
          <option>Wilson </option>
          </select>
      </div>
      <div class="form-group" id=transport>
        <label for="transport">Transport Method</label>
        <div class="radio">
          <label ><input type="radio" name="transport" id=friends class=transport> Friends/Family</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="transport" checked id=ems class=transport> Ambulance</label>
        </div>
        <div class="radio">
          <label ><input type="radio" name="transport" id=police class=transport> Sheriff/Law Enforcement</label>
        </div>
      </div>
      <div class="form-group" >
        <label for="destination">Destination</label>
        <div class="radio">
          <label  ><input type="radio" name="destination" checked id=psych class=destination> Psychiatric Facility</label>
        </div>
        <div class="radio">
          <label ><input type="radio" name="destination" id=telehealth class=destination> Telehealth Location</label>
        </div>
      </div>
      <button class="btn btn-primary" type="button" id="createBtn">Create</button>
    </div>
    <div class="column">
      <div class="form-group" id=q1>
        <label for="b1">1) Has a mental illness or serious emotional disturbance...</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b1f1" name=b1f1>
          <label class="custom-control-label" for="b1f1">Has a history of depression, now with suicidal ideation and a plan. </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b1f2" name=b1f2>
          <label class="custom-control-label" for="b1f2">Has a history of bipolar disorder, now presents with acute mania. </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b1f3" name=b1f3>
          <label class="custom-control-label" for="b1f3">Has a history of schizophrenia, now has symptoms of acute psychosis. </label>
	</div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b1f4" name=b1f4>
          <label class="custom-control-label" for="b1f4">Unknown history of mental illness, now presenting with active symptoms of psychiatric disorder. </label>
        </div>
        <textarea id=b1 class=prose name="b1" placeholder="list known mental illness and current Sx" required="true"></textarea>
      </div>

      <div class="form-group" id=q2>
	<label for="b2">2) Poses a high likelihood of harm...</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b2f5" name=b2f5>
          <label class="custom-control-label" for="b2f5">Has attempted suicide.  </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b2f1" name=b2f1>
          <label class="custom-control-label" for="b2f1">Has serious thoughts of suicide with a clear plan. </label>
	</div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b2f2" name=b2f2>
          <label class="custom-control-label" for="b2f2">Has threatened homicide and serious injury to others. </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b2f3" name=b2f3>
          <label class="custom-control-label" for="b2f3">Disorganized thoughts put the patient and others at substantial risk of harm. </label>
	</div>
	<div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b2f4" name=b2f4>
          <label class="custom-control-label" for="b2f4">Active symptoms of psychiatric disorder.</label>
        </div>
        <textarea id=b2 class=prose name="b2" placeholder="SI, HI with plan, etc" required="true" autocomplete="new-password"></textarea>
      </div>
      <div class="form-group" id=q3>
        <label for="b3">3) Describe what makes treatment necessary...</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b3f1" name=b3f1>
          <label class="custom-control-label" for="b3f1">Needs intensive inpatient psychiatric care. </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b3f2" name=b3f2>
          <label class="custom-control-label" for="b3f2">Lack of inpatient care will likely result in harm to others. </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b3f3" name=b3f3>
          <label class="custom-control-label" for="b3f3">Lack of inpatient care will likely result in harm to the patient. </label>
        </div>
        <textarea id=b3 class=prose name="b3" placeholder="needs intensive inpatient 𝚿 Tx" required="true"></textarea>
      </div>
      <div class="form-group" id=q4>
        <label for="b4">4) List alt Tx considered and rational for rejection...</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b4f1" name=b4f1>
          <label class="custom-control-label" for="b4f1">Not appropriate for outpatient management. </label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="b4f2" name=b4f2>
          <label class="custom-control-label" for="b4f2">The patient cannot contract for safety. </label>
        </div>
        <textarea id=b4 class=prose name="b4" placeholder="cannot contract for safety etc" required="true"></textarea>
      </div>
    </div>
  </div>
</form>

<!-- Donate post-CON modal -->
<div class="donate-overlay" id="donateOverlay" role="dialog" aria-modal="true" aria-labelledby="donateTitle">
  <div class="donate-modal">
    <button class="donate-close-x" id="donateCloseX" aria-label="Close">×</button>
    <div class="donate-hero">
      <div class="donate-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 1200" width="72" height="72" fill="currentColor" aria-hidden="true">
          <path d="m52.312 623.86h206.26c16.547 0 30 13.453 30 30v47.578l54.141-26.953c16.078-8.0156 32.578-12.891 49.641-14.672 16.828-1.7344 33.938-0.32812 51.422 4.2188l377.63 98.766 202.92-108.14c38.391-20.438 77.297-18.562 105.75-4.5 12.797 6.3281 23.766 15.328 31.922 26.016 8.7656 11.531 14.203 24.938 15.422 39.141 2.0625 24.516-8.0625 50.766-35.297 73.125l-329.76 271.03c-18.703 15.375-39.609 25.5-61.688 30.188s-45.328 3.9375-68.625-2.4844l-278.76-76.922c-13.125-3.6094-26.016-4.2656-38.203-1.9688-12.188 2.25-23.953 7.5-34.922 15.656l-41.578 30.844v44.438c0 16.547-13.453 30-30 30h-206.26c-16.547 0-30-13.453-30-30v-445.4c0-16.547 13.453-30 30-30zm590.95-369.42c-8.2969-14.297-3.4219-32.625 10.922-40.875 14.297-8.2969 32.625-3.4219 40.875 10.922l82.312 142.55c6.9375 12 4.6406 26.812-4.7344 36.141l-64.969 65.062c-11.719 11.719-30.703 11.719-42.422 0s-11.719-30.703 0-42.422l48.75-48.75-70.781-122.58zm325.78 157.55c-16.547 0-30-13.453-30-30s13.453-30 30-30h31.922c-6.8438-57.422-33-108.89-71.812-147.66-38.812-38.812-90.281-64.969-147.66-71.812v31.922c0 16.547-13.453 30-30 30-16.547 0-30-13.453-30-30v-31.922c-57.422 6.8438-108.89 33-147.66 71.812-38.812 38.812-64.969 90.281-71.812 147.66h31.922c16.547 0 30 13.453 30 30s-13.453 30-30 30h-31.922c6.8438 57.422 33 108.89 71.812 147.66 38.812 38.812 90.281 64.969 147.66 71.812v-31.922c0-16.547 13.453-30 30-30 16.547 0 30 13.453 30 30v31.922c57.422-6.8438 108.89-33 147.66-71.812 38.812-38.812 64.969-90.281 71.812-147.66zm-217.6-341.26c85.922 0 163.78 34.875 220.08 91.172 56.344 56.344 91.172 134.16 91.172 220.08 0 85.922-34.875 163.78-91.172 220.08-56.344 56.344-134.16 91.172-220.08 91.172-85.922 0-163.78-34.875-220.08-91.172-56.344-56.344-91.172-134.16-91.172-220.08 0-85.922 34.875-163.78 91.172-220.08 56.344-56.344 134.16-91.172 220.08-91.172zm-462.89 697.74v211.92l5.9062-4.4062c18.281-13.594 38.391-22.453 59.531-26.391 21.141-3.9844 43.078-2.9531 65.156 3.1406l278.76 76.922c13.828 3.7969 27.469 4.3125 40.312 1.5469 12.844-2.7188 25.125-8.7188 36.188-17.766l329.76-271.03c10.078-8.2969 13.969-15.938 13.5-22.031-0.23438-2.8125-1.4062-5.5781-3.2344-8.0156-2.4844-3.2344-6.1875-6.1875-10.828-8.4375-13.031-6.4219-31.641-6.7969-51.188 3.5625l-189.74 101.11c1.4062 6.3281 2.2031 12.75 2.2969 19.172 0.32812 16.875-3.8906 33.938-12.703 49.172-8.8125 15.375-21.562 27.609-36.422 35.812-14.766 8.1562-31.875 12.375-49.453 11.719-2.2969-0.09375-4.5469-0.42188-6.6562-0.98438l-237.98-63.703c-15.984-4.2656-25.453-20.719-21.188-36.703 4.2656-15.984 20.719-25.453 36.703-21.188l234.37 62.812c5.4375-0.28125 10.734-1.8281 15.422-4.4062 5.4844-3.0469 10.219-7.5469 13.5-13.219 3.2812-5.625 4.8281-12.047 4.7344-18.375-0.046876-2.8594-0.46875-5.7656-1.2656-8.5781l-375.19-98.109c-10.453-2.7188-20.531-3.6094-30.328-2.5781-9.5625 0.98437-19.219 3.9375-29.016 8.7656l-80.906 40.266z"/>
        </svg>
      </div>
      <h2 id="donateTitle">You just saved 10 minutes.</h2>
    </div>
    <div class="donate-body">
      <p class="lead">ConWriter is free and donor-supported.</p>
      <p>If it's earned its keep, consider chipping in to support the UT EM Residency in Chattanooga.</p>
      <div class="donate-actions">
        <a href="https://givebutter.com/conwriter" target="_blank" class="donate-btn-primary" id="donateGo">Donate</a>
        <button type="button" class="donate-btn-secondary" id="donateNotNow">Not now</button>
      </div>
    </div>
  </div>
</div>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src='./js/jspdf.debug.js'></script>
<script src='./js/jquery.min.js'></script>
<script src='./js/jquery.validate.min.js'></script>
<script src='./js/moment.min.js'></script>
<script src='./js/jquery.modal.min.js'></script>
<script src='./js/autoresize.js?v22'></script>
<script src='./js/script.v4.js?v1778374860'></script>

<script>
// Donate prompt: show modal on every Create click
(function() {
	var createBtn = document.getElementById('createBtn');
	var overlay = document.getElementById('donateOverlay');
	var closeX = document.getElementById('donateCloseX');
	var notNow = document.getElementById('donateNotNow');
	var donateGo = document.getElementById('donateGo');

	if (!createBtn || !overlay) return;

	function showModal() { overlay.classList.add('visible'); }
	function hideModal() { overlay.classList.remove('visible'); }

	createBtn.addEventListener('click', showModal);

	// Dismiss handlers
	closeX.addEventListener('click', hideModal);
	notNow.addEventListener('click', hideModal);
	overlay.addEventListener('click', function(e) {
		if (e.target === overlay) hideModal();
	});
	donateGo.addEventListener('click', function() {
		setTimeout(hideModal, 100);
	});
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && overlay.classList.contains('visible')) hideModal();
	});
})();
</script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8c78df7c7c0f484497ecbca7046644da1771523124516" integrity="sha512-8DS7rgIrAmghBFwoOTujcf6D9rXvH8xm8JQ1Ja01h9QX8EzXldiszufYa4IFfKdLUKTTrnSFXLDkUEOTrZQ8Qg==" data-cf-beacon='{"version":"2024.11.0","token":"eba0929686f048338b9103c8a7ead10d","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}' crossorigin="anonymous"></script>
</body>
</html>
