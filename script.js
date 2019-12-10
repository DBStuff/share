
$(window).on('load', function(){
    $.ajax({url: "http://localhost:8888/?action=listFlowers", success: function(result){
        var arr = result.split("|");
        console.log(arr);
        for(var i = 0; i < arr.length-1; i++){
            var obj = JSON.parse(arr[i]);
            $("#main").append("<div class='column' style='margin-bottom: 20px;'><div class='card'><div class='embed-responsive embed-responsive-16by9'><img alt='Card image cap' class='card-img-top embed-responsive-item' src='./flower_pics/"+obj["COMNAME"]+".jpg' /></div><div class='card-block'><h4 class='card-title'>"+obj["COMNAME"]+"</h4><p class='card-text'>"+obj["GENUS"]+" "+obj["SPECIES"]+"</p><a href='./update.html?comname="+obj["COMNAME"]+"&genus="+obj["GENUS"]+"&species="+obj["SPECIES"]+"' class='btn btn-primary' style='margin-bottom:10px'>Update Flower Info</a><br/><a href='./Add_Sighting.html' class='btn btn-primary'>Add Sighting</a></div></div></div>");
            console.log(obj);
        }
    }});
});