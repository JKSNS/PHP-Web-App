// script.js: BYU IT&C 210a JavaScript
function on_submit(event) {
    let formData = new FormData(event.currentTarget);
    let json = JSON.stringify(Object.fromEntries(formData));
    alert(json);
    event.preventDefault();
}

const inputBox = document.getElementById("input-box");
const dateInput = document.getElementById("date-input");
const listContainer = document.getElementById("list-container");

function formatDate(inputDate) {
    const options = { year: 'numeric', month: 'numeric', day: 'numeric' };
    const date = new Date(inputDate);
    return date.toLocaleDateString(undefined, options);
}

function createTask() {
    const taskText = inputBox.value;
    const taskDateInput = dateInput.value;

    // Parse the input date to check for validity
    const taskDate = new Date(taskDateInput);

    if (taskText === '' || taskDateInput === '' || isNaN(taskDate.getTime())) {
        alert("Both text and a valid date must be provided!");
    } else {
        let li = document.createElement("li");
        li.classList.add("task-item");

        // Add the task date and text
        li.innerHTML = `<span class="task-date">${formatDate(taskDate)}</span> ${taskText}`;

        // Add the delete task button
        let deleteButton = document.createElement("span");
        deleteButton.classList.add("close");
        deleteButton.innerHTML = "\u00d7";
        li.appendChild(deleteButton);

        listContainer.appendChild(li);
    }

    inputBox.value = "";
    dateInput.value = "";
    updateTask();
}

listContainer.addEventListener("click", function(e) {
    if (e.target.tagName === "LI") {
        e.target.classList.toggle("checked");
        updateTask();
    } else if (e.target.classList.contains("close")) {
        e.target.parentElement.remove();
        updateTask();
    }
}, false);

function updateTask() {
    localStorage.setItem("data", listContainer.innerHTML);
}

function readTask() {
    listContainer.innerHTML = localStorage.getItem("data");
}

readTask();

