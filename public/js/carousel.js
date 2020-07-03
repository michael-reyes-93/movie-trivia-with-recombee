$(document).ready(function() { 
  // $('#carouselExample0').on('slide.bs.carousel', function (e) {

  //   var $e = $(e.relatedTarget);
  //   var idx = $e.index();
  //   var itemsPerSlide = 7;
  //   var totalItems = $('.carousel-item0').length;
    
  //   if (idx >= totalItems-(itemsPerSlide-1)) {
  //       var it = itemsPerSlide - (totalItems - idx);
  //       for (var i=0; i<it; i++) {
  //           // append slides to end
  //           if (e.direction=="left") {
  //               $('.carousel-item0').eq(i).appendTo('.carousel-inner0');
  //           }
  //           else {
  //               $('.carousel-item0').eq(0).appendTo('.carousel-inner0');
  //           }
  //       }
  //   }
  // });

  // $('.carousel').carousel()

  $('.carousel-group').each(function(index, value){

    $('#carouselExample' + index).on('slide.bs.carousel', function (e) { 
      var $e = $(e.relatedTarget);
      var idx = $e.index();
      var itemsPerSlide = 7;
      var totalItems = $('.carousel-item' + index).length;

      if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item' + index).eq(i).appendTo('.carousel-inner' + index);
            }
            else {
                $('.carousel-item' + index).eq(0).appendTo('.carousel-inner' + index);
            }
        }
      }
    });
    // const link = this.href;
  
    // if (link.match(/https?:\/\//)) {
    //   console.log(link);
    // }
  });

});