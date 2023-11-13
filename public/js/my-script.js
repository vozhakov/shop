// подкачка поддиректорий в форму добавления товаров
$(".categories-admin").change(function(){
let id = $(".categories-admin").val();
	if(id == 0) {}

$.ajax({
type: "POST",
url: "/lib/adminAjax.php",
data: {id: id},

success: function(data){
$('.subcategories-admin').html(data);
//$('#tt').html(data);
},

error: function(){
alert('Ошибка!');
}

}); // $.ajax
});

// очистка полей в форме добавления товаров
$('#reset-add-product').on('click', function() {
$('.clear-js').attr('value', '');
$('.cleartxt-js').text('');
});


