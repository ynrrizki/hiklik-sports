@extends('layouts.dashboard')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Events</h1>
    </div>

    <div class="table-responsive col-lg-10">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a href="{{ route('events.create') }}" class="mt-1 btn btn-primary mb-3">Add event</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($events as $event)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->category->name }}</td>
                                <td>{{ $event->address }}</td>
                                <td>{{ $event->phone }}</td>
                                <td>{{ $event->date->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('events.edit', $event->id) }}" class="badge bg-warning"><span
                                            data-feather="edit"></span>
                                    </a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                        class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Are you sure?')"><span
                                                data-feather="trash-2"></span></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $events->links() }}
            </div>
        </div>
    </div>
@endsection
