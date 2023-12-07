document.getElementById('Menu').addEventListener('click', function() {
    var menuBarra = document.querySelector('.menuBarra');
    if (menuBarra.style.width === '' || menuBarra.style.width === '0px') {
      menuBarra.style.width = '235px';
    } else {
      menuBarra.style.width = '0';
    }
});