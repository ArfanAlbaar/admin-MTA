@extends('layouts.app')

@section('title', 'Record Chats')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Record Chats</h1>
            <a href="{{ route('admin.record-chats.report.pdf') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Recorded Chats</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Chat</th>
                                <th>Created Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recordChats as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->chat }}</td>
                                    <td>{{ $record->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No chat records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $recordChats->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
