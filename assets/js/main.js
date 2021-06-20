
// collapsing the header on scrolling

collapse_header ();

$( window ).resize(function(){
  collapse_header ();
});

$(document).ready(function(){
  $('.dropdown-menu a').click(function(e) {
        e.stopPropagation();
    });
});

function collapse_header () {
  if(document.documentElement.clientWidth >= 1200) {
    $(document).scroll(function(event){      
      if($(window).scrollTop() > 100) {
        $('.navbar').addClass('navbar-small');
      }
      else{
        $('.navbar').removeClass('navbar-small');
      }
    });
  }
}

// revealing the dropdown onHover

$('.dropdown').hover( function(){
  $(this).addClass('open');
}, 
function(){
  $(this).removeClass('open');
});


//=============================================
//edit user profile
//=============================================

$('#add-button').click(function(e){
  e.preventDefault();
  return false;
});

$('#delete-button').click(function(e){
  e.preventDefault();
  return false;
});
/*jshint multistr: true */

// For adding and deleting new education
function Education(count){
  this.html = "\
    <div class='col-xs-12 edu-detail' id='edu-detail-"+count+"'> \
      <a href='#!' id='delete-button' onclick=\"deleteElement(\'edu-detail-"+count+"\')\" class='delete-button'><i class='fa fa-trash'></i> Delete</a> \
      <div class='col-sm-12 item'> \
        <div class='label-wrapper'><label for='institute'>Institute</label></div> \
        <input type='text' name='institute[]' required value=''> \
      </div> \
      <div class='col-sm-12 item'> \
        <div class='label-wrapper'><label for='course'>Course</label></div> \
        <input type='text' name='course[]' required value=''> \
      </div> \
      <div class='col-sm-12 item'> \
        <div class='label-wrapper'><label for='feild_of_study'>Major Field of Study</label></div> \
        <input type='text' name='feild_of_study[]' required value=''> \
      </div> \
      <div class='col-sm-12 item select-edu-from'> \
        <div class='label-wrapper'><label for='edu_from'>From</label></div> \
        <input type='date' name='edu-date-from[]' value=''> \
      </div> \
      <div class='col-sm-12 item select-edu-to'> \
        <div class='label-wrapper'><label for='edu_to'>To</label></div> \
        <input type='date' name='edu-date-to[]' value=''> \
        <div class='checkbox-wrapper'> \
                      <input type='checkbox' class='to-date-check' name='current-education[]'> \
                      <span>Currently studying here</span> \
                    </div> \
      </div> \
    </div> \
  </div>";

}


function addEducation(){
  var count = parseInt($('#edu_count').val());

  var n = new Education(count);
  
  $('#education-block').append(n.html);
  $('#edu_count').val(count+1);
}

function deleteElement(identifier){
  $('#'+identifier).remove();
}

// For adding  new work

function Work(count){
  this.html = "\
    <div class=\"col-xs-12 work-detail\" id=\"work-detail-"+count+"\">\
          <a href=\"#!\" id=\"delete-button\" onclick=\"deleteElement('work-detail-"+count+"')\" class=\"delete-button\"><i class=\"fa fa-trash\"></i> Delete</a>\
          <div class=\"col-sm-12 item\">\
            <div class=\"label-wrapper\"><label for=\"company\">Company</label></div>\
            <input type=\"text\" name=\"company[]\" required value=\"\">\
          </div>\
          <div class=\"col-sm-12 item\">\
            <div class=\"label-wrapper\"><label for=\"designation\">Designation</label></div>\
            <input type=\"text\" name=\"designation[]\" required value=\"\">\
          </div>\
          <div class=\"col-sm-12 item\">\
            <div class=\"label-wrapper\"><label for=\"description\">Description</label></div>\
            <textarea name=\"job-description[]\"></textarea>\
          </div>\
          <div class=\"col-sm-12 item select-job-from\">\
            <div class=\"label-wrapper\"><label for=\"job_from\">From</label></div>\
            <input type=\"date\" name=\"job-date-from[]\" value=\"\">\
          </div>\
          <div class=\"col-sm-12 item select-job-to\">\
            <div class=\"label-wrapper\"><label for=\"job_to\">To</label></div>\
            <input type=\"date\" name=\"job-date-to[]\" value=\"\">\
            <div class=\"checkbox-wrapper\">\
              <input type=\"checkbox\" class=\"to-date-check\" name=\"current-work[]\">\
              <span>Currently Working here</span>\
            </div>\
          </div>\
        </div>";

  Work.counter++;
}


function addWork(){
  var count = parseInt($('#edu_count').val());
  var n = new Work(count);
  $('#work-block').append(n.html);
  $('#edu_count').val(count+1);

}

// For adding  new project

function Project(count){
  this.html = "\
    <div class=\"col-xs-12 project-detail\" id=\"project-detail-"+count+"\">\
            <a href=\"#!\" id=\"delete-button\" onclick=\"deleteElement('project-detail-"+count+"')\" class=\"delete-button\"><i class=\"fa fa-trash\"></i> Delete</a>\
            <div class=\"col-sm-12 item\">\
              <div class=\"label-wrapper\"><label for=\"project-name\">Project Name</label></div>\
              <input type=\"text\" name=\"project_name[]\" required value=\"\">\
            </div>\
            <div class=\"col-sm-12 item\">\
              <div class=\"label-wrapper\"><label for=\"project_details\">Project Description</label></div>\
              <textarea name=\"project_details[]\" required></textarea>\
            </div>\
            <div class=\"col-sm-12 item\">\
              <div class=\"label-wrapper\"><label for=\"skills_used\">Skills Used</label></div>\
              <input type=\"text\" name=\"skills_used[]\" required value=\"\">\
            </div>\
            <div class=\"col-sm-12 item select-project-from\">\
              <div class=\"label-wrapper\"><label for=\"project_from\">From</label></div>\
              <input type=\"date\" name=\"project_from[]\" value=\"\">\
            </div>\
            <div class=\"col-sm-12 item select-project-to\">\
              <div class=\"label-wrapper\"><label for=\"project_to\">To</label></div>\
              <input type=\"date\" name=\"project_to[]\" value=\"\">\
              <div class=\"checkbox-wrapper\">\
                            <input type=\"checkbox\" class=\"to-date-check\"  name=\"current-project[]\">\
                            <span>Currently doing this project</span>\
                          </div>\
            </div>\
          </div>";
}


function addProject(){
  var count = parseInt($('#project_count').val());
  var n = new Project(count);
  $('#project-block').append(n.html);
  $('#project_count').val(count+1);
}

// For skills

function deleteSkill(id){
  
  var url = $('#delete-skill').attr("goto"),
      
      userskill = $("#skill-value-"+id).val(),
      userid = $("#user-id").val();

  var data = {
              'user-skill' : userskill,
              'user-id' : userid
            };
  
  $.ajax({
      type: 'POST',
      url: url,
      data: data,
      success: function(result){
        } 
      }
  );

  $('#user-skill-'+id).remove();
}


$(document).on('change','.to-date-check',function(){
  var parents = $(this).parent().parent();

  var date = parents.find('input[type=\'date\']');
  console.log(date);
  var isDisabled = date.is(':disabled');
  console.log(isDisabled);
  
  if (isDisabled) {
    date.prop("disabled", false);
  }else{
    date.prop("disabled",true);
  }
});

// Upload profile picture

$(function(){
    $("#upload-profile").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});

$('#upload').change(function() {
  $('#upload-image-form').submit();
});

// Summernote Initialization

$(document).ready(function() {
        $('#textinput').summernote({
          toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
        });
    });

// Submit Minutes of meeting
function submitMinutes(e) {
  e.preventDefault();
  $('.post-form-error').html('');
  var msg = '',
  
  post_title = $('#post-title').val(),
  post_date = $('#post-date').val();
  
  console.log(post_date, post_title);

  if (!post_title || !post_date) {
     msg = "Please fill the name and date Correctly.";
     $('.post-form-error').append(msg);
     console.log(msg);
  }else{
    var markupStr = $('#textinput').summernote('code');

    // make a post request
    base_url = $('.new-post form').attr('action');
    data = {
      'title': post_title,
      'content': markupStr,
      'date' : post_date
    };
    $.ajax({
      type: "POST",
      url: base_url+'Minutesofmeeting/createMomSubmit',
      data: data,
      success: function(result){
          if (result == 1) {
            window.location.replace(base_url+"Minutesofmeeting");
          }
      },
      dataType: "json"
    });
  
  }
  
}