<?php

	include "../classes/category.php";
?>


 <?php

    include "inc/header.php";
?>



    
<?php
	
  $cat = new category();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $catName = $_POST['catName'];
      
      $insertCat = $cat->insert_category($catName);
  }
?>





	
    
    
    <link rel="stylesheet" type="text/css" href="css/layout.css" />
   

    



<div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục Sản Phẩm</h2>
               <div class="block copyblock"> 
                  <?php
                if(isset($insertCat)){
                	echo $insertCat;
                }
                ?>
                 <form action="addsp.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhập Loại Sản Phẩm mà bạn muốn thêm" class="medium" />
                                <style>table.form input[type="text"] {
                                    font-size: 17px;
                                    border-bottom: 1px solid #b3b3b3;
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;
                                }</style>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm Loại Sản Phẩm" />
                                <style>table.form input[type="submit"] {
                                    border: 1px solid #ddd;
                                    color: #444;
                                    cursor: pointer;
                                    font-size: 18px;
                                    padding: 2px 10px;
                                    border-radius: 50px 50px 50px 50px;
                                    background: yellow;
                                }</style>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>




















