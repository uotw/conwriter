var trimCanvas = (function() {
    function rowBlank(imageData, width, y) {
        for (var x = 0; x < width; ++x) {
            if (imageData.data[y * width * 4 + x * 4 + 3] !== 0) return false;
        }
        return true;
    }

    function columnBlank(imageData, width, x, top, bottom) {
        for (var y = top; y < bottom; ++y) {
            if (imageData.data[y * width * 4 + x * 4 + 3] !== 0) return false;
        }
        return true;
    }

    return function(canvas) {
        var ctx = canvas.getContext("2d");
        var width = canvas.width;
        var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        var top = 0, bottom = imageData.height, left = 0, right = imageData.width;

        while (top < bottom && rowBlank(imageData, width, top)) ++top;
        while (bottom - 1 > top && rowBlank(imageData, width, bottom - 1)) --bottom;
        while (left < right && columnBlank(imageData, width, left, top, bottom)) ++left;
        while (right - 1 > left && columnBlank(imageData, width, right - 1, top, bottom)) --right;

        var trimmed = ctx.getImageData(left, top, right - left, bottom - top);
        var copy = canvas.ownerDocument.createElement("canvas");
        var copyCtx = copy.getContext("2d");
        copy.width = trimmed.width;
        copy.height = trimmed.height;
        copyCtx.putImageData(trimmed, 0, 0);

        return copy;
    };
})();


 var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(0, 0, 0)',
    velocityFilterWeight: .7,
    minWidth: 1.5,
    maxWidth: 3.5,
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


var loc, long, lat, countyurl;
function log(){
	/*
    var transport = $(".transport:checked").attr("id");
        if (transport == "friends") {
         	var transport = 1; 
        } else if (transport == "ems") {
          	var transport = 2;
        } else if (transport == "police") {
          	var transport = 3;
        }
    var destination = $(".destination:checked").attr("id");
	if (destination == "psych") {
       		destination = 1; 
        } else {
          	destination = 2;
        }
     var county = $("#county").val();
     */
   $.ajax({
      url : 'https://www.conwriter.com/lelog.php',
      async: true,
      type : 'POST',
      data: {
	key: "maQCVP4tXpVZCUkw"
      },
      dataType:'html',
      success : function(data) {              
	  //console.log('logged'+data);
      },
      error : function(request,error)
      {
          console.log('error logging:'+error);
      }
  });
}
function ipLookUp() {
  $.ajax("https://ipinfo.io/json").then(
    function success(response) {
      loc = response.loc;
      lat = loc.split(",")[0];
      long = loc.split(",")[1];
      countyurl =
        "https://geo.fcc.gov/api/census/area?lat=" +
        lat +
        "&lon=" +
        long +
        "&format=json";
      $.ajax(countyurl).then(function success(response) {
        var county = response.results[0].county_name;
        $("#county").val(county);
      });
    },

    function fail(data, status) {
      console.log("Request failed.  Returned status of", status);
    }
  );
}
//localStorage.clear();
function setstorage() {
  //localStorage.setItem("county", $("#county").val());
  //localStorage.setItem("phone", $("#phone").val());
  //localStorage.setItem("transport", $(".transport:checked").attr("id"));
  //localStorage.setItem("destination", $(".destination:checked").attr("id"));
}
function getstorage() {
	/*
  if (localStorage.getItem("phone") != null) {
    $("#phone").val(localStorage.getItem("phone"));
  }
  if (localStorage.getItem("transport") != null) {
    var transportid = localStorage.getItem("transport");
    $("#" + transportid).prop("checked", true);
  }
  if (localStorage.getItem("destination") != null) {
    var destinationid = localStorage.getItem("destination");
    $("#" + destinationid).prop("checked", true);
  }
  if (localStorage.getItem("county") != null) {
    $("#county").val(localStorage.getItem("county"));
  } else {
    ipLookUp();
  }
  */
}
function openfile(doc) {
  var filename = "CON-" + moment().format("MM-DD-YY-hh-mm-ss") + ".pdf";
  doc.save(filename);
  // var encodedpdf = doc.output('datauristring');
  // let pdfWindow = window.open("")
  // pdfWindow.document.write("<iframe width='100%' height='100%' src='" + encodeURI(encodedpdf) + "'></iframe>")
}
$(document).ready(function() {
  $("textarea").autoResize();
  $("body").on("click", "a[data-modal]", function() {
    $(this).modal(function() {});
    return false;
  });
  $(".custom-control-input").change(function() {
    //console.log('click');
    $(this)
      .parent()
      .siblings(".prose")
      .prop("required", false);
    $(this)
      .parent()
      .siblings("label.error")
      .remove();
  });
  $("textarea").keydown(function() {
    $(this)
      .siblings(".error")
      .remove();
  });
  $("#create").click(function() { 
    if (!$("#conform").valid()) {
      $("#warning").show();
    } else if(signaturePad.isEmpty()){
	alert('sign this CON first');
  } else {
      buildcon();
	log();
    }
  });
  var width = 211;
  var height = parseInt(2200 * width / 1700);
  function toDataURL(url, i, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
      var reader = new FileReader();
      reader.onloadend = function() {
        callback(reader.result, i);
      };
      reader.readAsDataURL(xhr.response);
    };
    xhr.open("GET", url);
    xhr.responseType = "blob";
    xhr.send();
  }
  function drawgrid(doc) {
    //vertical
    for (i = 10; i < 300; i += 5) {
      if (i % 10 == 0) {
        doc.setLineWidth(0.25);
        doc.setDrawColor(255, 0, 0);
        doc.line(i, 4, i, 300);
        doc.text(i - 2, 3, i + "");
        doc.text(i - 2, 125, i + "");
      } else {
        doc.setLineWidth(0.1);
        doc.setDrawColor(255, 0, 0);
        doc.line(i, 4, i, 300);
      }
    }
    //horizontal
    for (i = 10; i < 300; i += 5) {
      if (i % 10 == 0) {
        doc.setLineWidth(0.25);
        doc.setDrawColor(255, 0, 0);
        doc.line(6, i, 300, i);
        doc.text(0, i + 1, i + "");
      } else {
        doc.setLineWidth(0.1);
        doc.setDrawColor(255, 0, 0);
        doc.line(8, i, 300, i);
      }
    }
  }
String.prototype.trimRight = function(charlist) {
  if (charlist === undefined)
    charlist = "\s";

  return this.replace(new RegExp("[" + charlist + "]+$"), "");
};
String.prototype.trimLeft = function(charlist) {
  if (charlist === undefined)
    charlist = "\s";

  return this.replace(new RegExp("^[" + charlist + "]+"), "");
};
String.prototype.trim = function(charlist) {
  return this.trimLeft(charlist).trimRight(charlist);
};
String.prototype.capitalize = function() {
  return this.charAt(0).toUpperCase() + this.slice(1)
}
  function getvalues(index) {
    var id = "#q" + index;
    var textarea = "#b" + index;
    var text = "";
    $(id + " input").each(function() {
      if ($(this).is(":checked")) {
        text += $(this)
          .next()
          .text();
      }
    });
    if ($(textarea).val()) {
      var thistext=$(textarea).val();
      var trimmedtext=thistext.trim(". ");
      var correctedText= trimmedtext +". ";
      var capitalizedCorrected=correctedText.capitalize();
      text += capitalizedCorrected;
    }
    return text;
  }
  var images = ['','','','',''];
  var image;
  //console.log(images);
  function getimages() {
	  i=0;
      toDataURL(
        "https://www.conwriter.com/img/new23/le.jpg?v13",
        i,
        function(dataUrl,i) {
          //console.log("setting %s",i);
          image = dataUrl;
        }
      );
  }
  getimages();
  function buildcon() {
    setstorage();
    var doc = new jsPDF();
    var patientname = $("#pt").val();
    var ofname = $("#of").val();
    var date = moment().format("L");
    var longdate = moment().format("MMMM Do");
    var longyear = moment().format("YYYY");
    var time = moment().format("hh:mm A");
    var timenoa = moment().format("hh:mm");
    var ampm = moment().format("A");
    var q1 = doc.splitTextToSize(getvalues(1), 270);
    var q2 = doc.splitTextToSize(getvalues(2), 240);
    var q3 = doc.splitTextToSize(getvalues(3), 240);
    var q4 = doc.splitTextToSize(getvalues(4), 240);
    var q1q2 = doc.splitTextToSize(getvalues(1)+getvalues(2), 270);
        //PAGE 1
        doc.addImage(image, "JPEG", 0, 10, width, height);
        doc.lineHeight = 1.72;
        doc.setFontSize(10.3);
        doc.text(27, 216, date);
        doc.text(27, 223, time);
        doc.text(120, 223, ofname);
        doc.text(80, 122, patientname);
        //doc.lstext(q1, 20,177, 10);
        doc.text(20, 177.6, q1q2);
        //doc.addPage();
	  //
	  //sig: 110,216 same as date
	var sig = signaturePad.toDataURL();
	var can = $('#signature-pad').get(0);
	var canTrimmed = trimCanvas(can);
	var sigWidth = 36 * canTrimmed.width / 600;
	var sigHeight = 12 * canTrimmed.height / 200;
	var sigY = 205 + ( 12 - sigHeight);
	doc.addImage(canTrimmed.toDataURL(),"PNG", 115, sigY, sigWidth, sigHeight);
	console.log(sigY, sigWidth, sigHeight);
	//drawgrid(doc);
        openfile(doc);
  }
});

