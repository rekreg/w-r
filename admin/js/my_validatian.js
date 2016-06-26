/////////// Валидайшен
 
  // Комнаты  
 $('#rooms').change(function(){
       // if($(this).val() !== null) {
           if($(this).val()=='default'){
    //alert('Please, choose an option');
    //return false;
} else {
    
    
    
    $(this).parents("div.form-group").children("label").html("<i class='fa fa-check-square-o' aria-hidden='true'></i> Комнат");
     //$("#rooms_label").css("color", "green"); 
    
    $(this).parents("div.form-group").addClass("has-success");
    $(this).selectpicker('setStyle', 'btn-success');
   
}
         
            
      //  }
      
    });     
      
     
 

function empty_m2(id, label_name) {
      
$(id).blur(function(){

// Важные переменные    
var form_group = $(this).parents("div.form-group");    

var label = $(this).parents("div.form-group").children("label");    

var help_block = $(this).parents("div.form-group").find("div.help_block");  

var ban_icon = "<i class='fa fa-ban' aria-hidden='true'></i> " + label_name;
    
var success_icon = "<i class='fa fa-check-square-o' aria-hidden='true'></i> " + label_name;
    
// Если поле пустое
 if($(this).val()==''){
label.html(ban_icon);
form_group.removeClass("has-success");
form_group.addClass("has-error");
help_block.html("необходимо заполнить");      
} 

// Если все Ок
    else {
    label.html(success_icon);
    form_group.addClass("has-success");
    form_group.removeClass("has-error");
    help_block.html("");
}
         
    });     
      
}
      
function empty_floors() {

 
$("#floor, #floors").blur(function(){
  
// Важные переменные
var label_name = "Этаж / Этажность";    
    
var form_group = $(this).parents("div.form-group");    

var label = $(this).parents("div.form-group").children("label");    

var help_block = $(this).parents("div.form-group").find("div.help_block");  

var ban_icon = "<i class='fa fa-ban' aria-hidden='true'></i> " + label_name;
    
var success_icon = "<i class='fa fa-check-square-o' aria-hidden='true'></i> " + label_name;        
    
    
    
    
    
    
    
// Если поле пустое
 if($("#floor").val() !== '' && $("#floors").val() !== ''){
label.html(success_icon);
    form_group.addClass("has-success");
    form_group.removeClass("has-error");
    help_block.html("");    
} else {
    

label.html(ban_icon);
form_group.removeClass("has-success");
form_group.addClass("has-error");
help_block.html("необходимо заполнить этаж и этажность");




} 


         
    });     
      
}     
      
      

empty_m2("#m2_o", "Общая площадь");
empty_m2("#m2_g", "Жилая площадь");
empty_m2("#m2_k", "Площадь кухни");
empty_floors();


