$(document).ready(function() {
    $.ajax({
        url: 'getSubject.php', 
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var selectElement = $('select[name="subject"]');
            selectElement.empty().append('<option value="Select">Select</option>');

            $.each(response.subjects, function(index, subject) {
                selectElement.append('<option value="' + subject.subject_name + '">' + subject.subject_name + '</option>');
            });
        }
    });
});