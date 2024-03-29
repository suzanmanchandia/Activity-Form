




			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse">

						{{ Menu::handler('main') }}
						<ul class="nav navbar-nav navbar-right navbar-special">
							<li class="dropdown">
								<a id="curUser" class="dropdown-toggle"
								   data-toggle="dropdown"
								   href="#">
									<span class="current-user">{{ $staff->first_name }}</span> <b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="{{ route('staff.password') }}">Change Password</a>
									</li>
									<li><a id="logout"  href="{{ route('staff.logout') }}">Logout</a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>