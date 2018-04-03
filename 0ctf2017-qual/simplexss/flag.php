<?php

if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '202.120.7.204'){
	echo 'flag{th1s_is_fr0m_a_re4l_cas3}';
}else{
	echo 'Only ip from this host is allowed';
}
