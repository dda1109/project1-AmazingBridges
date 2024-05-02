$(document).ready(function () {
  $("body").css("padding-top", $(".navbar").outerHeight() + "px");

  //danh dau filter nao dang duoc dung
  var url = window.location.toString();
  $(".list-inline-item a")
    .filter(function () {
      return url.includes(this.href);
    })
    .addClass("active");
  $(".list-inline-item .active")
    .children()
    .removeClass("fa-circle-o")
    .addClass("fa-dot-circle-o");

  // hieu ung an/hien navbar khi scroll trang len/xuong
  var isNavBarShown = false;
  var last_scroll_top = 0;
  $(window).scroll(function () {
    scroll_top = $(this).scrollTop();
    if (scroll_top < last_scroll_top) {
      $(".navbar").fadeIn();
      isNavBarShown = true;
    } else {
      $(".navbar").fadeOut();
      isNavBarShown = false;
    }
    last_scroll_top = scroll_top;
  });

  $("#shownav").hover(function () {
    if (isNavBarShown) {
      return;
    }
    $(".navbar").fadeIn();
  });

  /* when navbar is hovered over it will override previous */

  $(".navbar").hover(function () {
    $(".navbar").show();
  });

  $(".fdi-Carousel .carousel-item").each(function () {
    var next = $(this).next();
    if (!next.length) {
      next = $(this).siblings(":first");
    }
    next.children(":first-child").clone().appendTo($(this));

    for (var i = 0; i < 2; i++) {
      next = next.next();
      if (!next.length) {
        next = $(this).siblings(":first");
      }

      next.children(":first-child").clone().appendTo($(this));
    }
  });

  $("#imageModal").on("show.bs.modal", function (event) {
    var image = $(event.relatedTarget);
    var src = image.attr("src");
    $("#imageModal #galleryCarousel .carousel-item")
      .filter(function () {
        return $(this).find("img").attr("src") == src;
      })
      .addClass("active");
  });
  $("#imageModal").on("hidden.bs.modal", function () {
    $("#imageModal .active").removeClass("active");
  });
});
