function get_child_function(t){return function(){var n=t.attr("id"),e=t.data("url"),a=t.data("result"),i=t.data("response"),l=t.data("res_type"),s=t.data("lang"),o=$(this).val();$("#"+a).removeClass("d-none"),start_load(a),$.post(e,{name:n,value:o,response:i,response_type:l,lang:s}).done(function(t){$("#"+a).html(t),""==t&&$(".lastChild select").remove()},function(){$(".getChild").each(function(){$(this).get_child()})})}}function start_load(t){$("#"+t).html('<i class="fas fa-spinner fa-spin"></i>')}$.fn.get_child=function(){$th=$(this),$e=$th.find("select[name],input[name],textarea[name]"),$e.length>0&&$e.change(get_child_function($th))},$(window).on("load",function(){$(".getChild").each(function(){$(this).get_child()})});
