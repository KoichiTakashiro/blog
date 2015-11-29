$(function(){
    var setArea = $('.loadArea'),
    btnTxt = 'もっと見る'; // ボタンテキスト
 
    setArea.wrap('<div class="loadWrap"></div>');
    setArea.after('<div class="loadMoreBtn">' + btnTxt + '</div>');
 
    var setWrap = $('.loadWrap');
 
    setWrap.each(function(){
        var setThis = $(this),
        thisLoadArea = setThis.find(setArea),
        loadNum = 5, // 読み込む個数
        loadTxt = 'Loading...', // Loading中の表示テキスト
        fadeSpeed = 500; // フェードスピード
 
        var setMore = setThis.find('.loadMoreBtn');
 
        var setIndex = setWrap.index(this),
        setNum = setIndex + 1;
        setMore.click(function(){
            $.ajax({
                url: 'js/include' + setNum + '.json',
                dataType: 'json',
                cache: false,
                success : function(data){
                    var dataLengh = data.length,
                    loadItemLength = thisLoadArea.find('.loadItem').length,
                    setAdj = (dataLengh)-(loadItemLength),
                    setBeg = (dataLengh)-(setAdj);
                    if(!(dataLengh == loadItemLength)){
                        thisLoadArea.append('<div class="nowLoading">' + loadTxt + '</div>');
                        if(loadItemLength == 0){
                            if(dataLengh <= loadNum){
                                for (var i=0; i<dataLengh; i++) {
                                    $('<div id="item' + setNum + '_' + data[i].itemNum + '" class="loadItem">' + data[i].itemSource + '</div>').appendTo(thisLoadArea).css({opacity:'0'}).animate({opacity:'1'},fadeSpeed);
                                }
                                setMore.remove();
                            } else {
                                for (var i=0; i<loadNum; i++) {
                                    $('<div id="item' + setNum + '_' + data[i].itemNum + '" class="loadItem">' + data[i].itemSource + '</div>').appendTo(thisLoadArea).css({opacity:'0'}).animate({opacity:'1'},fadeSpeed);
                                }
                            }
                        } else if(loadItemLength > 0 && loadItemLength < dataLengh){
                            if(loadNum < setAdj){
                                for (var i=0; i<loadNum; i++) {
                                    v = i+setBeg;
                                    $('<div id="item' + setNum + '_' + data[v].itemNum + '" class="loadItem">' + data[v].itemSource + '</div>').appendTo(thisLoadArea).css({opacity:'0'}).animate({opacity:'1'},fadeSpeed);
                                }
                            } else if(loadNum >= setAdj){
                                for (var i=0; i<setAdj; i++) {
                                    v = i+setBeg;
                                    $('<div id="item' + setNum + '_' + data[v].itemNum + '" class="loadItem">' + data[v].itemSource + '</div>').appendTo(thisLoadArea).css({opacity:'0'}).animate({opacity:'1'},fadeSpeed);
                                }
                                setMore.remove();
                            }
                        } else if(loadItemLength == dataLengh){
                            return false;
                        }
                    } else {
                        return false;
                    }
                }, //success
                complete : function(){
                    $('.nowLoading').each(function(){
                        $(this).remove();
                    });
                    return false;
                } //complete
            });
            return false;
        });
        setThis.addClass('loadSet' + setNum);
        setMore.click();
    });
});
