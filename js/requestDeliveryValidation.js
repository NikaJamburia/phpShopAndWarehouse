document.getElementById('producerSelect').addEventListener('change', function(){

    productSelect = document.getElementById('productSelect');
    placeholder = document.getElementById('productSelectPlaceHolder');

    producer_id = document.getElementById('producerSelect').value;
    var params = "producer_id="+producer_id;

    xhr = new XMLHttpRequest();
    xhr.open("POST", '../../functions/ajax/readProducersProducts.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.status == 200){
            var productNames = JSON.parse(this.responseText);

            productSelect.innerHTML = "";
            output = "<option value='' id='productSelectPlaceHolder' disabled selected>Product Name...</option>";
           
            for(row in productNames){
                output += "<option value='"+productNames[row].id+"'>"+productNames[row].name+"</option>"
            }

            productSelect.removeAttribute('disabled');

            productSelect.innerHTML += output;

        }
    }
    xhr.send(params);
});

document.getElementById('submitBtn').addEventListener('click', function(e){
    e.preventDefault();

    producerSelect = document.getElementById('producerSelect');
    productSelect = document.getElementById('productSelect');
    amountInp = document.getElementById('amount');

    producerSelect.classList.remove('border-danger');
    productSelect.classList.remove('border-danger');
    amountInp.classList.remove('border-danger');
    document.getElementById('producerError').innerHTML = "";
    document.getElementById('productError').innerHTML = "";
    document.getElementById('amountError').innerHTML = "";

    errors = false;


    if(producerSelect.value == ""){
        errors = true;

        producerSelect.classList.add('border-danger');
        document.getElementById('producerError').innerHTML = "Choose a producer";
    }

    if(productSelect.value == ""){
        errors = true;

        productSelect.classList.add('border-danger');
        document.getElementById('productError').innerHTML = "Choose a product";
    }

    if(amountInp.value == ""){
        errors = true;

        amountInp.classList.add('border-danger');
        document.getElementById('amountError').innerHTML = "Amount must be greater that 0";
    }

    if(!errors){
        document.getElementById('form').submit();
    }
});