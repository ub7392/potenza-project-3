$(document).ready(function(){
  peopleDropdown();
  stateDropdown();
  info();

  $("#addperson")[0].reset();
  $("#addvisit")[0].reset();

  $('#submitperson').on('click', function(e){
    e.preventDefault();
    addPerson();
    $("#addperson")[0].reset();
  });

  $('#submitvisit').on('click', function(e){
    e.preventDefault();
    addVisit();
    $("#addvisit")[0].reset();
  });
});

function peopleDropdown(){
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "api/people",
    success: function(data){
      $("#people option").not("#people_id").remove();
      $("#peoplevisit option").remove();

      $.each(data, function(i, datap){
        var people_id = data[i]["people_id"];
        var first_name = data[i]["first_name"];
        var last_name = data[i]["last_name"];

        $("#people").append("<option value='"+people_id+"'>"+first_name+ " "+last_name+"</option>");
        $("#peoplevisit").append("<option value='"+people_id+"'>"+first_name+ " "+last_name+"</option>");
      });
    },
    error: function(data){
      console.log("There is an error loading people.");
      console.log(data);
    }
  });
}

function stateDropdown(){
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "api/states",
    success: function(data){
      $("#states option").remove();

      $.each(data, function(i, datap){
        var states_id = data[i]["states_id"];
        var states_name = data[i]["states_name"];
        var states_abbreviation = data[i]["states_abbreviation"];
        $("#states").append("<option value='"+states_id+"'>"+states_name+ " - "+states_abbreviation+"</option>");
      });
    },
    error: function(data){
      console.log("There is an error loading states");
      console.log(data);
    }
  });
}

function info(){
  $("#people").change(function(){
    var person_id = $("#people").val();

    $("#peopleInfo").empty();
    $("#visitInfo").empty();

    /*$.ajax({
      type: "GET",
      dataType: "json",
      url: "api/visits/" + person_id,
      success: function(data){
        var first_name = data[0]["first_name"];
        var last_name = data[0]["last_name"];
        var favorite_food = data[0]["favorite_food"];

        $("#peopleInfo").append("<p></p><p>Name: " +first_name+ " " +last_name+ "</p><p>Favorite Food: " +favorite_food+ "</p><p>State(s) Visited: </p>");

            var len = data.length;

            for(var i = 0; i < len; i++){
              var states_name = data[i]["states_name"];
              var states_abbreviation = data[i]["states_abbreviation"];
              var date_visited = data[i]["date_visited"];

            if(jQuery.isEmptyObject(states_name))
            {
              $("#visitInfo").append("No visits were recorded");
            }else{
              $("#visitInfo").append(" "+states_name+" - "+states_abbreviation+" on " +date_visited+ "</p>");
            }}
      },
      error: function(data){
        console.log(data);
      }
    });*/
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "api/people/" + person_id,
      success: function(data){
        var first_name = data[0]["first_name"];
        var last_name = data[0]["last_name"];
        var favorite_food = data[0]["favorite_food"];

        $("#peopleInfo").append("<p></p><p>Name: " +first_name+ " " +last_name+ "</p><p>Favorite Food: " +favorite_food+ "</p><p>State(s) Visited: </p>");
      },
      error: function(data){
        console.log(data);
      }
    });
    
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "api/visits/" + person_id,
      success: function(data){
        if(data != null)
        {
          var len = data.length;
          for(var i = 0; i < len; i++){
            //var states_name = data[i]["states_name"];
            //var states_abbreviation = data[i]["states_abbreviation"];
            var state_id = data[i]["state_id"];
            var date_visited = data[i]["date_visited"];
          //$("#visitInfo").append(" "+states_name+" - "+states_abbreviation+" on " +date_visited+ "</p>");
          $("#visitInfo").append(" "+state_id+" on " +date_visited+ "</p>");
        }
        }else{
          $("#visitInfo").append("No visits were recorded");
        }
      },
      error: function(data){
        console.log(data);
      }
    });

  });
}

function addPerson(){
  var first_name = document.getElementById("first_name").value;
  var last_name = document.getElementById("last_name").value;
  var favorite_food = document.getElementById("favorite_food").value;
  //Check input Fields Should not be blanks.
  if (first_name == '' || last_name == '' || favorite_food == '') {
  alert("Please Fill All Fields!");
  }else{
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "api/people",
      data: $("#addperson").serialize(),
      success: function(data){
        console.log("Person successfully Added");
      	console.log(data);
        peopleDropdown();
      },
      error: function(data){
       console.log("There is something wrong while adding this person");
       console.log(data);
      }
    });
  }
}

function addVisit(){
  var date_visited = document.getElementById("date_visited").value;
  //Check input Fields Should not be blanks.
  if (date_visited == '') {
    alert("Please Fill All Fields!");
  }else{
	   $.ajax({
       type: "POST",
      // dataType: "json",
       url: "api/visits",
       data: $("#addvisit").serialize(),
       success: function(data)
       {
         console.log("Visit successfully added");
         console.log(data);
       },
       error: function(data){
        console.log("There is something wrong while adding your visit");
       	console.log(data);
       }
     });
  }
}
