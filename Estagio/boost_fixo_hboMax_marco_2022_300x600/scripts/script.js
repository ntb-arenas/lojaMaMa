var load = function () {
  setTimeout(function () {
    $(".copy2").addClass("op-1 anim-top");
    setTimeout(function () {
      $(".copy3").addClass("op-1 anim-top");
      setTimeout(function () {
        $(".call").addClass("op-1 full");
        setTimeout(function () {
          $(".call").removeClass("full");
          setTimeout(function () {
            $(".call").addClass("full");
          }, 500);
        }, 500);
      }, 1000);
    }, 1000);
  }, 1000);
};

setTimeout(load, 0);
