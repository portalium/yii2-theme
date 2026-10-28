// Top menu: dropdown items that have their own child list (.dropdown-submenu).
// Bootstrap 5 has no nested dropdowns: its toggle closes the parent menu and the item's link never opens.
(function () {
    function isOpen(menu) {
        return window.getComputedStyle(menu).display !== 'none';
    }

    // open to the left when the list would leave the window
    function place(menu) {
        menu.classList.remove('open-start');
        if (menu.getBoundingClientRect().right > window.innerWidth - 8) {
            menu.classList.add('open-start');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.dropdown-menu .dropdown > [data-bs-toggle="dropdown"]').forEach(function (toggle) {
            toggle.removeAttribute('data-bs-toggle');
            toggle.parentElement.addEventListener('mouseenter', function () {
                var menu = toggle.parentElement.querySelector(':scope > .dropdown-submenu');
                if (menu && isOpen(menu)) {
                    place(menu);
                }
            });
        });
    });

    // Capture phase, so Bootstrap's document click handler does not close the parent menu.
    // First tap opens the child list; a tap on an item whose list is open follows its link.
    document.addEventListener('click', function (e) {
        var toggle = e.target.closest('.dropdown-menu .dropdown > .dropdown-toggle');
        if (!toggle) {
            return;
        }
        var menu = toggle.parentElement.querySelector(':scope > .dropdown-submenu');
        if (!menu) {
            return;
        }
        var href = toggle.getAttribute('href');
        if (isOpen(menu) && href && href !== '#') {
            return;
        }
        e.preventDefault();
        e.stopPropagation();

        toggle.parentElement.parentElement.querySelectorAll(':scope > .dropdown > .dropdown-submenu.show').forEach(function (other) {
            if (other !== menu) {
                other.classList.remove('show');
            }
        });
        menu.classList.toggle('show');
        toggle.setAttribute('aria-expanded', menu.classList.contains('show') ? 'true' : 'false');
        if (menu.classList.contains('show')) {
            place(menu);
        }
    }, true);

    document.addEventListener('hidden.bs.dropdown', function (e) {
        var item = e.target.parentElement;
        if (item) {
            item.querySelectorAll('.dropdown-submenu.show').forEach(function (menu) {
                menu.classList.remove('show');
            });
        }
    });
})();
