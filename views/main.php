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
        <input class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <!--
            <li class="completed">
                <div class="view">
                    <input class="toggle" type="checkbox" checked>
                    <label>Выполненное</label>
                    <button class="destroy"></button>
                </div>
                <input class="edit" value="Create a TodoMVC template">
            </li>
            <li>
                <div class="view">
                    <input class="toggle" type="checkbox">
                    <label>Купить единорога</label>
                    <button class="destroy"></button>
                </div>
                <input class="edit" value="Rule the web">
            </li>
            -->
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