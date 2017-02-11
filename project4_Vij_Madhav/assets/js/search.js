function func(obj,stocks)
     {   
      var href = obj.href;
      var isbn = obj.className.split(' ')[3];
      var quantity = document.getElementById(isbn).value;
      var link = href+"&isbn="+isbn+"&quantity="+quantity;
      if(checkQuant(stocks)){
      	window.location.href = link;
      	}
      else
      	event.preventDefault();
     return false;
    }   
   

function checkQuant(stocks){
	var quant = document.getElementsByName('quantity')[0];
	var quantity1 = quant.value;

	if(quantity1>stocks){
		var msg = "<div style='padding:2px; display:inline-block;' class='alert alert-danger' role='alert'>"+
		"<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"+
		"Please Do not choose more than stocks left</div>";
		document.getElementById("quant_err").innerHTML = msg;
		quant.focus();  
		return false;
	}
	else if (quantity1=="" || quantity1=="0" || quantity1 <0 ) {
		var msg = "<div style='padding:2px; display:inline-block;' class='alert alert-danger' role='alert'>"+
		"<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span>"+
		"Quantity Cannot Be Empty</div>";
		document.getElementById("quant_err").innerHTML = msg;
		quant.focus();  
		return false;
	}
	else{
		var msg = "";
		document.getElementById("quant_err").innerHTML = msg;
		return true;
	}
}