$(function() {
   var accordionActive = false;
  
   $(window).on('resize', function() {
       var windowWidth = $(window).width();
       var $topMenu = $('#top-menu');
       var $sideMenu = $('#side-menu');     
       
       if (windowWidth < 768) {
          if ($topMenu.hasClass("active")) {             
            $topMenu.removeClass("active");
            $sideMenu.addClass("active");
            
            var $ddl = $('#top-menu .movable.dropdown');
            $ddl.detach();
            $ddl.removeClass('dropdown');
            $ddl.addClass('nav-header');
            
            $ddl.find('.dropdown-toggle').removeClass('dropdown-toggle').addClass('link');
            $ddl.find('.dropdown-menu').removeClass('dropdown-menu').addClass('submenu');
                        
            $ddl.prependTo($sideMenu.find('.accordion'));
            $('#top-menu #qform').detach().removeClass('navbar-form').prependTo($sideMenu);
            
            if (!accordionActive) {
               var Accordion2 = function(el, multiple) {
                 this.el = el || {};
                 this.multiple = multiple || false;

                  // Variables privadas
                 var links = this.el.find('.movable .link');
                 // Evento
                 links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
                }

              Accordion2.prototype.dropdown = function(e) {
                var $el = e.data.el;
                $this = $(this),
                  $next = $this.next();

                $next.slideToggle();
                $this.parent().toggleClass('open');

                if (!e.data.multiple) {
                  $el.find('.movable .submenu').not($next).slideUp().parent().removeClass('open');
                };
              }    

              var accordion = new Accordion2($('ul.accordion'), false); 
              accordionActive = true;
            }
          }
       }
       else {
          if ($sideMenu.hasClass("active")) {              
            $sideMenu.removeClass('active');
            $topMenu.addClass('active');
            
            var $ddl = $('#side-menu .movable.nav-header');
            $ddl.detach();
            $ddl.removeClass('nav-header');
            $ddl.addClass('dropdown');
            
            $ddl.find('.link').removeClass('link').addClass('dropdown-toggle');
            $ddl.find('.submenu').removeClass('submenu').addClass('dropdown-menu');
            
             $('#side-menu #qform').detach().addClass('navbar-form').appendTo($topMenu.find('.nav'));
            $ddl.appendTo($topMenu.find('.nav'));
          }
       }
   });
  
  /**/
  var $menulink = $('.side-menu-link'),       
      $wrap = $('.wrap');
  
  $menulink.click(function() {    
    $menulink.toggleClass('active');
    $wrap.toggleClass('active');    
    return false;
  });
  
  /*Accordion*/
  var Accordion = function(el, multiple) {
    this.el = el || {};
    this.multiple = multiple || false;

    // Variables privadas
    var links = this.el.find('.link');
    // Evento
    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
  }

  Accordion.prototype.dropdown = function(e) {
     var $el = e.data.el;
     $this = $(this),
      $next = $this.next();

    $next.slideToggle();
    $this.parent().toggleClass('open');

    if (!e.data.multiple) {
      $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
    };
  }	

  var accordion = new Accordion($('ul.accordion'), false); 
  
  
});

function search() {
  var input, filter, found, table, tr, td, i, j;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
		if (td) {
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            tr[i].style.display = "none";
        }
		}
    }
}

$('#optionTrue').button('toggle');

$(document).on("click", ".open-EditMaterielDialog", function () {
	var id = $(this).data('id');
	var name = $(this).data('nom');
	var stock = $(this).data('qte-stock');
	var seuil = $(this).data('qte-min');
	var cmd = $(this).data('commandé');
	$(".modal-body #materiel_id").val( id );
	$(".modal-body #materiel_nom").val( name );
	$(".modal-body #quantite_restante").val( stock );
	$(".modal-body #seuil_bas").val( seuil );
	$(".modal-body #commandé").val( cmd );
});
	
$(document).on("click", ".open-AddMaterielDialog", function () {
	var id_main = $(this).data('main-id');
	var id = $(this).data('id');
	var name = $(this).data('nom');
	var stock = $(this).data('qte-stock');
	$(".modal-body #appartenir_id").val( id_main );
	$(".modal-body #materiel_id").val( id );
	$(".modal-body #materiel_nom").val( name );
	$(".modal-body #quantite_restante").val( stock );
});

$(document).on("click", ".open-StoryDialog", function () {
	var id = $(this).data('id');
	var name = $(this).data('nom');
	$(".modal-body #materiel_id").val( id );
	$(".modal-body #materiel_nom").val( name );
});

$(document).on("click", ".open-NewLoan", function () {
	var id = $(this).data('materiel-pret-id');
	var name = $(this).data('designation');
	var lastDate = $(this).data('last-date');
	$(".modal-body #materiel_pret_id").val( id );
	$(".modal-body #designation").val( name );
	$(".modal-body #last_date").val( lastDate );
});

//Correspondre à la fenêtre modale #story
$(document).ready(function(){
	$('[data-toggle="modal"]').tooltip(); 
    $(document).on('click', '#getId', function(e){
  
     e.preventDefault();
  
     var NNI = $(this).data('nni'); // get nni of clicked row
     var materiel_id = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content').html(''); // leave this div blank
 
     $.ajax({
          url: 'index.php?controller=membre&action=story',
          type: 'POST',
          data: {'NNI': NNI, 'materiel_id': materiel_id},
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content').html(''); // blank before load.
          $('#dynamic-content').html(data); // load here
     })
     .fail(function(){
          $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
     });

    });
});

//Permettre d'afficher plusieurs fenêtres modales
var modal_lv = 0;
$('.modal').on('shown.bs.modal', function (e) {
    $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
    $(e.currentTarget).css('zIndex',1052+modal_lv);
    modal_lv++
});

$('.modal').on('hidden.bs.modal', function (e) {
    modal_lv--
});

//Correspondre à la fenêtre modale #editCommentDialog
$(document).ready(function(){

    $(document).on('click', '#getComment', function(e){
  
     e.preventDefault();
  
     var appartenir_id = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content-2').html(''); // leave this div blank
 
     $.ajax({
          url: 'index.php?controller=membre&action=editComment',
          type: 'POST',
          data: 'appartenir_id='+appartenir_id,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content-2').html(''); // blank before load.
          $('#dynamic-content-2').html(data); // load here
     })
     .fail(function(){
          $('#dynamic-content-2').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
     });

    });
});

//Correspondre à la fenêtre modale #editMaterielDialog
$(document).ready(function(){

    $(document).on('click', '#getMaterielId', function(e){
  
     e.preventDefault();
  
     var materiel_id = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content-edit').html(''); // leave this div blank
 
     $.ajax({
          url: 'index.php?controller=materiel&action=formModify',
          type: 'POST',
          data: 'materiel_id='+materiel_id,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content-edit').html(''); // blank before load.
          $('#dynamic-content-edit').html(data); // load here
     })
     .fail(function(){
          $('#dynamic-content-edit').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
     });

    });
});

//Le formulaire de créer un nouveau membre dans le formulaire de prêter d'un matériel
function submitForm(){
    var nni = $('#inputNNI').val();
    var surname = $('#inputSurname').val();
    var name = $('#inputName').val();
	
    if(nni.trim() == '' ){
        alert('Entrer le NNI,s\'il vous plaît.');
        $('#inputNNI').focus();
        return false;
    }else if(surname.trim() == '' ){
        alert('Entrer le nom,s\'il vous plaît.');
        $('#inputSurname').focus();
        return false;
    }else if(name.trim() == '' ){
        alert('Entrer le prénom,s\'il vous plaît.');
        $('#inputName').focus();
        return false;
    }else{
        $.ajax({
            type:'POST',
            url:'index.php?controller=materielPret&action=saveNewMember',
            data:'formSubmit=1&nni='+nni+'&surname='+surname+'&name='+name,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
				console.log(msg); 
                if(msg != 'ok'){
                    $('#inputNNI').val('');
                    $('#inputSurname').val('');
                    $('#inputName').val('');
                    $('.statusMsg').html('<div class="alert alert-success" role="alert">Enregistré	<i class="glyphicon glyphicon-ok"></i></div>');
                }else{
                    $('.statusMsg').html('<div class="alert alert-danger" role="alert">Erreur d\'enregistrer	<i class="glyphicon glyphicon-ok"></i></div>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}

//date picker
$(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
})

//show password
function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
}

//hide password
function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
}

var pwShown = 0;
//on utilise sur le bouton de "Id = eye"
document.getElementById("eye").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);

//another function of showing password
//Cette fonction est utilisée dans le formulaire de changer le mot de passe d'utilisateur
function showPassword() {
    var pwd = document.getElementById("newPwd");
    var pwdConfirm = document.getElementById("newPwdConfirm");
    if ((pwd.type == "password") && (pwdConfirm.type == "password")) {
        pwd.type = "text";
        pwdConfirm.type = "text";
    } else {
        pwd.type = "password";
        pwdConfirm.type = "password";
    }
}