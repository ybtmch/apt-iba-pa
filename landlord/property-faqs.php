<?php
    use Models\Property;
    use Models\Unit;
    use Models\User;
    use Models\PropertyFaq;
    include ("../init.php");
    include ("session.php");

    if(isset($_POST['add_faq'])){
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $status = 1;
        
        $faq = new PropertyFaq();
        $faq->setConnection($connection);
        $faq = $faq->addFaq($user_id, $question, $answer, $status);
    
        if($faq){
            echo "<script>alert('Property FAQ added successfully.')</script>";
        } else {
            echo "<script>alert('Failed to add Property FAQ.')</script>";
        }
    }
    
    if(isset($_POST['save_faqs'])){
        $faq_id = $_POST['faq_id'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
    
        $faq = new PropertyFaq();
        $faq->setConnection($connection);
        $faq = $faq->updateFaq($faq_id, $user_id, $question, $answer);
    
        if($faq){
            echo "<script>alert('Property FAQ edited successfully.')</script>";
        } else {
            echo "<script>alert('Failed to update Property FAQ.')</script>";
        }
    }

    if(isset($_POST['delete_faq'])){
        $faq_id = $_POST['faq_id'];
        $status = 0;

        $faq = new PropertyFaq();
        $faq->setConnection($connection);
        $faq = $faq->deleteFaq($faq_id, $user_id, $status);
    
        if($faq){
            echo "<script>alert('Property FAQ deleted successfully.')</script>";
        } else {
            echo "<script>alert('Failed to delete Property FAQ.')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Apt Iba Pa | Faqs </title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <link href="css/view_owner.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
    <!-- <link href="css/view_property.css" rel="stylesheet" /> -->

    <!-- Vendor Files -->
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <link rel="icon" href="../resources/favicon/faviconlogo.ico" type="image/x-icon">
    </head>
  <body style="background-color: #f2f6f7">
    <!-- Navbar -->
        <?php include('navbar.php'); ?>
    <!-- Navbar ends -->

    <!-- Loader -->

    <!-- <?php include('loader_process.php'); ?> -->


<!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

    <div class="section-title">
        <p class="statusU text-center"><span>FAQs</span></p>
        <h2 class="mt-3">Frequently Asked Questions</h2>
        <p>Questions about the property that are frequently asked by tenants are shown here. If you have any queries that are not provided, you may send a message to the owner of the property.</p>
      </div>
      <button style="background-color:#0b2c3c; border-color:#0b2c3c; font-weight:500;" class="btn btn-primary btn-lg addNewFaq" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
      <div class="faq-list">
        <ul>
            <?php 
                $faqlist = 1;
                $property_faqs = new PropertyFaq();
                $property_faqs->setConnection($connection);
                $property_faqs = $property_faqs->getFaqs($user_id);
                foreach($property_faqs as $faqs){
                    $question = $faqs['question'];
                    $answer = $faqs['answer'];
                    $faqId = $faqs['faq_id'];
            ?>
          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-<?php echo $faqId ?>"><?php echo $question ?> <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-<?php echo $faqId ?>" class="collapse show" data-bs-parent=".faq-list">
              <p>
                <?php echo $answer ?>
              </p>
              <button style="background-color:#0b2c3c; border-color:#0b2c3c; font-weight:500;" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#editModal"data-question="<?php echo $question ?>" data-answer="<?php echo $answer ?>" data-faqid="<?php echo $faqId; ?>">Edit</button>
                
              <button style="background-color:#ff5a3d; border-color:#ff5a3d; font-weight:500;" type="button" class="btn btn-danger btn-lg" onclick="deleteFAQ(<?= $faqId; ?>)">Delete</button>

            </div>
          </li>

          <?php $faqlist++; } ?>
        </ul>
      </div>
      <hr style="margin-top: 30px">
    </div>
    <div class="col extraContainer"></div>
  </section>
<!-- End Frequently Asked Questions Section -->
    



    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->






<!-- Add FAQS Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Add FAQ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="property-faqs" method="POST" id="addForm">
          <div class="mb-3">
            <label for="addQuestion" class="form-label fs-3">Question</label>
            <input type="text" class="form-control" id="addQuestion" name="question" required>
          </div>
          <div class="mb-3">
            <label for="addAnswer" class="form-label fs-3">Answer</label>
            <textarea class="form-control" id="addAnswer" name="answer" rows="4" required></textarea>
          </div>
          <button   type="submit" name="add_faq" class="editFaq btn btn-primary fs-4">Add FAQ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit FAQS Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit FAQ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="property-faqs" method="POST" id="editForm">
          <input type="hidden" id="faqId" name="faq_id">
          <div class="mb-3">
            <label for="editQuestion" class="form-label fs-3 ">Question</label>
            <input type="text" class="form-control" id="editQuestion" name="question" required>
          </div>
          <div class="mb-3">
            <label for="editAnswer" class="form-label fs-3 ">Answer</label>
            <textarea class="form-control" id="editAnswer" name="answer" rows="4" required></textarea>
          </div>
          <button type="submit" name="save_faqs" class="btn btn-primary editFaq fs-5">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var faqid = button.data('faqid'); 
        var question = button.data('question'); 
        var answer = button.data('answer'); 

        var modal = $(this);
        modal.find('#faqId').val(faqid);
        modal.find('#editQuestion').val(question);
        modal.find('#editAnswer').val(answer);
    });

  function deleteFAQ(faqId) {
    if (confirm('Are you sure you want to delete this FAQ?')) {
      $.ajax({
        url: '',
        method: 'POST',
        data: { delete_faq: 1, faq_id: faqId },
        success: function(response) {
          window.location.reload();
        },
        error: function(xhr, status, error) {
          console.error('Error deleting FAQ: ' + error);
        }
      });
    }
  }
</script>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</html>

<?php


?>