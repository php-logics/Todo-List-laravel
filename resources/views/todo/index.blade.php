@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2">
            <a href="{{ route('todo.create') }}" class="btn btn-success ms-auto me-0">Create Todo Item</a>
        </div>
        <div class="col-12">
            <form action="{{ route('todo.index') }}" method="get">
                <div class="row">
                    <div class="col-3"> <input type="text" value="{{ request()->search }}" name="search" placeholder="Search using keyword" class="form-control" /></div>
                    <div class="col-3"> <input type="date" value="{{ request()->date }}" name="date" placeholder="select date" class="form-control" /></div>
                    <div class="col-3">
                        <select name="status" class="form-control" id="">
                            <option value="">select</option>
                            <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>pending</option>
                            <option value="completed" {{ request()->status == 'completed' ? 'selected' : '' }}>completed</option>
                            <option value="cancel" {{ request()->status == 'cancel' ? 'selected' : '' }}>cancel</option>
                        </select>
                    </div>
                    <div class="col-3"><input type="submit" value="Search" class="btn btn-success"></div>

                </div>

            </form>
        </div>
        <div class="col-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task Name</th>
                        <th scope="col">Task Detail</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $number = 1;
                    @endphp
                        @foreach($todo_list as $todo_item)
                            <tr>
                                <td>{{ $number }}</td>
                                <td>{{ $todo_item->title }}</td>
                                <td>{{ $todo_item->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($todo_item->date)->format('d-F-Y H:i:s a') }}</td>
                                <td>{{ $todo_item->status }}</td>
                                <td>{{ \Carbon\Carbon::parse($todo_item->created_at)->format('d-F-Y H:i:s a') }}</td>
                                <td>{{ \Carbon\Carbon::parse($todo_item->updated_at)->format('d-F-Y H:i:s a') }}</td>
                                <td class="d-flex gap-3">
                                    <a class="btn btn-sm btn-success" href="{{ route('todo.edit',$todo_item->id) }}">Edit</a>
                                    <form action="{{ route('todo.destroy', $todo_item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @php
                            $number++;
                        @endphp
                    @endforeach
            </tbody>
          </table>

        </div>
        <div class="col-12">
            {!! $todo_list->appends(['search'=>request()->search,'date'=>request()->date,'status'=>request()->status])->links() !!}
        </div>
    </div>
</div>
@endsection
