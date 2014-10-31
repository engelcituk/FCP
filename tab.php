
<link rel="stylesheet" href="css/bootstrap.css">
<script src="js/jquery-1.10.1.min.js"></script>
<script src="js/bootstrap.js"></script><!-- Tabs
  ================================================== -->
  <div class="container bs-example bs-example-tabs">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
        <li><a href="#description" data-toggle="tab">Descripcion</a></li>
      </ul>

      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="home">
          <!-- Aqui va el contenido que serán subtabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#home2" data-toggle="tab">Home</a></li>
              <li><a href="#des" data-toggle="tab">Descripcion</a></li>
            </ul> 
          <!-- fin de home -->
          <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home2">
            LOLOOO lorem
            </div>
            <div class="tab-pane fade" id="des">
            descripcion
            </div>
          </div>
            
        </div>
        <div class="tab-pane fade" id="description">
          description
        </div>
      </div>
  </div><!-- /example -->