// Sidebar Toggle & Scroll to Top Script (Vanilla JS Khusus Bootstrap 5)

document.addEventListener("DOMContentLoaded", function() {
    var toggleBtnMobile = document.getElementById("sidebarToggleTop");
    var toggleBtnDesktop = document.getElementById("sidebarToggle");
    var sidebar = document.getElementById("accordionSidebar");
    
    // Mobile toggle
    if(toggleBtnMobile) {
        toggleBtnMobile.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('toggled');
        });
    }
    
    // Desktop toggle
    if(toggleBtnDesktop) {
        toggleBtnDesktop.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('toggled');
            
            var icon = toggleBtnDesktop.querySelector('i');
            if (sidebar.classList.contains('toggled')) {
                icon.classList.replace('fa-angle-left', 'fa-angle-right');
            } else {
                icon.classList.replace('fa-angle-right', 'fa-angle-left');
            }
        });
    }

    // Scroll dropdown & scroll to top 
    window.addEventListener('scroll', function() {
        var scrollBtn = document.querySelector('.scroll-to-top');
        if (window.pageYOffset > 100) {
            scrollBtn.style.display = 'block';
        } else {
            scrollBtn.style.display = 'none';
        }
    });
});
