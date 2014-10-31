<h4><?php echo $palabra->idioma[$_SESSION['idioma']][8]; ?><!-- Arqueologia --></h4>
  <div class="bs-example bs-example-tabs">
      <ul id="myTab" class="nav nav-tabs">
        <li class="dropdown">
          <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Cruz Parlante <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
            <li><a href="#descripcion" tabindex="-1" data-toggle="tab">Descripcion</a></li>
            <li><a href="#localizacion" tabindex="-1" data-toggle="tab">Localizacion</a></li>
            <li><a href="#servicios" tabindex="-1" data-toggle="tab">Servicios</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Muyil <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
            <li><a href="#descripcion2" tabindex="-1" data-toggle="tab">Descripcion</a></li>
            <li><a href="#localizacion2" tabindex="-1" data-toggle="tab">Localizacion</a></li>
            <li><a href="#servicios2" tabindex="-1" data-toggle="tab">Servicios</a></li>
          </ul>
        </li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="descripcion">
          <p>1 </p>
        </div>
        <div class="tab-pane fade" id="localizacion">
          <p> 2 </p>
        </div>
        <div class="tab-pane fade" id="servicios">
          <p> 2 </p>
        </div>
        <div class="tab-pane fade" id="descripcion2">
          <p>4 </p>
        </div>
        <div class="tab-pane fade" id="localizacion2">
          <p> 5 </p>
        </div>
        <div class="tab-pane fade" id="servicios2">
          <p> 6 </p>
        </div>
      </div>
    </div>