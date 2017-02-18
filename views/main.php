{% extends "base.php" %}

{% block main %}
<section class="todoapp">
    <header class="header">
        <h1>ToDo</h1>
        <input class="new-todo" placeholder="Введите вашу задачу" autofocus>
    </header>
    <!-- This section should be hidden by default and shown when there are todos -->
    <section class="main">
        <input class="toggle-all" type="checkbox">
        <label for="toggle-all">Mark all as complete</label>
        <ul class="todo-list">
            <!-- These are here just to show the structure of the list items -->
            <!-- List items should get the class `editing` when editing and `completed` when marked as completed -->
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
        </ul>
    </section>
{% endblock %}