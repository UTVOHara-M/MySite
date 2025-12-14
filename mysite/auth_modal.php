<div id="authModal" class="modal-overlay">
    <div class="modal-content">
        <button class="close-modal" id="closeModal">&times;</button>
        
        <h2>Добро пожаловать</h2>

        <div id="authMessage" class="auth-message"></div>

        <div class="auth-tabs">
            <button class="auth-tab active" data-tab="login">Вход</button>
            <button class="auth-tab" data-tab="register">Регистрация</button>
        </div>

        <form id="loginForm" class="auth-form active" method="POST">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
            
            <div class="form-footer">
                Нет аккаунта? <a href="#" class="switch-to-register">Зарегистрироваться</a>
            </div>
        </form>

        <form id="registerForm" class="auth-form" method="POST">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="confirm_password" placeholder="Повторите пароль" required>
            <button type="submit">Зарегистрироваться</button>
            
            <div class="form-footer">
                Уже есть аккаунт? <a href="#" class="switch-to-login">Войти</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('authModal');
        const closeBtn = document.getElementById('closeModal');
        const openBtn = document.getElementById('openAuthModal');
        const tabs = document.querySelectorAll('.auth-tab');
        const forms = document.querySelectorAll('.auth-form');
        const messageDiv = document.getElementById('authMessage');

        if (openBtn) {
            openBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            });
        }

        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.style.display === 'flex') closeModal();
        });

        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            messageDiv.style.display = 'none';
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const tabName = this.getAttribute('data-tab');
                
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                forms.forEach(form => {
                    form.classList.remove('active');
                    if (form.id === tabName + 'Form') {
                        form.classList.add('active');
                    }
                });
            });
        });

        document.querySelector('.switch-to-register')?.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('[data-tab="register"]').click();
        });

        document.querySelector('.switch-to-login')?.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('[data-tab="login"]').click();
        });

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'login');

            fetch('auth_process.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                messageDiv.textContent = data.message;
                messageDiv.className = data.success ? 'auth-message success' : 'auth-message error';
                messageDiv.style.display = 'block';

                if (data.success) {
                    setTimeout(() => location.reload(), 1500);
                }
            });
        });

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'register');

            if (formData.get('password') !== formData.get('confirm_password')) {
                messageDiv.textContent = 'Пароли не совпадают';
                messageDiv.className = 'auth-message error';
                messageDiv.style.display = 'block';
                return;
            }

            fetch('auth_process.php', { method: 'POST', body: formData })
            .then(res => res.json())
            .then(data => {
                messageDiv.textContent = data.message;
                messageDiv.className = data.success ? 'auth-message success' : 'auth-message error';
                messageDiv.style.display = 'block';

                if (data.success) {
                    setTimeout(() => {
                        document.querySelector('[data-tab="login"]').click();
                    }, 2000);
                }
            });
        });
    });
</script>