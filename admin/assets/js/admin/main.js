$(document).ready(function(){    
    initTables();    
    init();
    
    $(".btn-close").click(function (b) {
        b.preventDefault();
        $(this).parent().parent().parent().fadeOut()
    });
    $(".btn-minimize").click(function (c) {
        c.preventDefault();
        var b = $(this).parent().parent().next(".box-content");
        if (b.is(":visible")) {
            $("i", $(this)).removeClass("icon-chevron-up").addClass("icon-chevron-down")
        } else {
            $("i", $(this)).removeClass("icon-chevron-down").addClass("icon-chevron-up")
        }
        b.slideToggle()
    });
});
function exists(el) {
    return ($(el).length > 0) ? true : false;
}

$(window).bind("resize", widthFunctions);

function widthFunctions(c) {
    var b = $(window).height();
    var a = $(window).width();
    if (a < 980 && a > 767) {
        if ($(".main-menu-span").hasClass("span2")) {
            $(".main-menu-span").removeClass("span2");
            $(".main-menu-span").addClass("span1")
        }
        if ($(".brand").hasClass("span2")) {
            $(".brand").removeClass("span2");
            $(".brand").addClass("span1")
        }
        if ($("#content").hasClass("span10")) {
            $("#content").removeClass("span10");
            $("#content").addClass("span11")
        }
        $("a").each(function () {
            if ($(this).hasClass("quick-button-small span1")) {
                $(this).removeClass("quick-button-small span1");
                $(this).addClass("quick-button span2 changed")
            }
        });
        $(".circleStatsItem, .circleStatsItemBox").each(function () {
            var d = $(this).parent().attr("onTablet");
            var e = $(this).parent().attr("onDesktop");
            if (d) {
                $(this).parent().removeClass(e);
                $(this).parent().addClass(d)
            }
        });
        $(".tempStatBox").each(function () {
            var d = $(this).attr("onTablet");
            var e = $(this).attr("onDesktop");
            if (d) {
                $(this).removeClass(e);
                $(this).addClass(d)
            }
        });
        $("div").each(function () {
            var d = $(this).attr("onTablet");
            var e = $(this).attr("onDesktop");
            if (d) {
                $(this).removeClass(e);
                $(this).addClass(d)
            }
        })
    } else {
        if ($(".main-menu-span").hasClass("span1")) {
            $(".main-menu-span").removeClass("span1");
            $(".main-menu-span").addClass("span2")
        }
        if ($(".brand").hasClass("span1")) {
            $(".brand").removeClass("span1");
            $(".brand").addClass("span2")
        }
        if ($("#content").hasClass("span11")) {
            $("#content").removeClass("span11");
            $("#content").addClass("span10")
        }
        $("a").each(function () {
            if ($(this).hasClass("quick-button span2 changed")) {
                $(this).removeClass("quick-button span2 changed");
                $(this).addClass("quick-button-small span1")
            }
        });
        $(".circleStatsItem, .circleStatsItemBox").each(function () {
            var d = $(this).parent().attr("onTablet");
            var e = $(this).parent().attr("onDesktop");
            if (d) {
                $(this).parent().removeClass(d);
                $(this).parent().addClass(e)
            }
        });
        $(".tempStatBox").each(function () {
            var d = $(this).attr("onTablet");
            var e = $(this).attr("onDesktop");
            if (d) {
                $(this).removeClass(d);
                $(this).addClass(e)
            }
        });
        $("div").each(function () {
            var d = $(this).attr("onTablet");
            var e = $(this).attr("onDesktop");
            if (d) {
                $(this).removeClass(d);
                $(this).addClass(e)
            }
        });
        $(".widget").each(function () {
            var d = $(this).attr("onTablet");
            var e = $(this).attr("onDesktop");
            if (d) {
                $(this).removeClass(d);
                $(this).addClass(e)
            }
        })
    } if ($(".timeline")) {
        $(".timeslot").each(function () {
            var d = $(this).find(".task").outerHeight();
            $(this).css("height", d)
        })
    }
};

jQuery(document).ready(function (a) {
    a("ul.main-menu li a").each(function () {
        if (a(a(this))[0].href == String(window.location)) {
            a(this).parent().addClass("active")
        }
    });
    a("ul.main-menu li ul li a").each(function () {
        if (a(a(this))[0].href == String(window.location)) {
            a(this).parent().addClass("active");
            a(this).parent().parent().show()
        }
    });    
    a(".dropmenu").click(function (b) {
        b.preventDefault();
        a(this).parent().find("ul").slideToggle()
    })
});

jQuery(document).ready(function (b) {
    var a = true;
    b("#main-menu-toggle").click(function () {
        if (b(this).hasClass("open")) {
            b(this).removeClass("open").addClass("close");
            var f = b("#content").attr("class");
            var e = parseInt(f.replace(/^\D+/g, ""));
            var c = e + 2;
            var d = "span" + c;
            b("#content").addClass("full");
            b(".brand").addClass("noBg");
            b("#sidebar-left").hide()
        } else {
            b(this).removeClass("close").addClass("open");
            var f = b("#content").attr("class");
            var e = parseInt(f.replace(/^\D+/g, ""));
            var c = e - 2;
            var d = "span" + c;
            b("#content").removeClass("full");
            b(".brand").removeClass("noBg");
            b("#sidebar-left").show()
        }
    })
});


function init(){
    if(typeof Shadowbox != 'undefined'){
        Shadowbox.init({players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv']});
    }
    init_tabs();
    
    if(exists(('.datepicker'))) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'es'
            });
    }
    if(exists(('.timepicker'))){
        $('.timepicker').timepicker({
            minuteStep: 5,
            showMeridian: false,
            showSeconds: true,        
            });
    }
    $("a.ax-modal" ).live('click',function(event) {
        event.preventDefault();
        var url = $(this).attr('href');        
        frm_send('none',url,'abc');
        });
    if(exists(('#fullcalendar'))) {
        fullCalendar();
    }
    init_tooltips();
    init_upload_manager();
    /*
    $('.j-enter').each(function(index) {
		$(this).keypress(function(event) {
			if (event.which == 13) {
				var onEnter = $(this).attr("data-onenter")
				$("#" + onEnter).click();
			}
		});
	});
    */
}
function shadowbox_open(file, ext){
    var options = {continuous: true, counterType: "skip"};
    switch(ext){
        case "jpg":
        case "gif":
        case "png":
            player = "img"
            break;
        case "flv":
            player = "flv"
            break;
        case "doc":
        case "docx":
        case "xls":
        case "txt":
            window.open(file)
            break;
        default:
            player = "iframe"
        break;
    }
    var img1 = {
        player:     player,
        content:    file,
        options:    options
    };
    Shadowbox.open([img1]);
}
function init_tabs(){   
    
    $("#jLangs a").each(function(index){
        var dataLang = $(this).attr('data-lang');
        if(dataLang ==_base_lang){
            $(this).removeClass('btn-inverse').addClass('active btn-primary');
        } else if(dataLang != _base_lang){           
            $("[name*=_"+dataLang+"]").each(function(){
                $(this).css('display','none');
            })
        }
    });
    init_tabs_panel();
}
function init_tabs_panel(){
    $("#jLangs a").live('click',function(){
       var setLang = $(this).attr('data-lang');      
        $("#jLangs a").each(function(index){
            var dataLang = $(this).attr('data-lang');
            if(dataLang != setLang){                
                $(this).removeClass('active btn-primary').addClass('btn-inverse');
                $("[name*=_"+dataLang+"]").each(function(){
                    $(this).css('display','none');
                })
            } 
            if(dataLang == setLang){               
                $(this).removeClass('btn-inverse').addClass('active btn-primary');
                $("[name*=_"+setLang+"]").each(function(){                    
                    $(this).css('display','block');
                })
            }
        }) 
    });
}


function initTables(){
    
    if(exists(('.jData-table'))){
       listTables = $('.jData-table').dataTable({    		
            "oLanguage": {
    			"sUrl": _base_url+"assets/widgets/tables/language/sp_ES.txt"
    		},
            "bSort" : false,
    		"sPaginationType": "bootstrap",
            "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span12'i><'span12 center'p>>",
                		
            "fnInitComplete": function (){     
                $(listTables.fnGetNodes()).mouseover(function(){
                    id = $(this).attr('id');
                    _id = $(this).attr('id').split("-").pop();
                })
            }
    	});
    }
    
    if(exists(('.jData-table-dashboard'))){
        $('.jData-table-dashboard').dataTable({
    		"bJQueryUI": true,
            "oLanguage": {
    			"sUrl": _base_url+"assets/widgets/tables/language/sp_ES.txt"
    		},
    		"sDom": 't',
    	});
    }
    
}






/* FORM FUNCTIONS */
function validateLoginForm(form) {
    
    if(typeof form == "string") e = $('#'+form);
    var validate = e.validate({       
        debug: true,
        submitHandler: function () {
            frm_send($('#' + form));
        },
        errorPlacement: function(error, element) {
            error.prependTo('#jAppendFormErrors');
        },
        errorLabelContainer: $("#jAppendFormErrors ul"),
        onblur: false,
        onkeyup: false,
        onsubmit: true,
        wrapper: "li",
        showErrors: function() {
            this.defaultShowErrors();
        },
        rules: {
            user:{            
                required: true,
                email: true
            },
        },
        messages: {
            user: {
                required: "Ingrese su usuario"
            },
            password: {
                required: "Ingrese su password"
            }
        }
    });
    $("#jAppendFormErrors ul").addClass('alert alert-error')
}
function validateForm(form) {
    if(typeof form == "string") e = $('#'+form);
    if($("select[id*=right]")){
        $("select[id*=right]").each(function(n,el){
            var id = $(el).attr('id');
            $('#'+id+' option').each(function(n,ele){
              $(ele).attr('selected','selected');  
            })
        })
    }
    var validate = e.validate({       
        debug: true,
        submitHandler: function () {
            frm_send($('#' + form));
        },
        errorClass: "help-inline",
		errorElement: "span",
        onblur: false,
        onkeyup: false,
        onsubmit: true,  
        rules: {
            password: {
                required: true,
                minlength: 7
            },
            valid_password:{            
                required: true,
                equalTo: "#password",
                minlength: 7
            },
        },
        highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
    });
}
function clear_form_elements() {
    $()
    $(window).find(':input').each(function() {
        alert('this');
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}
var _frm_progress = false;
function frm_send(form, ajaxUrl, ajaxId, extraData) {
    if(form=="none"){
        if(ajaxUrl==undefined || ajaxId==undefined)  { _exception.show(102, "frm_send"); return false;}
        var form = $("<form/>", {"id" : "frm"+ajaxId, "action":ajaxUrl});
    }
    if(extraData==undefined)
        extraData = new Array();
    if (!exists(form) && form != "none") {
        _exception.show(102, "frm_send");
        return false;
    }
    if (_frm_progress) {
        _exception.show(105, "frm_send");
        return false;
    }
    if (extraData.length > 0)
        extraData = "&" + extraData.join("&")
    _frm_progress = true
    $.ajax({
        type : 'POST',
        url  : form.attr('action'),
        data : form.serialize() + extraData,
        success : function(data) {
            _frm_progress = false;
            data = frm_jsonDecode(data)
            
            console.log(data)
            switch(data.success) {
                case "true":
                case true:
                case 1:
                case "1":
                    $('#'+form.attr('id')).reset();
                break;
                case "false":
                case false:
                case 0:
                break;
                case "error":
                case "-1":                    
                break;
                default:
                    _exception.show(103, form.attr("id"));
                    return false;
                break;
            }
            switch(data.responseType) {
                case "function":
                    if (data.value == "") {
                        _exception.show(106, form.attr("id"));
                    }
                    var fn = data.value
                    if (window[fn] != undefined) {
                        eval(fn)(data)
                    } else {
                        _exception.show(108, fn);
                    }
                break;
                case "redirect":
                    if (data.value == "") {
                        _exception.show(106, form.attr("id"));
                    }
                       window.location.href = data.value
                break;
                default:
                    _exception.show(104, form.attr("id"));
                break;
            }
        },
        error : function(data) {
            _frm_progress = false;
            console.log('Error Procesando Formulario '+form.attr("id"));
        }
    })
}
function frm_jsonDecode(data) {
	try {
		data = jQuery.parseJSON(data);
	} catch(err) {
		_exception.show(107, err);
		data = '{"success":"error"}';
		data = jQuery.parseJSON(data);
	}
	return data
}
$.fn.reset = function () {
  $(this).each (function() { this.reset(); });
}
function appendFormMessages(data){
    if(exists(('#jAppendFormErrors'))) {  
        $("#jAppendFormErrors").css('display','block');
        $("#jAppendFormErrors ul").css('display','block').html(data.messages);
    } else {
        console.log('TODO - SI EL ELEMENTO NO EXISTE');
        console.log(data)    
    }
}
function getOpcionesMedicasExtras(val){
        var id  = $('input[name=caballo_id]').val();        
        var url = _base_url+'fichas/setOpcionesMedicas/op/'+val+'/id/'+id
        frm_send('none',url,'fichaMedica');
}
function appendAccionesMedicasExtras(data){
    if(exists(('.jAccionesMedicasExtras'))) {
        $('.jAccionesMedicasExtras').remove();
    }
    $('#jAccionesMedicas').after(data.html);
}
function enableExtraFecha(val){
    if(val=='+n'){
        $('.setFechaMedica').removeAttr('disabled');
    } else {
        $('.setFechaMedica').val('').attr('disabled','disabled');
    };
}
function open_modal(data){    
    var dialog = $("#modal");
    if(!exists(('#modal'))) {    
        dialog = $('<div id="modal" class="modal fade" style="display:hidden"></div>').appendTo('body');
    } 
    dialog.html(data.html).modal();
}
function setActiveMenu(){
}
function setLocalStorage(key,val){
    localStorage.setItem(key,val);
}
function removeLocalStorage(key){
    localStorage.removeItem(key);
}
function change_select_multi_transfer(left,right){
    $("#"+left+" option:selected").remove().appendTo('#'+right);
}
function init_upload_manager(){
    $("[id^='upload_manager']").each(function(n,el){        
        var id   = $(el).attr('id')        
        var json = $(el).html()
        var flashvars = frm_jsonDecode(json);
        var params = {
        		menu: "false",
        		scale: "noScale",
        		allowFullscreen: "true",
        		allowScriptAccess: "always",
        		bgcolor: "#F9F9F9"
        	};
         var attributes = {
        		id:"uploadManager"
        	};
         swfobject.embedSWF(_base_url+"/assets/widgets/uploadManager/uploadManager.swf", id, "400", "25", "9.0.0", "expressInstall.swf", flashvars, params, attributes);
        })
}
function resize_images(id){
    console.log(id)
    var ajax = new Request({
         method: 'post',
		 url:    _base_url+"/assets/widgets/uploadManager/UploadManager.php?a=resize&id="+id,
		 onRequest: function(){},
         onSuccess: function(data){},
         onFailure: function(){alert('Conection error (error: axri-101).');} 
      }).send();
}

function cloneUpload(folder,env, pie){
    var pos = $('#uploadGroup #uploadManager').length
    var pie = (pie=='pie') ? 1 : 0;
    var url = _base_url+'institucional/getUploads/folder/'+folder+'/pos/'+pos+'/env/'+env+'/pie/'+pie
    frm_send('none',url,'cloneUpload');
}

function appendUploadElement(data){
    $('#uploadGroup .controls').append(data.html);
    var active_lang = $("#jLangs a.active").attr('data-lang');
    
   $("#jLangs a").each(function(index){
            var dataLang = $(this).attr('data-lang');
            if(dataLang != active_lang){
                $("[name*=_"+dataLang+"]").each(function(){
                    $(this).css('display','none');
                })
            } 
            if(dataLang == active_lang){               
                
                $("[name*=_"+active_lang+"]").each(function(){                    
                    $(this).css('display','block');
                })
            }
        })
    
    
    init_upload_manager();
}
function fullCalendar(){
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    $('#fullcalendar').fullCalendar({
        monthNames:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab', 'Dom'],
        header: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar !!!
        eventSources: [{
            url: _base_url+'dashboard/getCalendar',
            type: 'POST',
            error: function() {
                alert('there was an error while fetching events!');
            },                        
            textColor: 'withe' // a non-ajax option
            }],            
    });
}

function init_tooltips(){
    $('.tip').tooltip();	
	$('.tip-left').tooltip({ placement: 'left' });	
	$('.tip-right').tooltip({ placement: 'right' });	
	$('.tip-top').tooltip({ placement: 'top' });	
	$('.tip-bottom').tooltip({ placement: 'bottom' });
}
/* REUTILIZAR FORMS FUNCITONS SEND */
/*
    if(form=="none"){
    if(ajaxUrl==undefined || ajaxId==undefined)  { _exception.show(102, "frm_send"); return false;}
    var form = $("<form/>", {"id" : "frm"+ajaxId, "action":ajaxUrl});
    }
    switch(form.attr("id")) {
    case "frmFilter":
    _hash_arr = new Array();
    frm_setHash("search", form, false);
    break;
    case "frmnewa":
    hash_set("act/new", false);
    break;
    case "frmupdate":
    var frmupdate_id = ajaxUrl.split("/").pop();
    hash_set("act/update/" + frmupdate_id, false);
    break;
    }
    */
 /*
    case "back":
    page_back();
    break;
    case "redirect":
    if (data.value == "") {
    _exception.show(106, form.attr("id"));
    }
    window.location.href = data.value
    break;
    case "alert":
    if (data.value == "") {
    _exception.show(106, form.attr("id"));
    }
    alert(data.value)
    break;
    case "inject":
    if (data.value == "") {
    _exception.show(106, form.attr("id"));
    }
    var target = (data.inject != undefined) ? $("." + data.inject) : form.find(".x-msg")
    target.html(data.value.html)
    switch(data.injectType) {
    case "error":
    target.css("display", "block");
    target.effect("shake", {
    times : 3,
    distance : 3
    }, 70);
    break;
    default:
    frm_onInject()
    break;
    }
    break;
    */
 /*** MODALS ***/
/*
function init_modal() {
    $().modal({
        overlayClose: true,
        onOpen: function (dialog) {
        	dialog.overlay.fadeIn('slow', function () {
        		dialog.container.slideDown('slow', function () {
        			dialog.data.fadeIn('slow');
        		});
        	});
        }
    });
}
function showConfirm(data){
    init_modal();
    $(".simplemodal-wrap").html(data.msg);
} */