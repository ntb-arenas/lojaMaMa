var load = function () {
  $(".bg").addClass("grow");
  setTimeout(function () {
    $(".elem1").addClass("anim op-1");
    setTimeout(function () {
      $(".elem2").addClass("anim op-1");
      $(".copy2").addClass("anim op-1");
      setTimeout(function () {
        $(".elem2").removeClass("anim op-1");
        $(".copy2").removeClass("anim op-1");
        $(".elem1").removeClass("anim op-1");
        setTimeout(function () {
          $(".call").addClass("op-1 full");
          setTimeout(function () {
            $(".call").removeClass("full");
            setTimeout(function () {
              $(".call").addClass("full");
            }, 500);
          }, 500);
        }, 500);
      }, 2500);
    }, 250);
  }, 800);
};

setTimeout(load, 0);
