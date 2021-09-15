<nav id="sidebar" class="sidebar js-sidebar">

			<div class="sidebar-content js-simplebar">

				<a class="sidebar-brand" href="index.php">

          <span class="align-middle">GCMS</span>

        </a>



				<ul class="sidebar-nav">

					<li class="sidebar-header">

						Home

					</li>



					<li class="sidebar-item <?= ($_SERVER['SCRIPT_NAME']=="/admin/index.php") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="index.php">

              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>

            </a>

					</li>



					<li class="sidebar-item <?= ($_SERVER['SCRIPT_NAME']=="/admin/records.php") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="records.php">

              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Students</span>

            </a>

					</li>



					<li class="sidebar-header">

						Counseling

					</li>



					<li class="sidebar-item <?= ($_SERVER['REQUEST_URI']=="/admin/counseling.php") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="counseling.php">

              <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Counselling Records</span>

            </a>

					</li>




					<li class="sidebar-item <?= ($_SERVER['SCRIPT_NAME']=="/admin/message.php") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="message.php">

              <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Help Desk</span>

            </a>

					</li>



					<li class="sidebar-header">

						Others

					</li>



					<li class="sidebar-item <?= ($_SERVER['SCRIPT_NAME']=="/admin/visit_log.php") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="visit_log.php">

              <i class="align-middle" data-feather="archive"></i> <span class="align-middle">Visit Logs</span>

            </a>

					</li>



					<li class="sidebar-item <?= ($_SERVER['SCRIPT_NAME']=="/admin/files.php") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="files.php">

              <i class="align-middle" data-feather="file"></i> <span class="align-middle">Files & Documents</span>

            </a>



					</li>

					<li class="sidebar-item <?= ($_SERVER['REQUEST_URI']=="/admin/counseling.php?ref=1") ? 'active' : '' ;?>">

						<a class="sidebar-link" href="counseling.php?ref=1">

              <i class="align-middle" data-feather="flag"></i> <span class="align-middle">Reports</span>

            </a>

					</li>

				</ul>

			</div>

		</nav>



		<div class="main">

			<nav class="navbar navbar-expand navbar-light navbar-bg">

				<a class="sidebar-toggle js-sidebar-toggle">

          <i class="hamburger align-self-center"></i>

        </a>



				<div class="navbar-collapse collapse">

					<ul class="navbar-nav navbar-align">

					<li class="nav-item dropdown">

							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">

								

								<div class="position-relative">

									<i class="align-middle" data-feather="bell"></i>

									<?php if (countUnseenNotif() !== 0) : ?>

									<span class="indicator"><?= countUnseenNotif() ?></span>

									<?php else: ?>

										

										<?php endif; ?>



								</div>



							</a>

							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">

								<div class="dropdown-menu-header">

								<?php if (countUnseenNotif() !== 0) : ?>

									<?= countUnseenNotif() ?> New Notifications

									<?php else: ?>

										No New Notifications

									

									<?php endif; ?>

								</div>

								<div class="list-group">



								<?php 



								$sql = "SELECT * FROM `admin_notif` WHERE `status` = '0'";

								$query = mysqli_query($db, $sql);

								while($row = mysqli_fetch_assoc($query)):

								?>



								<form action="start_counseling.php" id="myform<?= $row['case_id']; ?>" method="post">

									<input type="hidden" name="student___id" value="<?= $row['student_id']; ?>">

									<input type="hidden" name="case_id" value="<?= $row['case_id']; ?>">

								</form>



								<a href="start_counseling.php?id=<?=$row['student_id']  ?>&case=<?= $row['case_id'] ?>" class="list-group-item <?= ($row['status'] == '0') ? 'bg-light' : '' ; ?>">

										<div class="row g-0 align-items-center">

											<div class="col-2">

												<i class="text-success" data-feather="briefcase"></i>

											</div>

											<div class="col-10">

												<div class="text-dark"><?= $row['message'] ?></div>

												<div class="text-muted small mt-1"><?= $row['datetime'] ?></div>

											</div>

										</div>

									</a>

									

								<?php

								endwhile;

								?>



								</div>

								<!-- <div class="dropdown-menu-footer">

									<a href="#" class="text-muted">Show all notifications</a>

								</div> -->

							</div>

						</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
									<span class="indicator"><?= countUnseenMSG() ?></span>

								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										<?= countUnseenMSG() ?> New Messages
									</div>
								</div>
								<div class="list-group">
								<?php 



						$sql = "SELECT * FROM `messages` INNER JOIN student ON messages.sender = student.id WHERE messages.status = '0' GROUP BY sender ORDER BY datetime DESC";

						$query = mysqli_query($db, $sql);

						while($row = mysqli_fetch_assoc($query)):

						?>

									<a href="message.php?id=<?= $row['sender'] ?>&ref=1" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="https://www.freeiconspng.com/uploads/profile-user-outline-vector-icon--social-icons--icons-download-26.png" class="avatar img-fluid rounded-circle" alt="">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark"><?= $row['firstname']. ' '. $row['lastname'] ?></div>
												<div class="text-muted small mt-1"><?= $row['message'] ?>.</div>
												<div class="text-muted small mt-1"><?= $row['datetime'] ?></div>
											</div>
										</div>
									</a>

									<?php endwhile; ?>
									
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>

						<li class="nav-item dropdown">

							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">

                <i class="align-middle" data-feather="settings"></i>

              </a>



							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">

                <img src="https://i.pinimg.com/564x/29/47/9b/29479ba0435741580ca9f4a467be6207.jpg" class="avatar img-fluid rounded me-1"/> <span class="text-dark"><?= $res['username'] ?></span>

              </a>

							<div class="dropdown-menu dropdown-menu-end">

								<a class="dropdown-item" href="<?= BASE_URL .'/actions/logout.php'; ?>">Log out</a>

							</div>

						</li>

					</ul>

				</div>

			</nav>