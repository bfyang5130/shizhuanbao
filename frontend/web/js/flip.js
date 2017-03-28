/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(".box-flip").bind("mouseover", function () {
    // 切换的顺序如下
    // 1. 当前在前显示的元素翻转90度隐藏, 动画时间225毫秒
    // 2. 结束后，之前显示在后面的元素逆向90度翻转显示在前
    // 3. 完成翻面效果
    $(this).children(1).addClass("out").removeClass("in");
    setTimeout(function () {
        $(this).children(2).addClass("in").removeClass("out");
    }, 225);
});

