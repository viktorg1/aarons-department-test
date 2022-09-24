<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom shadow-lg ">
    <div class="container-fluid">
        <a href="{{route('shifts.index')}}" class="navbar-brand">Aarons Department</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="{{route('employees.index')}}" class="nav-item nav-link">Employees</a>
                <a href="{{route('shifts.index')}}" class="nav-item nav-link">Shifts</a>
                <a href="{{route('import.index')}}" class="nav-item nav-link" tabindex="-1">Import</a>
            </div>
        </div>
    </div>
</nav>
