$.get("/task", function(data){
    var tasks = jQuery.parseJSON(data);

    tasks.forEach(function (item) {
        switch (true) {
            case (item.is_complete == true):
                $('.todo-list').append(
                    '<li class="completed"> <div class="view"> <input class="toggle" type="checkbox" checked> <label>'+ item.task +'</label> <button class="destroy"></button> </div> <input class="edit" value="Create a TodoMVC template"> </li>'
                );
                break;
            case (item.is_complete == false):
                $('.todo-list').append(
                    '<li class="view"> <div class="view"> <input class="toggle" type="checkbox"> <label>'+ item.task +'</label> <button class="destroy"></button> </div> <input class="edit" value="Create a TodoMVC template"> </li>'
                );
                break;
        }

    });
});

$(document).keypress(function(e) {
    if (e.which == 13) {
        $.post("/task/store",
            {
                task: $( "#new_task" ).val()
            },
            function(){
                location.href = "/";
            });
    }1
});