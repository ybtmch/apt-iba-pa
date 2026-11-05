$(function(){
    $("#withCurfew, #withoutCurfew").change(function(){
        $("#from_curfew, #to_curfew").val("None").attr("disabled",true);
        if($("#withoutCurfew").is(":checked")){
            $("#from_curfew").val("None").attr("disabled");
            $("#to_curfew").val("None").attr("disabled");
        }
        else if($("#withCurfew").is(":checked")){
            $("#from_curfew").removeAttr("disabled"); 
            $("#from_curfew").attr("required");
            $("#from_curfew").val("None");
            $("#to_curfew").removeAttr("disabled"); 
            $("#to_curfew").attr("required");
            $("#to_curfew").val("None"); 
        }
    });
});