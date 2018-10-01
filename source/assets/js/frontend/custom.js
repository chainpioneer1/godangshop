/**
 * Created by Administrator on 6/12/2017.
 */
var registerBtn = $('#sh_register_btn');
var nonregisterBtn = $('#sh_non_register_btn');
registerBtn.mouseover(function () {

    registerBtn.css("background","url("+baseURL+"assets/images/frontend/register_btn.png)");

});
registerBtn.mouseout(function () {

    registerBtn.css("background","url("+baseURL+"assets/images/frontend/register_btn1.png)");

});
nonregisterBtn.mouseover(function () {

    nonregisterBtn.css("background","url("+baseURL+"assets/images/frontend/nonuser_reg_btn.png)");

});
nonregisterBtn.mouseout(function () {

    nonregisterBtn.css("background","url("+baseURL+"assets/images/frontend/nonuser_reg_btn1.png)");

});