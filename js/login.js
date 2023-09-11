var input = document.getElementById('floatingPassword');
var check=document.getElementById('flexCheckChecked');
check.addEventListener("click", function(){
    if(input.type == "password"){
        input.type="text"
    }else{
        input.type="password"
    }
})
