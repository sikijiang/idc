<style type="text/css">
/*tip message start*/
.tip_message,.tip_message .tip_ico_succ,.tip_message .tip_ico_fail,.tip_message .tip_ico_hits,.tip_message .tip_content,.tip_message .tip_end{ background-image:url({$templatedir}/js/tip_message.png);_background-image:url({$templatedir}/js/tip_message_ie6.png);color:#606060;float:left;font-size:14px;font-weight:bold;height:54px;line-height:54px;}
.tip_message{ display:none;background:none;position:absolute;font-family:Arial,Simsun,"Arial Unicode MS",Mingliu,Helvetica;font-size:14px;}
.tip_message .tip_ico_succ
{ background-position:-6px 0;background-repeat:no-repeat;width:45px;}
.tip_message .tip_ico_fail{ background-position:-6px -108px;background-repeat:no-repeat;width:45px;}
.tip_message .tip_ico_hits{ background-position:-6px -54px;background-repeat:no-repeat;width:45px;}
.tip_message .tip_end{ background-position:0 0;background-repeat:no-repeat;width:6px;}
.tip_content{ background-position:0 -161px;background-repeat:repeat-x;padding:0 20px 0 8px; word-break:keep-all;white-space:nowrap;}
.tip_message .tip_message_content{ position:absolute; left:0; top:0; width:100%;height:100%;z-index:65530;}
.ie6_mask{ position:absolute; left:0; top:0; width:100%;height:100%;background-color:transparent;z-index:-1;filter:alpha(opacity=0);}
/* tip message end */
</style>
{if $alert['warning'] != ""}
<script type="text/javascript">
$.tipMessage('<strong>{$lang["警告"]}: </strong>{$alert["warning"]}',2 , 5000);
</script>
{/if}
{if $alert['error'] != ""}
<script type="text/javascript">
$.tipMessage('<strong>{$lang["错误"]}: </strong>{$alert["error"]}', 2, 5000);
</script>
{/if}
{if $alert['success'] != ""}
<script type="text/javascript">
$.tipMessage('<strong>{$lang["成功"]}: </strong>{$alert["success"]}',3 , 5000);
</script>
{/if}
{if $alert['info'] != ""}
<script type="text/javascript">
$.tipMessage(' <strong>{$lang["信息"]}: </strong>{$alert["info"]}', 1, 5000);
</script>
{/if}