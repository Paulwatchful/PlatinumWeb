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