<?php  defined('SWAP_ROOT') or die('非法操作'); class paypal extends controller { function config(){ return array( 'swap_no_login' => array( 'notify_url'=>'1', 'admin'=>'1', ), 'index' => '1', 'return_url'=>'1', 'return_url'=>'1', 'notify_url'=>'0', 'admin'=>'0', ); } function index(){ global $swap_mac; $OSWAP_d239fd1af65c3fb3883055769189a5db = _POST('money'); if($OSWAP_d239fd1af65c3fb3883055769189a5db=='') exit(redirect('/index.php/user/pay/?warning='.$this->lang['金额不能为空'])); if(!preg_match("/^[0-9]+(.[0-9]{1,2})?$/",$OSWAP_d239fd1af65c3fb3883055769189a5db)) exit(redirect('/index.php/user/pay/?warning='.$this->lang['请输入一个正确金额数值'])); if($OSWAP_d239fd1af65c3fb3883055769189a5db=='0') exit(redirect('/index.php/user/pay/?warning='.$this->lang['金额不能为0'])); $this->conn->insert('支付接口日志','支付接口,时间,uid,动作',"'paypal',NOW(),'".$this->getuid()."','请求存款操作,存入".$OSWAP_d239fd1af65c3fb3883055769189a5db."元'"); $this->conn->free(); $this->conn->insert('审核订单','uid,时间,总价,支付网关,状态',"'".$this->getuid()."',NOW(),'".$OSWAP_d239fd1af65c3fb3883055769189a5db."','paypal','创建订单'"); $OSWAP_76e3cee3ed489a385557cac6bbbfb894 = $this->conn->getid(); $OSWAP_c03c32ceb2a1466f4343af7e6be8904b=$swap_mac['c']['网站名称']; $OSWAP_654afc597723bb74f88f8bd4598728d7 = plug_eva('paypal','paypal帐户'); $OSWAP_cf23142c96944e0cb5a0b94c76aa81ea = plug_eva('paypal','sandbox调试模式'); $OSWAP_6c8497b835d96b0d45ad347d7405bc7c=plug_eva('paypal','货币后缀'); if($OSWAP_cf23142c96944e0cb5a0b94c76aa81ea){ $OSWAP_a1837c79b3342f83c71c6b2bdf8f02df='https://www.sandbox.paypal.com/cgi-bin/webscr'; }else{ $OSWAP_a1837c79b3342f83c71c6b2bdf8f02df='https://www.paypal.com/cgi-bin/webscr'; } $OSWAP_14b6919398592a498129c5c47b5b3710="http://".$_SERVER['SERVER_NAME']."/index.php/plugin/paypal/return_url/"; $OSWAP_71c4799abbfb141b04dec04d0f6eca94="http://".$_SERVER['SERVER_NAME']."/index.php/plugin/paypal/notify_url/"; $OSWAP_9c318328f7a4450c1f709bc97f0da5b1="http://".$_SERVER['SERVER_NAME']."/index.php/user/pay/?warning=".$this->lang['您并没有完成付款']; $OSWAP_0c9a59ff26cda98ac90ccdf4885010d9=<<<SWAP
<form action="{$OSWAP_a1837c79b3342f83c71c6b2bdf8f02df}" name="paypalform" method="post">
<input type="hidden" name="business" value="{$OSWAP_654afc597723bb74f88f8bd4598728d7}">
<input type="hidden" name="item_name" value="{$OSWAP_c03c32ceb2a1466f4343af7e6be8904b}充值账单">
<input type="hidden" name="amount" value="{$OSWAP_d239fd1af65c3fb3883055769189a5db}">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="return"  value="{$OSWAP_14b6919398592a498129c5c47b5b3710}">
<input type="hidden" name="cancel_return" value="{$OSWAP_9c318328f7a4450c1f709bc97f0da5b1}">
<input type="hidden" name="custom" value="{$OSWAP_76e3cee3ed489a385557cac6bbbfb894}">
<input type="hidden" name="notify_url" value="{$OSWAP_71c4799abbfb141b04dec04d0f6eca94}">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="currency_code" value="{$OSWAP_6c8497b835d96b0d45ad347d7405bc7c}">
<input type="hidden" name="charset" value="utf-8" />
<input type="hidden" name="rm" value="1" />
</form>
<script type="text/javascript">
document.paypalform.submit();
</script>
SWAP;
 TEMPLATE::display('create.tpl'); echo $OSWAP_0c9a59ff26cda98ac90ccdf4885010d9; } function notify_url(){ $OSWAP_e95f26c69a0d8ccfd9481b237bc9f4af = $_POST; $OSWAP_cf23142c96944e0cb5a0b94c76aa81ea = plug_eva('paypal','sandbox调试模式'); if($OSWAP_cf23142c96944e0cb5a0b94c76aa81ea) $OSWAP_a1837c79b3342f83c71c6b2bdf8f02df = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; else $OSWAP_a1837c79b3342f83c71c6b2bdf8f02df = 'https://www.paypal.com/cgi-bin/webscr'; $OSWAP_3330772e9d75a342c671803db44f9a93 = curl_init(); curl_setopt_array($OSWAP_3330772e9d75a342c671803db44f9a93,array( CURLOPT_URL => $OSWAP_a1837c79b3342f83c71c6b2bdf8f02df, CURLOPT_POST => TRUE, CURLOPT_POSTFIELDS => http_build_query(array('cmd' => '_notify-validate') + $OSWAP_e95f26c69a0d8ccfd9481b237bc9f4af), CURLOPT_RETURNTRANSFER => TRUE, CURLOPT_HEADER => FALSE, CURLOPT_SSL_VERIFYPEER => FALSE, CURLOPT_SSL_VERIFYHOST => TRUE )); $OSWAP_720304cb750b15e593e53dcc4d9f29a1 = curl_exec($OSWAP_3330772e9d75a342c671803db44f9a93); $OSWAP_d2a6f77542f5300984fb6fcf1018c1c0 = curl_getinfo($OSWAP_3330772e9d75a342c671803db44f9a93, CURLINFO_HTTP_CODE); curl_close($OSWAP_3330772e9d75a342c671803db44f9a93); if($OSWAP_d2a6f77542f5300984fb6fcf1018c1c0 == 200 && $OSWAP_720304cb750b15e593e53dcc4d9f29a1 == 'VERIFIED'){ $this->conn->select('审核订单',"*","id='".$OSWAP_e95f26c69a0d8ccfd9481b237bc9f4af['custom']."'"); $OSWAP_3561b4481f052c5d76cfd76150e98bf6 = $this->conn->fetch_array(); $this->conn->free(); $this->conn->select('用户',"*","uid='".$OSWAP_3561b4481f052c5d76cfd76150e98bf6['uid']."'"); $OSWAP_567131e0923d203059eb3ba75ab4d88b = $this->conn->fetch_array(); $OSWAP_fb236ff1984974f93f2b5de316731dee=plug_eva('paypal','交易币汇率'); $this->conn->update('用户',"预存款='".((float)$OSWAP_567131e0923d203059eb3ba75ab4d88b['预存款']+((float)$OSWAP_3561b4481f052c5d76cfd76150e98bf6['总价']*(float)$OSWAP_fb236ff1984974f93f2b5de316731dee))."'","uid='".$OSWAP_3561b4481f052c5d76cfd76150e98bf6['uid']."'"); $this->conn->update('审核订单',"状态='充值完成'","id='".$OSWAP_e95f26c69a0d8ccfd9481b237bc9f4af['custom']."'"); die('ok'); }else{ die('fail'); } } function return_url(){ TEMPLATE::display('TRADE_FINISHED.tpl'); } function admin() { need_admin(); $OSWAP_5b8e468cbb0283abce06f8edbfdecfb7="paypal"; $OSWAP_c15aedfba42147dee0a56fdc5db1a04f="PayPal支付设置"; $OSWAP_3aa199701c56c8e64a3e83370c62ceee=mac_url_get(1); if($OSWAP_3aa199701c56c8e64a3e83370c62ceee==""){$OSWAP_3aa199701c56c8e64a3e83370c62ceee="list";} $id="";$id=mac_url_get(2); $ok="";$ok=mac_url_get(3); $OSWAP_f748700cf8005a043bf0854fe3157a10 =array( array('paypal帐户','text','您的paypal帐户'), array('sandbox调试模式','yesno','开启sandbox调试模式') ); if($OSWAP_3aa199701c56c8e64a3e83370c62ceee=="editok"){ foreach( $OSWAP_f748700cf8005a043bf0854fe3157a10 as $OSWAP_685c5aa26d745bef96c4640bf5943640 => $OSWAP_01052e6ae0487eca14c7f31178a61948){plug_eva($OSWAP_5b8e468cbb0283abce06f8edbfdecfb7,$OSWAP_01052e6ae0487eca14c7f31178a61948[0],_POST($OSWAP_01052e6ae0487eca14c7f31178a61948[0]));} die("修改完成ok"); } AdminT::header($OSWAP_c15aedfba42147dee0a56fdc5db1a04f, ''); AdminT::search(); echo '<main class="page-content content-wrap">'; AdminT::navbar(); AdminT::sidebar(); echo '<div class="page-inner">'; AdminT::title($OSWAP_c15aedfba42147dee0a56fdc5db1a04f, '<li>网站设置</li>'); ?>	
<div id="main-wrapper" class="container"><div class="row"><div class="col-md-12"><div class="panel panel-primary"><div class="panel-body"><form role="form" id="settingfrom" class="form-horizontal form-groups-bordered">

<?php
 foreach( $OSWAP_f748700cf8005a043bf0854fe3157a10 as $OSWAP_685c5aa26d745bef96c4640bf5943640 => $OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c){ $OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[3]=plug_eva($OSWAP_5b8e468cbb0283abce06f8edbfdecfb7,$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[0]); if($OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[1]=='text'){ $OSWAP_1e6ea0ea7bd7bd338bfb5c6f6ab2b495="<input type=\"{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[1]}\" value=\"{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[3]}\" name=\"{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[0]}\" class=\"form-control\">"; }elseif($OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[1]=='yesno' ){ if($OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[3]=='on'){$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c['yes_yesno']='checked="checked"';} else{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c['no_yesno']='checked="checked"';} $OSWAP_1e6ea0ea7bd7bd338bfb5c6f6ab2b495="<label><input type=\"radio\" name=\"{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[0]}\" value=\"on\"{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c['yes_yesno']}/ >是 </label><label><input type=\"radio\" name=\"{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[0]}\" value=\"off\" {$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c['no_yesno']} />否</label> "; }else{$OSWAP_1e6ea0ea7bd7bd338bfb5c6f6ab2b495="{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[1]}-{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[3]}";} echo("<div class=\"form-group\"><label class=\"col-sm-3 control-label\">{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[0]}</label><div class=\"col-sm-5\">{$OSWAP_1e6ea0ea7bd7bd338bfb5c6f6ab2b495}{$OSWAP_117fa5d6e8f9828a619e57c63f2e6b1c[2]}</div></div>"); } ?> <div class="form-group"><div class="col-sm-offset-3 col-sm-5"><a href="javascript:void(0)" onclick="$.post('/index.php/plugin/<?php echo $OSWAP_5b8e468cbb0283abce06f8edbfdecfb7 ;?>/admin/editok/',$('#settingfrom').serialize(),function(data){if(data.match('ok')=='ok') swap_alert('success','保存成功',data); else swap_alert('error','保存失败',data);});" class="btn btn-success">保存更改</a></div></div></form></div></div></div></div></div></div><?php
 AdminT::page_footer(); echo '</div></main>'; AdminT::cd_nav(); AdminT::pjs(); echo '<script src="/admin_assets/plugins/waypoints/jquery.waypoints.min.js"></script><script src="/admin_assets/plugins/jquery-counterup/jquery.counterup.min.js"></script><script src="/admin_assets/plugins/toastr/toastr.min.js"></script><script src="/admin_assets/plugins/flot/jquery.flot.min.js"></script><script src="/admin_assets/plugins/flot/jquery.flot.time.min.js"></script><script src="/admin_assets/plugins/flot/jquery.flot.symbol.min.js"></script><script src="/admin_assets/plugins/flot/jquery.flot.resize.min.js"></script><script src="/admin_assets/plugins/flot/jquery.flot.tooltip.min.js"></script><script src="/admin_assets/plugins/curvedlines/curvedLines.js"></script><script src="/admin_assets/plugins/metrojs/MetroJs.min.js"></script><script src="/admin_assets/plugins/morris/raphael.min.js"></script><script src="/admin_assets/plugins/morris/morris.min.js"></script><script src="/admin_assets/js/modern.min.js"></script><script src="/admin_assets/plugins/datatables/js/jquery.dataTables.min.js"></script><script>var extable;$(document).ready(function() {extable=$(\'#example\').DataTable({"language":{"url":"https://cdn.datatables.net/plug-ins/e9421181788/i18n/Chinese.json"}});});</script></body></html>'; } } 