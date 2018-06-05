
$(window).load(function () {
  // ******************* function to search Blogs ***********************//
  function searchCharter(blogContent, Title) {
    var charterVar, ul, i, li, a;
    charterVar = document.querySelector("#sCharter").value;
    // console.log(Title);
    ul = document.getElementById("#theTitle");
    li = ul.getElementsByTagName("li");

    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      if (a.innerHTML.toUpperCase().indexOf(Title) > -1 ) {
        alert(li[i]);
      }
    }
  }
  // ******************* End of function to search Blogs ***********************//


// ************************** Get DataFile *******************************
$.ajax({
    url: '../php/dataFile.php',
    method: 'post',
    success: function(data){
      data = JSON.parse(data);
      console.log(data);
      // Dumping Data on blogposts.html page
      $.each(data[0], function (i, val) {
          // $(".junk").append(`${val.content}`);
            // va.title = val.title.replace(/ /g, "_");           .replace(/\s/g, "_")
          var htmlDATA = $.parseHTML($("#wrapSearchNotices").append(""
            +'<div><h3 style="text-transform:capitalize"> <ul id="theTitle"><li class="text-center " > <a href="#"> '+val.title+' </a></li></ul></h3><hr>'
           + '<div class="">'+val.content+'</div>'
           +'<p class="pull-right bottomEdition" > <span class="fa fa-edit" onclick="editBlog(`'+val.title+'`,`'+val.id+'`, `'+val.content.replace(/"/g, "*")+'`)"> Edit</span> <span class="fa fa-trash"> Delete</span> </p></div><br><br><br><br><br>'
         )
       );
         var dataX = $("#wrapSearchNotices").append(htmlDATA);
         searchCharter(val.content, val.title);
      });
    },error: function(data){console.log(data);}
});
// **************************End of Get DataFile *******************************
});




//  *******************************  Editing The Blog **********************************
// var content;
function editBlog(title, id, content) {
   content = content.replace(/[*]/g, '"');
   $("#title_val").val(title);

  tinyMCE.get("#tinymcedata").setContent(content);

  $("#tinymcedata").val(content);

}
//  ******************************* End of Editing The Blog **********************************
$(document).ready(function () {
});


//     ++++++++++++++++++++++ Pictures Html +++++++++++++++++++++++++
$('#postimg').submit(function (e) {
  e.preventDefault();
  formdata1 = new FormData();
  formdata1.append("link",$("#imglink").val());
  formdata1.append("name",$("#imgname").val());
  $.ajax({
    url: '../php/pictures.php',
    method: 'post',
    processData : false,
    contentType : false,
    data: formdata1,
    success: function(data){
      console.log(data);
       alert("Data Posted.");
      $('#postimg')[0].reset();
    },error: function(data){console.log(data);}
  });
});
//     ++++++++++++++++++++++ End Pictures Html +++++++++++++++++++++++++


// $(window).bind("load resize", function() {
//     topOffset = 50;
//     width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
//     if (width < 768) {
//         $('div.navbar-collapse').addClass('collapse');
//         topOffset = 100; // 2-row-menu
//     } else {
//         $('div.navbar-collapse').removeClass('collapse');
//     }
//
//     height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
//     height = height - topOffset;
//     if (height < 1) height = 1;
//     if (height > topOffset) {
//         $("#page-wrapper").css("min-height", (height) + "px");
//     }
// });
