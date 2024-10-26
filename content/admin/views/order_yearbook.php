<?php
include('../../auth.php');
include('../../connect.php');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $yearbook_id = isset($_POST['yearbook_id']) ? intval($_POST['yearbook_id']) : 0;
                $fetch_sql = "SELECT * FROM yearbook WHERE id = $yearbook_id";
                $result = $conn->query($fetch_sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Extract relevant data
                    $recipient_name = $row['fullname'];
                    $recipient_phone = $row['number'];
                    $delivery_address = $row['address'];
                    $latitude = $row['latitude'];
                    $longitude = $row['longitude'];  // Fixed

                    // Lalamove API configuration
                    $key = 'pk_test_572395d05c7a438f5a462402ea91f5cb';
                    $secret = 'sk_test_BZXAaq9B1/kjwzkBj1I3MDVZXyulbHIUABgPPoHJnpO+PzkULCwC3o16gIObEY8E';
                    $time = time() * 1000;
                    $baseURL = 'https://rest.sandbox.lalamove.com';
                    $region = 'PH_MNL';

                    // Function to create a quotation
                    function createQuotation($key, $secret, $baseURL, $time, $region, $latitude, $longitude, $delivery_address) {
                        $method = 'POST';
                        $path = '/v3/quotations';

                        // Prepare the quotation body
                        $body = '{
                            "data" : {
                                "serviceType": "MOTORCYCLE",
                                "specialRequests": [],
                                "language": "en_PH",
                                "item": {
                                    "quantity": "1",
                                    "weight": "LESS_THAN_3KG",
                                    "categories": ["OFFICE_ITEM"],
                                    "handlingInstructions": ["KEEP_UPRIGHT","FRAGILE"] 
                                },
                                "stops": [
                                {
                                    "coordinates": {
                                        "lat": "13.764088",
                                        "lng": "121.059236"
                                    },
                                    "address": "University of Batangas, National Hwy, 4200 Batangas City, Philippines"
                                },
                                {
                                    "coordinates": {
                                        "lat": "'.$latitude.'",
                                        "lng": "'.$longitude.'"
                                    },
                                    "address": "'.$delivery_address.'"
                                }]
                            }
                        }';

                        $rawSignature = "{$time}\r\n{$method}\r\n{$path}\r\n\r\n{$body}";
                        $signature = hash_hmac("sha256", $rawSignature, $secret);
                        $token = $key.':'.$time.':'.$signature;

                        // Initialize CURL for quotation request
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $baseURL.$path,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => $body,
                            CURLOPT_HTTPHEADER => array(
                                "Content-type: application/json; charset=utf-8",
                                "Authorization: hmac ".$token,
                                "Accept: application/json",
                                "Market: ".$region
                            ),
                        ));

                        $response = curl_exec($curl);
                        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        curl_close($curl);

                        // echo "Quotation Request Status Code: $httpCode\n";
                        // echo "Returned Data: $response\n";

                        return json_decode($response, true);
                    }

                    // Function to place an order based on the quotation
                    function placeOrder($key, $secret, $baseURL, $time, $region, $quotation, $recipient_name, $recipient_phone, $delivery_address) {
                        $method = 'POST';
                        $path = '/v3/orders';

                        // Prepare the order body using the returned quotationId and stopId
                        $body = '{
                            "data": {
                                "quotationId": "'.$quotation['data']['quotationId'].'",
                                "sender": {
                                    "stopId": "'.$quotation['data']['stops'][0]['stopId'].'",
                                    "name": "Alumnite Website",
                                    "phone": "+639171234567"
                                },
                                "recipients": [{
                                    "stopId": "'.$quotation['data']['stops'][1]['stopId'].'",
                                    "name": "'.$recipient_name.'",
                                    "phone": "'.$recipient_phone.'",
                                    "remarks": "Yearbook Delivery - '.$delivery_address.'"
                                }]
                            }
                        }';

                        $rawSignature = "{$time}\r\n{$method}\r\n{$path}\r\n\r\n{$body}";
                        $signature = hash_hmac("sha256", $rawSignature, $secret);
                        $token = $key.':'.$time.':'.$signature;

                        // Initialize CURL for order request
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $baseURL.$path,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => $body,
                            CURLOPT_HTTPHEADER => array(
                                "Content-type: application/json; charset=utf-8",
                                "Authorization: hmac ".$token,
                                "Accept: application/json",
                                "Market: ".$region
                            ),
                        ));

                        $response = curl_exec($curl);
                        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                        curl_close($curl);

                        // echo "Order Request Status Code: $httpCode\n";
                        // echo "Returned Data: $response\n";

                        return json_decode($response, true);
                    }

                    // Create quotation
                    $quotation = createQuotation($key, $secret, $baseURL, $time, $region, $latitude, $longitude, $delivery_address);

                    if (isset($quotation['error'])) {
                        error_log("Quotation Error: " . print_r($quotation['error'], true));
                        echo "<script>alert('Failed to create quotation: " . addslashes($quotation['error']) . "'); window.location.href='view_approved_yearbook.php';</script>";
                    } elseif (isset($quotation['data']['quotationId'])) {
                        // Place order
                        $order = placeOrder($key, $secret, $baseURL, $time, $region, $quotation, $recipient_name, $recipient_phone, $delivery_address);

                        if (isset($order['data']['orderId'])) {
                            // Update the yearbook entry with the Lalamove order ID
                            $order_id = $order['data']['orderId'];
                            $update_order_sql = "UPDATE yearbook SET order_id = '$order_id' WHERE id = $yearbook_id";
                            $conn->query($update_order_sql);

                            echo "<script>alert('Order placed successfully!'); window.location.href='view_approved_yearbook.php';</script>";
                            var_dump($response);
                        } else {
                            error_log("Order Error: " . print_r($order, true));
                            echo "<script>alert('Failed to place Order.'); window.location.href='view_approved_yearbook.php';</script>";
                        }
                    }
                }
            };

            ?>