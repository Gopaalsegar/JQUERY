var timeLeft = 60; 
var timerInterval;

function updateTimer() {
    $("#timer").html(timeLeft + " seconds remaining");
    $("#timeLeft").val(timeLeft); 
}

function startTimer() {
    updateTimer();

    timerInterval = setInterval(function() {
        timeLeft--;
        updateTimer();

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            document.cookie = "time_taken=" + (60 - timeLeft) + "; path=/";

            submitForm(); 
        }
        document.cookie = "time_taken=" + (60 - timeLeft) + "; path=/";

    }, 1000);
}

function submitForm() {
    clearInterval(timerInterval); 
    document.getElementById('submit').click(); 
}

$(document).ready(function() {
    startTimer();
});

