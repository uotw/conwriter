<!DOCTYPE html>
<html lang="en" >
<head>
  <meta http-equiv="Cache-control" content="private,max-age:3600">
  <meta charset="UTF-8">
  <title>CON Writer (6401)</title>
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
.btn{ 
    margin: 5px;
    height: 75px;
	    width: 100%;
    position: relative;
    /* float: right; */

background-color:#4678b3;}
.btn:hover{ opacity:0.8; background-color:#4678b3}
h1{
}
.qbad{
	width:240px;
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
top: 5px;
    position: absolute;
    right: 19px;
    width:240px;
        transition: 0.7s all;
	margin-right:-262px;
}
#about{
	margin-left:5px;
}

#signature-pad{
background-color: white;

}
</style>
</head>
<body>
<!-- partial:index.partial.html -->
<h1>CON Writer (6401)</h1>
<h6>©2024 <a href="mailto:bensmith.md@gmail.com">Ben Smith, MD, FACEP</a><span id=about><a href="#aboutdialogue" data-modal>[about]</a>  </span><a href="/stats/">[stats]</a></h6>
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
        <label for="of_name">Officer Name</label>
        <input type="text" class="form-control" id=of name="of" placeholder="Enter provider name" required="true" oninvalid="this.setCustomValidity('Please enter a provider\'s name')" oninput="setCustomValidity('')">
      </div>
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
    </div>
    <div class="column">
    <div class=form-group id=sig>
        <h5>Sign here</h5>

        <canvas id="signature-pad" width="600" height="200"></canvas>

        <div>
		<button id="clear">Clear</button>
        </div>

    </div>
	<button id=create class="btn btn-primary" type="button">Create</button>
    </div>
    <div class=form-group>

    </div>
  </div>
</form>
<!-- partial --> 
<script src='./js/jspdf.debug.js?v2'></script>
<script src='./js/jquery.min.js'></script>
<script src='./js/jquery.validate.min.js'></script>
<script src='./js/moment.min.js'></script>
<script src='./js/jquery.modal.min.js'></script>
<script src='./js/autoresize.js?v24'></script>
<script src='./js/signature_pad.umd.min.js'></script>
<script src='./js/script.le.v3.js?v13'></script>
<script>
/*
$( document ).ready(function() {

 var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)',
    velocityFilterWeight: .7,
    minWidth: 0.5,
    maxWidth: 2.5,
    throttle: 0, // max x milli seconds on event update, OBS! this introduces lag for event update
    minPointDistance: 5,
 });
 var saveButton = document.getElementById('save'),
    clearButton = document.getElementById('clear'),
    showPointsToggle = document.getElementById('showPointsToggle');
  clearButton.addEventListener('click', function(event) {
         event.preventDefault();
    signaturePad.clear();
  });
 saveButton.addEventListener('click', function(event) {
	 event.preventDefault();
	   console.log(signaturePad.toDataURL());
   });
});
 */
</script>

</body>
</html>
