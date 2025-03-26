<?php
  include('database/database.php');
  include('partials/header.php');
  include('partials/sidebar.php');

  $sql = "SELECT * FROM movies";

  if (!empty($_GET['search'])) {
      $search = $_GET['search'];
      $sql = "SELECT * FROM movies WHERE Title LIKE '%$search%' OR Genre LIKE '%$search%' OR Rating LIKE '%$search%' OR YearReleased LIKE '%$search%'";
  }
  
  $movies = $conn->query($sql);  
  $status = '';
  if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
  }
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Movie Information Management System</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">General</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Movie List</h5>
              <button class="btn btn-primary btn-sm mt-4 mx-2" data-bs-toggle="modal" data-bs-target="#addMovieModal">Add Movie</button>
            </div>

            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Genre</th>
                  <th>Rating</th>
                  <th>Date Released</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($movies->num_rows > 0): ?>
                  <?php while ($row = $movies->fetch_assoc()): ?>
                    <tr>
                      <td><?php echo $counter++; ?></td>
                      <td><?php echo $row['Title']; ?></td>
                      <td><?php echo $row['Genre']; ?></td>
                      <td><?php echo $row['Rating']; ?></td>
                      <td><?php echo $row['YearReleased']; ?></td>
                      <td class="d-flex justify-content-center">
                        <!-- Edit Button -->
                        <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['ID']; ?>">Edit</button>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo $row['ID']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Movie Info</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="database/update.php" method="POST">
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                  <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="Title" class="form-control" value="<?php echo $row['Title']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Genre</label>
                                    <input type="text" name="Genre" class="form-control" value="<?php echo $row['Genre']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <input type="text" name="Rating" class="form-control" value="<?php echo $row['Rating']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Date Released</label>
                                    <input type="date" name="YearReleased" class="form-control" value="<?php echo $row['YearReleased']; ?>" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>


                            <!-- View Button -->
                            <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#ViewModal<?php echo $row['ID']; ?>">View</button>

                            <!-- View Modal -->
                            <div class="modal fade" id="ViewModal<?php echo $row['ID']; ?>" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">View Movie Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <div class="mb-3">
                                    <p><strong>ID No.:</strong></p>
                                    <input type="text" class="form-control" value="<?php echo $counter -1 ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <p><strong>Title:</strong></p>
                                    <input type="text" class="form-control" value="<?php echo $row['Title']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <p><strong>Genre:</strong></p>
                                    <input type="text" class="form-control" value="<?php echo $row['Genre']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <p><strong>Rating:</strong></p>
                                    <input type="text" class="form-control" value="<?php echo $row['Rating']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <p><strong>Date Released:</strong></p>
                                    <input type="date" class="form-control" value="<?php echo $row['YearReleased']; ?>" disabled>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                  
                                </div>
                              </div>
                            </div>
                          </div>


                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['ID']; ?>">Delete</button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $row['ID']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                <h1 class="text-danger" style="font-size: 50px"><strong>!</strong></h1>
                                <h5>Are you sure you want to delete this Movie?</h5>
                                <h6>This action cannot be undone.</h6>
                              </div>
                              <div class="modal-footer d-flex justify-content-center">
                                <form action="database/delete.php" method="POST">
                                  <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No Movie found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

                        <div class="modal fade" id="ProfileModal" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <img src="assets/img/IMG-2498.jpg" alt="Profile" class="rounded-circle">
                                    <h6>Jared Hope Palma</h6>
                                    <span>Web Designer</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        <!-- Create (Add Movie) Modal -->
                        <div class="modal fade" id="addMovieModal" tabindex="-1" aria-labelledby="addMovieLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <form action="database/create.php" method="POST">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Add Movie</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <div class="mb-3">
                                  <label class="form-label">Title</label>
                                  <input type="text" name="Title" id="Title" class="form-control" placeholder="Enter Title" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <input type="text" name="Genre" id="Genre" class="form-control" placeholder="Enter Genre"required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <input type="text" name="Rating" id="Rating" class="form-control" placeholder="Enter Rating"required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Year Released</label>
                                <input type="date" name="YearReleased" id="YearReleased" class="form-control" placeholder="Enter Year Released"required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save Movie</button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>


<?php include('partials/footer.php'); ?>
