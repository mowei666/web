<?php

    error_reporting(E_ALL^E_NOTICE);
    $pdo=new PDO("mysql:host=localhost;dbname=mowei1220","root","root");

    //每一页显示的数据条数
    //总数据数
    $pagenum=2;
    //当前页
    $pagetotal=ceil($pdo->query("select * from mowei1220")->rowcount()/$pagenum);
    if($_GET['page']){
        $page=$_GET['page'];

    }else{
    $page=1;
    }
    //当前页范围
    if($page>=$pagetotal){
    $page=$pagetotal;
    }
    if($page<=1){
    $page=1;
    }
    $result=$pdo->query("select * from mowei1220 limit ".($page-1)*$pagenum.",".$pagenum);
    //执行查询语句，返回对象
    //$result=$pdo->query($sql);
    //从结集中一次性获取所有数据
    $data=$result->fetchAll(PDO::FETCH_OBJ);
    echo"<pre>";
    var_dump($data);
    echo"</pre>";
    echo"<hr>";
    echo "<a href='?page=".($page-1)."'>上一页</a>"."<a href='?page=".($page+1)."'>next</a>".$page."/".$pagetotal;
    echo "<hr>";
    echo "<input min=1 max=".$page." type='number' value=".$page." style='width:80px' class='changevalue'>";
    echo "<hr>";
    echo "<input type='number' value=".$page." style='width:80px' class='changevalue2'>";
    echo "<button type='submit' class='btn' style='height:15px'>";


?>
<script>
var changevalue=document.querySelector(".changevalue");
var changevalue2=document.querySelector(".changevalue2");
var btn=document.querySelector(".btn")
//input的change事件影响了地址栏的page的值
//地址栏page的值又影响php的分页
changevalue.addEventListener("change",function(){
location.href='?page='+this.value;});
/*changevalue2.addEventListener("change",function(){
location.href='?page='+this.value;});*/
//点击实现页面跳转
btn.addEventListener("click",function(){
location.href='?page='+changevalue2.value;})
</script>