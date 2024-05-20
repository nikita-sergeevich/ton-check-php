<?php
    $link = mysqli_connect("localhost", "user", "password", "database"); // Database connection

    function check_proof($ton_proof, $account) {
        
        // Data pre-processing
        $account["address"] = str_replace("0:", "", $account["address"]); // Remove extra characters
        $workchain = 0; // Default workchain
        $address = hex2bin($account["address"]);
        $public_key = hex2bin($account["publicKey"]);
        $timestamp = $ton_proof["timestamp"];
        $domain_length = $ton_proof["domain"]["lengthBytes"];
        $domain_value = $ton_proof["domain"]["value"];
        $signature = base64_decode($ton_proof["signature"]);
        $payload = $ton_proof["payload"];

        // Preparing a message
        $message = "ton-proof-item-v2/";
        $message .= pack("V", $workchain);  // 4 bytes, little-endian
        $message .= $address;
        $message .= pack("V", $domain_length); // 4 bytes, little-endian
        $message .= $domain_value;
        $message .= pack("P", $timestamp); // 8 bytes, little-endian
        $message .= $payload;

        // Signature creation
        $hashed_message = hash("sha256", $message, true);
        $signature_message = "\xFF\xFF" . "ton-connect" . $hashed_message;
        $hashed_signature_message = hash("sha256", $signature_message, true);

        // Signature verification
        $valid = sodium_crypto_sign_verify_detached($signature, $hashed_signature_message, $public_key);

        return $valid;
    }

    if (!empty($_POST["wallet"])) {
        $isValid = check_proof($_POST["proof"], $_POST["account"]);

        if ($isValid) {
            // Actions upon successful signature verification
            $query = mysqli_query($link, "UPDATE `table` SET `ton-wallet`='".$_POST["wallet"]."' WHERE `link`='".$_POST["proof"]["payload"]."'"); // Record the user-friendly wallet in the database
        } else {
            // Actions if signature verification fails
        }
    }
?>