@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('todo.index') }}" class="btn btn-success my-3">Go to List</a>
            <form action="{{ route('todo.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-4">Task Name:<span class="text-danger">*</span> <input type="text" class="form-control" placeholder="Enter Task Name..." name="task_name" required></div>
                    <div class="col-4">Task Date:<span class="text-danger">*</span><input type="datetime-local" class="form-control" placeholder="Enter Date" name="task_date" required></div>
                    <div class="col-4">Task Status:<span class="text-danger">*</span>
                        <select name="task_status" class="form-control" id="">
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                            <option value="cancel">cancel</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        Task Detail:<span class="text-danger">*</span>
                        <textarea name="task_detail" id="" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-3">
                        <input type="submit" value="Create" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
