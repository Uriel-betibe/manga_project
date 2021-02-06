<!-- menu commun a toutes les pages -->
<header class=" bg-dark">
        <div class="container">
          <div class="row ">
            <nav class="col navbar navbar-expand-lg  navbar-dark  ">
              <a class="navbar-brand" href="accueil.php">
                  <img src="img/logoT.png" width="40" height="30"  alt="logo du site">
                  MANGANIME
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="navbar-nav navbar-right">
                  <li class="nav-item active">
                    <a class="nav-link" href="accueil.php">Accueil</a>
                  </li>
                  <?php
                  if(isset($_SESSION["id"]))
                  { 
                  ?>
                  <li class="nav-item">
                    <a class="nav-link" href="bibliotheque.php">bibliothèque</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="favoris.php">favoris</a>
                  </li>
                    <?php if(($_SESSION["acces_utilisateur"] == 1) OR ($_SESSION["acces_utilisateur"] == 2)){ ?>
                      <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">gestion</a>
                      <div class="dropdown-menu bg-black text-white">
                        <a class="dropdown-item" href="gestionutilisateur.php">utilisateur</a>
                        <a class="dropdown-item" href="gestionOeuvres.php">mangas</a>
                      </div>
                      </li>
                    <?php } ?>
                  <?php
                  }
                  ?> 
                  <li class="nav-item">
                    <a class="nav-link" href="profilUser.php">profil</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">log</a>
                      <div class="dropdown-menu bg-black text-white">
                        <a class="dropdown-item" href="connexion.php">connexion</a>
                        <a class="dropdown-item" href="deconnexion.php">deconnexion</a>
                      </div>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
    </header>