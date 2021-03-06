{include file="header.tpl" title=$lang['用户中心'] hostname=$c['网站名称']}
    <div id="in-nav">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul class="pull-right">
			{if $s['是否已经登陆']=='是'}
              <li>{$lang['欢迎回来']}: {$s['登陆用户名']} / <a href="{$ROOT}/user/index/">{$lang['我的资料']}</a> / <a href="{$ROOT}/index/login/">{$lang['退出帐户']}</a></li>
            {else}
              <li><a href="{$ROOT}/index/login/">{$lang['登陆']}</a>/<a href="{$ROOT}/index/register/">{$lang['注册']}</a></li>
			{/if}
            </ul><a id="logo" href="{$ROOT}/index/index/">
              <h4>{$c['头部LOGO']}</h4></a>
          </div>
        </div>
      </div>
    </div>
    <div id="in-sub-nav">
      <div class="container">
        <div class="row">
          <div class="span12">
            <ul>
              <li><a href="{$ROOT}/index/index/"><i class="batch home"></i><br />{$lang['客户中心']}</a></li>
			  <li><a href="{$ROOT}/control/index/"><i class="batch b-database"></i><br>{$lang['控制面板']}</a></li>
              <li><a href="{$ROOT}/buy/index/"><i class="batch quill"></i><br />{$lang['订购产品']}</a></li>
              <li><a class="active" href="{$ROOT}/user/index/"><i class="batch users"></i><br />{$lang['用户中心']}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="page">
      <div class="page-container">
<div class="container">
  <div class="row">
<div class="span3">
	<div class="profile-sidebar">
		<h4>{$lang['UID']}:{$s['登陆UID']}</h4>
		<p class="pull-right">3.5/5</p>
		<div class="rating-star"></div>
		<div class="rating-star"></div>
		<div class="rating-star"></div>
		<div class="half-star"></div>
		<div class="no-star"></div>
		<ul>
			<li><a href="{$ROOT}/user/index/"><i class="icon-user"> </i>{$lang['个人信息']}</a></li>
			<li><a href="{$ROOT}/user/pay/"><i class="icon-signal"> </i>{$lang['账户充值']}</a></li>
			<li><a href="{$ROOT}/user/password/"><i class="icon-cog"> </i>{$lang['修改密码']}</a></li>
			{$plug['用户页面列表']}
		</ul>
	</div>
</div>
<div class="span6">
	<div class="btn-group pull-right">
	    <a href="{$ROOT}/user/info/" class="btn">{$lang['修改个人信息']}</a>
	</div>
	<h4 class="header">{$lang['用户中心']}</h4>{include file="alert.tpl"}
	<table class="table table-bordered">
		<tbody>
		<tr>
			<th>{$lang['姓名']}</th>
			<td>{$s['登陆姓名']}</td>
		</tr>
		<tr>
			<th>{$lang['国家']}</th>
			<td>{$s['登陆国家']}</td>
		</tr>
		<tr>
			<th>{$lang['地址']}</th>
			<td>{$s['登陆地址']}</td>
		</tr>
		<tr>
			<th>{$lang['邮编']}</th>
			<td>{$s['登陆邮编']}</td>
		</tr>
		<tr>
			<th>{$lang['电话号码']}</th>
			<td>{$s['登陆电话号码']}</td>
		</tr>
		<tr>
			<th>{$lang['电子邮箱']}</th>
			<td>{$s['登陆邮箱']}</td>
		</tr>
		<tr>
			<th>{$lang['预存款']}</th>
			<td>{$s['登陆预存款']} {$c['交易币名称']}</td>
		</tr>
		</tbody>
	</table>
</div>
    <div class="span3">
      <h4>{$lang['快速导航']}</h4>
        <table class="table">
           <tbody>
              <tr><td><a href="{$ROOT}/index/index/"><span class="label label-success">1</span> {$lang['客户中心']}</a></td></tr>
              <tr><td><a href="{$ROOT}/control/index/"><span class="label label-info">2</span> {$lang['控制面板']}</a></td></tr>
			  <tr><td><a href="{$ROOT}/index/announcements/"><span class="label label-warning">3</span> {$lang['公告信息']}</a></td></tr>
			  <tr><td><a href="{$ROOT}/ticket/submit/"><span class="label label-important">4</span> {$lang['提交服务单']}</a></td></tr>
			  <tr><td><a href="{$ROOT}/buy/index/"><span class="label label-info">5</span> {$lang['订购产品']}</a></td></tr>
           </tbody>
        </table>
	  <hr />
	  <h4>{$lang['选择语言']}</h4>
		<form method="post" name="languagefrm" id="languagefrom">
			<select name="language" onchange="languagefrom.submit()">
			  {foreach from=$l item=langs}
			  <option value="{$langs}"{if $langs==$language} selected="selected"{/if}>{$langs}</option>
			  {/foreach}
			</select>
		</form>
    </div>
  </div>
</div>
      </div>
    </div>
{include file="footer.tpl"}