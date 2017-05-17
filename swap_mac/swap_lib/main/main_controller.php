<?php  abstract class controller{ public $conn=''; public $config=''; public $c=''; public $lang=''; public $OSWAP_b59487239706386f068f2549a4adfa62=''; public $OSWAP_30b31a94e0c5a437f6c1c6006e473bc5=''; function __construct(){ $GLOBALS['incron']=false; if(file_exists(SWAP_CONFIGS.'compile.txt')) $GLOBALS['swap_mac']['otime']=json_decode(file_get_contents(SWAP_CONFIGS.'compile.txt')); TEMPLATE::assign('alert',array('warning'=>_GET('warning'),'error'=>_GET('error'),'success'=>_GET('success'),'info'=>_GET('info'))); if(RUN_ENV=='SAE'){ $this->config=array('MYSQL_HOST'=>SAE_MYSQL_HOST_M,'MYSQL_NAME'=>SAE_MYSQL_DB,'MYSQL_USER'=>SAE_MYSQL_USER,'MYSQL_PWD'=>SAE_MYSQL_PASS,'MYSQL_PORT'=>SAE_MYSQL_PORT); }else if(RUN_ENV=='BAE'){ if(file_exists(SWAP_CONFIGS.'config.php')) $this->config=require SWAP_CONFIGS.'config.php'; else redirect('/index.php/install/index/'); $this->config['MYSQL_HOST']=HTTP_BAE_ENV_ADDR_SQL_IP; $this->config['MYSQL_USER']=HTTP_BAE_ENV_AK; $this->config['MYSQL_PWD']=HTTP_BAE_ENV_SK; $this->config['MYSQL_PORT']=HTTP_BAE_ENV_ADDR_SQL_PORT; }else if(RUN_ENV=='JAE'){ $this->config=array('MYSQL_HOST'=>JAE_MYSQL_IP,'MYSQL_NAME'=>JAE_MYSQL_DBNAME,'MYSQL_USER'=>JAE_MYSQL_USERNAME,'MYSQL_PWD'=>JAE_MYSQL_PASSWORD,'MYSQL_PORT'=>JAE_MYSQL_PORT); }else{ if(file_exists(SWAP_CONFIGS.'config.php')){ $this->config=require SWAP_CONFIGS.'config.php'; }else redirect('/index.php/install/index/'); } $this->conn=D($this->config); $this->conn->query("select `TABLE_NAME` from `INFORMATION_SCHEMA`.`TABLES` where `TABLE_SCHEMA`='".$this->config['MYSQL_NAME']."' and `TABLE_NAME`='系统配置'"); if($this->conn->fetch_row()==0) redirect('/index.php/install/index/'); $this->c(); if((strstr(get_class($this),'swap_') && get_class($this)!='swap_admin') or get_class($this)=='FileRun'){ if(!file_exists(SWAP_CONFIGS.'install.lock')) redirect('/index.php/install/index/'); $this->conn->select('插件配置','*'); $OSWAP_7073d1c13fb1829eae073a71a399fbb4=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){$OSWAP_7073d1c13fb1829eae073a71a399fbb4[]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e;} foreach($OSWAP_7073d1c13fb1829eae073a71a399fbb4 as $OSWAP_35dc7f635a88728b4d11a1cb0064532b){ $OSWAP_32593a98a91e974a3129c3d9b9a7f64b=$OSWAP_35dc7f635a88728b4d11a1cb0064532b['插件名称']; $OSWAP_7970669be20a9e73202bef5cccbcafe6=$OSWAP_35dc7f635a88728b4d11a1cb0064532b['名']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b][$OSWAP_7970669be20a9e73202bef5cccbcafe6]=$OSWAP_35dc7f635a88728b4d11a1cb0064532b['值']; unset($OSWAP_32593a98a91e974a3129c3d9b9a7f64b,$OSWAP_7970669be20a9e73202bef5cccbcafe6,$OSWAP_35dc7f635a88728b4d11a1cb0064532b); } $this->conn->select('插件','*'); $GLOBALS['swap_mac']['config']['plug']=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){$GLOBALS['swap_mac']['config']['plug'][]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e;} foreach($GLOBALS['swap_mac']['config']['plug'] as $OSWAP_821b637388f0ac7298a6721379641cb0){ if(swap_main_conf_on($OSWAP_821b637388f0ac7298a6721379641cb0['启用'])){ load_plugins_file($OSWAP_821b637388f0ac7298a6721379641cb0['插件名']); } unset($OSWAP_821b637388f0ac7298a6721379641cb0); } $this->conn->select('支付接口','*'); $OSWAP_fd771f3c6ea72a6c21c24654efacca32=array(); $GLOBALS['swap_mac']['config']['plug_pay']=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){$GLOBALS['swap_mac']['config']['plug_pay'][]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e;} foreach($GLOBALS['swap_mac']['config']['plug_pay'] as $OSWAP_821b637388f0ac7298a6721379641cb0){ if(swap_main_conf_on($OSWAP_821b637388f0ac7298a6721379641cb0['启动'])){ $OSWAP_32593a98a91e974a3129c3d9b9a7f64b=$OSWAP_821b637388f0ac7298a6721379641cb0['支付接口名称']; load_plugins_file($OSWAP_32593a98a91e974a3129c3d9b9a7f64b); $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币id']=$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']; if(!isset($OSWAP_fd771f3c6ea72a6c21c24654efacca32[$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']])){ $this->conn->select('货币设置','*',"id='".$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']."'"); $temp=$this->conn->fetch_array(); unset($temp['id']); $OSWAP_fd771f3c6ea72a6c21c24654efacca32[$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']]=$temp; }else{ $temp=$OSWAP_fd771f3c6ea72a6c21c24654efacca32[$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']]; } $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币名称']=$temp['货币名称']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币前缀']=$temp['货币前缀']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币后缀']=$temp['货币后缀']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['交易币汇率']=$temp['交易币汇率']; unset($OSWAP_32593a98a91e974a3129c3d9b9a7f64b,$temp); } unset($OSWAP_821b637388f0ac7298a6721379641cb0); } if(file_exists(SWAP_TEMPLATES_ROOT.DS.'config.php')){ $GLOBALS['swap_mac']['template_config']=@require(SWAP_TEMPLATES_ROOT.DS.'config.php'); if(isset($GLOBALS['swap_mac']['template_config']['static']) && !empty($GLOBALS['swap_mac']['template_config']['static'])){ if(!plug_eva('系统配置','使用本地静态')){ TEMPLATE::assign("templatedir",$GLOBALS['swap_mac']['template_config']['static'],true); } } if(isset($GLOBALS['swap_mac']['template_config']['minsystemver']) && !empty($GLOBALS['swap_mac']['template_config']['minsystemver'])){ if(version_compare(VERSION,$GLOBALS['swap_mac']['template_config']['minsystemver'],'<')){ swap_main_error_module('系统版本不足','当前模版需要更高版本的系统运行'); } } } do_swap_plug('全局运行',$this->conn); do_temp_plug('HEAD区域'); } if(get_class($this)=='swap_admin' and mac_url_get(0)!='rpc'){ $this->conn->select('插件配置','*'); $OSWAP_7073d1c13fb1829eae073a71a399fbb4=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){$OSWAP_7073d1c13fb1829eae073a71a399fbb4[]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e;} foreach($OSWAP_7073d1c13fb1829eae073a71a399fbb4 as $OSWAP_35dc7f635a88728b4d11a1cb0064532b){ $OSWAP_32593a98a91e974a3129c3d9b9a7f64b=$OSWAP_35dc7f635a88728b4d11a1cb0064532b['插件名称']; $OSWAP_7970669be20a9e73202bef5cccbcafe6=$OSWAP_35dc7f635a88728b4d11a1cb0064532b['名']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b][$OSWAP_7970669be20a9e73202bef5cccbcafe6]=$OSWAP_35dc7f635a88728b4d11a1cb0064532b['值']; unset($OSWAP_32593a98a91e974a3129c3d9b9a7f64b,$OSWAP_7970669be20a9e73202bef5cccbcafe6,$OSWAP_35dc7f635a88728b4d11a1cb0064532b); } $OSWAP_a416a4b07b6f280c968f2f3bb53948d5=array(); $this->conn->select('插件','*'); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){$OSWAP_a416a4b07b6f280c968f2f3bb53948d5[]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e;} foreach($OSWAP_a416a4b07b6f280c968f2f3bb53948d5 as $OSWAP_821b637388f0ac7298a6721379641cb0){ if(swap_main_conf_on($OSWAP_821b637388f0ac7298a6721379641cb0['启用'])){ load_plugins_file($OSWAP_821b637388f0ac7298a6721379641cb0['插件名']); } unset($OSWAP_821b637388f0ac7298a6721379641cb0); } $this->conn->select('支付接口','*'); $OSWAP_fd771f3c6ea72a6c21c24654efacca32=array(); $GLOBALS['swap_mac']['config']['plug_pay']=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){$GLOBALS['swap_mac']['config']['plug_pay'][]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e;} foreach($GLOBALS['swap_mac']['config']['plug_pay'] as $OSWAP_821b637388f0ac7298a6721379641cb0){ if(swap_main_conf_on($OSWAP_821b637388f0ac7298a6721379641cb0['启动'])){ $OSWAP_32593a98a91e974a3129c3d9b9a7f64b=$OSWAP_821b637388f0ac7298a6721379641cb0['支付接口名称']; load_plugins_file($OSWAP_32593a98a91e974a3129c3d9b9a7f64b); $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币id']=$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']; if(!isset($OSWAP_fd771f3c6ea72a6c21c24654efacca32[$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']])){ $this->conn->select('货币设置','*',"id='".$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']."'"); $temp=$this->conn->fetch_array(); unset($temp['id']); $OSWAP_fd771f3c6ea72a6c21c24654efacca32[$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']]=$temp; }else{ $temp=$OSWAP_fd771f3c6ea72a6c21c24654efacca32[$OSWAP_821b637388f0ac7298a6721379641cb0['货币id']]; } $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币名称']=$temp['货币名称']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币前缀']=$temp['货币前缀']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['货币后缀']=$temp['货币后缀']; $GLOBALS['swap_mac']['plug_config'][$OSWAP_32593a98a91e974a3129c3d9b9a7f64b]['交易币汇率']=$temp['交易币汇率']; unset($OSWAP_32593a98a91e974a3129c3d9b9a7f64b,$temp); } unset($OSWAP_821b637388f0ac7298a6721379641cb0); } } $this->lang=$GLOBALS['lang']; $this->getlogin(); $this->nologin('index'); $this->nologin('admin'); $this->nologin('plugin'); $this->nologin('buy','index'); if((!$this->nologin()) && strstr(get_class($this),'swap_')) $this->needlogin(); if(get_class($this)=='swap_plugin') $this->main(); } function nologin($OSWAP_2df671901966a96e5152686822545e4d='',$OSWAP_e442be70bdd3a97eec8daa356732ff7b=''){ static $OSWAP_d0a4b2d15999ab7cbaf105f8102ecb9e=array(); if($OSWAP_2df671901966a96e5152686822545e4d==''){ $OSWAP_056e74fcfee629a0932fd34940fa2e1b=$GLOBALS['swap_mac']['c_str']; $OSWAP_dda77d47519f203ed71d4ddcf92a2363=$GLOBALS['swap_mac']['method']; if($OSWAP_d0a4b2d15999ab7cbaf105f8102ecb9e[$OSWAP_056e74fcfee629a0932fd34940fa2e1b][$OSWAP_dda77d47519f203ed71d4ddcf92a2363] || $OSWAP_d0a4b2d15999ab7cbaf105f8102ecb9e[$OSWAP_056e74fcfee629a0932fd34940fa2e1b]['all']) return true; else return false; }else{ if($OSWAP_e442be70bdd3a97eec8daa356732ff7b=='') $OSWAP_e442be70bdd3a97eec8daa356732ff7b='all'; $OSWAP_d0a4b2d15999ab7cbaf105f8102ecb9e[$OSWAP_2df671901966a96e5152686822545e4d][$OSWAP_e442be70bdd3a97eec8daa356732ff7b]=true; return true; } } function c(){ $this->conn->select('系统配置',"*"); $this->c=$this->conn->fetch_array(); if($this->c['伪静态开关']=='0') TEMPLATE::assign('ROOT','/index.php'); else TEMPLATE::assign('ROOT',''); if($this->c['关闭GZIP']) $GLOBALS['swap_mac']['close_gzip']=true; if($this->c['伪静态开关']=='1') WebStatic(true); if($this->c['网站状态']=='1' && $GLOBALS['swap_mac']['c_str']!='admin'){ if(empty($this->c['维护重定向'])) exit(swap_error_temp('当前网站正在维护中','信息:','',$this->c['维护消息'])); else exit(redirect($this->c['维护重定向'])); } if(strtotime($this->c['cron最后执行时间']) < strtotime("-1 days")){ add_swap_plug('全局页面内容','js_run_cron'); }else if($this->c['cron执行完成']!='2' and strtotime($this->c['cron最后执行时间']) < strtotime("-1 hours")){ add_swap_plug('全局页面内容','js_run_cron'); } if(empty($this->c['头部LOGO'])) $this->c['头部LOGO']=$this->c['网站名称']; $GLOBALS['swap_mac']['c']=$this->c; if(($this->c['开启SSL']=='1') and ($GLOBALS['swap_mac']['c_str']!='admin') and ($GLOBALS['swap_mac']['c_str']!='plugin')){ if(!is_ssl()) exit(redirect('https://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"])); } C('MAIL_CHARSET','UTF-8'); C('MAIL_HTML',true); C('MAIL_ADDRESS',$this->c['邮箱地址']); C('MAIL_SMTP',$this->c['SMTP服务器地址']); C('MAIL_LOGINNAME',$this->c['邮箱登录帐号']); C('MAIL_PASSWORD',$this->c['邮箱登录密码']); C('MAIL_AUTH',true); $tempc=$this->c; unset($tempc['安全码'],$tempc['通信码'],$tempc['令牌码'],$tempc['识别码'],$tempc[1],$tempc[2],$tempc[3],$tempc[4],$tempc['邮箱登录帐号'],$tempc['邮箱登录密码'],$tempc['邮箱地址'],$tempc['SMTP服务器地址'],$tempc[28],$tempc[29],$tempc[30],$tempc[31]); TEMPLATE::assign('c',$tempc); $this->country(); } function cakurl(){ return WebStatic(); } function news($OSWAP_fd3294d3be61b407cae98b089032c0e4size=10){ $this->conn->query("select count(*) from 公告"); $OSWAP_f8c16f19236fd4a7fafdc9fe97e2ea1a = $this->conn->fetch_array(); $OSWAP_b5966f537cc8e7710cdb306ca68f8f18rows=$OSWAP_f8c16f19236fd4a7fafdc9fe97e2ea1a[0]; $OSWAP_fd3294d3be61b407cae98b089032c0e4s=intval($OSWAP_b5966f537cc8e7710cdb306ca68f8f18rows/$OSWAP_fd3294d3be61b407cae98b089032c0e4size); if((mac_url_get(1)!='')and(!strstr(mac_url_get(1),'?'))){ $OSWAP_fd3294d3be61b407cae98b089032c0e4=mac_url_get(1); }else{ $OSWAP_fd3294d3be61b407cae98b089032c0e4=1; } $t=array(); $t['总页数']=$OSWAP_fd3294d3be61b407cae98b089032c0e4s+1; $t['当前页数']=$OSWAP_fd3294d3be61b407cae98b089032c0e4; if($OSWAP_fd3294d3be61b407cae98b089032c0e4==1){ $t['上一页连接']='javascript:return false;'; }else{ $t['上一页连接']=$this->cakurl().'/index/announcements/'.($OSWAP_fd3294d3be61b407cae98b089032c0e4-1).'/'; } if(($OSWAP_fd3294d3be61b407cae98b089032c0e4==($OSWAP_fd3294d3be61b407cae98b089032c0e4s+1))or($OSWAP_fd3294d3be61b407cae98b089032c0e4s=='0')){ $t['下一页连接']='javascript:return false;'; }else{ $t['下一页连接']=$this->cakurl().'/index/announcements/'.($OSWAP_fd3294d3be61b407cae98b089032c0e4+1).'/'; } TEMPLATE::assign('t',$t); $OSWAP_8e5fe8b0072876b7292728c12d5c33ee=$OSWAP_fd3294d3be61b407cae98b089032c0e4size*($OSWAP_fd3294d3be61b407cae98b089032c0e4 - 1); $this->conn->query("select * from 公告 order by 公告ID desc limit $OSWAP_8e5fe8b0072876b7292728c12d5c33ee,$OSWAP_fd3294d3be61b407cae98b089032c0e4size"); $OSWAP_2cf1b90afc6b200d75f0b6e6629437d8 =array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){ $OSWAP_2cf1b90afc6b200d75f0b6e6629437d8[]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e; } TEMPLATE::assign('news',$OSWAP_2cf1b90afc6b200d75f0b6e6629437d8); } function anew($id){ if($id=='') redirect($this->cakurl().'/index/announcements/'); $this->conn->select('公告','*',"公告ID='$id'"); if($this->conn->db_num_rows()==0) redirect($this->cakurl().'/index/announcements/'); $OSWAP_2cf1b90afc6b200d75f0b6e6629437d8 =$this->conn->fetch_array(); TEMPLATE::assign('e',$OSWAP_2cf1b90afc6b200d75f0b6e6629437d8); } function getuid(){ $this->OSWAP_b59487239706386f068f2549a4adfa62=User::Uid(); return $this->OSWAP_b59487239706386f068f2549a4adfa62; } function getlogin(){ $OSWAP_b59487239706386f068f2549a4adfa62=User::Uid(); if($OSWAP_b59487239706386f068f2549a4adfa62==''){ $s=array('是否已经登陆'=>'否'); TEMPLATE::assign('s',$s); }else{ $s=User::Info($OSWAP_b59487239706386f068f2549a4adfa62); if(!$s) $this->cleanlogin(); if($s['禁止']=='1'){ session('uid',NULL); redirect($this->cakurl().'/index/login/?error='.$this->lang['error']['您的账户已经被禁止登入']); } $s=array( '是否已经登陆'=>'是', '登陆用户名'=>$s['用户名'], '登陆姓名'=>$s['姓名'], '登陆地址'=>$s['地址'], '登陆国家'=>$s['国家'], '登陆邮箱'=>$s['电子邮件'], '登陆UID'=>$s['uid'], '登陆邮编'=>$s['邮编'], '登陆电话号码'=>$s['电话号码'], '登陆预存款'=>$s['预存款'], '登陆注册时间'=>$s['注册时间'], ); $this->OSWAP_30b31a94e0c5a437f6c1c6006e473bc5=$s; TEMPLATE::assign('s',$s); } } function cleanlogin(){ return User::Out(); } function cakelogin(){ $swapname=_POST('swapname'); if($swapname!=''){ $this->conn->select('用户','*',"(用户名='$swapname' or 电子邮件='$swapname') and (密码='".md5('swap'._POST('swappass'))."' or 密码=PASSWORD('"._POST('swappass')."') or 密码=OLD_PASSWORD('"._POST('swappass')."'))"); if($this->conn->db_num_rows()==0){ redirect($this->cakurl().'/index/login/?error='.$this->lang['login']['登陆失败提示']); }else{ $s=$this->conn->fetch_array(); session('uid',$s['uid']); do_swap_plug('登陆成功',$s); if(_GET('referer')=='') redirect($this->cakurl().'/index/index/?success='.$this->lang['login']['登陆成功提示']); else{ if(strstr(_GET('referer'),'?')){ redirect(_GET('referer').'&success='.$this->lang['login']['登陆成功提示']); }else{ redirect(_GET('referer').'?success='.$this->lang['login']['登陆成功提示']); } } } exit; } } function IsUsername($OSWAP_b83e77ca6f774009623a2dbf3dddc10d){ return IsUsername($OSWAP_b83e77ca6f774009623a2dbf3dddc10d); } function IsMail($OSWAP_4a6f164ef3c908fa9e5fd8ffecc9b706){ return IsMail($OSWAP_4a6f164ef3c908fa9e5fd8ffecc9b706); } function IsSame($OSWAP_cc4fe95dec9571fdfcb7533ce5f19827,$OSWAP_09d585d2cfd5623f376bfd25ce2969a8,$OSWAP_7eacd8d59452107c18a53464016335cf=false){ return IsSame($OSWAP_cc4fe95dec9571fdfcb7533ce5f19827,$OSWAP_09d585d2cfd5623f376bfd25ce2969a8,$OSWAP_7eacd8d59452107c18a53464016335cf); } function needlogin(){ $OSWAP_b59487239706386f068f2549a4adfa62=$this->getuid(); if($OSWAP_b59487239706386f068f2549a4adfa62==''){ redirect($this->cakurl().'/index/login/?info='.$this->lang['login']['需要登陆提示']); } } function setbuycp($dq=0){ $this->conn->select('产品','*',"分类id='".$dq."' and 隐藏=0 order by 顺序 desc"); $OSWAP_1d38f23bd78772c1aad2e5eea428da49=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){ if(strstr($OSWAP_51d4cad9672e6605c99e0c3d678f456e['周期'],'[')){ $OSWAP_51d4cad9672e6605c99e0c3d678f456e['周期']=json_decode($OSWAP_51d4cad9672e6605c99e0c3d678f456e['周期'],true); $temp=array(); foreach($OSWAP_51d4cad9672e6605c99e0c3d678f456e['周期'] as $OSWAP_6291cc79354613208317e7b10b238055=>$OSWAP_0d07de59261cc2c9023b194184c575fb){ if($OSWAP_0d07de59261cc2c9023b194184c575fb['启用']) $temp[$OSWAP_6291cc79354613208317e7b10b238055]=$OSWAP_0d07de59261cc2c9023b194184c575fb; } $OSWAP_51d4cad9672e6605c99e0c3d678f456e['周期']=$temp; } $OSWAP_1d38f23bd78772c1aad2e5eea428da49[]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e; } TEMPLATE::assign('buys',$OSWAP_1d38f23bd78772c1aad2e5eea428da49); } function setbuyfl(&$OSWAP_4c31c7e36ba871dcf8b7aded1e15f34b=''){ $this->conn->select('产品分类','*',"隐藏='0' order by 顺序 desc"); $OSWAP_1275d0f9f897f35950d781f72551b701=array(); while($OSWAP_51d4cad9672e6605c99e0c3d678f456e = $this->conn->fetch_assoc()){ $OSWAP_1275d0f9f897f35950d781f72551b701[]=$OSWAP_51d4cad9672e6605c99e0c3d678f456e; } $dq=mac_url_get(1); if($dq==''){ $dq=$OSWAP_1275d0f9f897f35950d781f72551b701[0]['id']; } $f=''; $tempnum=0; $OSWAP_22f15b232c6e5d0abe34c576702d8718=array(); foreach($OSWAP_1275d0f9f897f35950d781f72551b701 as $temp){ if($tempnum!=0) $f .=' | '; if($dq==$temp['id']){ $f .=$temp['分类名称']; $OSWAP_22f15b232c6e5d0abe34c576702d8718[]=array('id'=>$temp['id'],'分类名称'=>$temp['分类名称'],'选中'=>1,'类型'=>$temp['类型'],'备注'=>$temp['备注']); }else{ $f .='<a href="'.$this->cakurl().'/buy/index/'.$temp['id'].'/">'.$temp['分类名称'].'</a>'; $OSWAP_22f15b232c6e5d0abe34c576702d8718[]=array('id'=>$temp['id'],'分类名称'=>$temp['分类名称'],'选中'=>0,'类型'=>$temp['类型'],'备注'=>$temp['备注']); } $tempnum++; } TEMPLATE::assign('farray',$OSWAP_22f15b232c6e5d0abe34c576702d8718); TEMPLATE::assign('f',$f); $OSWAP_4c31c7e36ba871dcf8b7aded1e15f34b=$dq; return $dq; } function country(){ $OSWAP_02a174390636458eba5900a1013ff7bd=array('Afghanistan','Aland Islands','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla','Antarctica','Antigua And Barbuda','Argentina','Armenia','Aruba','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia And Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean Territory','Brunei Darussalam','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Cape Verde','Cayman Islands','Central African Republic','Chad','Chile','China','Christmas Island','Cocos (Keeling) Islands','Colombia','Comoros','Congo','Congo, Democratic Republic','Cook Islands','Costa Rica','Cote D&#39;Ivoire','Croatia','Cuba','Curacao','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Falkland Islands (Malvinas)','Faroe Islands','Fiji','Finland','France','French Guiana','French Polynesia','French Southern Territories','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala','Guernsey','Guinea','Guinea-Bissau','Guyana','Haiti','Heard Island & Mcdonald Islands','Holy See (Vatican City State)','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran, Islamic Republic Of','Iraq','Ireland','Isle Of Man','Israel','Italy','Jamaica','Japan','Jersey','Jordan','Kazakhstan','Kenya','Kiribati','Korea','Kuwait','Kyrgyzstan','Lao People&#39;s Democratic Republic','Latvia','Lebanon','Lesotho','Liberia','Libyan Arab Jamahiriya','Liechtenstein','Lithuania','Luxembourg','Macao','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico','Micronesia, Federated States Of','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Myanmar','Namibia','Nauru','Nepal','Netherlands','Netherlands Antilles','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island','Northern Mariana Islands','Norway','Oman','Pakistan','Palau','Palestinian Territory, Occupied','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn','Poland','Portugal','Puerto Rico','Qatar','Reunion','Romania','Russian Federation','Rwanda','Saint Barthelemy','Saint Helena','Saint Kitts And Nevis','Saint Lucia','Saint Martin','Saint Pierre And Miquelon','Saint Vincent And Grenadines','Samoa','San Marino','Sao Tome And Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Georgia And Sandwich Isl.','Spain','Sri Lanka','Sudan','Suriname','Svalbard And Jan Mayen','Swaziland','Sweden','Switzerland','Syrian Arab Republic','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tokelau','Tonga','Trinidad And Tobago','Tunisia','Turkey','Turkmenistan','Turks And Caicos Islands','Tuvalu','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','United States Outlying Islands','Uruguay','Uzbekistan','Vanuatu','Venezuela','Viet Nam','Virgin Islands, British','Virgin Islands, U.S.','Wallis And Futuna','Western Sahara','Yemen','Zambia','Zimbabwe'); TEMPLATE::assign('countrys',$OSWAP_02a174390636458eba5900a1013ff7bd); return $OSWAP_02a174390636458eba5900a1013ff7bd; } } class FileRoute{ static function start($OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7){ if(strstr($OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7,'?')): $OSWAP_596ebd3e867c668a94899980cc01bddf=explode('?',$OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7); $OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7=$OSWAP_596ebd3e867c668a94899980cc01bddf[0]; endif; if(strstr($OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7,'/index.php')): $OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7=str_replace('/index.php','',$OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7); endif; if(file_exists(SWAP_TEMPLATES_ROOT.DS.'public'.$OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7.'.tpl')): $GLOBALS['swap_mac']['controller']=new FileRun; $GLOBALS['swap_mac']['controller']->Start($OSWAP_1e2beaaf00b82e3bbe8c2179bcd53ed7); exit(); endif; return false; } } class FileRun extends controller{ function start($OSWAP_4bc309caf8c2e5f271253a12e5db051c){ TEMPLATE::display('public'.$OSWAP_4bc309caf8c2e5f271253a12e5db051c.'.tpl',true,$OSWAP_4bc309caf8c2e5f271253a12e5db051c); return true; } } 