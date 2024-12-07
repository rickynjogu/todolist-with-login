// Fetch the tasks from the backend and display them
async function loadTasks() {
    const response = await fetch('http://localhost/todolist/get_tasks.php'); // Ensure endpoint is consistent
    const tasks = await response.json();

    const taskList = document.getElementById('todoList');
    taskList.innerHTML = ''; // Clear the existing list
    tasks.forEach(task => {
        const listItem = document.createElement('li');
        listItem.className = 'todo-item';
        listItem.setAttribute('data-id', task.id);

        // Add fade-in animation class for smooth transition
        setTimeout(() => {
            listItem.classList.add('show');
        }, 100);

        // Task text
        const taskTextSpan = document.createElement('span');
        taskTextSpan.textContent = task.text;

        // Add the 'completed' class if the task is completed
        if (task.completed) {
            listItem.classList.add('completed');
        }

        // Complete toggle button
        const completeBtn = document.createElement('button');
        completeBtn.textContent = task.completed ? '✓' : '⧗'; // You could replace symbols here if needed
        completeBtn.onclick = () => toggleComplete(task.id, task.completed);

        // Delete button
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = '✖';
        deleteBtn.className = 'delete-btn'; // Add specific class for style
        deleteBtn.onclick = () => deleteTask(task.id);

        // Append elements to the list item
        listItem.appendChild(taskTextSpan);
        listItem.appendChild(completeBtn);
        listItem.appendChild(deleteBtn);

        // Append list item to the task list
        taskList.appendChild(listItem);
    });
}

// Add a new task
async function addTask() {
    const input = document.getElementById('todoInput');
    const taskText = input.value.trim();

    if (taskText === '') {
        alert('Please enter a task');
        return;
    }

    // Send POST request to add a new task
    await fetch('http://localhost/todolist/add_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ text: taskText })
    });

    loadTasks(); // Reload the tasks to include the newly added one
    input.value = ''; // Clear the input field
}

// Delete a task
async function deleteTask(id) {
    // Send POST request to delete the task
    await fetch('http://localhost/todolist/delete_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id })
    });

    loadTasks(); // Reload the tasks after deletion
}

// Toggle completion status of a task
async function toggleComplete(id, completed) {
    // Send POST request to toggle completion status
    await fetch('http://localhost/todolist/toggle_tasks.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: id, completed: !completed })
    });

    loadTasks(); // Reload the tasks to reflect the change
}

// Load the tasks when the page is ready
loadTasks();

// Allow adding a task with the Enter key
document.getElementById('todoInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        addTask();
    }
});

