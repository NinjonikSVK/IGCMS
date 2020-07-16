
            <?php
            define("DBHOST", $_POST["host"]);
            define("DBUSER", $_POST["user"]);
            define("DBPASS", $_POST["pass"]);
            define("DBNAME", $_POST["db"]);
            
            //application address
            define("DIR","http://igportals.eu");
            define("SITEEMAIL","noreply@igportals.eu");
            
            $siteemail = "noreply@igportals.eu";
            $siteurl = "http://igportals.eu/";
            
            class Connect extends PDO
            {
                public function construct()
                {
                    try {
            
                        //create PDO connection
                        $db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
                        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
                        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
                    } catch(PDOException $e) {
                        //show error
                        echo "<p>".$e->getMessage()."</p>";
                        exit;
                    }
            
                }
            
            }
            
            ?>
            
            