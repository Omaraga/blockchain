
function createInput(rebus, signs){
    var input = '';
    for (var i = 0; i < rebus.length; i++){
        var isLast = rebus.length-2 === i ? true : false;
        input += '<input type="text" class="form-control" value="'+rebus[i]+'">' +
            ((rebus.length - 1 > i) ?'<input type="hidden" class="form-control" value="'+signs[i][0]+'">':'') +
            '<br>' + (isLast ? '<hr>':'');
    }
    $('#rebus-inp').html(input);
}

function updateInput(items){
    var input = '';
    for (var i = 0; i < items.length; i++){
        var isLast = items.length-2 === i ? true : false;
        input += ((items[i] !== '+' && items[i] !== '-' && items[i] !== '*' && items[i] !== '/' && items[i] !== '=')
                ? '<input type="text" class="form-control" value="'+items[i]+'">'
                : '<input type="hidden" class="form-control" value="'+items[i]+'">') +

            '<br>' + (isLast ? '<hr>':'');
    }
    $('#rebus-inp').html(input);
}
function setInput(){
    var result = [];
    $('#rebus-inp').find('input').each(function (e){
        result.push($(this).val());
    });
    $('#question').val(JSON.stringify(result));

}
$('#rebus-ok').click(function (e){
    e.preventDefault();
    var rightRebus = $('#rebus-right').val();
    var rebus = rightRebus.split(/[-,+,*,/,=]/);

    var signs = [...rightRebus.matchAll(/[-,+,*,/,=]/g)];

    createInput(rebus, signs);
    setInput();
    $('#rebus-inp input').keyup(function (e){
        setInput();
    });
});

$(document).ready(function (){
    var rightRebus = $('#question').val();
    if (rightRebus.length > 0){
        var rebus = JSON.parse(rightRebus);
        updateInput(rebus);
        $('#rebus-inp input').keyup(function (e){
            setInput();
        });
    }

});