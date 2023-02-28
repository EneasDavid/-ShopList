const salvarTag=document.querySelector("[salvar]");
const tabelaSelect = document.querySelectorAll('#td')[3];
const salvarTagPopUp=document.querySelector("[popUp-cadastrar-tag]");
const integrantesTagPopUp=document.querySelector("[popUp-integrantes-tag]");

const item=document.querySelector("#item");

function chamaPopUpIntegrantes(){
  integrantesTagPopUp.classList.add("aparecer");
}
function removerPopUpIntegrantes(){
  integrantesTagPopUp.classList.remove("aparecer");
}
function chamaPopUp(){
  salvarTagPopUp.classList.add("aparecer");
}
function removerPopUp(){
  salvarTagPopUp.classList.remove("aparecer");
}