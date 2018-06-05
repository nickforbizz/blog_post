$(document).ready(function () {
  //  alert("It works up to here.......");
});
var someData = "By this far it works";
// $("#BlogsRecent").hover(function () {
//     if($("#BlogsRecent div").hasClass("recentBlog")){$("#BlogsRecent div").hide()}
// }), function () {
//   $(".recentBlog em").show();
// }

$("#aboutDetails").click(function () {
  alert(someData);
});

$("#welcomeHeader").delay(2000).fadeIn();

window.addEventListener("scroll", resizeNav);
var theNav = document.querySelector("#theNav");
var headerOffset = theNav.offsetTop;

function resizeNav() {
  if (window.scrollY >= headerOffset) {
    document.body.classList.add("fixNav");
    document.body.style.paddingTop = theNav.offsetHeight + "px";
  }else {
    document.body.classList.remove("fixNav");
    document.body.paddingTop = "0px";
  }
}

$(window).bind("scroll", function () {
  var navHeight = $(window).height() - 400;
  if ($(window).scrollTop() > navHeight) {
    $("#theNav").addClass("navResized");
  }else {
    $("#theNav").removeClass("navResized");
  }
});

$('body').scrollspy({
      target: '#theNav',
      offset: 80
  });

  $("#theNav a").on("click", function (e) {
    if (this.hash !== "") {
      e.preventDefault();
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top,
      },{
        duration: 1500,
        easing: 'swing'
      }, function () {
        window.location.hash = hash;
      });
    }
  });
  // ******************* function to search Blogs ***********************//
  function searchCharter(blogContent, Title) {
    // var charterVar = document.querySelector("#sCharter").value;
    // console.log(Title);

    // var foundSearch  = Title.search(/charterVar/gi);
    // if (charterVar == foundSearch) {
    //   console.log(foundSearch);
    // }
    // if (foundSearch == Title) {
    //
    //   $("#seachBlogsResults").html(blogContent);
    // }
  }
  // ******************* End of function to search Blogs ***********************//

  // ************************** Get DataFile *******************************
  $.ajax({
      url: './Dashboard/php/dataFile.php',
      method: 'post',
      success: function(data){
        data = JSON.parse(data);
        console.log(data);
        // Dumping Data on blogposts.html page
        $.each(data[0], function (i, val) {
          searchCharter(val.content, val.title);
            $("#wrapSearchNotices").append(
            +'<div><h3 class="text-center" style="text-transform:capitalize">'+val.title+'</h3><hr>'
             +'<div class="">'+val.content+'</div>'
             +'<p class="pull-right" ><span class="badge CommentLikeIcon">11</span> <span class="fa fa-thumbs-o-up CommentLikeIconText" onclick="editBlog(`'+val.title+'`,`'+val.id+'`, `'+val.content.replace(/"/g, "*")+'`)"> Like</span>  <b onclick="showComment()"> <span class="badge CommentLikeIcon koment">4</span>  <span class="fa fa-comment CommentLikeIconText koment"> Comment</span> </b> </p></div><br>'
               +'<form class="form-comment"  method="post">'
                   +'<label>Comment Here</label>'
                   +'<div class="form-group input-group">'
                       +'<span class="input-group-addon">@</span>'
                       +'<input type="text" name="commentForPost" class="form-control" placeholder="Enter Your comment">'
                   +'</div>'
                     +'<div class="modal-footer">'
                         +'<button class="btnSend" type="submit" class="btn btn-primary">Send</button>'
                     +'</div>'
                 +'</form>');
        });
      },error: function(data){console.log(data);}
  });
  // **************************End of Get DataFile *******************************

function showComment() {
  $(".koment").click(function () {
    $(".form-comment").toggle();
    $(".btnSend").click(function () {
      slideUp();
    });
  });
}
