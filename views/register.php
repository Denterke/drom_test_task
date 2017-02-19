{% extends "base.php" %}

{% block errors %}
    <div class="errors">
        {% for item in data %}
        {{ item }}<br>
        {% endfor %}
    </div>
{% endblock %}

{% block main %}
    <section class="todoapp">
        <header class="header">
            <h1>Регистрация</h1>
        </header>
        <section class="main">
            <form action="/user/store" method="POST">
                <input class="new-todo" name="login" placeholder="Введите логин" autofocus>
                <input type = "password" class="new-todo" name="password" placeholder="Введите пароль">
                <div>
                    <input class="submit_button" type="submit" value="Создать пользователя">
                </div>
            </form>
        </section>
    </section>
{% endblock %}
