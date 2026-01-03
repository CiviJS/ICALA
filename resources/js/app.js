 function filterUsers() {
        const input = document.getElementById('userSearchInput');
        const filter = input.value.toUpperCase();
        const select = document.getElementById('userSelect');
        const options = select.getElementsByTagName('option');

        for (let i = 0; i < options.length; i++) {
            const txtValue = options[i].textContent || options[i].innerText;
            options[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }


window.filterUsers = filterUsers;    