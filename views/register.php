{% extends "base.php" %}

{% block main %}
<section class="todoapp">
    <header class="header">
        <h1>Регистрация</h1>
    </header>
    <section class="main">
        <form action="/user/store" method="POST">
            <input class="new-todo" name="login" placeholder="Введите логин" autofocus>
            <input class="new-todo" name="password" placeholder="Введите пароль">
            <div>
                <input class="submit_button" type="submit" value="создать пользователя">
            </div>
        </form>
    </section>
    {% endblock %}