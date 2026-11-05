<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="../../resources/images/logo.png" alt="Bootstrap" width="120" height="50" />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../property/index.php">My Property</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../appointment/index.php">Appointments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php">Reservations</a>
              </li>
            </ul>
            <form class="d-flex signOutbtn" role="search" action="../../logout.php" method="POST">
              <button class="btn btn-outline-secondary me-2" type="submit">
              Sign Out &nbsp;<i class="fa-solid fa-right-from-bracket"></i> 
              </button>
            </form>
          </div>
        </div>
      </nav>