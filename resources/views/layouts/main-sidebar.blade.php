<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if(auth('web')->check()) {
            @include('layouts.sidebars.admin-sidebar')
                }
            @elseif(auth('student')->check()){
            @include('layouts.sidebars.student-sidebar')
                }
            @elseif(auth('parent')->check()){
            @include('layouts.sidebars.parent-sidebar')
                }
            @elseif(auth('teacher')->check()){
            @include('layouts.sidebars.teacher-sidebar')
                }
            @endif
        </div>
    </div>
</div>

