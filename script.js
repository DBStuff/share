function click(id){
    // document.getElementById(id).setAttribute(height, "10000px;");
    console.log("a");
}
$(window).on('load', function(){
    $.ajax({url: "http://localhost:8888/?action=listFlowers", success: function(result){
        var arr = result.split("|");
        console.log(arr);
        for(var i = 0; i < arr.length-1; i++){
            var obj = JSON.parse(arr[i]);
            $("#main").append("<div class='column' style='margin-bottom: 20px;' onclick='location.href = \"./sighting.html?name="+obj["COMNAME"]+"\";'><div class='card'><div class='embed-responsive embed-responsive-16by9'><img alt='Card image cap' class='card-img-top embed-responsive-item' src='http://localhost:8888/flower_pics/"+obj["COMNAME"]+".jpg' /></div><div class='card-block'><h4 class='card-title'>"+obj["COMNAME"]+"</h4><p class='card-text'>"+obj["GENUS"]+" "+obj["SPECIES"]+"</p><a href='./update.html?comname="+obj["COMNAME"]+"&genus="+obj["GENUS"]+"&species="+obj["SPECIES"]+"' class='btn btn-primary' style='margin-bottom:10px'>Update Flower Info</a><br/><a href='./add_sighting.html?name="+obj["COMNAME"]+"' class='btn btn-primary'>Add Sighting</a><br/><"+obj["COMNAME"].replace(" ", "")+"></"+obj["COMNAME"].replace(" ", "")+"></div></div></div>");
            console.log(obj);
        }
    }});
});