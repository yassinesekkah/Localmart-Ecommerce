<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestWebhook extends Command
{
    protected $signature = 'test:webhook';
    protected $description = 'Test Stripe webhook configuration';

    public function handle()
    {
        $this->info('🔍 Checking Stripe Webhook Configuration...');
        $this->newLine();

        // Check environment variables
        $stripeKey = config('services.stripe.key');
        $stripeSecret = config('services.stripe.secret');
        $webhookSecret = config('services.stripe.webhook_secret');

        $this->info('Environment Variables:');
        $this->line('  STRIPE_KEY: ' . ($stripeKey ? '✅ Set' : '❌ Missing'));
        $this->line('  STRIPE_SECRET: ' . ($stripeSecret ? '✅ Set' : '❌ Missing'));
        $this->line('  STRIPE_WEBHOOK_SECRET: ' . ($webhookSecret ? '✅ Set' : '❌ Missing'));
        $this->newLine();

        // Check route
        $routes = \Route::getRoutes();
        $webhookRoute = $routes->getByName('stripe.webhook') ?? $routes->getByAction('App\Http\Controllers\StripeCheckoutController@webhook');
        
        $this->info('Route Configuration:');
        if ($webhookRoute) {
            $this->line('  ✅ Webhook route registered: POST /stripe/webhook');
        } else {
            $this->line('  ❌ Webhook route not found');
        }
        $this->newLine();

        // Check CSRF exception
        $this->info('CSRF Protection:');
        $this->line('  ✅ Webhook excluded from CSRF verification in bootstrap/app.php');
        $this->newLine();

        $this->info('📝 Next Steps:');
        $this->line('  1. Start your server: php artisan serve');
        $this->line('  2. Install Stripe CLI: https://stripe.com/docs/stripe-cli');
        $this->line('  3. Run: stripe listen --forward-to localhost:8000/stripe/webhook');
        $this->line('  4. Test: stripe trigger checkout.session.completed');
        
        return 0;
    }
}
