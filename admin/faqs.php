<?php
    use Models\Faq;
    include "../init.php";
    include ("session.php");

    $faq = new Faq();
    $faq->setConnection($connection);
    $faqs = $faq->getFaqs();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="css/adminstyle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">

	<title>Apt Iba Pa | Admin</title>
</head>
<body>

<?php include ('sidebar.php'); ?>



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<?php include('navbar.php');?>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>FAQs</h1>
				</div>
                <a href="add-faq" class="btn-add">	
                    <span class="text">Add</span>
                </a>
			</div>

			<div style="overflow-y:scroll; max-height:500px; scrollbar-width:none; " id="data-table" class="table-data">
				<div class="order">
					<div class="head">
						<h3>FAQs List</h3>
						
					</div>
					<table>
						<thead>
							<tr>
                                <th>ID</th>
								<th>Question</th>
								<th>Answer</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                                foreach($faqs as $faq){
                                    $faq_id = $faq['faq_id'];
                                    $question = $faq['question'];
                                    $answer = $faq['answer'];
                                    $status = $faq['status'];
                                    if($status===1){
                                        $show_status = 'Active';
                                    }elseif($status===0){
                                        $show_status = 'Deleted';
                                    }
                            ?>
							<tr>
								<td><p><?php echo $faq_id?></p></td>
								<td><p><?php echo $question ?></p></td>
								<td><p><?php echo $answer ?></p></td>
                                <td><span class="status completed"><?php echo $show_status ?></span></td>
								<td>
                                    <i class='editbtn bx bx-edit' ></i>
                                    <i class='trash bx bx-trash' ></i>
                                </td>
							</tr>
                            <?php } ?>
						</tbody>
					</table>
				</div>
			</div>

            <!-- EDIT-DATA -->
			<div id="edit-form" class="edit-data" >
				<div class="order">
					<div class="head">
						<h3>Edit FAQ</h3>			
					</div>
                    <form action="edit-faq" method="POST" id="editForm">
                    <input type="hidden" name="faq_id" id="faq-id" value="">
					<div class="row row-container">
						<div class="edit-column">
                            <label for="faq-question">Question</label>
							<input id="faq-question" name="question" type="text" class="edit-txtbox" required/>
							<label for="faq-answer">Answer</label>
							<textarea id="faq-answer" name="answer" type="text" class="edit-txtbox" required style="overflow-y: hidden; height: 200px;"></textarea>
						</div>
						
					</div>
					<div class="row saveNcancel">
						<div class="saveNcancel">
							<!-- <span id="save-btn" class="status save action-status">Save</span> -->
                            <button class="edtSaveChanges" type="submit" id="save-btn" name="edit_faq">Save Changes</button>
                            </form>
							<span style="background-color:#0b2c3c;" id="cancl-btn" class="status cancel action-status">Cancel</span>
						</div>
					</div>
					
				</div>
				
			</div>

			<!-- EDIT-DATA -->

		</main>
		<!-- MAIN -->
	</section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.trash').click(function(){
                var row = $(this).closest('tr');
                var faqId = row.find('td:nth-child(1) p').text();
                var result = window.confirm("Are you sure you want to delete this faq?");

                if (result) {
                    deleteFaq({
                        delete_faq: 1,
                        faq_id: faqId
                    });
                }
            });

            function deleteFaq(data) {
                $.ajax({
                    url: 'edit-faq',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }

            //const editBtn = document.querySelector('.editbtn');
            const addBtn = document.querySelector('.btn-add');
            const editForm = document.getElementById('edit-form');
            const dataTable = document.getElementById('data-table');

            $('.editbtn').click(function() {
                dataTable.style.display = 'none';
                editForm.style.display = 'block';
                var row = $(this).closest('tr');
                var faqId = row.find('td:nth-child(1) p').text();
                var question = row.find('td:nth-child(2) p').text();
                var answer = row.find('td:nth-child(3) p').text();

                $('#faq-id').val(faqId);
                $('#faq-question').val(question);
                $('#faq-answer').val(answer);

                var saveButton = document.getElementById('save-btn');
                saveButton.setAttribute('name', 'edit_faq');
                dataTable.style.display = 'none';
                editForm.style.display = 'block';
            });

            addBtn.addEventListener('click', function() {
                dataTable.style.display = 'none';
                editForm.style.display = 'block';
                var saveButton = document.getElementById('save-btn');
                saveButton.setAttribute('name', 'add_faq');
            });

            const canclBtn = document.getElementById('cancl-btn');

            canclBtn.addEventListener('click', function() {
                dataTable.style.display = 'block';
                editForm.style.display = 'none';
            });
        });
        
    </script>
	<!-- CONTENT -->
	<!-- <script src="admin_script.js"></script> -->
</body>
</html>