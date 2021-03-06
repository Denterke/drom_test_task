<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ваш ToDo</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
</head>
<body>
    {% block errors %}
    {% endblock %}

    {% block main %}
    {% endblock %}

    <footer class="info">
        {% block footer %}
        {% endblock %}
    </footer>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    {% block scripts %}
    {% endblock %}
</body>
</html>