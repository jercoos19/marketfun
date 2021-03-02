// When the user clicks the button, open the modal 
$(document).ready(function () {
    $("#logBtn").click(function(){
        $('.logmodal').css('display','block');
    });
    $("#resBtn").click(function(){
        $('.resmodal').css('display','block');
    });
    $("#upBtn").click(function(){
        $('.memupmodal').css('display','block');
    });
    $("#pswBtn").click(function(){
        $('.pswupmodal').css('display','block');
    });
});
// When the user clicks on <span> (x), close the modal
$(document).ready(function () {
    $(".close").click(function(){
        $('.logmodal').css('display','none');
    });
    $(".close").click(function(){
        $('.resmodal').css('display','none');
    });
    $(".close").click(function(){
        $('.memupmodal').css('display','none');
    });
    $(".close").click(function(){
        $('.pswupmodal').css('display','none');
    });
    $(".close").click(function(){
        $('.forgetpassmodal').css('display','none');
    });
});
// When the user clicks anywhere outside of the modal, close it
var delemodal = document.getElementById("deleModal");
var logmodal = document.getElementById("logModal");
var resmodal = document.getElementById("resModal");
var memupmodal = document.getElementById("memupModal");
var pswupmodal = document.getElementById("pswupModal");
var forgetpassmodal = document.getElementById("forgetpassModal");
window.onclick = function(event) {
    if (event.target == delemodal) {
        delemodal.style.display = "none";
    }
    if (event.target == memupmodal) {
        memupmodal.style.display = "none";
    }
    if (event.target == logmodal) {
        logmodal.style.display = "none";
    }
    if (event.target == resmodal) {
        resmodal.style.display = "none";
    }
    if (event.target == pswupmodal) {
        pswupmodal.style.display = "none";
    }
    if (event.target == forgetpassmodal) {
        forgetpassmodal.style.display = "none";
    }
};