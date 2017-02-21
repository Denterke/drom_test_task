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
        <h1>ToDo</h1>
        <input class="new-todo" id = "new_task" placeholder="Введите вашу задачу" autofocus>
    </header>

    <section class="main">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
        </ul>
    </section>

    <footer class="footer">
        <span class="todo-count"><strong id="uncomplete_tasks_count"></strong> активных</span>
        <ul class="filters">
            <li>
                <a class="state all selected">Все</a>
            </li>
            <li>
                <a class="state uncompleted"">Активные</a>
            </li>
            <li>
                <a class="state completed"">Завершенные</a>
            </li>
        </ul>
    </footer>

</section>
{% endblock %}

{% block footer %}
    <a href="/user/out"> Выйти из аккаунта </a>
{% endblock %}

{% block scripts %}
    <script src="/js/app.js"></script>
{% endblock %}