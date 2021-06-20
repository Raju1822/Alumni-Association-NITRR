
$('add-education').click(function(e){
	e.preventDefault();
});
function addEducation(){
	$('#education-block').append('<div class="col-xs-12 edu-detail"><div class="col-sm-12 item"><div class="label-wrapper"><label for="institute">Institute</label></div><input type="text" name="institute" required value=""></div><div class="col-sm-12 item"><div class="label-wrapper"><label for="course">Course</label></div><input type="text" name="course" required value=""></div><div class="col-sm-12 item"><div class="label-wrapper"><label for="feild_of_study">Major Field of Study</label></div><input type="text" name="feild_of_study" required value=""></div><div class="col-sm-12 item select-edu-from"><div class="label-wrapper"><label for="edu_from">From</label></div><input type="date" name="edu-date-from" value=""></div><div class="col-sm-12 item select-edu-to"><div class="label-wrapper"><label for="edu_to">To</label></div><input type="date" name="edu-date-to" value=""><div class="checkbox-wrapper"><input type="checkbox" name="edu-date-to"><span>Currently studying here</span></div></div></div>');
}