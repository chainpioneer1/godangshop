/**
 * Created by ITbeckham7 on 6/4/2017.
 */
var itemSelectState = false;
/*
 Bulk Select and Delete functions
 */
function selectAllItem()
{
    $userSelChkBox = $('.user-select-chk');
    if(!itemSelectState)
    {
        $userSelChkBox.prop('checked',true);
        $userSelChkBox.attr('checkSt','checked');
        itemSelectState = true;

    }else{

        itemSelectState = false;
        $userSelChkBox.prop('checked',false);
        $userSelChkBox.attr('checkSt','unchecked');
    }
}
function selectEachItem(self)
{
    var checkSt = self.getAttribute('checkSt');
    if(checkSt==='checked')
    {
        self.setAttribute('checkSt','unchecked');
    }else{

        self.setAttribute('checkSt','checked');
    }
}
function deleteSelectedItem()
{
    var selectedRows = [];
    $userSelChkBox = $('.user-select-chk');
    $userSelChkBox.each(function() {
        $st = ($(this).attr('checkSt'));
        if($st==='checked')
        {
            selectedRows.push(($(this).attr('user_id')));
        }

    });
   if(selectedRows.length>0)///bulk delete operation
   {
       deleteItems(selectedRows)
   }
}
function deleteItems(deleteUserIds)///ajax function
{
    $.ajax({
        type: "post",
        url: baseURL+"admin/users/delete",
        dataType: "json",
        data: {userIds: deleteUserIds},
        success: function(res) {
            if(res.status=='success') {
                var table = document.getElementById("userInfo_tbl");
                var tbody = table.getElementsByTagName("tbody")[0];
                tbody.innerHTML = res.data;

            }
            else//failed
            {
                alert("Cannot delete CourseWare Item.");
            }
        }
    });

}





