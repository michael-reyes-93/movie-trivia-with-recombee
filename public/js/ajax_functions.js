function myFunction(url) {
  country_name = $("#country-name").val();
  console.log($("#country-name").val());
  $.post(url, {country: country_name} ).done(function(data, textStatus, jqXHR) {
    currentClass = $('#country input').attr('class');
    console.log(data);
    if (!data.success && !currentClass.includes("is-invalid")) {
      $("#country input").toggleClass("is-invalid");
      $("#country span").text(data.msg1);
    } else if (data.success && currentClass.includes("is-invalid")){
      $("#country input").toggleClass("is-invalid");
    }
    
    //is-invalid
  }).fail(function(jqXHR, textStatus, errorThrown) 
  {
    console.log(jqXHR.responseText);
    //failed
  });
}

function myFunction2(url) {
  category_name = $("#category-name").val();
  console.log($("#country-name").val());
  $.post(url, {category: category_name} ).done(function(data, textStatus, jqXHR) {
    currentClass = $('#category input').attr('class');
    console.log(data);
    if (!data.success && !currentClass.includes("is-invalid")) {
      $("#category input").toggleClass("is-invalid");
      $("#category span").text(data.msg1);
    } else if (data.success && currentClass.includes("is-invalid")){
      $("#category input").toggleClass("is-invalid");
    }
    
    //is-invalid
  }).fail(function(jqXHR, textStatus, errorThrown) 
  {
    console.log(jqXHR.responseText);
    //failed
  });
}

function fn1() {
  alert("external fn clicked");
}

$(document).ready(function(){

  $("#country_add").click(function(){
    // console.log("HELLO");
    // $.post("demo_test_post.asp",
    // {
    //   name: "Donald Duck",
    //   city: "Duckburg"
    // },
    // function(data,status){
    //   alert("Data: " + data + "\nStatus: " + status);
    // });


  });

});