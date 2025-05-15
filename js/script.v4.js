var loc, long, lat, countyurl;
function log(){
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
   $.ajax({
      url : 'https://www.conwriter.com/log.php',
      async: true,
      type : 'POST',
      data: {
	key: "maQCVP4tXpVZCUkw",
	transport: transport,
	destination: destination,
	county:county
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
  localStorage.setItem("county", $("#county").val());
  localStorage.setItem("phone", $("#phone").val());
  localStorage.setItem("transport", $(".transport:checked").attr("id"));
  localStorage.setItem("destination", $(".destination:checked").attr("id"));
}
function getstorage() {
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
}
function openfile(doc) {
  var filename = "CON-" + moment().format("MM-DD-YY-hh-mm-ss") + ".pdf";
  doc.save(filename);
  // var encodedpdf = doc.output('datauristring');
  // let pdfWindow = window.open("")
  // pdfWindow.document.write("<iframe width='100%' height='100%' src='" + encodeURI(encodedpdf) + "'></iframe>")
}
$(document).ready(function() {
  $('.adwrap').css('margin-right','0');
  //alert($('.transport:checked').attr('id'));
  $("#phone").focus(function() {
    //alert('focus');
    $(this).select();
  });
  getstorage();
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
  $(".btn").click(function() {
    if (!$("#conform").valid()) {
      $("#warning").show();
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
	  console.log('dg');
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
  //console.log(images);
  function getimages() {
    for (i = 1; i < 6; i++) {
      toDataURL(
        "https://www.conwriter.com/img/2024/" + i + ".jpg?2",
        i,
        function(dataUrl,i) {
          //console.log("setting %s",i);
          images.splice(i-1,1,dataUrl);
          if(i==5){
            //console.log(images);
          }
        }
      );
    }
  }
  getimages();
  function buildcon() { 
    console.log('building');
    setstorage();
    var doc = new jsPDF();
    var patientname = $("#pt").val();
    var mdname = $("#md").val();
    var county = $("#county").val();
    var phone = $("#phone").val();
    var transport = $(".transport:checked").attr("id");
    var destination = $(".destination:checked").attr("id");
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
	 console.log('set point 1');
	  console.log(images);
    for (i = 1; i < 6; i++) {
	    console.log(i);
      if (i == 1) {
        //PAGE 1
        doc.addImage(images[0], "JPEG", 0, 10, width, height);
        doc.lineHeight = 1.72;
        doc.setFontSize(10.3);
        doc.text(27, 216, date);
        doc.text(27, 223, time);
        doc.text(120, 223, mdname);
        doc.text(80, 122.2, patientname);
        //doc.lstext(q1, 20,177, 10);
        doc.text(20, 177.6, q1q2);
        doc.addPage();
      } else if (i == 2) {
        //PAGE 2 (BLANK)
        //doc.addImage(images[1], "JPEG", 0, 10, width, height);
        //doc.addPage();
      } else if (i == 3) {
        //PAGE 3
        doc.addImage(images[2], "JPEG", 0, 10, width, height);
        doc.text(30, 61, longdate);
        doc.text(88, 61, longyear);
        doc.text(115, 61, timenoa);
        doc.setLineWidth(1);
        doc.setDrawColor(0);
        if (ampm == "AM") {
          doc.ellipse(135, 60, 5, 3);
        } else {
          doc.ellipse(143.2, 60, 5, 3);
        }
        doc.text(25, 44, mdname);
        doc.text(125, 44, county);
        doc.text(115, 52.5, patientname);
        doc.setFontSize(10.3);
	
	doc.lineHeight = 1.3;
	doc.setFillColor(25,25,0);
        doc.text(20, 263.7, q1);
	doc.lineHeight = 1.72;
	//drawgrid(doc);
        doc.addPage();
      } else if (i == 4) {
        //PAGE 4
        doc.addImage(images[3], "JPEG", 0, 10, width, height);
        //doc.setFontType("bold");
	doc.setFontSize(14);
        if (transport == "friends") {
          doc.text(16.6, 155.4, "X");
        } else if (transport == "ems") {
          doc.text(16.6, 181, "X");
        } else if (transport == "police") {
          doc.text(16.5, 181, "X");
        }
        if (destination == "psych") {
          doc.text(16.7, 146.7,"X");
        } else {
          doc.text(16.7, 138.2, "X");
        }
      doc.setFontSize(10.3);
      doc.setFontType("normal");
        doc.lineHeight = 1.15;
        doc.text(25, 264.1, date);
        doc.text(60, 264.1, time);
        doc.text(120, 264.1, phone);
        doc.text(25, 254, mdname);
        doc.text(30, 58.2, q2);
        doc.text(30, 83.8, q3);
        doc.text(30, 109.2, q4);
	doc.text(44,17,patientname);
	doc.text(93,17,date);
        doc.addPage();
      } else if (i == 5) {
        //PAGE 5
        doc.addImage(images[4], "JPEG", 0, 0, width, height);
	doc.text(50,12,patientname);
	//doc.addPage();
	//drawgrid(doc);
        openfile(doc);

      }
    }
  }
});
/*
$('input[type="checkbox"]').prop('checked', true).trigger('input');
$('.prose').val('.');
$('#pt').val('John Doe');
$('#md').val('Ben Smith, MD');
*/
