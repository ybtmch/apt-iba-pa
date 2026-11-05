<?php 
    use Models\Chat;
    use Models\Message;
    use Models\User;
    include ("init.php");
    include ("session.php");

    if(isset($_GET['chat_id'])){
        try {
            $user_id = $_SESSION['user_id'];
            $chat_id = $_GET['chat_id'];

            $chat = new Chat();
            $chat->setConnection($connection);
            $chat = $chat->getChat($user_id, $chat_id);

            $property = $chat['property_name'];

            $messages = new Message();
            $messages->setConnection($connection);
            $all_messages = array_reverse($messages->getMessages($chat_id));
    
            // $messagesData = array();
            // foreach ($all_messages as $message) {
            //     $messagesData[] = array(
            //         'sender_id' => $message['sender_id'],
            //         'message_text' => $message['message_text'],
            //         'timestamp' => $message['timestamp'],
            //         'isRead' => $message['isRead'],
            //     );
            // }
            
            // Return the messages data as JSON
            //echo json_encode($messagesData);
            ?>
                <div class="offcanvas-header" >

                <div class="row justify-content-between align-items-center w-100" >

                <div class="col-1">
                    <button  class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasChat" aria-controls="offcanvasBackToChats">
                    <i class="fa-solid fa-arrow-right fa-2x"></i>
                    </button>
                </div>

                <div class="col-9 mt-3">
                    <input type="hidden" value="<?php echo $chat_id ?>" id="chat_id">
                    <p class="chatName" ><?php echo $property ?></p>
                </div>

                </div>


                </div>

                <div class="offcanvas-body" >


                    <div class="card mx-auto" style="max-width:400px">

                        <div class="card-body p-4" style="height: 850px; overflow: auto; display: flex; flex-direction: column-reverse;">

                        <?php 
                        foreach($all_messages as $message) { 
                            $sender_id = $message['sender_id'];
                            $message_text = $message['message_text'];
                            $message_id = $message['message_id'];
                            $originalDateTime = $message['timestamp'];
                            $dateTime = new DateTime($originalDateTime);
                            $timestamp = $dateTime->format("F d, Y h:ia");
                            $isRead = $message['isRead']; 

                            if($sender_id !== $user_id){
                            
                            $user = new User();
                            $user->setConnection($connection);
                            $user = $user->getById($sender_id);
                            $landlord_picture = $user['image_name'];
                            $landlord_id = $user['user_id'];

                            $read_messages = new Message();
                            $read_messages->setConnection($connection);
                            $read_messages = $read_messages->markAsRead($message_id, $chat_id, $sender_id);
                        ?>

                            <div class="d-flex align-items-baseline mb-4">
                                <div class="position-relative avatar">
                                    <img src="resources/images/users/<?php echo $user_picture ?>" class="img-fluid rounded-circle" alt="">
                                </div>
                                <div class="pe-2">
                                    <div>
                                        <div class="card card-text d-inline-block p-2 px-3 m-1"><?php echo $message_text ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small"><?php echo $timestamp ?></div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            } 
                            elseif($sender_id===$user_id){
                            $user = new User();
                            $user->setConnection($connection);
                            $user = $user->getById($sender_id);
                            $user_picture = $user['image_name'];
                            ?>
                            <div class="d-flex align-items-baseline text-end justify-content-end mb-4">
                                <div class="pe-2">
                                    <div>
                                        <div class="card card-text d-inline-block p-2 px-3 m-1"><?php echo $message_text ?>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small"><?php echo $timestamp ?></div>
                                    </div>
                                </div>
                                <div class="position-relative avatar">
                                    <img src="resources/images/users/<?php echo $user_picture ?>"
                                        class="img-fluid rounded-circle" alt="">
                                </div>
                            </div>
                        <?php } } ?>
                            
                        </div>
                        
                    </div>

                </div>
                
                        </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                
            <?php
        } catch (Exception $e) {
            echo 'An error occurred: ' . $e->getMessage();
        }
        
    }

?>
