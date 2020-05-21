<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	
    <title>CSCAREER</title>
  </head>
  <body style="background: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)), url('image/background.jpg');
					background-size: cover; background-position: center;">
	  
	
	  
	<div class="container">
		<h2>CSCAREER</h2>
		<p class="bg-info text-white">Admin Account</p>
	</div>
	<div class= "container"	 style = "background: rgba(211, 211, 211, 0.3);">	
		<form  method="post">
			<div class="form-group">
				<?php
				require_once ('connect.php');
				session_start();
				if(isset($_POST["edit_question_id"]))
				{
					$edit_question_id = $_POST['edit_question_id'];
					$sql = "select description from question where question_id = '{$edit_question_id}'";
					$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
					while ( $row = mysqli_fetch_array ($result)) {
						echo "<br><br><div class='input-group'>
								<label for='description' style = 'color:#FFFFFF; font-size: 19px;'>Enter Your Question:</label><br> 
									<input type='description' name='description' size='40' class='form-control' value = '{$row['description']}'>	
								</div><br>";
					}
				}
				?>	
				<br>
				<label for="choices" style = "color:#FFFFFF; font-size: 19px;">Choices:</label><br><br>
				<?php
				require_once ('connect.php');
				
				if(isset($_POST["edit_question_id"]))
				{
					$edit_question_id = $_POST['edit_question_id'];
					$sql = "select choice_text from choice where question_id = '{$edit_question_id}' order by question_id";
					$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
					$choice_array = array("A", "B", "C", "D"); 
					$counter = 0;
					
					while ( $row = mysqli_fetch_array ($result)) {
						echo "<div class='input-group'>";
						echo "<label for='choicetext_{$choice_array[$counter]}' style = 'color:#FFFFFF; font-size: 19px;'>{$choice_array[$counter]}:</label><br> 
									<input type='choicetext_{$choice_array[$counter]}' name='choicetext_{$choice_array[$counter]}' size='40' class='form-control' value = '{$row['choice_text']}'>	
								";
						$counter = $counter + 1;
						echo "</div><br>";
					}
					
				}
				?>	
				
				<br>
				
				<div class="input-group">
						<label for="isCorrectAnswer" style = "color:#FFFFFF; font-size: 19px;">Select its Correct Answer:</label>
							<select name="isCorrectAnswer">
								<?php
									require_once ('connect.php');
									$sql = "select choice_id from choice 
											where question_id = '{$edit_question_id}' and isCorrectAnswer = '1'";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									$row = mysqli_fetch_array ($result);
									if ($row['choice_id'] == '1')
									{
										echo "<option value='a'>a</option>";
										$c = array ("a");
									}	
									else if ($row['choice_id'] == '2')
									{
										echo "<option value='b'>b</option>";
										$c = array("b");
									}	
									else if ($row['choice_id'] == '3')
									{
										echo "<option value='c'>c</option>";
										$c = array("c");
									}	
									else if ($row['choice_id'] == '4')
									{
										echo "<option value='d'>d</option>";
										$c = array("d");
									}
										
									$array = array("a", "b", "c", "d");
									$dif_choices = array_diff($array,$c);
									foreach ($dif_choices as $temp)
									{
										echo "<option value='{$temp}'>{$temp}</option>";
									}
								?>
							</select>
					</div>
				<br>
				<div class="input-group">
						<label for="difficulty" style = "color:#FFFFFF; font-size: 19px;">Select its Difficulty:</label>
							<select name="difficulty">
								<?php
									require_once ('connect.php');
									
									$sql = "select difficulty from question where question_id = '{$edit_question_id}'";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									if ($row = mysqli_fetch_array ($result))
									{
										echo "<option value='{$row['difficulty']}'>{$row['difficulty']}</option>";
									}
									$dif_array = array("easy", "medium", "hard");
									foreach ($dif_array as $key => $dif)
									{
										if ($dif == $row['difficulty'])
										{
											 unset($dif_array[$key]);
										}
									}
									foreach ($dif_array as $dif){
										echo "<option value='{$dif}'>{$dif}</option>";
									}
								?>
							</select>
					</div>
				
				<br>
				<!--
				<div class="input-group">
						<label for="subjects">Select its Subjects (to select more than 1, hold ctrl):</label>
							<select name="subjects[]" multiple size="5">
								<?php
									require_once ('connect.php');
									
									$sql = "select category_name from category";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									while ( $row = mysqli_fetch_array ($result)) {
										echo "<option value='{$row['category_name']}'>{$row['category_name']}</option>";
									}
								?>
							</select>
				</div
				-->
				<div class="input-group">
					<label for="subjects" style = "color:#FFFFFF; font-size: 19px;">Select its Subjects:</label>
							<?php
									require_once ('connect.php');
									
									$sql = "select distinct category_name from category";
									$result = mysqli_query ($conn, $sql) or die(mysqli_error($conn));
									$sql2 = "select category_name from categorized_as where question_id = '{$edit_question_id}'";
									$result2 = mysqli_query ($conn, $sql2) or die(mysqli_error($conn));
									$selected_cb = array();
									while ( $row2 = mysqli_fetch_array ($result2))
									{
										echo "<input type='checkbox' name='subjects[]' value='{$row2['category_name']}'  style = 'margin-right: 5px;'  checked><label style = 'color: #000000'>{$row2['category_name']}</label></input>";
										array_push($selected_cb, $row2['category_name']);
									}
									$all_cb = array();
									while ( $row = mysqli_fetch_array ($result) )
									{
										array_push($all_cb, $row['category_name']);
											
									}
									$unselected = array_diff($all_cb, $selected_cb);
									foreach ($unselected as $un )
									{
											echo "<input type='checkbox' name='subjects[]' value='{$un}' style = 'margin-right: 5px;'><label style = 'color: #000000'>{$un} </label></input>";
									}   	 
							?>
					
				</div>
				
				<br>
				
				<button type="submit" class="btn-success btn-lg" formaction="editQuestionCode.php" style="float: right;">Save Changes</button>
				<br><br><br>
			</div>
		</form>
	</div>
	 <?php
		require_once ('connect.php');
		
		if(isset($_POST["edit_question_id"]))
		{
			$edit_question_id = $_POST['edit_question_id'];
			$_SESSION['edit_question_id'] = $edit_question_id;
		}
		
	?>	
	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>