//while sleep 1; do phantomjs --ignore-ssl-errors=true --local-to-remote-url-access=true --web-security=false --ssl-protocol=any xss-bot.js; done;
var system = require('system');
var url = '';
if (system.args.length === 1) {
   console.log('Ussage: '+phantom.scriptName+' url');
} else {
    url = system.args[1];
}

var page = require('webpage').create();
var timeout = 3000;

phantom.addCookie({
  'name'     : 'flag',   /* required property */
  'value'    : '0ctf{httponly_sometimes_not_so_secure}',  /* required property */
  'domain'   : '127.0.0.1',
  'path'     : '/',                /* required property */
  'httponly' : true,
  'secure'   : false,
  'expires'  : (new Date()).getTime() + (1000 * 60 * 60)   /* <-- expires in 1 hour */
});
phantom.addCookie({
  'name'     : 'admin',   /* required property */
  'value'    : 'salt_is_admin',  /* required property */
  'domain'   : '127.0.0.1',
  'path'     : '/',                /* required property */
  'httponly' : true,
  'secure'   : false,
  'expires'  : (new Date()).getTime() + (1000 * 60 * 60)   /* <-- expires in 1 hour */
});


page.settings.userAgent = "Mozilla/5.0 0CTF by md5_salt";
page.settings.XSSAuditingEnabled = true

page.onNavigationRequested = function(url, type, willNavigate, main) {
    console.log("[URL] URL="+url);  
};
 
page.settings.resourceTimeout = timeout;
page.onResourceTimeout = function(e) {
    setTimeout(function(){
        console.log("[INFO] Timeout")
        phantom.exit();
    }, 1);
};

page.open(url, function(status) {
    console.log("[INFO] rendered page");
    phantom.exit();
});
