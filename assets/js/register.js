$("#degree-type").change(function(){
    var degreeType = $("#degree-type").val();
    var host = $("#base-url").val();
    $.ajax({
        url: host+"register/registerGetDegree/"+degreeType,
        success: function(result){
            $("#degree").empty();
            $.each($.parseJSON(result), function(idx, obj){
                $("#degree").prepend('<option value="">Select</option>');
                for (var i = 0; i < obj.length; i++) {
                    $("#degree").append('<option value="'+obj[i].DegreeId+'">'+obj[i].DegreeName+'</option>');
                }
            });
        }
    });
});

$("#degree").change(function(){
    var degreeId = $("#degree").val();
    var host = $("#base-url").val();
    $.ajax({
        url: host+"/register/registerGetBranch/"+degreeId,
        success: function(result){
            console.log(result);
            // console.log($.parseJSON(result));

            $("#branch").empty();
            $.each($.parseJSON(result), function(idx, obj){
                $("#branch").prepend('<option value="">Select</option>');
                
                for (var i = 0; i < obj.length; i++) {
                    $("#branch").append('<option value="'+obj[i].BranchId+'">'+obj[i].Branch+'</option>');
                }
            });
        }
    });
});
function calculateConfluxAmount(){

    var single_rate = 7250;
    var double_rate = 4850;
    var children_rate = 2950;

    var single_persons = $('select[name="conflux-hyd-single-occupancy-persons"]').val() || 0;
    var single_days = $('select[name="conflux-hyd-single-occupancy-days"]').val() || 0;

    var double_persons = $('select[name="conflux-hyd-double-occupancy-persons"]').val() || 0;
    var double_days = $('select[name="conflux-hyd-double-occupancy-days"]').val() || 0;

    var children_persons = $('select[name="conflux-hyd-children-occupancy-persons"]').val() || 0;
    var children_days = $('select[name="conflux-hyd-children-occupancy-days"]').val() || 0;
    
    var city_tour_qty = $('select[name="conflux-hyd-2018-city-tour-qty"]').val() || 0;

    var city_tour_val = $('select[name="conflux-hyd-2018-city-tour"]').val();
    var city_tour_rate = 0;
    if(city_tour_val == "Hyderabad City Tour Attractions : Rs 1400"){
        city_tour_rate = 1400;
    }
    if(city_tour_val == "Ramoji Film City Tour: Rs 2500"){
        city_tour_rate = 2500;
    }
    var total_amount = (single_rate * single_persons * single_days) + 
                    (double_rate * double_persons * double_days) + 
                    (children_rate * children_persons * children_days) +
                    (city_tour_rate * city_tour_qty);
    var total_amount_text = "";
    if(single_persons > 0 && single_days > 0){
        total_amount_text = total_amount_text + "Single occupancy - Rs 7250" + " x " + single_persons + " Persons x "+ single_days +" Days <br>";
    }
    if(double_persons > 0 && double_days > 0){
        total_amount_text = total_amount_text + "Double occupancy (Each person) - Rs 4850" + " x " + double_persons + " Persons x " + double_days + " Days <br>";
    }
    if(children_persons > 0 && children_days > 0){
        total_amount_text = total_amount_text + "Childrens (5+ up to 18 years) - Rs 2950" + " x " + children_persons + " Persons x " + children_days + " Days <br>";
    }
    if(city_tour_qty > 0){
        total_amount_text = total_amount_text + city_tour_val + " x " + city_tour_qty + " Persons <br>";
    }
    console.log("total_amount", total_amount);

    $('input[name="amount"]').val(total_amount);
    $('input[name="amount"]').prop('readonly', true);
    $('input[name="sub-plan-details"]').val(total_amount_text);
}

function calculateJubileeAmount(){

    var participation_fees = 3000;
    var accommodation_fees = 3000;

    var price_object = {
        0: 0,
        "Persons: 1": 3000,
        "Persons: 2": 3000,
        "Persons: 2 with Minor": 3000,
        "Persons: 3": 6000,
        "Persons: 4": 6000
    }

    var participation_selection = $('select[name="golden-jubilee-participation"]').val() || 0;
    var accommodation_days_selection = $('select[name="golden-jubilee-single-occupancy-days"]').val() || 0;
    var accommodation_person_selection = $('select[name="golden-jubilee-single-occupancy-persons"]').val() || 0;

    total_amount = participation_fees * participation_selection + accommodation_days_selection * price_object[accommodation_person_selection];
    var total_amount_text = "";
    if(participation_selection > 0 && accommodation_days_selection > 0 && accommodation_person_selection > 0){
        total_amount_text = total_amount_text + "Participation - Rs 3000 x "+ participation_selection+" People <br>" + "Accommodation x "+ accommodation_days_selection +" Days for "+ accommodation_person_selection+" People <br>";
    }
    if(participation_selection == 0 && accommodation_days_selection > 0 && accommodation_person_selection > 0){
        total_amount_text = total_amount_text + "Accommodation x "+ accommodation_days_selection +" Days <br>";
    }
    console.log("total_amount", total_amount);

    $('input[name="amount"]').val(total_amount);
    $('input[name="amount"]').prop('readonly', true);
    $('input[name="sub-plan-details"]').val(total_amount_text);
}

function calculateAppliedGeologyAmount(){

    var participation_fees = 1500;
    var accommodation_fees = 2000;

    var participation_selection = $('select[name="applied-geology-participation"]').val() || 0;
    var accommodation_persons = $('select[name="applied-geology-persons"]').val() || 0;
    var accommodation_days = $('select[name="applied-geology-days"]').val() || 0;

    total_amount = participation_fees * (participation_selection > 0 ? 1 : 0) + accommodation_persons * accommodation_days * accommodation_fees;
    var total_amount_text = "";
    if(participation_selection > 0 && accommodation_persons > 0 && accommodation_days > 0){
        total_amount_text = total_amount_text + "Participation - Rs 1500 for "+ participation_selection+" People <br>" + "Accommodation x "+ accommodation_days +" Days for "+ accommodation_persons+" People <br>";
    }
    if(participation_selection == 0 && accommodation_persons > 0 && accommodation_days > 0){
        total_amount_text = total_amount_text + "Accommodation x "+ accommodation_persons +" Days  for "+accommodation_persons+ " persons<br>";
    }
    console.log("total_amount", total_amount);

    $('input[name="amount"]').val(total_amount);
    $('input[name="amount"]').prop('readonly', true);
    $('input[name="sub-plan-details"]').val(total_amount_text);
}

function calculateAnnualAlumniDayAmount(){
    var single_regstration_fees = 3000,
        family_registration_fees = 5000,
        single_sharing_occupancy_fees = 2000,
        single_occupancy_fees = 4000,
        family_couple_fees = 4000,
        family_fees = 5000;

    var alumni_meet_participation_single = $('select[name="alumni-meet-participation-single"]').val() || 0;
    var alumni_meet_participation_family = $('select[name="alumni-meet-participation-family"]').val() || 0;
    var alumni_meet_persons_single_sharing_days = $('select[name="alumni-meet-persons-single-sharing-days"]').val() || 0;
    var alumni_meet_persons_single_non_sharing_days = $('select[name="alumni-meet-persons-single-non-sharing-days"]').val() || 0;
    var alumni_meet_family_couple_days = $('select[name="alumni-meet-family-couple-days"]').val() || 0;
    var alumni_meet_family_children_days = $('select[name="alumni-meet-family-children-days"]').val() || 0;

    total_amount = alumni_meet_participation_single * single_regstration_fees + 
                    alumni_meet_participation_family * family_registration_fees + 
                    single_sharing_occupancy_fees * alumni_meet_persons_single_sharing_days + 
                    single_occupancy_fees * alumni_meet_persons_single_non_sharing_days + 
                    alumni_meet_family_couple_days * family_couple_fees + 
                    alumni_meet_family_children_days * family_fees;

    var total_amount_text = "";

    if(alumni_meet_participation_single > 0) {
        total_amount_text = total_amount_text + "Single Registration x " + alumni_meet_participation_single + " <br>";
    }

    if(alumni_meet_participation_family > 0){
        total_amount_text = total_amount_text + "Family Registration x " + alumni_meet_participation_family + " <br>";
    }

    if(alumni_meet_persons_single_sharing_days > 0){
        total_amount_text = total_amount_text + "Single Occupancy sharing x " + alumni_meet_persons_single_sharing_days + " days <br>";
    }

    if(alumni_meet_persons_single_non_sharing_days > 0){
        total_amount_text = total_amount_text + "Single Occupancy x " + alumni_meet_persons_single_non_sharing_days + " days <br>";
    }

    if(alumni_meet_family_couple_days > 0){
        total_amount_text = total_amount_text + "Family (couple) Stay  x " + alumni_meet_family_couple_days + " days <br>";
    }

    if(alumni_meet_family_children_days > 0){
        total_amount_text = total_amount_text + "Family (with children) Stay x " + alumni_meet_family_children_days + " days <br>";
    }
    console.log("total_amount", total_amount);

    $('input[name="amount"]').val(total_amount);
    $('input[name="amount"]').prop('readonly', true);
    $('input[name="sub-plan-details"]').val(total_amount_text);
}

function calculateGoldenGuestRoomAmount(){
    var selected_plan = $('select[name="golden-guest-room-plans"]').val() || 0;
    var selected_rooms = $('select[name="golden-guest-room-count"]').val() || 0;
    var selected_days = $('select[name="golden-guest-room-days"]').val() || 0;
    
    var category_charges = {
        "0" : 0,
        "A" : 1500,
        "B" : 2000
    };

    var total_amount = category_charges[selected_plan] * selected_rooms * selected_days;
    var total_amount_text = "Category " + selected_plan + " x " + selected_rooms + " Rooms x " + selected_days + " Days";
    $('input[name="amount"]').val(total_amount);
    $('input[name="amount"]').prop('readonly', true);
    $('input[name="sub-plan-details"]').val(total_amount_text);
}

function calculateGoldenConferenceRoomAmount(){
    var selected_plan = $('select[name="golden-conference-room-plans"]').val() || 0;
    var selected_days = $('select[name="golden-conference-room-days"]').val() || 0;
    
    var category_charges = {
        "0" : 0,
        "A" : 5000,
        "B" : 7500
    };

    var total_amount = category_charges[selected_plan] * selected_days;
    var total_amount_text = "Category " + selected_plan + " x " + selected_days + " Days";
    $('input[name="amount"]').val(total_amount);
    $('input[name="amount"]').prop('readonly', true);
    $('input[name="sub-plan-details"]').val(total_amount_text);
}

$('select[name="cause"]').change(function(){
    $('input[name="amount"]').prop('readonly', false);
    $('input[name="amount"]').val('');

    if ($(this).val() == "Annual Alumni Day 2019"){
        $('#golden-jubilee').hide();
        $('#alumni-meet').show();
        $('#conflux-hyd-2018').hide();
        $('#applied-geology').hide();
        $('#golden-guest-room').hide();
        $('#golden-conference-room').hide();
        $('select[name="sub-plan-details"]').val('');
    }else if ($(this).val() == "Conflux 2018 Hyderabad"){
        $('#golden-jubilee').hide();
        $('#conflux-hyd-2018').show();
        $('#alumni-meet').hide();
        $('#applied-geology').hide();
        $('#golden-guest-room').hide();
        $('#golden-conference-room').hide();
        calculateConfluxAmount();
    }else if ($(this).val() == "Golden Jubilee Reunion"){
        $('#conflux-hyd-2018').hide();
        $('#applied-geology').hide();
        $('#alumni-meet').hide();
        $('#golden-jubilee').show();
        $('#golden-guest-room').hide();
        $('#golden-conference-room').hide();
        calculateJubileeAmount();
    }else if ($(this).val() == "Applied Geology Reunion 2018"){
        $('#conflux-hyd-2018').hide();
        $('#alumni-meet').hide();
        $('#golden-jubilee').hide();
        $('#applied-geology').show();
        $('#golden-guest-room').hide();
        $('#golden-conference-room').hide();
        calculateAppliedGeologyAmount();
    }else if($(this).val() == "Golden Tower Guest Room Booking"){
        $('#conflux-hyd-2018').hide();
        $('#alumni-meet').hide();
        $('#golden-jubilee').hide();
        $('#applied-geology').hide();
        $('#golden-guest-room').show();
        $('#golden-conference-room').hide();
        calculateGoldenGuestRoomAmount();
    }else if($(this).val() == "Golden Tower Conference Room Booking"){
        $('#conflux-hyd-2018').hide();
        $('#alumni-meet').hide();
        $('#golden-jubilee').hide();
        $('#applied-geology').hide();
        $('#golden-guest-room').hide();
        $('#golden-conference-room').show();
        calculateGoldenGuestRoomAmount();
    }
    else{
        $('#conflux-hyd-2018').hide();
        $('#alumni-meet').hide();
        $('#golden-jubilee').hide();
        $('#applied-geology').hide();
        $('#golden-guest-room').hide();
        $('#golden-conference-room').hide();
        if($(this).val() == "Alumni Association Member Fee"){
            $('input[name="amount"]').val('1000');
            $('input[name="amount"]').prop('readonly', true);
        }
    }        
});

$('select[name="sub-plan-details"]').change(function(){
    if ($(this).val() == "Singe Participation 3000"){
        $('input[name="amount"]').val('3000');
        $('input[name="amount"]').prop('readonly', true);
    }else if ($(this).val() == "Couple Participation 5000"){
        $('input[name="amount"]').val('5000');
        $('input[name="amount"]').prop('readonly', true);
    }else if ($(this).val() == "Family Participation 6000"){
        $('input[name="amount"]').val('6000');
        $('input[name="amount"]').prop('readonly', true);
    }
});
// Golden Tower Guest Room
$('select[name="golden-guest-room-plans"]').change(function(){
    calculateGoldenGuestRoomAmount();
});

// Golden Tower Conference Room
$('select[name="golden-conference-room-plans"]').change(function(){
    if ($(this).val() == "Category A Rs 5000"){
        $('input[name="amount"]').val('5000');
        $('input[name="amount"]').prop('readonly', true);
    }else if ($(this).val() == "Category B Rs 7500"){
        $('input[name="amount"]').val('7500');
        $('input[name="amount"]').prop('readonly', true);
    }
});


$('select[name="conflux-hyd-single-occupancy-persons"]').change(function(){
    calculateConfluxAmount();
});

$('select[name="conflux-hyd-single-occupancy-days"]').change(function(){
    calculateConfluxAmount();
});
$('select[name="conflux-hyd-double-occupancy-days"]').change(function(){
    calculateConfluxAmount();
});

$('select[name="conflux-hyd-double-occupancy-persons"]').change(function(){
    calculateConfluxAmount();
});

$('select[name="conflux-hyd-children-occupancy-persons"]').change(function(){
    calculateConfluxAmount();
});

$('select[name="conflux-hyd-children-occupancy-days"]').change(function(){
    calculateConfluxAmount();
});
$('select[name="conflux-hyd-2018-city-tour"]').change(function(){
    calculateConfluxAmount();
});
$('select[name="conflux-hyd-2018-city-tour-qty"]').change(function(){
    calculateConfluxAmount();
});

$('select[name="golden-jubilee-participation"]').change(function(){
    calculateJubileeAmount();
});

$('select[name="golden-jubilee-single-occupancy-days"]').change(function(){
    calculateJubileeAmount();
});

$('select[name="golden-jubilee-single-occupancy-persons"]').change(function(){
    calculateJubileeAmount();
});

$('select[name="applied-geology-participation"]').change(function(){
    calculateAppliedGeologyAmount();
});

$('select[name="applied-geology-persons"]').change(function(){
    calculateAppliedGeologyAmount();
});

$('select[name="applied-geology-days"]').change(function(){
    calculateAppliedGeologyAmount();
});

$('select[name="applied-geology-days"]').change(function(){
    calculateAppliedGeologyAmount();
});


$('select[name="alumni-meet-participation-single"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-participation-family"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-persons-single-sharing"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-persons-single-sharing-days"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-persons-single-non-sharing"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-persons-single-non-sharing-days"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-family-couple-days"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="alumni-meet-family-children-days"]').change(function(){
    calculateAnnualAlumniDayAmount();
});

$('select[name="golden-guest-room-plans"]').change(function(){
    calculateGoldenGuestRoomAmount();
});

$('select[name="golden-guest-room-count"]').change(function(){
    calculateGoldenGuestRoomAmount();
});

$('select[name="golden-guest-room-days"]').change(function(){
    calculateGoldenGuestRoomAmount();
});

$('select[name="golden-conference-room-count"]').change(function(){
    calculateGoldenConferenceRoomAmount();
});

$('select[name="golden-conference-room-days"]').change(function(){
    calculateGoldenConferenceRoomAmount();
});


function makeReadOnly(){
    
}
