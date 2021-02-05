(function () {
    function start (){
        var form = document.getElementById('form');
        var button = form.querySelector('button');
        var input = form.querySelector('input[type=text]');
        var select = form.querySelectorAll('input[type=radio]');
        var warning = document.querySelector('.warning');
        var info = document.querySelector('.info');

        for (let node of select) {
            node.addEventListener('change', function (e) {
                var placeholder;
                if (e.target.value == 'full_name') {
                    placeholder = 'ФИО';
                }
                if (e.target.value == 'phone') {
                    placeholder = 'Номер';
                    type = 'number';
                }
                input.setAttribute('placeholder', placeholder);
            })
        }

        input.addEventListener('input', function (e) {
            let select = form.querySelector('input[type=radio]:checked');
            if (!e.target.value) {
                button.setAttribute('disabled', true);
            }
            if (select.value == 'full_name' && e.target.value) {
                button.removeAttribute('disabled');
            }

            if (select.value == 'phone' && /[+0-9]+/.test(e.target.value)) {
                button.removeAttribute('disabled');
            }

        });

        button.onclick = send;

        async function send(e) {
            var loading = document.querySelector('.animate-flicker');
            let select = form.querySelector('input[type=radio]:checked');
            e.preventDefault();
            const data = {
                column: select.value,
                text: input.value
            }
            warning.style.display = 'none';
            info.style.display = 'none'
            loading.style.display = 'block';
            deleteItems()

            let response = await fetch('/search',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                let json = await response.json();
                if (json.length) {
                    loading.style.display = 'none';
                    render(json);
                } else {
                    warning.style.display = 'block';
                    loading.style.display = 'none';
                }

            } else {
                alert("Ошибка HTTP: " + response.status);
            }

        }

        function render(data) {
            var content = document.querySelector('.home__content');
            data.forEach((item)=> {
                var template = `<div class="item__phone" data-id="${item.id}">
                    <div class="item__phone_left">
                        <small>ФИО</small>
                        <span>${item.full_name}</span>
                    </div>
                    <div class="item__phone_right">
                        <small>Телефон</small>
                        <span>${item.phone}</span>
                    </div>
                    <div class="item__phone_options">
                        <a href="/phone/edit/${item.id}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <span class="deleteBtn" data-id="${item.id}">
                            <i class="fas fa-trash" data-id="${item.id}"></i>
                        </span>
                    </div>
                </div>`
                content.innerHTML += template;
            });
            deleteEvent();
        }

        function deleteEvent() {
            var deletes = document.querySelectorAll('.deleteBtn');
            for (let node of deletes) {
                node.addEventListener('click', deleteItem);
            }
        }

        function deleteItems() {
            var content = document.querySelectorAll('.item__phone');
            for (let node of content) {
                node.remove();
            }
        }

        async function deleteItem(e) {
            let id =  Number(e.target.dataset.id);
            const data = {
                id
            }
            let response = await fetch('/phone/delete',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                var content = document.querySelectorAll('.item__phone');
                for (let node of content) {
                    if (Number(node.dataset.id) === id) {
                        node.remove();
                    };
                }
            } else {
                alert("Ошибка HTTP: " + response.status);
            }
        }

    }

    window.onload = start;
})();