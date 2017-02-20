$(document).ready(function() {

    var task_id = 0;

    //Загрузка первоначального списка
    $.get("/task", function(data){
    var tasks = jQuery.parseJSON(data);

    tasks.forEach(function (item) {
        task_count = item.task_id;
        preppend_task(item.task, item.is_complete, task_count)
    });
});

    //Добавление новой задачи
    $(document).keypress(function(e) {
        if (e.which == 13) {
            var task = $("#new_task").val();
            $.post("/task/store",
                {
                    task: task
                },
                function(data){
                    task_count = data;
                    preppend_task(task, false, task_count);
                    $("#new_task").val("");
                });
        }1
    });

    //Обновление списка задач
    function preppend_task(task, is_complete, task_count) {
        switch (true) {
            case (is_complete == true):
                $('.todo-list').prepend(
                    '<li class="completed" id="task_'+task_count+'"> <div class="view"> <input class="toggle" type="checkbox" checked> <label>'+ task +'</label> <button id='+task_count+' class="destroy"></button> </div> <input class="edit" value="Create a TodoMVC template"> </li>'
                );
                break;
            case (is_complete == false):
                $('.todo-list').prepend(
                    '<li class="view" id="task_'+task_count+'"> <div class="view"> <input class="toggle" type="checkbox"> <label>'+ task +'</label> <button id='+task_count+' class="destroy"></button> </div> <input class="edit" value="Create a TodoMVC template"> </li>'
                );
                break;
        }
    }


    //Удаление задачи
    $(".todo-list").on('click', '.destroy', function(){
        $('#task_' + event.target.id).remove();

        $.post("/task/remove",
            {
                task_id: event.target.id
            },
            function(){
            });
    });
});