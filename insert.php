<?php
  require_once('db_connection.php');
  require_once('sand_box.php');
  $link=connect();
if(isset($_POST['submit'])){
    
    $subject=$_POST['subject'];
    $chapter=$_POST['chapter'];
    $question=$_POST['question'];
    $optionA=$_POST['optionA'];
    $optionB=$_POST['optionB'];
    $optionC=$_POST['optionC'];
    $optionD=$_POST['optionD'];
    $optionAC=$_POST['optionAC'];
    $optionBC=$_POST['optionBC'];
    $optionCC=$_POST['optionCC'];
    $optionDC=$_POST['optionDC'];
    $creation_date=date("Y-m-d");
    $answer=$_POST['answer'];
    $q="INSERT INTO blanks(mcq_subject,mcq_chapter,mcq_question,mcq_option_1,mcq_option_2,mcq_option_3,mcq_option_4,mcq_option_1_comment,mcq_option_2_comment,mcq_option_3_comment,mcq_option_4_comment,mcq_creation_date,answer) VALUES ('$subject','$chapter','$question','$optionA','$optionB','$optionC','$optionD','$optionAC','$optionBC','$optionCC','$optionDC','$creation_date','$answer')";
    $exe=mysqli_query($link,$q) or die(mysqli_error($link));
    if($exe) { echo "$question"." Submitted Successfully"; }
    else{ echo "Error in 1st Query". mysqli_error($link);}
}
if(isset($_POST['submit_chapter'])){
    $chapter=$_POST['chapter'];
    $q="INSERT INTO chapters(chapter_name) VALUES ('$chapter')";
    $exe=mysqli_query($link,$q) or die(mysqli_error($link));
    if($exe) { echo "$chapter"." Submitted Successfully"; }
    else{ echo "Error in topic Query". mysqli_error($link);}
  }
  if(isset($_POST['submit_topic'])){
    $topic=$_POST['topic'];
    $q="INSERT INTO topics(topic_name) VALUES ('$topic')";
    $exe=mysqli_query($link,$q) or die(mysqli_error($link));
    if($exe) { echo "$topic"." Submitted Successfully"; }
    else{ echo "Error in topic Query". mysqli_error($link);}
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Wsk Mcqs</title>
  </head>
  <body>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="container-fluid p-5 bg-primary text-white text-center">
      <h3>Create New Blanks</h3>
    </div>
    <div class="container">
      <form action="#" method="POST">
      <div class="row">
        <div class="col-sm-6">
          <?php select_subject($link); ?>
            <div class="form-group">
              <label for="question">Question:</label>
              <textarea class="form-control" id="question" name="question" required rows="1" style="background-color:yellow;"></textarea>
            </div>
            <div class="form-group">
              <label for="optionA">Option A:</label>
              <textarea class="form-control" id="optionA" required name="optionA" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="optionB">Option B:</label>
              <textarea class="form-control" id="optionB" required name="optionB" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="optionC">Option C:</label>
              <textarea class="form-control" id="optionC" required rows="1" name="optionC"></textarea>
            </div>
            <div class="form-group">
              <label for="optionD">Option D:</label>
              <textarea class="form-control" id="optionD" required rows="1" name="optionD"></textarea>
            </div>
          </div>
        <div class="col-sm-6">
          <?php select_chapter($link); ?>
          <div class="form-group">
            <label for="answer">Answer:</label>
            <textarea class="form-control" id="answer" name="answer" rows="1" required style="background-color:#4efff3;"></textarea>
          </div>
          <div class="form-group">
            <label for="optionAC">Option A Comment:</label>
            <textarea class="form-control" id="optionAC" name="optionAC" rows="1">No</textarea>
          </div>
          <div class="form-group">
            <label for="optionBC">Option B Comment:</label>
            <textarea class="form-control" id="optionBC" name="optionBC"rows="1">No</textarea>
          </div>
          <div class="form-group">
            <label for="optionCC">Option C Comment:</label>
            <textarea class="form-control" id="optionCC" name="optionCC"rows="1">No</textarea>
          </div>
          <div class="form-group">
            <label for="optionDC">Option D Comment:</label>
            <textarea class="form-control" id="optionDC" name="optionDC" rows="1">No</textarea>
          </div>
          
          <button type="submit" name="submit" class="btn btn-primary md-5">Submit</button>
        </div>
          </form>
        </div>
        <br>
        <hr>
        <br>
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <form class="form-inline" action="#" method="POST">
                <div class="form-group">
                  <label for="chapter">Subject Name:</label>
                  <input type="text" class="form-control" id="chapter" name="chapter">
                </div>
                <button type="submit" name="submit_chapter" class="btn btn-primary">Submit</button>
              </form>
            </div>
          <div class="col-sm-6">
            <form class="form-inline" action="#" method="POST">
              <div class="form-group">
                <label for="topic">Chapter Name:</label>
                <input type="topic" class="form-control" id="topic" name="topic">
              </div>
              <button type="submit" name="submit_topic" class="btn btn-primary">Submit</button>
              </form>
            </form>
          </div>
        </div>
        <script>
          $( document ).ready(function() {
            document.getElementById("chapter");
    
        </script>
  </body>
</html>