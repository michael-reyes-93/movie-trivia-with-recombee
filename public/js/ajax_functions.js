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
  let genre_name = $("#genre-name").val();
  $.post(url, {genre: genre_name} ).done(function(data, textStatus, jqXHR) {
    let currentClass = $('#genre input').attr('class');
    console.log(data);
    if (!data.success && !currentClass.includes("is-invalid")) {
      console.log("here");
      $("#genre input").toggleClass("is-invalid");
      $("#genre span").text(data.msg1);
    } 
    else if (data.success && currentClass.includes("is-invalid")){
      $("#genre input").toggleClass("is-invalid");
      $("#genre" ).fadeToggle("slow", "linear");
      $('#genre-select').append($('<option value="' + data.genre_id + '">' + genre_name + '</option>'));
      $('.selectpicker').selectpicker('refresh');
    } 
    else if (data.success && !currentClass.includes("is-invalid")) {
      $("#genre" ).fadeToggle("slow", "linear");
      $('#genre-select').append($('<option value="' + data.genre_id + '">' + genre_name + '</option>'));
      $('.selectpicker').selectpicker('refresh');
    }
    
    //is-invalid
  }).fail(function(jqXHR, textStatus, errorThrown) 
  {
    console.log(jqXHR.responseText);
    //failed
  });
}

function addParticipant(url, id, category) {
  console.log(url);
  console.log("category: " + category);
  // category_name = $("#category-name").val();
  console.log("status: " + $("#status-" + id).val());
  console.log("particpant id: " + $("#participant-picked-" + id).val());
  category_name = "nothing";
  $.post(url, {status: $("#status-" + id).val(), participant_picked: $("#participant-picked-" + id).val(), award_id: id, category: category} )
  .done(function(data, textStatus, jqXHR) {
    console.log(data.redirect);
    // if (!data.success && !currentClass.includes("is-invalid")) {
    //   $("#category input").toggleClass("is-invalid");
    //   $("#category span").text(data.msg1);
    // } else if (data.success && currentClass.includes("is-invalid")){
    //   $("#category input").toggleClass("is-invalid");
    // }

    // window.location.href = data.redirect;
    
    //is-invalid
  }).fail(function(jqXHR, textStatus, errorThrown) 
  {
    console.log(jqXHR.responseText);
    //failed
  });
}

function editParticipant(url, participant_id, category) {
  console.log(url);
  console.log("category: " + category);
  // category_name = $("#category-name").val();
  console.log("status: " + $("#status-" + participant_id).val());
  console.log("particpant picked: " + $("#participant-picked-" + participant_id).val());
  category_name = "nothing";
  $.post(url, {status: $("#status-" + participant_id).val(), participant_picked: $("#participant-picked-" + participant_id).val(), participant_id: participant_id, category: category} )
  .done(function(data, textStatus, jqXHR) {
    console.log(data.redirect);
    // if (!data.success && !currentClass.includes("is-invalid")) {
    //   $("#category input").toggleClass("is-invalid");
    //   $("#category span").text(data.msg1);
    // } else if (data.success && currentClass.includes("is-invalid")){
    //   $("#category input").toggleClass("is-invalid");
    // }

    // window.location.href = data.redirect;
    
    //is-invalid
  }).fail(function(jqXHR, textStatus, errorThrown) 
  {
    console.log(jqXHR.responseText);
    //failed
  });
}

function deleteParticipant(url, participant_id, category, award_id) {
  console.log(url);
  console.log("category: " + category);
  console.log("award id: " + award_id);
  console.log("participant id: " + participant_id);
  category_name = "nothing";
  $.post(url, {participant_id: participant_id, category: category, award_id: award_id} )
  .done(function(data, textStatus, jqXHR) {
    console.log(data.redirect);
    // window.location.href = data.redirect;
    
  }).fail(function(jqXHR, textStatus, errorThrown) 
  {
    console.log(jqXHR.responseText);
    //failed
  });
}

function addMovieToTop5(url) {
  console.log(url);
  $.post(url, {movie: $("#top5-movie-picked").val()} )
  .done(function(data, textStatus, jqXHR) {
    console.log(data.redirect);
    // window.location.href = data.redirect;
    
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