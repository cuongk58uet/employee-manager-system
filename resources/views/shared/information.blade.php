@if(Auth::user()->is_admin)
    <div class="col-md-6 offset-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">ADMIN Dashboard</div>
            <div class="card-body">
                <p class="text-success">You are logged in as ADMIN.</p>
            </div>
        </div>
    </div>
@else
    <div class="col-md-6 offset-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">USER Dashboard</div>
            <div class="card-body">
                <p class="text-success">You are logged in as USER.</p>
            </div>
        </div>
    </div>
@endif
