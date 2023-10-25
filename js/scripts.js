// scripts.js

document.addEventListener("DOMContentLoaded", function() {
    var navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(function(item) {
        item.addEventListener('click', function() {
            navItems.forEach(function(innerItem) {
                innerItem.classList.remove('active');
            });
            item.classList.add('active');
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(function(link) {
        if (window.location.href.indexOf(link.href) !== -1) {
            var parent = link.parentElement;
            parent.classList.add('active');
        }
    });
});
