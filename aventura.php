<div id="menu-1" class="about content">
                        <div class="row">
                            <ul class="tabs submenu ">
                                <li  class="aventurate col-md-3 col-sm-3 col-xs-6"><a id ="aventura" href="#tab1" title=""><span class="icon"><i aria-hidden="true" class="fa piramide"></i></span><span><?php echo $palabra->idioma[$_SESSION['idioma']][8]; ?><!-- Arqueología --></span></a></li>
                                <li  class="aventurate col-md-3 col-sm-3 col-xs-6"><a id ="aventura" href="#tab2" title=""><span class="icon"><i aria-hidden="true" class="fa flamingo"></i></span><span><?php echo $palabra->idioma[$_SESSION['idioma']][9]; ?><!-- Bellezas Naturales --></span></a></li>
                                <li  class="aventurate col-md-3 col-sm-3 col-xs-6"><a id ="aventura" href="#tab3" title=""><span class="icon"><i aria-hidden="true" class="fa bici"></i></span><span><?php echo $palabra->idioma[$_SESSION['idioma']][10]; ?><!-- Ecoturismo --></span></a></li>
                                <li  class="aventurate col-md-3 col-sm-3 col-xs-6"><a id ="aventura" href="#tab4" title=""><span class="icon"><i aria-hidden="true" class="fa iglesia"></i></span><span><?php echo $palabra->idioma[$_SESSION['idioma']][11]; ?><!-- Pueblos Emblematicos --></span></a></li>
                            </ul> <!-- /.tabs -->
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="toggle-content text-justify" id="tab1">
                                	<?php include "arqueologia.php" ?>
                                    <a class="btn btn-success subir" onclick="$('#menu').animatescroll({scrollSpeed:2000,easing:'easeOutElastic'});">  Subir</a>
                                </div>

                                <div class="toggle-content text-center" id="tab2">
                                    <h3>What We Do</h3>
                                    <p>Donec quis orci nisl. Integer euismod lacus nec risus sollicitudin molestie vel semper turpis. In varius imperdiet enim quis iaculis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris ac mauris aliquam magna molestie posuere in id elit. Integer semper metus felis, fringilla congue elit commodo a. Donec eget rutrum libero.
                                    <br><br>Nunc dui elit, vulputate vitae nunc sed, accumsan condimentum nisl. Vestibulum a dui lectus. Vivamus in justo hendrerit est cursus semper sed id nibh. Donec ut dictum lorem, eu molestie nisi. Quisque vulputate quis leo lobortis fermentum. Ut sit amet consectetur dui, vitae porttitor lectus.</p>
                                </div>

                                <div class="toggle-content text-center" id="tab3">
                                    <h3>Our Team</h3>
                                    <p>Aliquam erat volutpat. Vivamus tempus, nisi varius imperdiet molestie, velit mi feugiat felis, sit amet fringilla mi massa sit amet arcu. Mauris dictum nisl id felis lacinia congue. Aliquam lectus nisi, sodales in lacinia quis, lobortis vel sem. Vestibulum elit nisi, placerat eget auctor ut, dictum at libero.
                                    <br><br>Proin enim odio, eleifend eget euismod vitae, pharetra sed lacus. Donec at sapien nunc. Mauris vehicula quis diam nec dignissim. Nulla consequat nibh mattis metus sodales, at eleifend tortor tempor. Sed auctor lacus felis. </p>
                                </div>
                                <div class="toggle-content text-center" id="tab4">
                                    <h3>Our Team</h3>
                                    <p>Aliquam erat volutpat. Vivamus tempus, nisi varius imperdiet molestie, velit mi feugiat felis, sit amet fringilla mi massa sit amet arcu. Mauris dictum nisl id felis lacinia congue. Aliquam lectus nisi, sodales in lacinia quis, lobortis vel sem. Vestibulum elit nisi, placerat eget auctor ut, dictum at libero.
                                    <br><br>Proin enim odio, eleifend eget euismod vitae, pharetra sed lacus. Donec at sapien nunc. Mauris vehicula quis diam nec dignissim. Nulla consequat nibh mattis metus sodales, at eleifend tortor tempor. Sed auctor lacus felis. </p>
                                </div>
                            </div> <!-- /.col-md-12 -->
                        </div> <!-- /.row -->
                    </div> <!-- /.about -->