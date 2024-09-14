
setTimeout(() => {
    if(!(document.getElementById('true')==null)){
        document.getElementById('true').remove();
    }else if(!(document.getElementById('false')===null)){
        document.getElementById('false').remove();
    }
}, 4000);


document.getElementById("side-bar-active").removeAttribute("id");
document.querySelector(".active-admin").id = "side-bar-active";
