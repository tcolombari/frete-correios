function cepMask(element) {
    var input = element;
    var cep = input.value;

    input.setAttribute('maxlength', 8);

    newCep = cep.replace(/(\D)/g, '').replace(/^(\d{5})(\d{3})/, '$1-$2');
    input.value = newCep;
}

function decimalMask(element) {
    var input = element;
    var price = input.value;

    input.setAttribute('maxlength', 10)
    
    var newPrice = 
        (price.replace(/(\D)/g, '') / 100)
        .toFixed(2)
        .replace('.', ',')
        .replace(/(\d)(\d{3})(\d{3}),/g, '$1.$2.$3')
        .replace(/(\d)(\d{3}),/g, '$1.$2,');

    input.value = newPrice;
}

function sizeMask(element) {
    var input = element;
    var value = input.value;

    input.setAttribute('maxlength', 3);

    value = value.replace(/(\D)/g, '');
    input.value = value;
}