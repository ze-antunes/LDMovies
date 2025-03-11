function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
        }
        
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function openOps() {
          document.getElementById("myOps").style.width = "250px";
        }
        
function closeOps() {
  document.getElementById("myOps").style.width = "0";
}

function filme(i){
    location.href = "/php/filmeAdmin.php?i="+i;
}

function comprar(i){
  location.href = "/php/compraAdmin.php?i="+i;
}

function finalizar(i){
  if(document.forms['purchaseForm'].Endereço.value === "" || document.forms['purchaseForm'].Cartão.value === "" || document.forms['purchaseForm'].VCV.value === "" || document.forms['purchaseForm'].Data.value === "" || document.forms['purchaseForm'].PAC.value === ""){
  alert("Preencha todos os campos!");
  }
  else{
      location.href = "/php/confirmationAdmin.php?i="+i;
  }
}