<?php
if(isset($_POST['ajax-jobview'])){
    require_once('web-admin/functions.php');
    $id = intval($_POST['ajax-jobview']);
    if($info = db_get_row("SELECT * FROM job_application WHERE id='$id' ")){
        //var_dump($info);
        echo '<table class="table table-condensed table-bordered" >';
        $cnt=0;
        foreach($info AS $key=>$val){
            if($key=='id'||$key=='apply'||$key=='applicant_info_id'||$key=='applicant_names') continue;
            //echo '<tr><th>'.strtoupper(str_replace("_"," ",$key)).'</th><td>'.$val.'</td></tr>';
            if(++$cnt%2==1) echo '<tr><th>'.strtoupper(str_replace("_"," ",$key)).'</th><td>'.$val.'</td>';
            else echo '<th>'.strtoupper(str_replace("_"," ",$key)).'</th><td>'.$val.'</td></tr>';
        }
        echo $cnt%2==1? '<th></th><td></td></tr>':'';
        echo '</table>';
        
    }
} else {
    echo '<div class="alert alert-warning text-left alert-dismissible1" role="alert">
            <span>No Job Application Details found</span>
        </div>';
}