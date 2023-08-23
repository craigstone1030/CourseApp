@extends('layouts.admin')

@section('content')

   <div class="title d-flex justify-content-between">
        <h3 class="page-title">Category</h3>
        @can('category_create')
        <p >
            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Add New</a>

        </p>
        @endcan
   </div>


    <div class="card">
        <div class="card-header">
            Category
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Location">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th width="15%">
                                Title
                            </th>
                            <th width="30%">
                                Description
                            </th>
                            <th>
                                Category Image
                            </th>
                            <th>
                                Published
                            </th>
                            <th width="150px">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 0;
                        $j = 0;
                    @endphp
                    @forelse($categories as $key => $row)
                        <tr data-entry-id="{{ $row["id"] }}">
                        @php
                         if($row["parent_id"] == 0) {
                            $i++;
                            $j = 0;
                         }
                        @endphp
                            <td>
                                @php

                                    if($row["parent_id"] > 0) $j++;

                                    if($j > 0)
                                        echo $i."-".$j;
                                    else
                                        echo $i;
                                @endphp

                            </td>
                            <td>
                                {{ $row["title"] ?? '' }}
                            </td>

                            <td>
                                {!! $row["description"] ?? '' !!}
                            </td>

                            <td>
                                <img width="50" src="{{ Storage::url($row["category_image"]) }}" alt="{{ $row["category_image"] }}">
                            </td>

                            <td>
                                {{ $row["published"] }}
                            </td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('admin.categories.edit', $row["id"]) }}">
                                    Edit
                                </a>
                                <span>&nbsp;&nbsp;</span>
                                <form action="{{ route('admin.categories.destroy', $row["id"]) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger" >Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="10">Not found !</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
