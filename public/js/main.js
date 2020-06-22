$(document).ready(function() {

  $(function () {
    $('select').selectpicker();
  });

  // load options for select
  console.log($('#awards').find("option").length);
  if ($('#awards').find("option").length < 1) {  //Check condition here
    console.log("something");
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
    let award_div = `<div class="form-row align-items-center award-div">
    <div class="form-group col-lg-10">
      <label for="award_name_list"> Award 1: <sup>*</sup></label>
      <input type="text" name="award_name_list[]" class="form-control form-control-lg" placeholder="testing">
    </div>
    <div class="form-group col-lg-2">
      <label for="category_list"> category of award: <sup>*</sup></label>
      <select class="selectpicker form-control" name="category_list[]">
        <option value="x" selected>Select</option>
        <option value="m">Movies</option>
        <option value="a">Actor</option>
        <option value="d">Director</option>
        <option value="p">Producer</option>
      </select>
    </div>
  </div>`;
    
    $(award_div).insertAfter(this);
    $('.selectpicker').selectpicker('render');
 
  });

});

function myNewFunction(url) {
  fn1();
}

function changeTesting(value, list) {
  console.log("value: " + value );
  console.log("list: " + list);
}