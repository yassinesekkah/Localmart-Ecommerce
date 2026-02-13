<?php
// Test Stripe Webhook Endpoint
// Run: php test-webhook.php

$url = 'http://localhost:8000/stripe/webhook';

// Sample Stripe webhook payload
$payload = json_encode([
    'id' => 'evt_test_webhook',
    'object' => 'event',
    'type' => 'checkout.session.completed',
    'data' => [
        'object' => [
            'id' => 'cs_test_123',
            'payment_intent' => 'pi_test_123',
            'payment_status' => 'paid'
        ]
    ]
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Stripe-Signature: test_signature'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status: $httpCode\n";
echo "Response: $response\n";

if ($httpCode === 200) {
    echo "\n✅ Webhook endpoint is accessible (CSRF protection bypassed)\n";
} elseif ($httpCode === 419) {
    echo "\n❌ CSRF token mismatch - webhook will fail\n";
} else {
    echo "\n⚠️ Unexpected response code\n";
}
