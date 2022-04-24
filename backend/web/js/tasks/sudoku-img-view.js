function setTableVal(){
    var size = parseInt($('#sudoku-size').val());
    var str = $('#question').val();
    var url = $('#answerUrl').data('url');

    if (str != null && str !== ''){
        var question = JSON.parse(str);
        $(question).each(function (index){
            var tmp = $('#sudoku-table').find("td[data-adr='"+this.adr+"']").find('.sudoku-check');

            if (this.value == 1){
                $(tmp).prop('checked',true);
            }else{
                $(tmp).prop('checked', false);
            }
        })
    }

    var strAns = $('#answer').val();
    var img = $('#answerUrl').val();
    if (strAns != null && strAns !== ''){
        var answer = JSON.parse(strAns);
        var images = JSON.parse(img);
        $(answer).each(function (index){
            var tmp = $('#sudoku-table').find("td[data-adr='"+this.adr+"']").find('.sudoku-img').attr({'src':url+images[this.value]});
        })
    }
}



function createTable(size){

    var html = '<table style="width:100%">';
    for (var i = 0; i < size; i ++){
        html+='<tr>';
        for (var j = 0; j < size; j++){
            html+='<td ' +'data-adr="'+i+'-'+j+'">'+
                '<input type="checkbox" class="sudoku-check" checked> <br>'+
                '<img src="" alt="" class="sudoku-img" style="max-height: 70px;">'+
                '</td>';
        }
        html+='</tr>';
    }
    html+='</table>';
    $("#sudoku-table").html(html);
    var width = parseInt($('#sudoku-table').width());

    $(".sudoku-inp").css({'min-height': width/size+'px'});


}


$('#sudoku-create').click(function (e){
    e.preventDefault();
    var size = parseInt($('#sudoku-size').val());
    createTable(size);
    setTableVal();
});
$(document).ready(function (){
    var questionVal = $('#question').val();
    if (questionVal != null && questionVal !== ''){
        var arr = JSON.parse(questionVal);
        $('#sudoku-size').val(Math.sqrt(arr.length));

    }
    var size = parseInt($('#sudoku-size').val());
    if (size > 0){
        createTable(size);
    }

    setTableVal();
});



