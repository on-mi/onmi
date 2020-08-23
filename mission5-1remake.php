<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>mission_5-1</title>
</head>
<body>
        <form action="" method="post">
            <h3/>【　投稿フォーム　】</h3>
            <span class="mgr-10">名前：&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span><input type="string" name="name" placeholder="Name"><br>
            <span class="mgr-10">コメント：&ensp;&ensp;&ensp;</span><input type="string" name="comment" placeholder="Comment"><br> 
            <span class="mgr-10">パスワード：&ensp;</span><input type="password" name="pass1" placeholder="Password"><br>
             <button type="submit" name="flag" value=1>投稿</button><br>
            
            <h3/>【　削除フォーム　】</h3>
            <span class="mgr-10">削除番号：&ensp;&ensp;&ensp;&ensp;</span><input type="number" name="dstep" placeholder="Delete Number"><br>
            <span class="mgr-10">パスワード：&ensp;&ensp;</span><input type="password" name="pass2" placeholder="Password"><br>
            <button type="submit" name="dflag" value=1 >削除</button><br>
            
            <h3/>【　編集フォーム　】</h3>
            <span class="mgr-10">編集番号：&ensp;&ensp;&ensp;&ensp;</span><input type="number" name="estep" placeholder="Edit Number" ><br>
            <span class="mgr-10" >新名前：&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</span><input type="string" name="ename" placeholder="Name"><br>
            <span class="mgr-10">新コメント&ensp;&ensp;&ensp;&ensp;</span><input type="string" name="ecomment" placeholder="Comment"><br>
            <span class="mgr-10">パスワード：&ensp;&ensp;</span><input type="password"  name="pass3" placeholder="Password"><br>
            <button type="submit" name="eflag" placeholder="Edit number" value=1> 編集</button><br>
                
          
  
        </form>
        <?php
        //Mysqlに接続
        $dsn = 'mysql:dbname==co_***_it_3919_com;host=localhost';
	    $user =  'co-***.it.3919.c';
	    $password = "PASSWORD';
	    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
   
         //データ関係
         $name = $_POST["name"];
         $submitDate = date("Y/m/d H:i:s");
         
         //新規投稿関係
        
         $flag = $_POST["flag"];
         $comment = $_POST["comment"];
         $pass = $_POST["pass1"];
          
        //削除関係
            $dstep = $_POST["dstep"];
            $dpass = $_POST["pass2"];
            $dflag = $_POST["dflag"];
        //編集関係
            $estep = $_POST["estep"];
            $ename = $_POST["ename"];
            $ecomment = $_POST["ecomment"];
            $epass = $_POST["pass3"];
            $eflag = $_POST["eflag"];

        //削除
         if($dflag == 1){
             if(!empty($dstep && $dpass)){
                 $sql = $pdo -> prepare("DELETE FROM tbseventh WHERE id =:id");
                 $sql -> bindParam(':id',$dstep);
                 $sql -> execute();
                 $message = " No." . "$dstep" . " 削除成功！！";
             }else{  //ERROR表示ZONE
                 if(empty($dstep)){echo "Error: Delete number is empty!"."<br>";}
                 if(empty($dpass)){echo "Error: Delete password is empty!"."<br>";}
                 
             }
         //編集
         }elseif($eflag == 1){
             if(!empty($ename && $ecomment && $epass)){
                 $id = $estep; //編集する投稿番号
                 $sql = 'UPDATE tbseventh SET name=:name,comment=:comment WHERE id=:id';
                 $sql = $pdo -> prepare($sql);
                 $sql -> bindParam(':name',$ename,PDO::PARAM_STR);
                 $sql -> bindParam(':comment',$ecomment,PDO::PARAM_STR);
                 $sql -> bindParam(':id',$estep);
                 $sql -> execute();
                 $message = "編集成功！！";
             }else{
                 if(empty($ename)){echo "Error: Edit name is empty!"."<br>";}
                 if(empty($ecomment)){echo "Error: Edit comment is empty!"."<br>";}
                 if(empty($epass)){echo "Error: Edit password is empty!"."<br>";}
                 if(empty($estep)){echo "Error: Edit ID is empty!"."<br>";}
             
                 }
          //新規投稿
            }elseif($flag=1){
             if(!empty($name && $comment && $pass)){
	            $sql = $pdo -> prepare("INSERT INTO tbseventh (name, comment, submitDate) VALUES (:name, :comment, :submitDate)");
	            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
	            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	            $sql -> bindParam(':submitDate', $submitDate);
	            $sql -> execute();
	  
                }
                else{
                    //Error 
                    if(empty($name)){   echo "Error: Name is empty"."<br>";}
                    if(empty($comment)){echo "Error: Comment is empty"."<br>";}
                    if(empty($pass)){   echo "Error: Password is empty"."<br>";}
                }
            
            }    
            
         //表示
            echo "新規投稿"."<br>";
            $sql  =  'SELECT * FROM tbseventh';
            $stmt =  $pdo->query($sql);
	        $results = $stmt->fetchAll();
	        foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		    echo $row['id'].',';
		    echo $row['name'].',';
		    echo $row['comment'].',';
		    echo $row['submitDate'].'<br>';
	        
	    }
	        echo "<hr>";
            
	      // DB接続設定
	    $dsn =  'mysql:dbname=co_***_it_3919_com;host=localhost';
	    $user =  'co-***.it.3919.c';
	    $password =  ʼPASSWORD';
	    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	   
        ?>
</body>
</html>