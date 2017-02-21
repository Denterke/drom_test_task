$(document).ready(function() {

    var uncomplete_tasks_count = 0;
    var tasks = "";
    var complete_category = false;

    //Загрузка первоначального списка
    all_tasks();

    //Редактирование задачи
    var editing_task_id = "";
    var task_object = "";
    var editing_task = "";
    var editting = false;

    $(".todo-list").on('dblclick', '.edit_task', function(){

        editing_task_id = event.target.id;
        task_object = $('#task_' + editing_task_id);
        editting = true;

        task_object.toggleClass("editing");

        editing_task = "";
    });

    $(document).mouseup(function (e) { // событие клика по веб-документу
        editing_task = $("#editing_task_" + editing_task_id);
        if (!editing_task.is(e.target) && editting) {
            task_object.removeClass("editing");
            editting = false;
        }
    });

    //Добавление новой/отредактированной задачи
    $(document).keypress(function(e) {
        if (e.which == 13) {
            var new_task = $("#new_task").val();

            if (new_task != "") {
                $.post("/task/store",
                    {
                        task: new_task
                    },
                    function (data) {
                        if (!complete_category) {
                            task_count = data;
                            preppend_task(new_task, false, task_count);
                        }
                        $("#new_task").val("");
                    });
                uncomplete_tasks_count++;
                $("#uncomplete_tasks_count").text(uncomplete_tasks_count);
            }
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
                    '<li class="completed" id="task_'+task_count+'"> <div class="view"> <input class="toggle" type="checkbox" checked id='+task_count+'> <label class="edit_task" id='+task_count+'>'+ task +'</label> <button id='+task_count+' class="destroy"></button> </div> <input id="editing_task_'+task_count+'" class="edit" value="'+task+'"> </li>'
                );
                break;
            case (is_complete == false):
                $('.todo-list').prepend(
                    '<li class="" id="task_'+task_count+'"> <div class="view"> <input class="toggle" type="checkbox" id='+task_count+'> <label class="edit_task" id='+task_count+'>'+ task +'</label> <button id='+task_count+' class="destroy"></button> </div> <input id="editing_task_'+task_count+'" class="edit" value="'+task+'"> </li>'
                );
                break;
        }
    }

    //Удаление задачи
    $(".todo-list").on('click', '.destroy', function(){
        $('#task_' + event.target.id).remove();
        uncomplete_tasks_count--;
        $("#uncomplete_tasks_count").text(uncomplete_tasks_count);
        $.post("/task/remove",
            {
                task_id: event.target.id
            },
            function(){
            });
    });

    //Перевод состоний задачи
    $(".todo-list").on('click', '.toggle', function(){
        var task_id = event.target.id;
        var task = $('#task_' + event.target.id);
        task.toggleClass("completed");

        (task.attr('class') == "completed") ? toggle_complete(1, task_id) : toggle_complete(0, task_id);
    });

    function toggle_complete(state, task_id) {
        (state == 0) ? uncomplete_tasks_count++ : uncomplete_tasks_count--;
        $("#uncomplete_tasks_count").text(uncomplete_tasks_count);

        $.post("/task/toggle_complete",
            {
                state: state,
                task_id: task_id
            },
            function(){
            });
    }

    //Отображение только неактивных задач
    $(".footer").on('click', '.completed', function(){
        toogle_category(true);
        toogle_select(this);
    });

    //Отображение только активных задач
    $(".footer").on('click', '.uncompleted', function(){
        toogle_category(false);
        toogle_select(this);
    });

    //Все задачи
    $(".footer").on('click', '.all', function(){
        $(".todo-list").empty();
        all_tasks();
        toogle_select(this);
    });

    function all_tasks() {
        $.get("/task", function(data){
            complete_category = false;
            tasks = jQuery.parseJSON(data);

            uncomplete_tasks_count = tasks.filter(function (item) {
                return item.is_complete == false;
            }).length;

            $("#uncomplete_tasks_count").text(uncomplete_tasks_count);

            tasks.forEach(function (item) {
                task_count = item.task_id;
                preppend_task(item.task, item.is_complete, task_count)
            });

        });
    };

    function toogle_category(is_complete) {
        $(".todo-list").empty();
        complete_category = is_complete;
        $.get("/task", function(data){
            var complete_tasks = jQuery.parseJSON(data);

            complete_tasks.forEach(function (item) {
                task_count = item.task_id;
                if (item.is_complete == is_complete)
                    preppend_task(item.task, is_complete, task_count)
            });
        });
    }

    function toogle_select(current_state) {
        $(".state").removeClass('selected');
        $(current_state).addClass("selected");
    }
});