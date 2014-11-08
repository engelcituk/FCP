<div id="menu-5" class="about content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
           <form action="#" method="POST" role="form">
           <div class="login-form">
            	<legend>Contacto</legend>
            	<div class="form-group">
              		<input type="text" class="form-control login-field" value="" placeholder="Enter your name"/>
             	 	<label class="login-field-icon usuario" for="login-name"></label>
            	</div>
              	<div class="form-group">
              		<input type="text" class="form-control login-field" value="" placeholder="Enter your mail"/>
             	 	<label class="login-field-icon candado" for="login-name"></label>
            	</div>
            	<div class="form-group">
              		<textarea class="form-control" rows="3"></textarea>
                  <label class="login-field-icon escribir" ></label>
            	</div>
				<button class="btn btn-primary">Submit</button>
            </div>
            </form> 
        </div>
    </div> <!-- /.col-md-12 -->  
   </div> <!-- /.row -->
</div> <!-- /.about -->

<!-- if (isSet($_SESSION['usuario'])) {
          echo '
          <form action="subPagina.php?tid='.$_GET['tid'].'" method="POST"
            <div class="login-form">
              <legend>Suscribirse al tema de conversacion</legend>
                <input class="form-cont" type="email" name="email" placeholder="usuario@mail.com"/>
                <label class="ogin-field-icon escribir"></label>
                <input type="submit" name="suscribe" value="Subscribe" require/>
            </div>
          </form>
          <!-- inicio  de seccion para suscribirse al tema de conversacion --> 
          <!-- ';
          } --> 