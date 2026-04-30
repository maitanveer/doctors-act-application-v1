@extends('layouts.admin')

@section('title', 'Applications Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Applications</h1>
    <div class="d-flex gap-2">
        <div class="btn-group mr-2">
            <a href="{{ route('admin.applications.export.excel', request()->all()) }}" class="btn btn-success">
                <i class="fa fa-file-excel-o"></i> Export Excel
            </a>
            <a href="{{ route('admin.applications.export.pdf', request()->all()) }}" class="btn btn-danger">
                <i class="fa fa-file-pdf-o"></i> Export PDF
            </a>
        </div>
        <span class="badge badge-primary" style="font-size: 14px; padding: 10px;">{{ $applications->total() }} Total</span>
    </div>
</div>

<!-- Filters -->
<div class="stat-card mb-4">
    <form method="GET" action="{{ route('admin.applications.index') }}">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Search by name, email, ID..." 
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="submitted" {{ request('status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                    <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under Review</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_from" class="form-control" placeholder="From Date" 
                       value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <input type="date" name="date_to" class="form-control" placeholder="To Date" 
                       value="{{ request('date_to') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i> Filter
                </button>
                <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">
                    <i class="fa fa-refresh"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Applications Table -->
<div class="stat-card">
    @if($applications->count() > 0)
        <form id="bulkActionForm">
            @csrf
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div>
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll()">Select All</button>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="deselectAll()">Deselect All</button>
                </div>
                <div>
                    <select id="bulkAction" class="form-control form-control-sm d-inline-block" style="width: auto;">
                        <option value="">Bulk Actions</option>
                        <option value="approved">Mark as Approved</option>
                        <option value="rejected">Mark as Rejected</option>
                        <option value="under_review">Mark as Under Review</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <button type="button" class="btn btn-sm btn-primary" onclick="applyBulkAction()">Apply</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="30"><input type="checkbox" id="selectAllCheckbox"></th>
                            <th>Application ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Citizenship</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($applications as $app)
                        <tr>
                            <td><input type="checkbox" class="app-checkbox" value="{{ $app->id }}"></td>
                            <td><code>{{ $app->application_id }}</code></td>
                            <td>{{ $app->full_name }}</td>
                            <td>{{ $app->email }}</td>
                            <td>{{ $app->citizenship }}</td>
                            <td>
                                @if($app->status === 'submitted')
                                    <span class="badge badge-warning">Submitted</span>
                                @elseif($app->status === 'under_review')
                                    <span class="badge badge-info">Under Review</span>
                                @elseif($app->status === 'approved')
                                    <span class="badge badge-success">Approved</span>
                                @elseif($app->status === 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $app->submission_date ? $app->submission_date->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.applications.show', $app->id) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @if(auth()->user()->isSuperAdmin())
                                <a href="{{ route('admin.applications.edit', $app->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endif
                                <a href="{{ route('admin.applications.export-pdf', $app->id) }}" class="btn btn-sm btn-success" title="Export PDF">
                                    <i class="fa fa-download"></i>
                                </a>
                                <form action="{{ route('admin.applications.destroy', $app->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Are you sure you want to delete this application?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $applications->links() }}
        </div>
    @else
        <p class="text-center text-muted py-5">No applications found.</p>
    @endif
</div>
@endsection

@push('scripts')
<script>
function selectAll() {
    document.querySelectorAll('.app-checkbox').forEach(checkbox => checkbox.checked = true);
    document.getElementById('selectAllCheckbox').checked = true;
}

function deselectAll() {
    document.querySelectorAll('.app-checkbox').forEach(checkbox => checkbox.checked = false);
    document.getElementById('selectAllCheckbox').checked = false;
}

document.getElementById('selectAllCheckbox')?.addEventListener('change', function() {
    document.querySelectorAll('.app-checkbox').forEach(checkbox => checkbox.checked = this.checked);
});

function applyBulkAction() {
    const action = document.getElementById('bulkAction').value;
    if (!action) {
        alert('Please select an action');
        return;
    }

    const selectedIds = Array.from(document.querySelectorAll('.app-checkbox:checked')).map(cb => cb.value);
    if (selectedIds.length === 0) {
        alert('Please select at least one application');
        return;
    }

    if (action === 'delete') {
        if (!confirm(`Are you sure you want to delete ${selectedIds.length} application(s)?`)) {
            return;
        }
        submitBulkAction('{{ route("admin.applications.bulk-delete") }}', selectedIds);
    } else {
        submitBulkAction('{{ route("admin.applications.bulk-update-status") }}', selectedIds, action);
    }
}

function submitBulkAction(url, ids, status = null) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    form.innerHTML = `<input type="hidden" name="_token" value="${csrfToken}">`;
    
    ids.forEach(id => {
        form.innerHTML += `<input type="hidden" name="application_ids[]" value="${id}">`;
    });
    
    if (status) {
        form.innerHTML += `<input type="hidden" name="status" value="${status}">`;
    }
    
    document.body.appendChild(form);
    form.submit();
}
</script>
@endpush
