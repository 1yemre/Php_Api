

<?php

class UdmyCourseCommentList{

    public $data;
    public
    function __construct($url)
    {
        $this->data=file_get_contents($url);
  
     }
    function Parser()
    {
        $this->data= json_decode($this->data,true);
    }
    public function getcommentCount()
    {
        return $this->data["count"];
    }     
    public function getcommentList()
    {
         return  $this->data["results"];
    }
}


$udemy=new UdmyCourseCommentList("https://www.udemy.com/api-2.0/courses/1050454/reviews/");
$udemy->Parser();
?>


<div style="padding: 10px; background-color:#5995c7; color:white;">
      <?php echo $udemy->getcommentCount(); ?> Commented</div>
<?php
foreach($udemy->getcommentList() as $k=>$v){
    $userName=$v["user"]["display_name"];
    $color="green";
            if($v["rating"]<3)
            {
                $color="red";
            }
?>
    <div class="list" style="padding:7px; border-bottom:1px solid  #ddd ;color:<?php echo $color;  ?> ">
        <?php echo $userName; ?> <?php  echo $v["rating"];  ?> Gave Stars 
        
    </div>
 <?php } ?>