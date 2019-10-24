<ul class="sidebar sidebar-dashboard navbar-nav">
        <li id="dashboard" class="nav-item">
          <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li id="post-event-reports" class="nav-item">
          <a class="nav-link" href="post-event-reports">
            <i class="fas fa-fw fa-folder"></i>
            <span>Projects</span>
          </a>
        </li>
        @if(auth()->user()->role_id == 3)
  

        <li id="search" class="nav-item">
            <a class="nav-link" href="search">
              <i class="fas fa-fw fa-user"></i>
              <span>Search</span></a>
          </li>
        </li>

        <li id="account-management" class="nav-item">
            <a class="nav-link" href="account-management">
              <i class="fas fa-fw fa-user"></i>
              <span>Account Management</span></a>
          </li>
        </li>

        <li id="administrator" class="nav-item">
            <a class="nav-link" href="administrator">
              <i class="fas fa-fw fa-user"></i>
              <span>Administrator</span></a>
          </li>
        </li>

        @endif

        @if(auth()->user()->role_id == 1)
        <li id="student-list" class="nav-item">
          <a class="nav-link" href="student-list">
            <i class="fas fa-fw fa-table"></i>
            <span>Student List</span>
          </a>
        </li>

        <li id="speaker-list" class="nav-item">
          <a class="nav-link" href="speaker-list">
            <i class="fas fa-fw fa-table"></i>
            <span>Speaker List</span>
          </a>
        </li>

<!--         <li id="student-participants" class="nav-item">
          <a class="nav-link" href="student-participants">
            <i class="fas fa-fw fa-user"></i>
            <span>Student Participants</span>
          </a>
        </li>

        <li id="event-speakers" class="nav-item">
          <a class="nav-link" href="event-speakers">
            <i class="fas fa-fw fa-user"></i>
            <span>Event Speakers</span>
          </a>
        </li> -->
        
        @endif

<!--         <li id="management" class="nav-item dropdown">
          <a id="gardens-list" class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Management</span>
          </a>
          <div id="garden-management-dropdown" class="garden-side-dropdown dropdown-menu" aria-labelledby="pagesDropdown">
            <a id="" class="dropdown-item" href="">Item 1</a>
            <div class="dropdown-divider"></div>
            <a id="" class="dropdown-item" href="">Item 2</a>
          </div>
        </li> -->
        
  <!--       <li id="reports" class="nav-item">
          <a class="nav-link" href="reports.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Reports</span></a>
        </li> -->
      </ul>