<body>
	
	<!-- Navigation -->
	<div class="wrap">
  <nav class="nav-bar navbar-inverse" role="navigation">
      <div id ="top-menu" class="container-fluid active">
          <a class="navbar-brand" href="index.php?controller=materiel&action=readAll">Gestion de stock</a>
          <ul class="nav navbar-nav"> 
              <li class="dropdown movable">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilisateur<span class="caret"></span><span class="fa fa-4x fa-child"></span></a>
                  <ul class="dropdown-menu" role="menu">
                      <li><a href="index.php?controller=user&action=editPwd"><span class="fa fa-gear"></span>Changer le mot de passe</a></li>
                      <li class="divider"></li>
                      <li><a href="index.php?controller=home&action=authentifier"><span class="fa fa-power-off"></span>Se déconnecter</a></li>
                  </ul>
              </li>   
          </ul>
      </div>      
  </nav>
  <aside id="side-menu" class="aside" role="navigation">            
        <ul class="nav nav-list accordion">                    
          <li class="nav-header">
            <div class="link"><a href="index.php?controller=materiel&action=readAll"><i class="fa fa-lg fa-globe"></i>Stock<i class="fa fa-chevron-down"></i></a></div>
          </li>
          
          <li class="nav-header">
            <div class="link"><a href="index.php?controller=membre&action=readAll"><i class="fa fa-lg fa-users"></i>Membre<i class="fa fa-chevron-down"></i></a></div>
          </li>
          
          <li class="nav-header">
            <div class="link"><a href="index.php?controller=materielPret&action=readAll"><i class="fa fa-cloud"></i>Prêt<i class="fa fa-chevron-down"></i></a></div>
          </li> 
          
      </ul>
	  
	  <!-- une alerte permanente -->
	  <div id="panel-alert">
		<div class="panel panel-default">
		  <div class="panel-heading">
            <div class="link"><a href="index.php?controller=materiel&action=readAll"><h3><span class="glyphicon glyphicon-alert"></span> Alerte</h3></a></div>
		  </div>
		  <div class="panel-body">
			  <?php 
			   if (!empty($tab_materiel_alert)) {
				foreach ($tab_materiel_alert as $materiel) {
					echo "<div class='alert alert-danger' role='alert'><strong>".$materiel->materiel_nom. "</strong> doit être commandé</div>";
			   }
			   } else {
				   echo "<div class='alert alert-info' role='alert'>Aucune alerte</div>";
			   }
			   ?>
		  </div>
        </div>  
		</div>
		

  </aside>
  
  <!--Body content-->
  <div class="content">
    <div class="top-bar">       
      <a href="#menu" class="side-menu-link burger"> 
        <span class='burger_inside' id='bgrOne'></span>
        <span class='burger_inside' id='bgrTwo'></span>
        <span class='burger_inside' id='bgrThree'></span>
      </a>      
    </div>