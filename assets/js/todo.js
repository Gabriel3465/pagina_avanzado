function getTask() {

    let task = JSON.parse(window.localStorage.getItem("tasks"));

    if (task === null || !Array.isArray(task))
        task = [];

    task.push(document.getElementById("task_name").value)

    window.localStorage.setItem("tasks", JSON.stringify(task))
    updateTodoList()

    return false;

    document.getElementById("task").value = "";

}

function deleteTask(index) {
    let tasks = JSON.parse(window.localStorage.getItem("tasks"));

    tasks.splice(index, 1);

    window.localStorage.setItem("tasks", JSON.stringify(tasks))
    updateTodoList()
}

function updateTodoList() {
    var lista = "<ol>";
    let tasks = JSON.parse(window.localStorage.getItem("tasks"));

    tasks.forEach((task, index) => lista += "<li>" + task +
        "........................" +
        "<button class='delete_btn' onclick=\"deleteTask(" + index + ")\">Eliminar tarea</button>" + "</li>");

    lista += "</ol>";

    document.getElementById("todo_list").innerHTML = lista
}

updateTodoList()