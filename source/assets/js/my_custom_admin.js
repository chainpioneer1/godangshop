

cs_chk.click(function (e) {
    var self = document.getElementById("CourseManagement_chk");
    if(self.checked){

        cs_pro_chk.prop('checked',true);
        cs_unit_chk.prop('checked',true);
        unit_sub_chk.prop('checked',true);

        cs_pro_st = '1';
        cs_unit_st = '1';
        unit_sub_st = '1';

    }else {
        cs_pro_chk.prop('checked', false);
        cs_unit_chk.prop('checked', false);
        unit_sub_chk.prop('checked', false);

        cs_pro_st = '0';
        cs_unit_st = '0';
        unit_sub_st = '0';

    }
});

account_chk.click(function (e) {
    var self = document.getElementById("AccountManagement_chk");
    if(self.checked){
        user_chk.prop('checked',true);
        admin_chk.prop('checked',true);
        logview_chk.prop('checked',true);

        user_st = '1';
        admin_st = '1';
        logview_st = '1';

    }else {
        user_chk.prop('checked', false);
        admin_chk.prop('checked', false);
        logview_chk.prop('checked', false);

        user_st = '0';
        admin_st = '0';
        logview_st = '0';
    }
});

community_chk.click(function (e) {
    var self = document.getElementById("CommunityManagement_chk");
    if(self.checked){
        content_chk.prop('checked',true);
        comment_chk.prop('checked',true);

        content_st = '1';
        comment_st = '1';

    }else {
        content_chk.prop('checked', false);
        comment_chk.prop('checked', false);

        content_st = '0';
        comment_st = '0';
    }
});

cs_pro_chk.click(function (e) {
    var self = document.getElementById("CourseProjectManagement_chk");
    if(self.checked){
        cs_pro_st = '1';

    }else {
        cs_pro_st = '0';
    }
});
cs_unit_chk.click(function (e) {
    var self = document.getElementById("CourseUnitManagement_chk");
    if(self.checked){
        cs_unit_st = '1';

    }else {
        cs_unit_st = '0';
    }
});
unit_sub_chk.click(function (e) {
    var self = document.getElementById("UnitSubwareManagement_chk");
    if(self.checked){
        unit_sub_st = '1';

    }else {
        unit_sub_st = '0';
    }
});

user_chk.click(function (e) {
    var self = document.getElementById("UserManagement_chk");
    if(self.checked){
        user_st = '1';
    }else {
        user_st = '0';
    }
});
admin_chk.click(function (e) {
    var self = document.getElementById("AdminManagement_chk");
    if(self.checked){
        admin_st = '1';

    }else {
        admin_st = '0';
    }
});
logview_chk.click(function (e) {
    var self = document.getElementById("LogView_chk");
    if(self.checked){
        logview_st = '1';
    }else {
        logview_st = '0';
    }
});

content_chk.click(function (e) {
    var self = document.getElementById("ContentManagement_chk");
    if(self.checked){
        content_st = '1';

    }else {
        content_st = '0';
    }
});
comment_chk.click(function (e) {
    var self = document.getElementById("CommentManagement_chk");
    if(self.checked){
        comment_st = '1';

    }else {
        comment_st = '0';
    }
});

function makeArrayFromChkSt()
{
   var courseRole = {cs_pro_st:cs_pro_st, cs_unit_st:cs_unit_st, unit_sub_st:unit_sub_st};
   var accountRole ={user_st:user_st, admin_st:admin_st, logview_st:logview_st};
   var communityRole = {content_st:content_st, comment_st:comment_st};
   roleinfo = [courseRole,accountRole,communityRole];

   var jsonArray = [];
   jsonArray.push(courseRole);
   jsonArray.push(accountRole);
   jsonArray.push(communityRole);
   return jsonArray;
}
$('#assign_admin_submit_form').submit(function(e){
    var admin_id = $('#assign_admin_saveBtn').attr('admin_id');
    role_info = makeArrayFromChkSt();
    e.preventDefault();
    jQuery.ajax({
        url:baseURL+"admin/admins/assign",
        type:"post",
        data:{admin_id:admin_id,role_info:role_info},
        success: function(res){
            var ret = JSON.parse(res);
            if(ret.status=='success') {
                var table = document.getElementById("adminInfo_tbl");
                var tbody = table.getElementsByTagName("tbody")[0];
                tbody.innerHTML = ret.data;
                executionPageNation();
            }
            else//failed
            {
                alert("Cannot modify Unit Data.");
            }
        }
    });
    jQuery('#assign_admin_modal').modal('toggle');


});


