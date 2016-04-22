<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script type="text/javascript">
function SelectAll(id)
{
    document.getElementById(id).focus();
    document.getElementById(id).select();
}
</script>
</head>
<body>
<center>
<p>تم رفع الملف بنجاح</p>
    
        <?php
             $ext = $data['ext'];
             $name = $data['dir'];
             $file_path = base_url()."assets/uploads/".$name;
             
echo "<input type=\"text\" id=\"txtfld\" onClick=\"SelectAll('txtfld');\" style=\"width:400px\" value = \"".$file_path."\" />";


if ($ext == '.jpg' || $ext == '.gif' || $ext == '.png') echo "<br/><br/>
<a href='".$file_path."'><img style='width:111px;height;111px' src='".$file_path."'/></a>";

if($ext =='swf') echo swf($file_path,138,300);



            
            echo "<p>".anchor(base_url().'sst_admin/upload', 'رفع ملف جديد')."</p>"; 
        ?>

</center>
</body>
</html>
