<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 & jQuery -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: #f4f7f6;
        }

        .navbar {
            background: #2c3e50;
            color: white;
        }

        .navbar-nav .nav-link {
            color: white !important;
        }

        .summary-card1 {
            padding: 15px;
            opacity: 0.9;
            background-color: white;
            border-radius: 8px;
            color: black;
            text-align: center;
            display: flex;
            justify-content: space-between;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            border-top: 5px solid green;
        }
        .summary-card2 {
            padding: 15px;
            opacity: 0.9;
            border-radius: 8px;
            background-color: white;
            color: black;
            text-align: center;
            display: flex;
            justify-content: space-between;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            border-top: 5px solid yellow;
        }
        .summary-card3 {
            padding: 15px;
            opacity: 0.9;
            border-radius: 8px;
            color: black;
            background-color: white;
            text-align: center;
            display: flex;
            justify-content: space-between;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            border-top: 5px solid red;
        }
        .summary-card4 {
            padding: 15px;
            opacity: 0.9;
            background-color: white;
            border-radius: 8px;
            color: black;
            text-align: center;
            display: flex;
            justify-content: space-between;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            border-top: 5px solid blue;
        }
        .card {
    width: 100%;
    max-width: 100%;
    max-height: 45px;
    display: flex;
    justify-content: space-between;
    background: #f8f9fa;
    padding: 5px 10px;
    margin: 7px 0px;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    transition: max-height 0.6s ease-in-out, padding 0.3s ease-in-out;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
}

.card:hover {
    display:flex;
    max-height: 170px;
    border-radius: 30px;
    height: auto;
    min-height: 70px;
    border-radius: 8px;
    background: white;
    padding: 3px 15px;
    margin: 7px 0px;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.6s ease-in-out;
    white-space: normal;
    transform: scale(1.02);
}

        .summary-card1:hover {
            box-shadow: 3px 3px 10px rgb(11, 194, 35);
            background: rgb(157, 255, 170);
            border-top:none;
            transition: 0.3s;
        }
        .summary-card2:hover {
            box-shadow: 3px 3px 10px rgb(219, 198, 4);
            background: rgb(255, 238, 82);
            transition: 0.3s;
            border-top:none;
        }
        .summary-card3:hover {
            box-shadow: 3px 3px 10px rgb(248, 0, 0);
            background: rgb(255, 157, 157);
            transition: 0.3s;
            border-top:none;
        }
        .summary-card4:hover {
            box-shadow: 3px 3px 10px rgb(0, 38, 255);
            background: rgb(51, 83, 243);
            transition: 0.3s;
            border-top:none;
        }



        .priority-high {
           border-left: 5px solid red;
       }
        .priority-high:hover {
            border-left: 5px solid red;
            background: rgb(255, 157, 157);
            transition: 0.3s;
            border-left:none;


        }

        .priority-medium {
            border-left: 5px solid orange;


        }
        .priority-medium:hover {
            border-left: 5px solid green;
            background: rgb(255, 209, 157);
            transition: 0.3s;
            border-left:none;

        }

        .priority-low {
            border-left: 5px solid green;

        }
        .priority-low:hover {
            border-left: 5px solid green;
            background: rgb(157, 255, 170);
            transition: 0.3s;
            border-left:none;

        }

        .task-date {
           margin-left: auto;
            font-size: 14px;
            color: black;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .task-actions{
            margin: 5px 0px;
        }

        .task-details {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        .badge{
            margin-top: 5px;
            font-size: 14px;
        }
        .taskid{
            margin-left: 5px;
        }
        .task-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}
    </style>
</head>

<body>



    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manager Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="navbar-nav ms-auto">
                    <button id="addTaskButton" style="margin-right: 10px; color: white;" type="button"class="btn" data-bs-toggle="modal" data-bs-target="#taskModal">Create Task</button>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <div class="row">
            <div class="col-md-3">
                <div class="summary-card1">
                    <h4>Active Tasks</h4>
                    <h2 id="activeTasks">{{$activeTasks ?? 0}}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-card2 ">
                    <h4>Completed Tasks</h4>
                    <h2 id="completedTasks">{{$completedTasks ?? 0}}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-card3">
                    <h4>Cancelled Tasks</h4>
                    <h2 id="cancelledTasks">{{$cancelledTasks ?? 0}}</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="summary-card4">
                    <h4>Queries</h4>
                    <h2 id="queriesTasks">0</h2>
                </div>
        </div>

    </div>

    <h3 class="mt-4">Task List</h3>
    <div id="taskList"></div>

    <!-- Task Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create new Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm">
                    <div class="mb-3">
                        <label for="taskId" class="form-label">Task ID</label>
                        <input type="text" id="taskId" name="task_id" class="form-control" readonly>
                    </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assigned To</label>
                            <input type="text" class="form-control" name="assigned_to" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" class="form-control" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <input type="text" class="form-control" name="remarks">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Priority</label>
                            <select class="form-control" name="priority">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Task</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
           $(document).ready(function () {
        $('#addTaskButton').click(function () {
            $.ajax({
                url: "/manager-dashboard/create", 
                type: "GET",
                success: function (response) {
                    $('#taskId').val(response.nextTaskId); 
                    $('#taskModal').modal('show'); 
                },
                error: function () {
                    alert("Error fetching task ID.");
                }
            });
        });
    });



        $('#addTaskButton').click(function() {
    $('#taskForm')[0].reset();
    $('#taskId').val('');
});
                $(document).ready(function () {
                    show();
                });

            function show() {
                $.ajax({
                    url: "/manager-dashboard/",
                    method: "GET",
                    dataType: 'json',
                    success: function (response) {
                        $('#taskList').html('');
                        $('#activeTasks').text(response.activeTasks);
                        $('#completedTasks').text(response.completedTasks);
                        $('#cancelledTasks').text(response.cancelledTasks);

                        response.tasks.forEach(task => {
                            let priorityClass = task.priority.toLowerCase() === 'high' ? 'priority-high' :
                                task.priority.toLowerCase() === 'medium' ? 'priority-medium' : 'priority-low';
                            $('#taskList').append(`
                        <div class="card ${priorityClass}">
                         <div class="task-header">
                                 <p><span class="badge  ${getStatusClass(task.status)}">${task.status}</span></p>
                               <p><span class="taskid badge bg-primary">Task # ${task.id}</span></p>

                                 <span class="task-date ">${new Date(task.created_at).toLocaleDateString()}</span>
                                    </div>
                            <h5><strong>${task.description}</strong></h5>
                            <div class="task-details">
                                <p><strong>Assigned To:</strong> ${task.assigned_to}</p>
                               <p style="margin-left: 30px;"><strong>Deadline:</strong> ${task.deadline}</p>
                                <p style="margin-left: 30px;"><strong>Priority:</strong> ${task.priority}</p>
                                <p style="margin-left: 30px;"><strong>Remarks:</strong> ${task.remarks || 'N/A'}</p>

                           </div>
                                <div class="task-actions">
                                 <a href="#" class="btn btn-warning btn-sm" onclick="editTask(event, ${task.id})">Edit</a>
                                 <a href="#" class="btn btn-danger btn-sm" onclick="deleteTask(event, ${task.id})">Delete</a>
                                </div>
                        </div>


                    `);
                        });
                    },
                    error: function () {
                        $('#taskList').html('<p class="text-danger">Error fetching tasks.</p>');
                    }
                });
            }

            $('#taskForm').submit(function (e) {
    e.preventDefault();

    let taskId = $('#taskId').val(); 
    let formData = $(this).serialize(); 
    let method = taskId ? "PUT" : "POST";  
    let url = taskId ? `/manager-dashboard/${taskId}` : "/manager-dashboard";

    $.ajax({
        url: url,
        type: "POST",  // Always use POST
        data: formData + (taskId ? "&_method=PUT" : ""), // Laravel requires _method for PUT
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            $('#taskModal').modal('hide');
            $('#taskForm')[0].reset();
            show();
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText); // 🔍 Log error for debugging
            alert('Error processing request.');
        }
    });
});
$('#taskForm').submit(function (e) {
    e.preventDefault();

    let taskId = $('#taskId').val(); // Get task ID from form
    let formData = new FormData(this);
    let url = "/manager-dashboard";
    let method = "POST"; // Default method is POST for creating a new task

    if (taskId) { 
        url = `/manager-dashboard/${taskId}`;
        formData.append('_method', 'PUT'); // Laravel requires _method for PUT
    }

    console.log("Sending request to:", url, "with method:", method); // Debugging

    $.ajax({
        url: url,
        type: method,
        data: formData, 
        processData: false,
        contentType: false,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            console.log("Success:", response);
            $('#taskModal').modal('hide');
            $('#taskForm')[0].reset();
            show(); // Refresh task list
        },
        error: function (xhr) {
            console.log("Error:", xhr.responseText); // Log detailed error
            alert('Error processing request.');
        }
    });
});




        function getStatusClass(status) {
    let normalizedStatus = status.trim().toLowerCase();
    switch (normalizedStatus) {
        case 'active': return 'bg-success text-white';
        case 'cancelled': return 'bg-danger text-white';
        case 'completed': return 'bg-primary text-white';
        default: return 'bg-dark text-dark';
    }
}
function editTask(event, taskId) {
    event.preventDefault();
    $.ajax({
        url: `/manager-dashboard/${taskId}/show`,
        type: "GET",
        success: function (task) {
            $('#taskId').val(task.id);
            $('input[name="description"]').val(task.description);
            $('input[name="assigned_to"]').val(task.assigned_to);
            $('input[name="deadline"]').val(task.deadline);
            $('input[name="remarks"]').val(task.remarks);
            $('select[name="priority"]').val(task.priority);
            $('#taskForm').attr('action', `/manager-dashboard/${taskId}`);
            $('#taskModal').modal('show');
        },
        error: function () {
            alert('Error fetching task details.');
        }
    });
}

function deleteTask(event, taskId) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this task?')) {
        $.ajax({
            url: `/manager-dashboard/${taskId}`,
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                alert('Task deleted successfully.');
                show();

            },
            error: function () {
                alert('Error deleting task.');
            }
        });
    }
}

    </script>

</body>

</html>
