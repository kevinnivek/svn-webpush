<?

$sites[] = array(
"name" => "Site A",
"url" => "http://site-a.server.com",
"path" => "/usr/local/www/site-a.server.com",
"source" => "svn://svn.server.com/repository/branches/site-a",
"login" => "svnlogin",
"base" => "1.00",
"notes" => "Standard build for Site A"
);

"name" => "Site B",
"url" => "http://site-b.server.com",
"path" => "/usr/local/www/site-b.server.com",
"source" => "svn://svn.server.com/repository/branches/site-b",
"login" => "svnlogin",
"base" => "1.00",
"notes" => "Standard build for Site B"
);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
        <title>SVN Update Page</title>

<style>
body {
        background-color:#eeeeee;
}

.tdheader {
        background-color:#0f2c66;
        color:#FFFFFF;
        font-weight: bold;
}

.tdheader2 {
        background-color:#000000;
        color:#FFFFFF;
        font-weight: bold;
}

.tdrow {
        background-color:#ffffff;
        color:#000000;
        font-weight: normal;
}

a:link,a:active,a:visited {
        color:#0f2c66;
}

a:hover {
        color:#6A9CD3;
}
.menuon {
        background-color:#6699cc;
        color:white;
        font-weight: bold;
}

.menuoff {
        background-color:white;
        color:black;
        font-weight: bold;
}

table {
        border-style: solid;
        border-width: 1px;
        border-color: #000000;
}

</style>
<script type="text/javascript">
function confirmexport(text) {
        if (confirm(text)) {
                document.getElementById('framecont').style.display = '';
                document.getElementById("processframe").contentWindow.document.body.innerHTML = "<div align='center'>Exporting...</div>";
                return true;
        } else return false;
}
function viewframe() {
        document.getElementById('framecont').style.display = '';
}
function closeframe() {
        document.getElementById('framecont').style.display = 'none';
}

</script>
</head>
<body>
<table width="750px" cellpadding="2" cellspacing="1" bgcolor="#000000" border="0">
<tr>
<td class="tdheader2">Server: </td>
<td class="menuon" align="center">Development Server</td>
<td class="menuoff" align="center"><a href="https://staging.server.com/svn/svnupdate.php">Staging Server</a></td>
<td class="menuoff" align="center"><a href="https://www.server.com/svn/svnupdate.php">Production Server</a></td>
</tr>
</table>

<hr size="1" noshade="noshade" />
<a href="log.php" target="processframe" onclick="closeframe();viewframe()">View Development Export Log</a>
<br><br>
<table cellpadding="2" width="1000px" cellspacing="1" bgcolor="#000000" border="0">
<tr class="tdheader">
<td>Site</td>
<td>Source</td>
<td>UN/PW</td>
<td>Base</td>
<td>Revision</td>
<td>Export</td>
<td>Pending Updates</td>
<td>Notes</td>
</tr>

<?
if($sites) {
foreach($sites as $key => $value) {
?>
<form method="post" action="svnupdate_process.php" target="processframe">
<tr class="tdrow">
<td><a href="<?=$value['url']?>" target="_blank"><?=$value['name']?></a></td>
<td><?=preg_replace("/svn:\/\/svn\.server\.com\//","",$value['source'])?><input type="hidden" name="source" value="<?=$value['source']?>"></td>
<td><?=$value['login']?></td>
<td><?=$value['base']?></td>
<td><input type="text" name="revision" size="5"></td>
<td><input type="hidden" name="site" value="<?=$value['path']?>">
<input type="submit" name="submitbutton" value="Export" onClick="javascript:return confirmexport('This will overwrite the current files on development. Are you sure?');">
</td>
<td width="150px"><center><a href="viewcommit.php?name=<?=$value['name']?>&path=<?=$value['path']?>&svn=<?=$value['source']?>" target="processframe" onclick="closeframe();viewframe()">View</a></center></td>
<td><?=$value['notes']?></td>
</tr>
</form>
<? } ?>
<? } ?>
</table>
<br><div id='framecont' style="text-align: left; display: none">
<iframe name="processframe" id="processframe" width="1000px" height="300px" align="left" scrolling="yes" frameborder="0">
                </iframe>
</div>
</body>
</html>
