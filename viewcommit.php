<?

        if(($_GET['svn'] != "") && ($_GET['path'] != "") && ($_GET['name'] != "")) {

        // Cross Site Script  & Code Injection Sanitization
        function xss_cleaner($input_str) {
        $return_str = str_replace( array('<',';','|','&','>',"'",'"',')','('), array('&lt;','&#58;','&#124;','&#38;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
        }

        $xss_path=xss_cleaner($_GET['path']);
        $xss_svn=xss_cleaner($_GET['svn']);
        $xss_name=xss_cleaner($_GET['name']);

        echo "<b>Viewing Pending Updates For : ". $xss_name . "</b>";
        echo "<hr>";

        $command = "/usr/bin/svn --username svnuser --password 'svnpassword' --config-dir /tmp log " . $xss_svn . " -r {\"`grep \"" . $xss_path . "\" log.txt | tail -n 1 | awk -F \" \" '{printf \"%s %s\", $1,$2}' | sed -e 's/\[//g' -e 's/\]//g'`\"}:{\"`date \"+%Y-%m-%d %H:%M:%S\"`\"}";

        $output = shell_exec("umask 022;".$command);
        echo "<pre>$output</pre>";
}
        else {
        echo "No queries passed!";
        }

?>
