<?php
    include ("dbconnect.php");
    
    require_once dirname(__FILE__) . '/log4php/Logger.php';
    Logger::configure(dirname(__FILE__) . '/log4php.properties', 'LoggerConfiguratorIni');
    $logger = Logger::getRootLogger();
    
    session_start();
    
    if (!isset($_SESSION["session_username"])){
        $logger->info("Session was not found. Redirect to login page");
        header("location:login.php");
    }

	
?>



<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <div class="parent">   
			<p><a href="logout.php">Выйти</a> из системы</p>
		 <form name="myForm2" action="action.php" method="post" >
                <input type="submit" name="action" value="delete">
            </form>
	     
            <div class="block2">
                <h3 align="center">Добро пожаловать <span><?php echo $_SESSION['session_full_name'];?> </span> ! </h3>
                <br>
                <!-- форма отправки сообщения -->

                <!-- проверка заполнения формы -->
                <script>
                    function splash(){
                                                
                        if (document.myForm.msg.value  == ''){
                            alert ("Введите текст сообщения!");
                            return false;
                        }

                        return true;
                    }
                </script>

                <!-- код формы -->
                <form name="myForm" action="action.php" method="post" onSubmit="return splash();">
                    <input type="hidden" name="action" value="add">
                    <table border="0">
                        <tr>
                            <td width="160">
                               
							   </td>
                            <td>
                                <p>Введите текст сообщения</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="160" valign="top">
                                
                            </td>
                            <td>
                                <textarea name="msg" style="width: 300px;"></textarea>
                            </td>
                        </tr>		
                        <tr>
                            <td width="160">&nbsp;</td>
                            <td>
                                <input type="submit" value="Отправить сообщение">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>  
            <!-- блок отображения сообщений-->
            <div class="block">
                <?php
                $c = 0;
                
                // выбор всех записей из БД, отсортированных так, что самая последняя отправленная запись будет всегда первой.
                $r = mysql_query("SELECT username as 'username', dt as 'dt', msg as 'msg' FROM gb ORDER BY dt DESC");
                
                // для каждой записи организуем вывод.
                while ($row=mysql_fetch_array($r)){
                    if ($c%2)
                        // цвет для четных записей
                        $col="bgcolor='#f9f9f9'";	
                    else
                        // цвет для нечетных записей
			$col="bgcolor='#f0f0f0'";
                ?>
                <table border="0" cellspacing="3" cellpadding="0" width="80%" <?php echo $col; ?> style="margin: 10px 0px;">
                    <tr>
                        <td width="150" style="color: #999999;">Кто оставил сообщение:</td>
                        <td><?php echo $row['username']; ?></td>
                        <td width="150" style="color: #999999;">Текст сообщения:</td>
                        <td><?php echo $row['dt']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="color: #999999;">------------------------------------------</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php echo $row['msg']; ?><br> </td>
                    </tr>
                    <tr>
                        <td width="150" style="color: #999999;"></td>
                       
                    </tr>
                </table>
                
                <?php
                $c++;
                }
                
                if ($c==0) // если ни одной записи не встретилось
                    echo "Гостевая книга пуста!<br>";
                ?>
            </div>
        </div>
    </body>
</html>