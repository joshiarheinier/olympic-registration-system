// Set the date we're counting down to
var countDownDate = new Date("Oct 4, 2018 00:00:00").getTime();
var type = "entry number";
var n = new Date().getTime();
if (countDownDate - n < 0) {
    countDownDate = new Date("Oct 12, 2018 00:00:00").getTime();
    type = "entry name";
}

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="counter"
    document.getElementById("counter").innerHTML = days + " hari " + hours + " jam "
    + minutes + " menit " + seconds + " detik ";
    document.getElementById("entry-type").innerHTML = type;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("counter").innerHTML = "0";
    }
}, 1000);