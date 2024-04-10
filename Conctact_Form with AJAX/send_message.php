<?php   

    ini_set("SMTP","ssl://smtp.gmail.com");
    ini_set("smtp_port","465");

    $data = json_decode(file_get_contents('php://input'), true);

    if($_SERVER['REQUEST_METHOD'] === "POST" && $data !== null)
    {

        if(empty($data['EmailToSend']) || empty($data['Email']) || empty($data['PhoneNumber']) || empty($data['Website']) || empty($data['Message']))
        {

            echo "One or more Fields are Empty";
            exit();

        }
 
        if(!filter_var($data['PhoneNumber'], FILTER_SANITIZE_NUMBER_INT))
        {

            echo "Enter valid Phone Number";

            exit();

        }

        
        $receiver = $data['EmailToSend']; 
        $subject = "From: {$data['Email']} <{$data['EmailToSend']}>";
        $body="Name: {$data['Email']}\nEmail: {$data['EmailToSend']}\nPhone: {$data['PhoneNumber']}\nWebsite: {$data['Website']}\n\nMessage: {$data['Message']}\n\nRegards, \n{$data['Email']}"; $sender = "From: {$data['EmailToSend']}"; 

        if (mail($receiver, $subject, $body, $sender)) {
            echo 'Email sent successfully!';
        } else {
            echo 'Email could not be sent.';
        }

    }
