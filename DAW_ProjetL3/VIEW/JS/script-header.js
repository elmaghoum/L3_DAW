function mouseOverPP(){
    setTimeout(function(){
        $("#profile-pict").css("display", "none");
        $("#options-burger").css("display", "flex");
    }, 300);
}

function mouseLeavePP(){
    setTimeout(function(){
        $("#options-burger").css("display", "none");
        $("#profile-pict").css("display", "flex");
    }, 300);
}