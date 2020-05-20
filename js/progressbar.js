$(document).ready(function(){

    const steps = $('div.steps');
    const stepBar = $('.step-bar');

    $('#next').click(function(){
        
        steps.find('li.activated')
            .next('li')
            .addClass('activated');

        if (stepBar.attr('id') == 'first') {
            stepBar.attr('id', 'second')
        } else if (stepBar.attr('id') == 'second') {
            stepBar.attr('id', 'third')
        }
    });

    $('#prev').click(function(){
        steps
            .find('li.activated')
            .removeClass('activated')
            .prev()
            .addClass('activated');

        if (stepBar.attr('id') == 'third') {
            stepBar.attr('id', 'second')
        } else if (stepBar.attr('id') == 'second') {
            stepBar.attr('id', 'first')
        }
    });

 });