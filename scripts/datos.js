let form = document.getElementById('modal');
let span = getElementById('link');
let cerrar = document.getElementsByClassName('cerrar')[0];

    span.addEventListener('click', (e) => {
        e.preventDefault();
        form.style.display = "block";
    });
  
cerrar.onclick = function() { 
    form.style.display = "none";
}
  
window.onclick = function(event) {
    if (event.target == form) {
        form.style.display = "none";
    }
}