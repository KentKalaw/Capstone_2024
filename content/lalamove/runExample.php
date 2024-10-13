<?php
// Lalamove API credentials
$key = 'pk_test_572395d05c7a438f5a462402ea91f5cb'; // Your public key
$secret = 'sk_test_BZXAaq9B1/kjwzkBj1I3MDVZXyulbHIUABgPPoHJnpO+PzkULCwC3o16gIObEY8E'; // Your secret key

$time = time() * 1000;
$baseURL = 'https://rest.sandbox.lalamove.com'; // Base URL for Lalamove Sandbox API
$region = 'PH_MNL'; // Your region (e.g., PH_MNL for Manila, PH_BTG for Batangas, etc.)

/**
 * Function to create a quotation
 */
function createQuotation($key, $secret, $baseURL, $time, $region) {
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
                "categories": ["FOOD_DELIVERY","OFFICE_ITEM"],
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
                    "lat": "13.771309",
                    "lng": "121.059387"
                },
                "address": "RK 4 VILLAGE MERALCO SITE,KUMINTANG ILAYA,BATANGAS CITY., Batangas, Philippines"
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

    echo "Quotation Request Status Code: $httpCode\n";
    echo "Returned Data: $response\n";

    return json_decode($response, true);
}

/**
 * Function to place an order based on the quotation
 */
function placeOrder($key, $secret, $baseURL, $time, $region, $quotation) {
    $method = 'POST';
    $path = '/v3/orders';

    // Prepare the order body using the returned quotationId and stopId
    $body = '{
        "data": {
            "quotationId": "'.$quotation['data']['quotationId'].'",
            "sender": {
                "stopId": "'.$quotation['data']['stops'][0]['stopId'].'",
                "name": "John Doe",
                "phone": "+639171234567"
            },
            "recipients": [{
                "stopId": "'.$quotation['data']['stops'][1]['stopId'].'",
                "name": "Jane Smith",
                "phone": "+639175678901"
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

    echo "Order Request Status Code: $httpCode\n";
    echo "Returned Data: $response\n";

    return json_decode($response, true);
}

// 1. Create Quotation
$quotation = createQuotation($key, $secret, $baseURL, $time, $region);

// 2. Check if the quotation is successful
if (isset($quotation['data']['quotationId'])) {
    // 3. Place an order using the generated quotationId
    $order = placeOrder($key, $secret, $baseURL, $time, $region, $quotation);

    if (isset($order['data']['orderId'])) {
        echo "Order placed successfully. Order ID: ".$order['data']['orderId']."\n";
    } else {
        echo "Failed to place order.\n";
    }
} else {
    echo "Failed to create quotation.\n";
}
?>
