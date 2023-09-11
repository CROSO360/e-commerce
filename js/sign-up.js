var input = document.getElementById('floatingPassword');
var input2 = document.getElementById('floatingPassword2');
var check=document.getElementById('flexCheckChecked');
check.addEventListener("click", function(){
    if(input.type == "password"){
        input.type="text"
        input2.type="text"
    }else{
        input.type="password"
        input2.type="password"
    }
})
