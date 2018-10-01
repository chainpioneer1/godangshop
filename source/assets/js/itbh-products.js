/**
 * Created by Administrator on 6/9/2017.
 */
$(document).ready(function() {
    $(".product-elem .thumbnail").hover(function() {
        // $("#orderedlist li:last").hover(function() {
        $(this).addClass("over");
    }, function() {
        $(this).removeClass("over");
    });
    $(".itbh-sellers-products-singlie-item").hover(function() {
        // $("#orderedlist li:last").hover(function() {
        $(this).addClass("over");
    }, function() {
        $(this).removeClass("over");
    });
});