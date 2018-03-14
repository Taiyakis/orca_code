function countdown(){
    var data = document.getElementById("delete").innerHTML;
    var countDownDate = new Date(data).getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();
            
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        var timeleft = seconds + " s."
        if(minutes > 0) {
            timeleft = minutes + " m. " + timeleft;
            if(hours > 0) {
                timeleft = hours + " h. " + timeleft;
                if(days > 0) {
                    timeleft = days + " d. " + timeleft;
                }
            }
        }

        document.getElementById("time").innerHTML = timeleft;

        if (distance < 0) {
            document.getElementById("time").innerHTML = "EXPIRED";
            document.cookie = "timeExpired=1"; 
            window.location.href = '/';
        }
    }, 1000);
}