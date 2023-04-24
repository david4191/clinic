
	
	<div class="wrapper">		
		<!-- Page Content -->
		<div id="content">
			<!-- Top Navigation -->
			<div class="container top-brand">
				<nav class="navbar navbar-default">			
					<div class="navbar-header">
						<div class="sidebar-header"> <a href="account.php"><img src="images/DSS-Logo.png" class="logo" alt="DSS Medical Centre" width="90px" height="85px"></a>
						</div>
					</div>
					<ul class="nav justify-content-end">
						<li class="nav-item">
							<a class="nav-link">
								<span title="Fullscreen" class="ti-fullscreen fullscreen"></span>
							</a>							
						</li>
						
						<li class="nav-item">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
							 aria-expanded="false">
								<span class="ti-announcement"></span>
							</a>
							<div class="dropdown-menu proclinic-box-shadow2 notifications animated flipInY">
								<h5>Notifications</h5>
								<a class="dropdown-item" href="#">
									<span class="ti-wheelchair"></span> New Doctor's Record Added</a>
								
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
							 aria-expanded="false">
								<span class="ti-user"></span>
							</a>
							<div class="dropdown-menu proclinic-box-shadow2 profile animated flipInY">
								<h5 style="text-transform: uppercase"><?= $_SESSION['username'] ?></h5>
									
								<a class="dropdown-item" href="account-profile.php">
									<span class="ti-user"></span> Profile</a>
								<a class="dropdown-item" href="logout.php">
									<span class="ti-power-off"></span> Logout</a>
							</div>
						</li>
					</ul>
			
				</nav>
			</div>
			<!-- /Top Navigation -->
			<!-- Menu -->
			<div class="container menu-nav">
				<nav class="navbar navbar-expand-xl proclinic-bg text-white">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="ti-menu text-white"></span>
					</button>
					
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item dropdown ">
								<a class="nav-link" href="account.php" role="button" aria-haspopup="true"
								 aria-expanded="false"><i class="fas fa-clinic-medical"></i> Dashboard</a>
								
							</li>
							
							
							<li class="nav-item dropdown active">
								<a class="nav-link" href="" role="button" aria-haspopup="true"
								 aria-expanded="false"><i class="fas fa-money-check"></i> Account & Sales</a>
								
							</li>
							
							
							<li class="nav-item dropdown ">
								<a class="nav-link" href="" role="button" aria-haspopup="true"
								 aria-expanded="false"><i class="fas fa-file-prescription"></i> Invoice</a>
								
							</li>
							
							<li class="nav-item dropdown">
								<a class="nav-link " href="" role="button" aria-haspopup="true"
								 aria-expanded="false"><i class="fas fa-user-nurse"></i> My Profile</a>
								
							</li>
							
						</ul>
					</div>
				</nav>
			</div>