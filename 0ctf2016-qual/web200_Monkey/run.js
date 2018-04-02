//while sleep 1; do phantomjs --ignore-ssl-errors=true --local-to-remote-url-access=true --web-security=false --ssl-protocol=any xss-bot.js; done;
var fs = require('fs');
var system = require('system');
var url = '';
if (system.args.length === 1) {
   console.log('Ussage: '+phantom.scriptName+' url');
} else {
    url = system.args[1];
}

var page = require('webpage').create();
var timeout = 5000;

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
    try{
      fs.write(Math.random(), page.url+"\n\n"+page.content+"\n\n", 'a');  
    }catch(e){console.log(e)}
    setTimeout(function(){
        phantom.exit();
    }, 1000*60*2);
});