<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>
                <?php
                       if ($_SESSION['role_name'] == 'Admin'){
                        // display the HTML code if the session variable 'role_name' is set to 'Admin'
                        ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="schools.php"
                        aria-expanded="false"><i class="mdi mdi-book-open-page-variant"></i><span
                            class="hide-menu">Schools</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="departments.php"
                        aria-expanded="false"><i class="mdi mdi-folder-multiple"></i><span
                            class="hide-menu">Departments</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="courses.php"
                        aria-expanded="false"><i class="mdi mdi-school"></i><span class="hide-menu">Courses</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
               if ($_SESSION['role_name'] == 'Chairperson' || $_SESSION['role_name'] == 'Dean'|| $_SESSION['role_name'] == 'Lecturer'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="department-courses.php"
                        aria-expanded="false"><i class="mdi mdi-school"></i><span class="hide-menu">Courses</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Chairperson'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="department-units.php"
                        aria-expanded="false"><i class="mdi mdi-vector-square"></i><span
                            class="hide-menu">Units</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Chairperson' || $_SESSION['role_name'] == 'Dean' || $_SESSION['role_name'] == 'Lecturer'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="select-units.php"
                        aria-expanded="false"><i class="mdi mdi-checkbox-marked"></i><span class="hide-menu">Select
                            Units</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Chairperson' || $_SESSION['role_name'] == 'Dean' || $_SESSION['role_name'] == 'Lecturer'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="selected-units.php"
                        aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Selected
                            Units</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
               if ($_SESSION['role_name'] == 'Chairperson' || $_SESSION['role_name'] == 'Dean' || $_SESSION['role_name'] == 'Lecturer'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="schedules.php"
                        aria-expanded="false"><i class="fa fa-file-alt"></i><span class="hide-menu">Reports</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="units.php"
                        aria-expanded="false"><i class="mdi mdi-vector-square"></i><span
                            class="hide-menu">Units</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
                if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="academic-year.php"
                        aria-expanded="false"><i class="mdi mdi-calendar-range"></i><span class="hide-menu">Academic
                            Year</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="semesters.php"
                        aria-expanded="false"><i class="mdi mdi-timetable"></i><span
                            class="hide-menu">Semesters</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="rooms.php"
                        aria-expanded="false"><i class="mdi mdi-window-open"></i><span
                            class="hide-menu">Rooms</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="course-groups.php"
                        aria-expanded="false"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Course
                            Groups</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
                if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="users.php"
                        aria-expanded="false"><i class="mdi mdi-account"></i><span
                            class="hide-menu">Lecturers</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
                if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="admins.php"
                        aria-expanded="false"><i class="mdi mdi-account-key"></i><span
                            class="hide-menu">Admins</span></a>
                </li>
                <?php
                   }
              ?>

                <?php
                if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="timetable.php"
                        aria-expanded="false"><i class="mdi mdi-calendar-clock"></i><span class="hide-menu">Generate
                            Timetable</span></a>
                </li>
                <?php
                   }
              ?>
                <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="reports.php"
                        aria-expanded="false"><i class="fa fa-file-alt"></i><span class="hide-menu">Reports</span></a>
                </li>
                <?php
                   }
              ?>
                <li class="sidebar-item mt-1">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php"
                        aria-expanded="false" style="color:red;font-weight:bold; font-size:20px"><i
                            class="mdi mdi-login-variant"></i><span class="hide-menu">LOGOUT</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>