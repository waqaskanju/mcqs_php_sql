<?php
$link=require_once('db_connection.php');

function select_subject($link){
   $id=0;
   $sel=0;
   $i=1;
   $q="select * from chapters";
   $exe=mysqli_query($link,$q);
   echo '
   <div class="form-group">
	  <label for="subject">  </label>
     <select class="form-control" name="subject" id="subject" class="subject" required>
         <option value="">Select Subject </option>';
         
         while($exer=mysqli_fetch_assoc($exe)){ 
            $id=$exer['chapter_id'];
           // Give value to id to change Defualt subject. 
            if($id=='9'){$sel='selected';}
            else{ $sel=" ";}

           echo '<option value="'.$exer['chapter_name'].'"'.$sel.'>'.$i .' '.$exer['chapter_name'].'</option>';
         $i++;
         }
         echo'</select>
   </div>';
	}

function select_chapter($link){
   $i=1;
   $q="select * from topics";
   $exe=mysqli_query($link,$q);
   echo '
   <div class="form-group">
	  <label for="chapter">  </label>
      <select class="form-control" name="chapter" class="chapter" id="chapter" required>
         <option value="">Select Chapter </option>';
         $id=0;
            while($exer=mysqli_fetch_assoc($exe)){
               $id=$exer['topic_id'];
               // Give value to id to change Defualt subject. 
               if($id==10){$sel='selected';}
               else{ $sel=" ";}
                  echo '<option value="'.$exer['topic_name'].'"'.$sel.'>'.$i .' '.$exer['topic_name'].'</option>';
            $i++;
            }
      echo '    </select>
   </div>';
}
function show_subjects_names($link){
   $q="Select DISTINCT mcq_subject from blanks";
   $exe=mysqli_query($link,$q);
   echo '<ol >';
   while($exer=mysqli_fetch_assoc($exe)){
     echo $sub=$exer['mcq_subject'];
      $sub="'$sub'";
       '<li>' .$sub.'</li>';
      echo '<ol type="I">';
      $q2= "SELECT DISTINCT mcq_chapter from blanks WHERE mcq_subject=".$sub;
      $exe2=mysqli_query($link,$q2);
      while($exer2=mysqli_fetch_assoc($exe2)){
         $chap=$exer2['mcq_chapter'];
         $chap_o="'$chap'";
        $q3="SELECT * from blanks WHERE mcq_subject=$sub AND mcq_chapter=$chap_o";
        $exe3=mysqli_query($link,$q3);
        $total_blanks=mysqli_num_rows($exe3);
         echo '<li>';
         echo '<a href="index.php?submit=ok&subject='.$sub.'&chapter='.$chap_o.'">'.$chap.'</a>'; 
         echo'<span class="badge text-success">'.$total_blanks.'</span>';
         echo'</li>';
      }
    echo '</ol>';
   }
   echo '</ol>';
}
?>