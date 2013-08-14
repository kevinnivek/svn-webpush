<b>Update/Status Window</b>
<hr>


<?
include("./functions.inc.php");
$logfile = new logfile();

if($_POST['submitbutton']) {

        if($_POST['revision'] != "") {
                $revision = "-r ".$_POST['revision'];
        }

        $command = "/usr/bin/svn export --force --username svnuser --password 'svnpassword' $revision --config-dir /tmp ".$_POST['source']. " " . $_POST['site']." 2>&1";

        if($_POST['submitbutton'] == "Export") {
                $output = shell_exec("umask 022;".$command);
        }

        echo "<pre>$output</pre>";
        $logtext = "Exported to {$_POST['site']}";
        $logfile->write($logtext);
        eaccelerator_clear();
}

?>
