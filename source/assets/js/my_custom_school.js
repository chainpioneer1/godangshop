var add_chkgrade1 = true;
var add_chkgrade2 = true;
var add_chkgrade3 = true;
var add_chkgrade4 = true;
var add_chkgrade5 = true;

var edit_chkgrade1 = true;
var edit_chkgrade2 = true;
var edit_chkgrade3 = true;
var edit_chkgrade4 = true;
var edit_chkgrade5 = true;

var pager = new Pager('schoolInfo_tbl', showedItems);
pager.init();
pager.showPageNav('pager', 'schoolpageNavPosition');
pager.showPage(currentShowedPage);

function executionPageNation()
{
    pager.showPageNav('pager', 'schoolpageNavPosition');
    pager.showPage(currentShowedPage);
}
function delete_school(self)
{
    var school_id = self.getAttribute("school_id");
    jQuery("#delete_school_btn").attr("school_id",school_id);
    jQuery("#school_delete_modal").modal({
        backdrop: 'static',
        keyboard: false
    });
}
function publish_school(self)
{
    var enabled_school_id = self.getAttribute("school_id");
    var curBtnText = self.innerHTML;
    var stop_st = '0';
    if(enabledStr==curBtnText)
    {
        self.innerHTML = disabledStr;
    }
    else{
        self.innerHTML = enabledStr;
        stop_st = '1';
    }
    ///ajax process for publish/unpublish
    jQuery.ajax({
        type: "post",
        url: baseURL+"admin/schools/publish",
        dataType: "json",
        data: {school_id: enabled_school_id,stop_state:stop_st},
        success: function(res) {
            if(res.status=='success') {
                /*
                 ///if click publish/unpublish button, don't need to update table
                 var table = document.getElementById("swInfo_tbl");
                 var tbody = table.getElementsByTagName("tbody")[0];
                 tbody.innerHTML = res.data;
                 var pager = new Pager('swInfo_tbl', 5);
                 pager.init();
                 pager.showPageNav('pager', 'swpageNavPosition');
                 pager.showPage(1);
                 */
            }
            else//failed
            {
                alert("Cannot delete CourseWare Item.");
            }
        }
    });
}
function edit_school(self) {

    var school_id = self.getAttribute("school_id");
    var tdtag = self.parentNode;
    var trtag = tdtag.parentNode;
    var school_name = trtag.cells[1].innerHTML;//(学校名称

    $("#edit_school_name").val(school_name);
    $("#edit_school_info_id").val(school_id);

    $("#school_edit_modal").modal({backdrop: 'static',
        keyboard: false});
}
function convOutStr(gradeNum,inStr){
    var classInfo = gradeNum+gradeStr+"&nbsp&nbsp"+inStr+"&nbsp&nbsp"+classStr;
    return '<p class="class_list_Info">'+classInfo+'</p>';
}
function add_school_ajax(school_name,class_attr)
{
    $.ajax({
        type: "post",
        url: baseURL+"admin/schools/add",
        dataType: "json",
        data: {school_name: school_name,class_attr:class_attr},
        success: function(res) {
            if(res.status=='success') {
                 ///if click publish/unpublish button, don't need to update table
                 var table = document.getElementById("schoolInfo_tbl");
                 var tbody = table.getElementsByTagName("tbody")[0];
                 tbody.innerHTML = res.data;
                 executionPageNation();
            }
            else//failed
            {
                alert("Cannot delete CourseWare Item.");
            }
        }
    });
    $("#school_addNew_modal").modal('toggle');
}
function edit_school_ajax(school_id,school_name,class_attr)
{
    $.ajax({
        type: "post",
        url: baseURL+"admin/schools/edit",
        dataType: "json",
        data: {school_id:school_id,school_name: school_name,class_attr:class_attr},
        success: function(res) {
            if(res.status=='success') {
                ///if click Enable/Disabled button, don't need to update table
                var table = document.getElementById("schoolInfo_tbl");
                var tbody = table.getElementsByTagName("tbody")[0];
                tbody.innerHTML = res.data;
                executionPageNation();
            }
            else//failed
            {
                alert("Cannot delete CourseWare Item.");
            }
        }
    });
    $("#school_edit_modal").modal('toggle');
}
var init_grade_chk = function()///init checkbox as checked state
{
    var outStr1 = convOutStr(oneStr,1);
    var outStr2 = convOutStr(twoStr,1);
    var outStr3 = convOutStr(threeStr,1);
    var outStr4 = convOutStr(fourStr,1);
    var outStr5 = convOutStr(fiveStr,1);
    //init checkbox
    $("#add_first_chk").prop('checked',true);
    $("#add_second_chk").prop('checked',true);
    $("#add_third_chk").prop('checked',true);
    $("#add_fourth_chk").prop('checked',true);
    $("#add_fifth_chk").prop('checked',true);
    ///init grade/class add new school dialog box
    $("#first_grade_col").append(outStr1);
    $("#second_grade_col").append(outStr2);
    $("#third_grade_col").append(outStr3);
    $("#fourth_grade_col").append(outStr4);
    $("#fifth_grade_col").append(outStr5);
    ///init grade/class information for edit school information
    $("#edit_first_grade_col").append(outStr1);
    $("#edit_second_grade_col").append(outStr2);
    $("#edit_third_grade_col").append(outStr3);
    $("#edit_fourth_grade_col").append(outStr4);
    $("#edit_fifth_grade_col").append(outStr5);
    //init checkbox for edit school information
    $("#edit_first_chk").prop('checked',true);
    $("#edit_second_chk").prop('checked',true);
    $("#edit_third_chk").prop('checked',true);
    $("#edit_fourth_chk").prop('checked',true);
    $("#edit_fifth_chk").prop('checked',true);

    $("p.class_list_Info").css('margin','0px');

    //init class num information
};
init_grade_chk();
(function($) {
    ////show add new school dialog
    $("#add_new_school_btn").click(function () {
        $("#school_addNew_modal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
    $("#delete_school_btn").click(function () {
        var delete_school_id = $("#delete_school_btn").attr("school_id");
        $.ajax({
            type: "post",
            url: baseURL+"admin/schools/delete",
            dataType: "json",
            data: {school_id: delete_school_id},
            success: function(res) {
                if(res.status=='success') {
                    var table = document.getElementById("schoolInfo_tbl");
                    var tbody = table.getElementsByTagName("tbody")[0];
                    tbody.innerHTML = res.data;
                    executionPageNation();
                }
                else//failed
                {
                    alert("Cannot delete CourseWare Item.");
                }
            }
        });
        $('#school_delete_modal').modal('toggle');
    });
    ///search for school name
    $("#school_name_search").keyup(function () {

        var input, filter, table, tr, td, i;
        input = document.getElementById("school_name_search");
        filter = input.value.toUpperCase();
        table = document.getElementById("schoolInfo_tbl");
        tr = table.getElementsByTagName("tr");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
    ///when save button of new dialog
    $("#add_school_save_btn").click(function () {

        var schoolName = $("#add_school_name").val();
        var jsonAtrr = [],class_num;
        ///first check chekbox option
        if(add_chkgrade1){
            ///get first grade label
            class_num= parseInt($("#add_first_grade_classCnt").text());
            var arr = {'grade':'','class':''};
            arr['grade'] = 1;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(add_chkgrade2){

            class_num = parseInt($("#add_second_grade_classCnt").text());
            var arr = {'grade':'','class':''};
            arr['grade'] = 2;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(add_chkgrade3){

            class_num = parseInt($("#add_third_grade_classCnt").text());
            var arr = {'grade':'','class':''};
            arr['grade'] = 3;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(add_chkgrade4){

            var arr = {'grade':'','class':''};
            class_num = parseInt($("#add_fourth_grade_classCnt").text());
            arr['grade'] = 4;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(add_chkgrade5){
            var arr = {grade:'',class:''};
            class_num = parseInt($("#add_fifth_grade_classCnt").text());
            arr['grade'] = 5;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        add_school_ajax(schoolName,jsonAtrr)

    });
    ////check box and label for add new school
    $("#add_first_chk").click(function (e) {
        var self = document.getElementById("add_first_chk");
        if(self.checked){
            add_chkgrade1 = true;
            $("#add_plus_first_grade_btn").prop("disabled",false);
            $("#add_minus_first_grade_btn").prop("disabled",false);


        }else
        {
            add_chkgrade1 = false;
            $("#add_plus_first_grade_btn").prop("disabled",true);
            $("#add_minus_first_grade_btn").prop("disabled",true);
        }
    });
    $("#add_second_chk").click(function (e) {
        var self = document.getElementById("add_second_chk");
        if(self.checked){

            add_chkgrade2 = true;
            $("#add_plus_second_grade_btn").prop("disabled",false);
            $("#add_minus_second_grade_btn").prop("disabled",false);

        }else{
            add_chkgrade2 = false;
            $("#add_plus_second_grade_btn").prop("disabled",true);
            $("#add_minus_second_grade_btn").prop("disabled",true);

        }

    });
    $("#add_third_chk").click(function (e) {
        var self = document.getElementById("add_third_chk");
        if(self.checked){

            add_chkgrade3 = true;
            $("#add_plus_third_grade_btn").prop("disabled",false);
            $("#add_minus_third_grade_btn").prop("disabled",false);

        }else {
            add_chkgrade3 = false;
            $("#add_plus_third_grade_btn").prop("disabled",true);
            $("#add_minus_third_grade_btn").prop("disabled",true)

        }
    });
    $("#add_fourth_chk").click(function (e) {
        var self = document.getElementById("add_fourth_chk");
        if(self.checked){
            add_chkgrade4 = true;
            $("#add_plus_fourth_grade_btn").prop("disabled",false);
            $("#add_minus_fourth_grade_btn").prop("disabled",false)
        }else{
            add_chkgrade4 = false;
            $("#add_plus_fourth_grade_btn").prop("disabled",true);
            $("#add_minus_fourth_grade_btn").prop("disabled",true)
        }
    });
    $("#add_fifth_chk").click(function (e) {
        var self = document.getElementById("add_fifth_chk");
        if(self.checked){
            add_chkgrade5 = true;
            $("#add_plus_fifth_grade_btn").prop("disabled",false);
            $("#add_minus_fifth_grade_btn").prop("disabled",false)
        }else{
            add_chkgrade5 = false;
            $("#add_plus_fifth_grade_btn").prop("disabled",true);
            $("#add_minus_fifth_grade_btn").prop("disabled",true)
        }
    });

    $("#add_plus_first_grade_btn").click(function () {
        var val1 = parseInt($("#add_first_grade_classCnt").text());
        $("#add_first_grade_classCnt").html(val1+1);
        var outStr = convOutStr(oneStr,(val1+1));
        $("#first_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');
    });
    $("#add_minus_first_grade_btn").click(function () {
        val2 = parseInt($("#add_first_grade_classCnt").text());
        if(val2>1){
            $("#add_first_grade_classCnt").html(val2-1);
            $("#first_grade_col").children().last().remove();
        }
    });
    $("#add_plus_second_grade_btn").click(function () {
        val1 = parseInt($("#add_second_grade_classCnt").text());
        $("#add_second_grade_classCnt").html(val1+1);
        var outStr = convOutStr(twoStr,(val1+1));
        $("#second_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');
    });
    $("#add_minus_second_grade_btn").click(function () {

        val2 = parseInt($("#add_second_grade_classCnt").text());
        if(val2>1){
            $("#add_second_grade_classCnt").html(val2-1);
            $("#second_grade_col").children().last().remove();
        }
    });
    $("#add_plus_third_grade_btn").click(function () {

        val1 = parseInt($("#add_third_grade_classCnt").text());
        $("#add_third_grade_classCnt").html(val1+1);
        var outStr = convOutStr(threeStr,(val1+1));
        $("#third_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');

    });
    $("#add_minus_third_grade_btn").click(function () {

        val2 = parseInt($("#add_third_grade_classCnt").text());
        if(val2>1){
            $("#add_third_grade_classCnt").html(val2-1);
            $("#third_grade_col").children().last().remove();
        }
    });
    $("#add_plus_fourth_grade_btn").click(function () {

        val1 = parseInt($("#add_fourth_grade_classCnt").text());
        $("#add_fourth_grade_classCnt").html(val1+1);
        var outStr = convOutStr(fourStr,(val1+1));
        $("#fourth_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');

    });
    $("#add_minus_fourth_grade_btn").click(function () {

        val2 = parseInt( $("#add_fourth_grade_classCnt").text());
        if(val2>1){
            $("#add_fourth_grade_classCnt").html(val2-1);
            $("#fourth_grade_col").children().last().remove();
        }
    });
    $("#add_plus_fifth_grade_btn").click(function () {

        var val1 = parseInt($("#add_fifth_grade_classCnt").text());
        $("#add_fifth_grade_classCnt").html(val1+1);
        var outStr = convOutStr(fiveStr,(val1+1));
        $("#fifth_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');
    });
    $("#add_minus_fifth_grade_btn").click(function () {
        var val2 = parseInt( $("#add_fifth_grade_classCnt").text());
        if(val2>1){
            $("#add_fifth_grade_classCnt").html(val2-1);
            $("#fifth_grade_col").children().last().remove();
        }
    });

    ////check box and label for edit school information
    $("#edit_first_chk").click(function (e) {
        var self = document.getElementById("edit_first_chk");
        if(self.checked){
            edit_chkgrade1 = true;
            $("#edit_plus_first_grade_btn").prop("disabled",false);
            $("#edit_minus_first_grade_btn").prop("disabled",false);


        }else
        {
            edit_chkgrade1 = false;
            $("#edit_plus_first_grade_btn").prop("disabled",true);
            $("#edit_minus_first_grade_btn").prop("disabled",true);
        }
    });
    $("#edit_second_chk").click(function (e) {
        var self = document.getElementById("edit_second_chk");
        if(self.checked){

            edit_chkgrade2 = true;
            $("#edit_plus_second_grade_btn").prop("disabled",false);
            $("#edit_minus_second_grade_btn").prop("disabled",false);

        }else{
            add_chkgrade2 = false;
            $("#edit_plus_second_grade_btn").prop("disabled",true);
            $("#edit_minus_second_grade_btn").prop("disabled",true);

        }

    });
    $("#edit_third_chk").click(function (e) {
        var self = document.getElementById("edit_third_chk");
        if(self.checked){

            edit_chkgrade3 = true;
            $("#edit_plus_third_grade_btn").prop("disabled",false);
            $("#edit_minus_third_grade_btn").prop("disabled",false);

        }else {
            edit_chkgrade3 = false;
            $("#edit_plus_third_grade_btn").prop("disabled",true);
            $("#edit_minus_third_grade_btn").prop("disabled",true)

        }
    });
    $("#edit_fourth_chk").click(function (e) {
        var self = document.getElementById("edit_fourth_chk");
        if(self.checked){
            edit_chkgrade4 = true;
            $("#edit_plus_fourth_grade_btn").prop("disabled",false);
            $("#edit_minus_fourth_grade_btn").prop("disabled",false)
        }else{
            edit_chkgrade4 = false;
            $("#edit_plus_fourth_grade_btn").prop("disabled",true);
            $("#edit_minus_fourth_grade_btn").prop("disabled",true)
        }
    });
    $("#edit_fifth_chk").click(function (e) {
        var self = document.getElementById("edit_fifth_chk");
        if(self.checked){
            edit_chkgrade5 = true;
            $("#edit_plus_fifth_grade_btn").prop("disabled",false);
            $("#edit_minus_fifth_grade_btn").prop("disabled",false)
        }else{
            edit_chkgrade5 = false;
            $("#edit_plus_fifth_grade_btn").prop("disabled",true);
            $("#edit_minus_fifth_grade_btn").prop("disabled",true)
        }
    });

    $("#edit_plus_first_grade_btn").click(function () {
        var val1 = parseInt($("#edit_first_grade_classCnt").text());
        $("#edit_first_grade_classCnt").html(val1+1);
        var outStr = convOutStr(oneStr,(val1+1));
        $("#edit_first_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');
    });
    $("#edit_minus_first_grade_btn").click(function () {
        val2 = parseInt($("#edit_first_grade_classCnt").text());
        if(val2>1){
            $("#edit_first_grade_classCnt").html(val2-1);
            $("#edit_first_grade_col").children().last().remove();
        }
    });
    $("#edit_plus_second_grade_btn").click(function () {
        val1 = parseInt($("#edit_second_grade_classCnt").text());
        $("#edit_second_grade_classCnt").html(val1+1);
        var outStr = convOutStr(twoStr,(val1+1));
        $("#edit_second_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');
    });
    $("#edit_minus_second_grade_btn").click(function () {

        val2 = parseInt($("#edit_second_grade_classCnt").text());
        if(val2>1){
            $("#edit_second_grade_classCnt").html(val2-1);
            $("#edit_second_grade_col").children().last().remove();
        }
    });
    $("#edit_plus_third_grade_btn").click(function () {

        val1 = parseInt($("#edit_third_grade_classCnt").text());
        $("#edit_third_grade_classCnt").html(val1+1);
        var outStr = convOutStr(threeStr,(val1+1));
        $("#edit_third_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');

    });
    $("#edit_minus_third_grade_btn").click(function () {

        val2 = parseInt($("#edit_third_grade_classCnt").text());
        if(val2>1){
            $("#edit_third_grade_classCnt").html(val2-1);
            $("#edit_third_grade_col").children().last().remove();
        }
    });
    $("#edit_plus_fourth_grade_btn").click(function () {

        val1 = parseInt($("#edit_fourth_grade_classCnt").text());
        $("#edit_fourth_grade_classCnt").html(val1+1);
        var outStr = convOutStr(fourStr,(val1+1));
        $("#edit_fourth_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');

    });
    $("#edit_minus_fourth_grade_btn").click(function () {

        val2 = parseInt( $("#edit_fourth_grade_classCnt").text());
        if(val2>1){
            $("#edit_fourth_grade_classCnt").html(val2-1);
            $("#edit_fourth_grade_col").children().last().remove();
        }
    });
    $("#edit_plus_fifth_grade_btn").click(function () {

        var val1 = parseInt($("#edit_fifth_grade_classCnt").text());
        $("#edit_fifth_grade_classCnt").html(val1+1);
        var outStr = convOutStr(fiveStr,(val1+1));
        $("#edit_fifth_grade_col").append(outStr);
        $("p.class_list_Info").css('margin','0px');
    });
    $("#edit_minus_fifth_grade_btn").click(function () {
        var val2 = parseInt( $("#edit_fifth_grade_classCnt").text());
        if(val2>1){
            $("#edit_fifth_grade_classCnt").html(val2-1);
            $("#edit_fifth_grade_col").children().last().remove();
        }
    });

    $("#edit_school_save_btn").click(function () {

        var school_id = $("#edit_school_info_id").val();
        var schoolName = $("#edit_school_name").val();
        var jsonAtrr = [],class_num;
        ///first check chekbox option
        if(edit_chkgrade1){
            ///get first grade label
            class_num= parseInt($("#edit_first_grade_classCnt").text());
            var arr = {'grade':'','class':''};
            arr['grade'] = 1;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(edit_chkgrade2){

            class_num = parseInt($("#edit_second_grade_classCnt").text());
            var arr = {'grade':'','class':''};
            arr['grade'] = 2;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(edit_chkgrade3){

            class_num = parseInt($("#edit_third_grade_classCnt").text());
            var arr = {'grade':'','class':''};
            arr['grade'] = 3;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(edit_chkgrade4){

            var arr = {'grade':'','class':''};
            class_num = parseInt($("#edit_fourth_grade_classCnt").text());
            arr['grade'] = 4;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        if(edit_chkgrade5){
            var arr = {grade:'',class:''};
            class_num = parseInt($("#edit_fifth_grade_classCnt").text());
            arr['grade'] = 5;
            arr['class'] = class_num;
            jsonAtrr.push(arr);
        }
        edit_school_ajax(school_id,schoolName,jsonAtrr)

    });

})(jQuery);