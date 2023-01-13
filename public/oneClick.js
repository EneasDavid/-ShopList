function myFunction(e) {
    //Desabilita o botao
    e.disabled = true;
    
    //Habilita novamente após dois segundos (2000) ms
    setTimeout(function(){
      toggleDisabled(e)
    },2000);
}

function toggleDisabled(elem){
  elem.disabled = !elem.disabled;
}