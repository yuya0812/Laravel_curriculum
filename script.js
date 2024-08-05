// ヒント
//  「2-B_jQuery基礎知識.pdf」p20
// キーワード
//  「jQuery　input要素　値取得」

$(function(){
    // ここに処理を記述
    $("#button").click( function(){
        alert($('#value').val());
    });
});