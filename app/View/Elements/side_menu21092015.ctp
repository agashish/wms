<div class="leftside">
			<div class="sidebar">
				<!-- BEGIN RPOFILE -->
				<div class="nav-profile">
					<div class="thumb">
						<?php
						if($this->session->read('Auth.User.id') > 0)
						{	
							$getCommonHelper = $this->Common->getUserDataAfterLogin( $this->session->read('Auth.User.id') );
							
							/* Set FirstName with LastName*/
							$getUserName = $this->Common->getFirstLastName( $this->session->read('Auth.User.id') );
						} 
						?>
                        <?php
						    $userImage = $getCommonHelper['User']['user_image'];
							$userName = $getCommonHelper['User']['first_name'].' '.$getCommonHelper['User']['last_name'];
							if( isset( $userImage ) && $userImage != "" )
							{
								print $this->html->image( 'upload/'.$userImage, array( "class" => "img-circle", "title" => $userName ) );			
							}
                        ?>  
						<!--<span class="label label-danger label-rounded">3</span>-->
					</div>
					<div class="info">
						<a href="#"><?php print $getUserName; ?></a>
					</div>
					<a href="<?php print Router::url(array('controller' => 'users', 'action' => 'logout')); ?>" class="button"><i class="ion-log-out"></i></a>
				</div>
				<!-- END RPOFILE -->
				<!-- BEGIN NAV -->
				<div class="title">Navigation</div>
					<ul class="nav-sidebar">
						<li class="active">
                            <a title="Dashboard" href="javascript::void(0);">
                                <i class="ion-home"></i> <span>Dashboard</span>
                            </a>
                        </li>
						
						<!-- Start here user section -->
						<li class="nav-dropdown">
                            <a title="Roles" href="#">
                                <i class="ion-wand"></i> <span>Roles</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showRoles">Show Roles</a></li>
									<li><a href="/wms/managerole">Add New Roles</a></li>									
                            </ul>
                        </li>						
						<!-- End here role section -->
						
						<!-- Start here user section -->
						<li class="nav-dropdown">
                            <a title="Users" href="#">
                                <i class="fa fa-users"></i> <span>Users</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showList">Show All Users</a></li>
									<li><a href="/wms/register">Register User</a></li>									
                            </ul>
                        </li>
						<!-- End here user section -->
						
						<!-- Start here state & city section -->
						<li class="nav-dropdown">
                            <a title="Region" href="#">
                                <i class="fa fa-map-marker"></i> <span>Region</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showallLocation">Show All Countries</a></li>
									<li><a href="/wms/manageCounty">Add Country</a></li>
									<li><a href="/wms/showallStates">Show All States</a></li>
									<li><a href="/wms/manageState">Add State</a></li>
									<li><a href="/wms/showallCities">Show All Cities</a></li>
									<li><a href="/wms/manageCity">Add City</a></li>
                            </ul>
                        </li>
						
						<!-- Start here warehouse section -->
						<li class="nav-dropdown">
                            <a title="Warehouse" href="#">
                                <i class="fa fa-cubes"></i> <span>Warehouse</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showallWarehouses">Show All Warehouse</a></li>
									<li><a href="/wms/manageWarehouse">Add Physical Warehouse</a></li>
                            </ul>
                        </li>
						<!-- End here warehouse section -->
						
						<!-- Start here client section -->
						<li class="nav-dropdown">
                            <a title="Clients" href="#">
                                <i class="ion-ios-color-filter-outline"></i> <span>Clients</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showall/Client/List">Show All Client</a></li>
									<li><a href="/wms/manage/client/new">Add Client</a></li>
                            </ul>
                        </li>
						<!-- End here client section -->
						
						<!-- Start here for supplier section -->
						<li class="nav-dropdown">
                            <a title="Suppliers" href="#">
								
                                <i class="ion-android-person-add"></i> <span>Suppliers</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showAllSupplier">Show Supplier</a></li>
									<li><a href="/wms/manageSupplier">Add New Supplier</a></li>	
						    </ul>
                        </li>
						<!-- End here user for supplier section -->
						
						<!-- Start here for category section -->
						<li class="nav-dropdown">
                            <a title="Categories" href="#">
                                <i class="ion-merge"></i> <span>Categories</span>
                                <i class="ion-chevron-right pull-right"></i>
								
                            </a>
                            <ul>
									<li><a href="/wms/manageCategory">Add New Category</a></li>	
									<li><a href="/wms/showAllCategory">Show Category</a></li>	
						    </ul>
                        </li>
						<!-- End here user for category section -->
						
						<!-- Start here for Brands section -->
						<li class="nav-dropdown">
							<a title="Brands" href="#">

								<i class="fa fa-shirtsinbulk"></i> <span>Brands</span>
								<i class="ion-chevron-right pull-right"></i>
							</a>
							<ul>
								<li><a href="/wms/showAllBrand">Show Brands</a></li>
								<li><a href="/wms/manageBrand">Add Brand</a></li> 
							</ul>
						</li>
						<!-- End here user for Brands section -->
						
						<!-- Start here for attribute section -->
						<li class="">
							<a title="Product Attributes" href="/wms/attribute">
								<i class="fa fa-buysellads"></i> <span>Product Attributes</span>
							</a>
						</li>
						<!-- End here user for attribute section -->
						
						<!-- Start here for linnworks API -->
						<li class="">
							<a title="Product Attributes" href="/wms/linnworksapis">
								<i class="fa fa-plug"></i> <span>Linnworks API</span>
							</a>
						</li>
						<!-- End here user for linnworks API -->
						
						
						
						<!-- Start here for Products section 
						<li class="nav-dropdown">
                            <a href="#">
								
                                <i class="fa fa-cube"></i><span>Products Management</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
									<li><a href="/wms/showAllProducts">Show Products</a></li>
									<li><a href="/wms/manageProducts">Add Product</a></li>	
						    </ul>
                        </li>-->
						<!-- End here user for Products section -->
						
						
						
						
						
						
                        <!--<li>
							<a href="inbox.html">
								<i class="ion-email"></i> <span>Inbox</span>
								<span class="label pull-right">10</span>
							</a>
						</li>
                        <li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-beaker"></i> <span>UI Elements</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="panels.html">Panels</a></li>
                                <li><a href="tiles.html">Tiles</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="material.html">Material Colors</a></li>
                                <li><a href="icons.html">Icons</a></li>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="sliders.html">Sliders</a></li>
                            </ul>
                        </li>
                        <li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-compose"></i> <span>Forms</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="form-elements.html">Form Elements</a></li>
                                <li><a href="form-validation.html">Form Validation</a></li>
                                <li><a href="form-layouts.html">Form Layouts</a></li>
                                <li><a href="form-advanced.html">Advanced Plugins</a></li>
                                <li><a href="file-upload.html">File Upload</a></li>
                                <li><a href="text-editor.html">Text Editors</a></li>
                            </ul>
                        </li>
                        <li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-navicon-round"></i> <span>Tables</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="basic-tables.html">Basic tables</a></li>
                                <li><a href="data-tables.html">Data tables</a></li>
                            </ul>
                        </li>
						<li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-arrow-graph-up-right"></i> <span>Charts</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="flot.html">Flot</a></li>
                                <li><a href="morris.html">Morris</a></li>
                            </ul>
                        </li>
						<li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-paper-airplane"></i> <span>Layouts</span> 
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
							<ul>
                                <li><a href="fixed-header.html">Fixed Header</a></li>
                                <li><a href="fixed-sidebar.html">Fixed Sidebar</a></li>
                                <li><a href="fixed-layout.html">Fixed Layout</a></li>
                                <li><a href="collapsed-sidebar.html">Collapsed Sidebar</a></li>
                            </ul>
                        </li>
                        <li>
							<a href="calendar.html">
								<i class="ion-calendar"></i> <span>Calendar</span>
								<span class="label bg-green-700 pull-right">NEW</span>
							</a>
						</li>
                        <li class="nav-dropdown">
							<a href="#">
								<i class="ion-ios-location"></i> <span>Map</span>
                                <i class="ion-chevron-right pull-right"></i>
							</a>
							<ul>
								<li><a href="vectormap.html">Vector Map</a></li>
								<li><a href="googlemap.html">Google Map</a></li>
                            </ul>
						</li>
                        <li class="nav-dropdown">
                            <a href="#">
                                <i class="ion-document-text"></i> <span>Other Pages</span>
                                <i class="ion-chevron-right pull-right"></i>
                            </a>
                            <ul>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="lockscreen.html">Lockscreen</a></li>
                                <li><a href="timeline.html">Timeline</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="500.html">500 Error</a></li>
                                <li><a href="blank.html">Blank Page</a></li>
                            </ul>
                        </li>-->
                    </ul>
					<!-- END NAV -->				
			</div><!-- /.sidebar -->
        </div>
