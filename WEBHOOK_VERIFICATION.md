# Stripe Webhook Verification Guide

## ✅ CSRF Protection Fixed

The webhook endpoint `/stripe/webhook` has been excluded from CSRF verification in `bootstrap/app.php`.

## Configuration Check

1. **Environment Variables** (.env):
   - ✅ STRIPE_KEY is set
   - ✅ STRIPE_SECRET is set  
   - ✅ STRIPE_WEBHOOK_SECRET is set

2. **Route Registration**:
   - ✅ POST /stripe/webhook → StripeCheckoutController@webhook

## Testing the Webhook

### Option 1: Using Stripe CLI (Recommended)

```bash
# Install Stripe CLI: https://stripe.com/docs/stripe-cli
stripe login
stripe listen --forward-to localhost:8000/stripe/webhook
```

In another terminal, trigger a test event:
```bash
stripe trigger checkout.session.completed
```

### Option 2: Manual cURL Test

```bash
curl -X POST http://localhost:8000/stripe/webhook \
  -H "Content-Type: application/json" \
  -H "Stripe-Signature: test" \
  -d '{
    "id": "evt_test",
    "type": "checkout.session.completed",
    "data": {
      "object": {
        "id": "cs_test_123",
        "payment_intent": "pi_test_123"
      }
    }
  }'
```

Expected response: `{"error":"Invalid signature"}` (400) - This is correct! It means CSRF is bypassed but signature validation is working.

### Option 3: Test from Stripe Dashboard

1. Go to: https://dashboard.stripe.com/test/webhooks
2. Click "Add endpoint"
3. Enter URL: `https://your-domain.com/stripe/webhook`
4. Select events: `checkout.session.completed`
5. Click "Send test webhook"

## What Should Happen

1. ✅ No 419 CSRF error
2. ✅ Webhook receives the request
3. ✅ Signature validation occurs
4. ✅ Payment status updates to 'paid' in database

## Verify in Database

```sql
SELECT * FROM payments ORDER BY created_at DESC LIMIT 5;
```

Look for status changing from 'pending' to 'paid' after successful webhook.
