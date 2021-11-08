<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    
<link rel="stylesheet" type="text/css" href="css/layout.css" />


<?php include "../classes/category.php"; ?>
<?php include "inc/header.php"; ?>

<?php
    $cat = new category();
    if(!isset($_GET['catId']) || $_GET['catId']==NULL){
        echo "<script>window.location = 'listloaisp.php'</script>";
    }else{
    $Id = $_GET['catId'];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
      $catName = $_POST['catName'];
      $updateCat = $cat->update_category($catName,$Id);
  }
?>


<?php ?>    
<div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa Loại Sản Phẩm</h2>
               <div class="block copyblock"> 
                  <?php
                if(isset($updateCat)){
                	echo $updateCat;
                }
                ?>


                <?php

                    $get_cate_name = $cat->getcatbyId($Id);
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){

                     

                ?>



                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value = "<?php echo $result['catName']?>" name="catName" placeholder="Nhập Loại Sản Phẩm mà bạn muốn Sửa" class="medium" />
                                <style>table.form input[type="text"] {
                                    font-size: 15px;
                                    border-bottom: 1px solid #b3b3b3;
                                    border-right: 1px solid #b3b3b3;
                                    border-left: 1px solid #b3b3b3;
                                    border-top: 1px solid #b3b3b3;
                                }</style>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa Loại Sản Phẩm" />
                                <style>table.form input[type="submit"] {
                                    border: 1px solid #ddd;
                                    color: #444;
                                    cursor: pointer;
                                    font-size: 17px;
                                    padding: 2px 10px;
                                    border-radius: 50px 50px 50px 50px;
                                    background: yellow;
                                }</style>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php

                           }
                    }

                    ?>
                </div>
            </div>
        </div>





















