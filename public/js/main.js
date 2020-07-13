$(document).ready(function() {

  $(function () {
    $('select').selectpicker();
    $('[data-toggle="tooltip"]').tooltip();
  });

  $("#countries").on("change", function() {
    // var selectedOption = $(this).val();
    // if (selectedOption == '0') {
    //   console.log("show");
    //   $('#sign-out').modal('show');
    // }
    // else {
    //   $('#sign-out').modal('hide');
    // }
  });

  $("#logout").click(function(){
    // $("#countries option:selected").each(function () {
    //   if ( $(this).val() == '0') {}
    //   $(this).removeAttr('selected'); 
    // });
  });

  $(".toggle-country" ).on( "click", function() {
    $("#country" ).fadeToggle("slow", "linear");
  });

  $(".toggle-genre" ).on( "click", function() {
    $("#genre" ).fadeToggle("slow", "linear");
  });

  $(".toggle-language" ).on( "click", function() {
    $("#language" ).fadeToggle("slow", "linear");
  });

  $("#uploaded_poster").change(function(){
    console.log($(this)[0].files[0]);
    if ($(this)[0].files && $(this)[0].files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
       
        $('#poster-preview').attr('src', e.target.result)

        $('#poster-preview-2').attr('src', e.target.result)
          
        $("#posters-preview" ).fadeIn( "slow" );
      };

      reader.readAsDataURL($(this)[0].files[0]);
      
    }
  });

  $("#uploaded_catalog_photo").change(function(){
    console.log($(this)[0].files[0]);
    if ($(this)[0].files && $(this)[0].files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
       
        $('#catalog-photo-preview').attr('src', e.target.result)
          
        $("#catalog-preview").fadeIn( "slow" );
      };

      reader.readAsDataURL($(this)[0].files[0]);
      
    }
  });

  // load options for select
  if ($('#awards').find("option").length < 1) {  //Check condition here
    $('#awards').empty().append('<option>select</option>');        
    // $.ajax({
    //         url: '/ci/ajaxcall/loadRoles.php',
    //         dataType: 'json',
    //         type: 'POST',
    //         data: {"userCode": userCode},
    //         success: function(response) {
    //           var array = response.value;
    //           if (array != '')
    //           {
    //             for (i in array) {                        
    //              $("#roleType").append("<option>"+array[i].ROLE_TYPE+"</option>");
    //            }

    //           }

    //         },
    //         error: function(x, e) {

    //         }

    //     });
  }

  $("#add-awards").click(function () {
    let award_div = `<div class="form-row align-items-center award-div"><div class="form-group col-lg-8"><label for="award_name_list"> Award 1: <sup>*</sup></label><input type="text" name="award_name_list[]" class="form-control form-control-lg" placeholder=""></div><div class="form-group col-lg-3"><label for="category_list"> category of award: <sup>*</sup></label><select class="selectpicker form-control" name="category_list[]"><option value="x" selected>Select</option><option value="m">Movies</option><option value="a">Actor</option><option value="d">Director</option><option value="p">Producer</option></select></div><input name="ids[]" type="hidden" value="x"><input name="status[]" type="hidden" value="new"><button type="button" class="btn btn-danger award-status-remove"><i class="fas fa-minus-circle"></i></button></div>`;
    
    $('#awards-with-category').append(award_div);
    $('.selectpicker').selectpicker('render');
 
  });

  // If the game pieces are added after the page load (i.e. by clicking a button) you need to use event delegation by using 
  // jquery .on()

  // Event delegation allows us to attach a single event listener, to a parent element, that will fire for all descendants 
  // matching a selector, whether those descendants exist now or are added in the future.
  $('#awards-with-status').on('click','.award-status-remove', function(){
    console.log("something");
    $(this).parent().remove();
  });

  $('#awards-with-category').on('click','.award-status-remove', function(){
    console.log("something");
    if ($(this).siblings('input[name^="status"]').val() != 'new') {
      $(this).parent().hide();
      $(this).siblings('input[name^="status"]').val("deleted");
      console.log($(this).siblings('input[name^="status"]').val());
    } else {
      $(this).parent().remove();
    }
  });

  $('.page-item').click(function() {
    let page = $(this).attr('page');
    let current_page = parseInt($('.page-item.active').attr('page'));
    let limit = parseInt($(".page-item[page='next']").attr('limit'));

    if (page == "previous") {
      if(current_page > 1) {
        current_page -= 1;
        $( ".page-item[page='" + current_page + "']" ).addClass('active').siblings().removeClass('active');
        testingArrays(current_page);
      }
    } else if(page == "next") {
      if (current_page < parseInt($(this).attr('limit'))) {
        current_page += 1;
        $( ".page-item[page='" + current_page + "']" ).addClass('active').siblings().removeClass('active');
        testingArrays(current_page);
      } 
    } else {
      console.log(page);
      $(this).addClass('active').siblings().removeClass('active');
      testingArrays(page);
    }
  });

  $('.page-item').click(function() {
    let page = $(this).attr('page');
    let current_page = parseInt($('.page-item.active').attr('page'));
    let limit = parseInt($(".page-item[page='next']").attr('limit'));

    if (page + 1 > limit || current_page + 1 > limit) {
      $(".page-item[page='next']").hide();
    }
    if (page - 1 < 1 || current_page - 1 < 1) {
      $(".page-item[page='previous']").hide();
    }
    if (current_page < limit) {
      if ($(".page-item[page='next']").is(":hidden")) {
        $(".page-item[page='next']").show();
      }
    }
    if (current_page > 1) {
      if ($(".page-item[page='previous']").is(":hidden")) {
        $(".page-item[page='previous']").show();
      }
    }
  });

});



function myNewFunction(url) {
  // fn1();
}

function changeTesting(value, list) {
  console.log("value: " + value );
  console.log("list: " + list);
}