<!DOCTYPE html>
<html lang="en" >
<head>
  <meta http-equiv="Cache-control" content="private,max-age:3600">
  <meta charset="UTF-8">
  <title>CON Writer</title>
  <link rel='stylesheet' href='./css/bootstrap.min.css'>
<link rel='stylesheet' href='./css/jquery.modal.min.css'>
<link rel="stylesheet" href="./css/style.css?<?php echo time();?>">
<style>
body{
overflow-x:hidden;
}
a{
	color:#4678b3;
}
.btn{ background-color:#4678b3;
width: 100%;
}
.btn:hover{ opacity:0.8; background-color:#4678b3}
h1{
}
.qbad{
	width:180px;
	position:absolute;
	border-radius:5px;
	transition:all 0.5s;
}
.qbad:hover{
	opacity:0.9;
	transition:all 0.5s;
	transform:scale(1.05);
}
.adwrap{
top: 8px;
    position: absolute;
    right: 19px;
    width:180px;
        transition: 0.7s all;
	margin-right:-262px;
}
#about{
	margin-left:5px;
}
#otherlinks{
	font-size:10px;
}
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<h1>CON Writer</h1>
<span class=adwrap><a href="https://coreultrasound.com/" target=_blank><img src='img/CoreUS.Ad.png' class=qbad></a></span>
<h6>©2024 <a href="mailto:bensmith.md@gmail.com">Ben Smith, MD, FACEP</a><span id=about><a href="#aboutdialogue" data-modal>[about]</a>  </span><a href="/stats/">[stats]</a></h6>
<h6 id=otherlinks>this is for licensed physicians, need the <a href=le.php>LE/6401 version</a> or the <a href=mpa.php>MPA version</a>?</h6>
<div id=aboutdialogue>
  About
  <ul>
    <li>This tool generates a TN Certificate of Need for involuntary psychiatric commitment.</li>
    <li>This is an in-browser PDF generator, no PHI is stored or transmitted.</li>
    <li>No patient-specific information typed in here is sent to the web.</li>
    <li>Destination, Transport method, and County will be logged.</li>
    <li>Provider Phone, County, Transport Method, and Destination will be stored in your browser for the next time you visit this page.</li>
    <li>This use of this tool does not constitiute any form of medical advice.</li>
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
      <button class="btn btn-primary" type="button">Create</button>
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
<!-- partial --> 
<script src='./js/jspdf.debug.js'></script>
<script src='./js/jquery.min.js'></script>
<script src='./js/jquery.validate.min.js'></script>
<script src='./js/moment.min.js'></script>
<script src='./js/jquery.modal.min.js'></script>
<script src='./js/autoresize.js?v22'></script>
<script src='./js/script.v4.js?v<?php echo time();?>'></script>

</body>
</html>
