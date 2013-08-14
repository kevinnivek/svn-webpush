<?
class logfile {
        function logfile() {
                $this->filename = "log.txt";
                $this->Username = $_SERVER['PHP_AUTH_USER'];
                $this->logfile = $this->filename;
        }

        function write($data) { // write to logfile
                $handle = fopen($this->logfile, "a+");
                $date = date("Y-m-d H:i:s");
                $IP = getenv('REMOTE_ADDR');
                $data = "[$date] {$this->Username}:{$IP} - " . $data . "\n";
                $return = fwrite($handle, $data);
                fclose($handle);
        }

        function display() { // display logfile
                $handle = fopen($this->logfile, "a+");
                while(!feof($handle)) { // Pull lines into array
                        $lines[] = fgets($handle, 1024);
                }
                $count = count($lines);
                $count = $count - 2;
                for($i=$count;$i>=0;$i--) {
                        echo $lines[$i] . "<br>";
                }
                fclose($handle);
        }
}
?>
