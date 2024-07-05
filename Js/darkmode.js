document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const logoImage = document.querySelector('.navbar-brand img');
    const navbar = document.querySelector('.navbar');
    const footer = document.querySelector('.footer');
    const darkModeCSS = document.getElementById('dark-mode-css');

    // Initialiser l'état du mode sombre en fonction de la valeur stockée dans localStorage
    const currentMode = localStorage.getItem('darkMode');

    if (currentMode === 'enabled') {
        darkModeCSS.removeAttribute('disabled');
        if (logoImage) logoImage.src = 'img/logoTacheTicDark.png';
        if (navbar) navbar.classList.add('navbar-darkmode');
        if (footer) footer.classList.add('footer-darkmode');
        if (darkModeToggle) darkModeToggle.checked = true;
    }

    // Gestion du switch de mode sombre
    if (darkModeToggle) {
        darkModeToggle.addEventListener('change', function() {
            if (this.checked) {
                darkModeCSS.removeAttribute('disabled');
                if (logoImage) logoImage.src = 'img/logoTacheTicDark.png';
                if (navbar) navbar.classList.add('navbar-darkmode');
                if (footer) footer.classList.add('footer-darkmode');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                darkModeCSS.setAttribute('disabled', 'disabled');
                if (logoImage) logoImage.src = 'img/logoTacheTic.png';
                if (navbar) navbar.classList.remove('navbar-darkmode');
                if (footer) footer.classList.remove('footer-darkmode');
                localStorage.setItem('darkMode', null);
            }
        });
    }
});
