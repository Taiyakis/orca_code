function deleteCookie()
{
    var myCookie = document.cookie.replace(/(?:(?:^|.*;\s*)timeExpired\s*\=\s*([^;]*).*$)|^.*$/, "$1");

    if(myCookie == "1")
    {
        document.getElementById("alerts").innerHTML = '<div class="alert"><h4>Žinutės galiojimo laikas baigėsi</h4></div>';
        document.cookie = "timeExpired=0"; 
    }
}