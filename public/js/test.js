$(document).ready(function() {

  $('.gallery-list-item').click(function() {
    let value = $(this).attr('data-filter');
    if (value === 'all') {
      $('.filter').show(300);
    } else {
      $('.filter').not('.' + value).hide(300);
      $('.filter').filter('.' + value).show(300);
    }
  });

  $('.gallery-list-item').click(function() {
    $(this).addClass('active-item').siblings().removeClass('active-item');
  });

  // $("#add-awards").click(function () {
  //   let award_div = `<div class="form-row align-items-center award-div">
  //   <div class="form-group col-lg-10">
  //     <label for="award_list"> Award 1: <sup>*</sup></label>
  //     <input type="text" name="award_list[]" class="form-control form-control-lg <?= (!empty($data['award_list_err'])) ? 'is-invalid' : ''; ?>" value="" placeholder="testing">
  //     <span class="invalid-feedback"><?= $data['award_list_err']; ?></span>
  //   </div>
  //   <div class="form-group col-lg-2 mt-4">
  //       <select class="selectpicker form-control <?= (!empty($data['participated_as_err'])) ? 'is-invalid' : ''; ?>" name="category[]">
  //       <option value="" disabled selected>Select</option>
  //       <option value="m">Movies</option>
  //       <option value="a">Actor</option>
  //       <option value="d">Director</option>
  //       <option value="p">Producer</option>
  //     </select>
  //   </div>
  // </div>`;
    
  //   $(award_div).insertAfter(this);
 
  // });

});