


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Lesson Api</title>
</head>
<body>
    

<?php
class UdmyLessonList
{       
     public $data;
     public function __construct($url) {
        $this->data=file_get_contents($url);
     }
     public function parser()
     {
         $this->data=json_decode($this->data,true);
     }
     public function nextUrl()
     {
          return $this->getpage($this->data["next"]);
     }
     public function prevUrl()
     {
        return $this->getpage($this->data["previous"]);
  
     }
     public function getCount()
     {
        return $this->data["count"];
     }
     public function getLessonList()
     {
        return $this->data["results"];
     }
     public function getpage($item)
     {
         if($item !=""){
           $explode=explode('?page=',$item);
            if(isset($explode[1])){
                   return $explode[1];
            }
         
         }
         else{
              return 1;
         }
        
     }
       

       


}

if(isset($_GET["page"])){$page=intval($_GET["page"]);}else{$page=1;}
$udemy=new UdmyLessonList("https://www.udemy.com/api-2.0/courses/1050454/public-curriculum-items/?page=".$page);
$udemy->parser();

?>
<div style="padding: 10px; background-color:#5995c7; color:white">
      <?php echo $udemy->getCount(); ?> Lesson  </div>


<table class="table">
<tbody>
    <tr>
<?php foreach($udemy->getLessonList() as $key => $value) 
{?> 
     
         <td><?php echo  $value["title"] ;?></td>
    
     </tr> 
 <tr>     
<?php
}  
 ?> 
<td>
     <?php
     echo '<a href="?page='.$udemy->prevUrl().'">Back<i class="fa-solid fa-backward"></i></a>';
     ?>
    

    <?php
     echo '<a href="?page='.$udemy->nextUrl().'"><i class="fa-solid fa-forward"></i>Forward</i></a>';
     ?>
</td>
</tr> 
</tbody>
</table>


</body>
</html>

