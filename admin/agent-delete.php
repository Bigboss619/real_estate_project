<?php require_once('top.php'); ?>
<?php
    if(!isset($_SESSION['admin']))
    {
        header('location: '.ADMIN_URL.'login.php');
        exit;
    }
?>

<?php
   try {
            $id = $_GET['id'];

            // Deleting the agent from the messages table
            $statement = $conn->prepare("DELETE FROM messages WHERE agent_id=?");
            $statement->execute([$id]);

            // Deleting the agent reply from the message reply table
            $statement = $conn->prepare("DELETE FROM message_replies WHERE agent_id=?");
            $statement->execute([$id]);

            // Deleting the agent  from the orders table
            $statement = $conn->prepare("DELETE FROM orders WHERE agent_id=?");
            $statement->execute([$id]);

            // Deleting the agent  from the property table
            $statement = $conn->prepare("SELECT * FROM property WHERE agent_id=?");
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {        
                unlink('../uploads/property/'.$row['feature_photo']);

                $statement1 = $conn->prepare("SELECT * FROM property_photo WHERE property_id=?");
                $statement1->execute([$row['id']]);
                $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result1 as $row1) {
                    unlink('../uploads/property/property-photo/'.$row1['photo']);
                }
                $statement2 = $conn->prepare("DELETE FROM property_photo WHERE property_id=?");
                $statement2->execute([$row['id']]);

                $statement2 = $conn->prepare("DELETE FROM property_video WHERE property_id=?");
                $statement2->execute([$row['id']]);


            }
            $statement = $conn->prepare("DELETE FROM property WHERE id=?");
             $statement->execute([$id]);


            $statement = $conn->prepare("SELECT * FROM agents WHERE id=?");
            $statement->execute([$id]);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $photo = $row['photo'];
                if($photo != ''){
                    unlink('../uploads/agent-dp/'.$photo);
                }
            }

             // Deleting the agent 
             $statement = $conn->prepare("DELETE FROM agents WHERE id=?");
             $statement->execute([$id]);


            $success_message = 'Agent is deleted successfully';

            $_SESSION['success_message'] = $success_message;

            header('location: ' . ADMIN_URL . 'agent-view.php');
            exit;
   } catch (Exception $e) {
        $error_message = $e->getMessage();
        $_SESSION['error_message'] = $error_message;
        header('location: ' . ADMIN_URL . 'agent-view.php');
        exit;
   };
?>

