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

    //Редактирование задачи
    var editing_task_id = "";
    var task_object = "";
    var editing_task = "";

    $(".todo-list").on('dblclick', '.edit_task', function(){

        editing_task_id = event.target.id;
        task_object = $('#task_' + editing_task_id);
        editting = true;

        task_object.toggleClass("editing");

        editing_task = "";
    });

    $(document).mouseup(function (e) { // событие клика по веб-документу
        editing_task = $("#editing_task_" + editing_task_id);
        if (!editing_task.is(e.target))
            task_object.removeClass("editing");
    });

    //Добавление новой задачи
    $(document).keypress(function(e) {
        if (e.which == 13) {
            var new_task = $("#new_task").val();

            if (new_task != "")
                $.post("/task/store",
                    {
                        task: new_task
                    },
                    function(data){
                        task_count = data;
                        preppend_task(new_task, false, task_count);
                        $("#new_task").val("");
                    });
            else {
                if (editing_task) {
                    editing_task.text(editing_task.val());
                    $("#"+editing_task_id).text(editing_task.val());

                    $.post("/task/edit",
                        {
                            task: editing_task.val(),
                            task_id: editing_task_id
                        },
                        function(data){
                        });
                }
                task_object.removeClass("editing");
            }
        }
    });

    //Обновление списка задач
    function preppend_task(task, is_complete, task_count) {
        switch (true) {
            case (is_complete == true):
                $('.todo-list').prepend(
                    '<li class="completed" id="task_'+task_count+'"> <div class="view"> <input class="toggle" type="checkbox" checked> <label class="edit_task" id='+task_count+'>'+ task +'</label> <button id='+task_count+' class="destroy"></button> </div> <input id="editing_task_'+task_count+'" class="edit" value="'+task+'"> </li>'
                );
                break;
            case (is_complete == false):
                $('.todo-list').prepend(
                    '<li class="view" id="task_'+task_count+'"> <div class="view"> <input class="toggle" type="checkbox"> <label class="edit_task" id='+task_count+'>'+ task +'</label> <button id='+task_count+' class="destroy"></button> </div> <input id="editing_task_'+task_count+'" class="edit" value="'+task+'"> </li>'
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