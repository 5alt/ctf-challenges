//<?php die();?>
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
  'name'     : 'username',   /* required property */
  'value'    : 'admin',  /* required property */
  'domain'   : 'admin.government.vip',
  'path'     : '/',                /* required property */
  'httponly' : false,
  'secure'   : false,
  'expires'  : (new Date()).getTime() + (1000 * 60 * 60)   /* <-- expires in 1 hour */
});
phantom.addCookie({
  'name'     : 'admin_secret',   /* required property */
  'value'    : 'md5_salt_is_the_real_admin',  /* required property */
  'domain'   : 'admin.government.vip',
  'path'     : '/',                /* required property */
  'httponly' : true,
  'secure'   : false,
  'expires'  : (new Date()).getTime() + (1000 * 60 * 60)   /* <-- expires in 1 hour */
});


page.settings.userAgent = "Mozilla/5.0 Chrome for 0ctf2017 by md5_salt";
page.settings.XSSAuditingEnabled = true

page.onConsoleMessage = function(msg) {
  console.log(msg);
};

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
    setTimeout(function(){
        console.log("[INFO] Timeout")
        phantom.exit();
    }, timeout);
});
