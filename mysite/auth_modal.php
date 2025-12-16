<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        
        <h2>Добро пожаловать</h2>

        <div id="authMessage"></div>

        <div class="tabs">
            <button class="tablink active" onclick="openTab(event, 'Login')">Вход</button>
            <button class="tablink" onclick="openTab(event, 'Register')">Регистрация</button>
        </div>

        <!-- Вход -->
        <div id="Login" class="tabcontent">
            <form id="loginForm">
                <input type="text" name="username" placeholder="Логин" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <button type="submit">Войти</button>
            </form>
        </div>

        <!-- Регистрация -->
        <div id="Register" class="tabcontent" style="display:none;">
            <form id="registerForm">
                <input type="text" name="username" placeholder="Логин" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="password" name="password_confirm" placeholder="Повторите пароль" required>
                <button type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>
</div>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.7);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #1e293b;
        padding: 30px;
        border-radius: 16px;
        width: 400px;
        max-width: 90%;
        position: relative;
        color: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }

    .close {
        position: absolute;
        top: 15px;
        right: 20px;
        color: #aaa;
        font-size: 32px;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover {
        color: white;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
    }

    #authMessage {
        text-align: center;
        margin: 15px 0;
        font-size: 14px;
        display: none;
    }
    #authMessage.success {
        color: #44ff88;
    }

    .tabs {
        display: flex;
        margin-bottom: 25px;
        border-bottom: 1px solid #334155;
    }

    .tablink {
        flex: 1;  /* ← Сделали равную ширину вкладкам */
        padding: 12px;
        background: #334155;
        border: none;
        color: white;
        cursor: pointer;
        text-align: center;
        transition: background 0.3s;
    }
    .tablink.active {
        background: #00d4ff;
        color: black;
    }

    input {
        width: 100%;  /* ← Полная ширина полей */
        padding: 14px;
        margin: 12px 0;
        background: #0f172a;
        color: white;
        border: none;
        border-radius: 8px;
        box-sizing: border-box;
        font-size: 16px;
    }

    button {
        width: 100%;  /* ← Полная ширина кнопки */
        padding: 16px;
        background: #00d4ff;
        color: black;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }
    button:hover {
        background: #00b7e6;
    }
</style>

<script>
    const modal = document.getElementById('authModal');
    const closeBtn = document.getElementsByClassName('close')[0];
    const messageDiv = document.getElementById('authMessage');

    closeBtn.onclick = () => modal.style.display = "none";
    window.onclick = (e) => { if (e.target == modal) modal.style.display = "none"; };

    function openTab(evt, tabName) {
        document.querySelectorAll('.tabcontent').forEach(tab => tab.style.display = 'none');
        document.querySelectorAll('.tablink').forEach(link => link.className = link.className.replace(' active', ''));
        document.getElementById(tabName).style.display = 'block';
        evt.currentTarget.className += ' active';
        messageDiv.style.display = 'none';
    }

    // AJAX для входа
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'login');

        fetch('auth_process.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageDiv.textContent = 'Вход успешен! Обновляю...';
                messageDiv.className = 'success';
                messageDiv.style.display = 'block';
                setTimeout(() => location.reload(), 1200);
            } else {
                messageDiv.textContent = data.message || 'Неверный логин или пароль';
                messageDiv.style.display = 'block';
            }
        });
    });

    // AJAX для регистрации
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'register');

        if (formData.get('password') !== formData.get('password_confirm')) {
            messageDiv.textContent = 'Пароли не совпадают';
            messageDiv.style.display = 'block';
            return;
        }

        fetch('auth_process.php', { method: 'POST', body: formData })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                messageDiv.textContent = 'Регистрация успешна! Теперь войдите.';
                messageDiv.className = 'success';
                messageDiv.style.display = 'block';
                openTab({currentTarget: document.querySelectorAll('.tablink')[0]}, 'Login');
            } else {
                messageDiv.textContent = data.message || 'Логин или email уже заняты';
                messageDiv.style.display = 'block';
            }
        });
    });
</script>