<div id="authModal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Вход или регистрация</h2>
        <p>Пока это просто заглушка — здесь будет форма.</p>
        <p>Когда захочешь — добавим полноценную авторизацию.</p>
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
        background-color: rgba(0,0,0,0.8);
    }
    .modal-content {
        background: #1e1e1e;
        margin: 15% auto;
        padding: 30px;
        width: 400px;
        border-radius: 16px;
        color: white;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 32px;
        font-weight: bold;
        cursor: pointer;
    }
    .close:hover {
        color: white;
    }
</style>

<script>
    document.getElementById('authBtn').onclick = function() {
        document.getElementById('authModal').style.display = 'block';
    }
    document.getElementsByClassName('close')[0].onclick = function() {
        document.getElementById('authModal').style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById('authModal')) {
            document.getElementById('authModal').style.display = 'none';
        }
    }
</script>