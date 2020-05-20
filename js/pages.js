$(document).ready(function(){

    const nextBtn = $('#next');
    const prevBtn = $('#prev');

    nextBtn.click(function(){
        $('section.active')
        .removeClass('active')
        .next('section')
        .addClass('active');
        
        if ($('section.active').attr('id') == 'result-section') {
            nextBtn.attr('class', 'active').attr('class', 'inative');
            submitForm();
        }

        if ($('form').find('#prev').attr('class') == 'inative') {
            prevBtn.attr('class', 'ative');
        }
    });

    prevBtn.click(function(){
        $('form')
        .find('section.active')
        .removeClass('active')
        .prev()
        .addClass('active');

        if (nextBtn.attr('class') == 'inative') {
            nextBtn.attr('class', 'active');
        }

        if ($('form').find('section.active').attr('id') == 'send-section') {
            prevBtn.attr('class', 'active').attr('class', 'inative');
        } 
    });

    function submitForm() {
        const zipCode       = $('#zipCode')[0].value;
        const zipCodeDest   = $('#zipCodeDest')[0].value;
        const sendType      = $('#sendType')[0].value;
        const price         = $('#price')[0].value;
        const weight        = $('#weight')[0].value;
        const width         = $('#width')[0].value;
        const height        = $('#height')[0].value;
        const lenght        = $('#lenght')[0].value;

        $.ajax({
            method:'post',
            url: `http://localhost/api-correios/calculate.php?zipCode=${zipCode}&zipCodeDest=${zipCodeDest}&sendType=${sendType}&price=${price}&weight=${weight}&lenght=${lenght}&width=${width}&height=${height}`,
            async: true,
            dataType:'json',
            success: function (arr) {
                const sendType = arr[0];
                const price = arr[1][0];

                $('#result1').text(zipCode)
                $('#result2').text(zipCodeDest)
                $('#result3').text(sendType)
                $('#result4').text(price)
            },
            error: function (responseText) {
                $('#result1').text('Erro');
                $('#result2').text('Erro');
                $('#result3').text('Erro');
                $('#result4').text('Erro');
                console.log(responseText);
            }
        });
    }

 });