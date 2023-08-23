@extends('layouts.admin')

@push("style-alt")
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
@endpush

@section('content')
<div class="title d-flex justify-content-between">
    <h3 class="page-title">Category</h3>
    <p >
        <a href="{{ route('admin.learn.create') }}" class="btn btn-success">Add Learn</a>
    </p>
</div>
<div class="card">
    <div class="card-header">
        Learn
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover datatable datatable-Location">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Category</td>
                    <td>Title</td>
                    <td>Content</td>
                    <td>Resolved</td>
                    <td>Received</td>
                    <td>Average Time</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
            @forelse ($learn as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->category_title }}</td>
                    <td>{{ $row->title }}</td>
                    <td>{!! $row->content !!}</td>
                    <td>{{ $row->resolved_num }}</td>
                    <td>{{ $row->received_num }}</td>
                    <td>{{ $row->response_time }}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('admin.learn.edit', $row->id) }}">
                            Edit
                        </a>
                        <span>&nbsp;&nbsp;</span>
                        <form action="{{ route('admin.learn.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                        </form>
                    </td>
                </tr>
             @empty
            <tr>
                <td class="text-center" colspan="8">Not found !</td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
