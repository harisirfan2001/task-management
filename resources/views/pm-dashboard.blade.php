<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-Manager Dashboard</title>

    <!-- Bootstrap 3 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            background: #f9f9f9;
        }
        .priority-high { border-left: 5px solid red; }
        .priority-medium { border-left: 5px solid orange; }
        .priority-low { border-left: 5px solid green; }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Task</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Task</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('manager-dashboard.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea class="form-control" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Task Assigned To</label>
                            <select class="form-control" name="assigned_to" required>
                                <option value="">Select a user</option>
                                <option value="User 1">User 1</option>
                                <option value="User 2">User 2</option>
                                <option value="User 3">User 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Deadline</label>
                            <input type="date" class="form-control" name="deadline" required>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <select class="form-control" name="priority" required>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h3>Task List</h3>
    @foreach($tasks as $task)
        <div class="card priority-{{ strtolower($task->priority) }}">
            <h4>{{ $task->description }}</h4>
            <p><strong>Assigned To:</strong> {{ $task->assigned_to }}</p>
            <p><strong>Deadline:</strong> {{ $task->deadline }}</p>
            <p><strong>Remarks:</strong> {{ $task->remarks ?? 'N/A' }}</p>
            <p><strong>Priority:</strong> <span class="label label-{{ strtolower($task->priority) == 'high' ? 'danger' : (strtolower($task->priority) == 'medium' ? 'warning' : 'success') }}">{{ $task->priority }}</span></p>
        </div>
    @endforeach
</div>

</body>
</html>
