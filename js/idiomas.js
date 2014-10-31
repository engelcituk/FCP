//usamos ajax
function nuevoAjax()
{
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objeto AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }
 
	return xmlhttp;
}
 
//creamos la funcion que toma el idioma elegido
function cambio_idioma(){
    var idioma=document.getElementById("select_idioma").value;
    var ajax=nuevoAjax();
    ajax.open("GET", "cambia_idioma.php?idioma="+idioma, true);
    ajax.onreadystatechange=function(){
        if (ajax.readyState==4){
            document.location.href = document.location.href;
        }
    }
    ajax.send(null);
}