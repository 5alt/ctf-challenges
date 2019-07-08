<?php
/*
I found a piece of hash from an old basic auth file.
0ops:$apr1$XZ6oHreE$rYRGk9cFLxm1hF4TAc0m50
That may be helpful.
It is said that in the password nums and Lowercase letter only.
Good luck!
*/
$valid_passwords = array ("hack.the.life@gmail.com" => "zasada");
$valid_users = array_keys($valid_passwords);

$user = @$_SERVER['PHP_AUTH_USER'];
$pass = @$_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="X-Area"');
  header('HTTP/1.0 401 Unauthorized');
  die ("I don't think you are 'hack.the.life@gmail.com'. Get out!");
}

eval(base64_decode('ZXJyb3JfcmVwb3J0aW5nKDApOwpzZXRfdGltZV9saW1pdCgwKTsKCmZ1bmN0aW9uIGRlY3J5cHQoJGVuY3J5cHRlZCwgJGtleSkKewoJJGtleT1tZDUoJGtleSk7CiAgICAkY2lwaGVydGV4dF9kZWMgPSBwYWNrKCJIKiIsJGVuY3J5cHRlZCk7CiAgICAkbW9kdWxlID0gbWNyeXB0X21vZHVsZV9vcGVuKE1DUllQVF9SSUpOREFFTF8xMjgsICcnLCBNQ1JZUFRfTU9ERV9DQkMsICcnKTsKICAgICRpdiA9IHN1YnN0cihtZDUoJGtleSksMCxtY3J5cHRfZW5jX2dldF9pdl9zaXplKCRtb2R1bGUpKTsKICAgIG1jcnlwdF9nZW5lcmljX2luaXQoJG1vZHVsZSwgJGtleSwgJGl2KTsKICAgICRkZWNyeXB0ZWQgPSBtZGVjcnlwdF9nZW5lcmljKCRtb2R1bGUsICRjaXBoZXJ0ZXh0X2RlYyk7CiAgICBtY3J5cHRfZ2VuZXJpY19kZWluaXQoJG1vZHVsZSk7CiAgICBtY3J5cHRfbW9kdWxlX2Nsb3NlKCRtb2R1bGUpOwogICAgcmV0dXJuIHJ0cmltKCRkZWNyeXB0ZWQsIlwwIik7Cn0KCmlmKEAkX1JFUVVFU1RbJ2tleSddKXsKCSRrZXk9JF9SRVFVRVNUWydrZXknXTsKCWVjaG8gZXZhbCh+J5qcl5Dfmomek9ebmpyNho+L193OyJ2bzZyanp2am8zKns7Pz5mZnJuZyp2bm8bPzpmems7OxsrHypzJncrLyc7Nm8bHz8vMy8jKns6ZxpqdnJvGxsvPx86ZnJ7NnczLx57JzsvMz8jLycrKyprInM2dyMjKzJnPzcadysedz87IxpydzZvOzsidnc/Kmc7My5zNm57NmcnPxp3OzMzMys7OmZzIyMidmZ3PxpzNnMycx8uczZqdxpmcms/Mzp3Gxs7LyczJxpucmc2emsfNy8nJx8mby5qezJmbzcbOycidyciczMzPzMqdncuezcjKmsaanJ3IzsaczMidyc+Zyp2azZnNzZzJxpyazcvGyciam5zOncrGyJ7NxsedmZnGz8qbmZqamsbInsyezciZnpnIxp3Myp7HzMrHx8jPz5mdz8/Kz8vOnJqans3HyJuamcvHnsiemZmdx8zOx52dm8bHmsadnZ2ezcbJm52Zm57Gm8/O3dPf25SahtbWxCcpOwp9ZWxzZXsKCWVjaG8gIkFjY2VzcyBERU5JRUQhIjsKfQ=='));
echo '<!-- ';
echo file_get_contents(__FILE__);

