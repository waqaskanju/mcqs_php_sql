<?php
  require_once('db_connection.php');
  require_once('sand_box.php');
  $link=connect();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="stylesheet.css" rel="stylesheet">
    <title>Wsk Mcqs</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
function click_toggle(clicked_id)
  {
   
    var div = document.getElementById(clicked_id);
    var nextSibling = div.nextSibling;
    while(nextSibling && nextSibling.nodeType != 1) {
    nextSibling = nextSibling.nextSibling
}
    $(nextSibling).toggle()
  }
</script>
  </head>
  <body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <div class="container-fluid p-5 bg-primary text-white text-center">
      <h3> MCQS </h3>
    </div>
    <div class="container">
      <form action="#" class="form-inline" method="POST">
        <div class="row">
          <div class="col-sm-5">
            <?php select_subject($link);?>
          </div>
          <div class="col-sm-5">
            <?php select_chapter($link);?>
          </div>
          <div class="col-sm-2">
            <button type="submit" name="submit" class="btn btn-primary mt-4">Submit</button>
          </div>
        </div>
      </form>
    </div>
    <div class="container">
    <?php 
      if(isset($_REQUEST['submit'])){
        $subject=$_REQUEST['subject'];
        $chapter=$_REQUEST['chapter'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $q="SELECT * FROM blanks WHERE mcq_subject='$subject' AND mcq_chapter='$chapter'";
        }
        else{
          $q="SELECT * FROM blanks WHERE mcq_subject=$subject AND mcq_chapter=$chapter";
        }
        $exe=mysqli_query($link,$q);
        $i=1;
        while($e=mysqli_fetch_assoc($exe)){
        ?>
      <div class="row">
        <div class="col-sm-12">
          <div class='form-group'>
            <label for='question'><?php echo $i ?> Question:</label>
            <textarea class='form-control' id='question' name='question' rows='1' readonly><?php echo $e['mcq_question'] ?></textarea>
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-sm-3">
            <div class='form-group'>
              <label for='optionA'>Option A:</label>
              <button type='button' class='btn btn-info' style='float:right' data-toggle='tooltip' data-placement='left' title=" <?php echo $e['mcq_option_1_comment'] ?>">Tip </button>
              <textarea class='form-control' id='optionA' name='optionA' rows='5' readonly> <?php echo $e['mcq_option_1'] ?></textarea>
            </div>
          </div>
          <div class="col-sm-3">
            <div class='form-group'>
              <label for='optionB'>Option B:</label>
              <button type='button' style='float:right' class='btn btn-info' data-toggle='tooltip' data-placement='left' title="<?php echo $e['mcq_option_2_comment'] ?>"?>Tip</button>
              <textarea class='form-control' id='optionB' name='optionB' rows='5' readonly><?php echo $e['mcq_option_2'] ?></textarea>
            </div>
          </div>
        <div class="col-sm-3">
          <div class='form-group'>
            <label for='optionB'>Option C:</label>
            <button type='button' style='float:right' class='btn btn-info' data-toggle='tooltip' data-placement='left' title="<?php echo $e['mcq_option_3_comment'] ?>"?>Tip</button>
            <textarea class='form-control' id='optionC' name='optionC' rows='5' readonly><?php echo $e['mcq_option_3'] ?></textarea>
          </div>
        </div>
        <div class="col-sm-3">
          <div class='form-group'>
            <label for='optionB'>Option D:</label>
            <button type='button' style='float:right' class='btn btn-info' data-toggle='tooltip' data-placement='left' title="<?php echo $e['mcq_option_4_comment'] ?>"?>Tip</button>
            <textarea class='form-control' id='optionD' name='optionD' rows='5' readonly><?php echo $e['mcq_option_4'] ?></textarea>
          </div>
        </div>
        <div class="col-sm-3">
          <div class='form-group'>
            <button for='answer' class="btn btn-success" id="<?php echo $i;?>" onClick="click_toggle(this.id)">Show  Answer:</button>
            <textarea class='form-control <?php echo $i;?>' style="display:none" name='answer' rows='1' cols='1' readonly><?php echo $e['answer'] ?></textarea>
          </div>
        </div>
      </div>
     <?php $i++; }
      }?>
    </div>
  </body>
</html>
          
