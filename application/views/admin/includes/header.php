  <nav class="site-navbar navbar navbar-inverse navbar-fixed-top navbar-mega navbar-inverse"
  role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
      data-toggle="collapse">
        <i class="icon md-more" aria-hidden="true"></i>
      </button>
      <a class="navbar-brand navbar-brand-center" href="<?php echo base_url(); ?>Admin/dashboard">
        <img class="navbar-brand-logo navbar-brand-logo-normal" src="<?php echo base_url(); ?>assets/admin/images/logo.png"
        title="GEC NIT RAIPUR ALUMNI ASSOCIATION">
        
        <span class="navbar-brand-text ">GEC NITRR Alumni Associaton | Administrator Panel</span>
      </a>
      <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon md-search" aria-hidden="true"></i>
      </button>
    </div>
    <div class="navbar-container container-fluid">
      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
          <li class="hidden-float" id="toggleMenubar">
            <a data-toggle="menubar" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
            </a>
          </li>
          <li class="hidden-xs" id="toggleFullscreen">
            <a class="icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
              <span class="sr-only">Toggle fullscreen</span>
            </a>
          </li>          
        </ul>

      </div>
      <!-- End Navbar Collapse -->
    </div>
  </nav>
  <div class="site-menubar">
    <div class="site-menubar-body">
      <div>
        <div>
          <ul class="site-menu">
            <li class="site-menu-category"></li>
            <li class="site-menu-item"><a href="<?php echo base_url() ?>Admin/dashboard">
                <span class="site-menu-title">Dashboard</span>
              </a></li>
            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-account" aria-hidden="true"></i>
                <span class="site-menu-title">Users</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/pendingapprovals/users">
                            <span class="site-menu-title">Pending Approvals</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/users_search">
                            <span class="site-menu-title">Search Users</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/users_edit">
                            <span class="site-menu-title">Edit Users</span>
                          </a>
                        </li>
                       <!--  <li class="site-menu-item">
                          <a class="animsition-link" href="add-exam.php">
                            <span class="site-menu-title">Send Email</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="">
                            <span class="site-menu-title">Export Users List</span>
                          </a>
                        </li>
                        --> 
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">News</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/edit_news">
                            <span class="site-menu-title">Add News</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/list_news">
                            <span class="site-menu-title">View All</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>


            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Minutes</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/edit_mom">
                            <span class="site-menu-title">Add Minutes of Meeting</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/list_mom">
                            <span class="site-menu-title">View All</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>


            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Discussion</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/edit_discussion/1">
                            <span class="site-menu-title">Add Discussion</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/list_discussion/1">
                            <span class="site-menu-title">View All</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>


            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Events</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/edit_event">
                            <span class="site-menu-title">Add Event</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/list_event">
                            <span class="site-menu-title">View All</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Chapters</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/edit_discussion/3">
                            <span class="site-menu-title">Add Chapter</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/list_discussion/3">
                            <span class="site-menu-title">View All</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Student Forum</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/edit_discussion/2">
                            <span class="site-menu-title">Add Student Forum</span>
                          </a>
                        </li>
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/list_discussion/2">
                            <span class="site-menu-title">View All</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="dropdown site-menu-item has-sub">
              <a class="dropdown-toggle" href="javascript:void(0)" data-dropdown-toggle="false">
                <i class="site-menu-icon md-view-compact" aria-hidden="true"></i>
                <span class="site-menu-title">Donations</span>
                <span class="site-menu-arrow"></span>
              </a>
              <div class="dropdown-menu">
                <div class="site-menu-scroll-wrap is-list">
                  <div>
                    <div>
                      <ul class="site-menu-sub site-menu-normal-list">
                        <li class="site-menu-item">
                          <a class="animsition-link" href="<?php echo base_url() ?>Admin/view_successful_donations">
                            <span class="site-menu-title">View Successful Donations</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </li>

            <li class="site-menu-item"><a href="<?php echo base_url() ?>Admin/logout">
                <span class="site-menu-title">Logout</span>
              </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>