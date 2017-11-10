@if(Auth::user()->is_admin)
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">Account Dashboard</div>
            <div class="card-body">
                <p class="text-success">
                    Accounts Active: {{$usersActive}}
                </p>
                <p class="text-danger">
                    Accounts Locked: {{$usersLocked}}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">ADMIN Dashboard</div>
            <div class="card-body">
                <p class="text-success">Welcome,</p>
                <p class="text-success">You are logged in as ADMIN.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-secondary text-white">Department Dashboard</div>
            <div class="card-body">
                <p class="text-success">
                    Departments Active: {{$departmentsActive}}
                </p>
                <p class="text-danger">
                    Departments Locked: {{$departmentsLocked}}
                </p>
            </div>
        </div>
    </div>

@else
    <div class="col-md-6 offset-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">USER Dashboard</div>
            <div class="card-body">
                <p class="text-success">Welcome,</p>
                <p class="text-success">You are logged in as USER.</p>
            </div>
        </div>
    </div>
@endif
