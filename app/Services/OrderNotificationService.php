<?php

namespace App\Services;

use App\Mail\OrderPlacedMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class OrderNotificationService
{
    /**
     * Envoyer une notification de nouvelle commande au seller
     */
    public function notifySeller(Order $order)
    {
        try {
            // Email générique pour tous les sellers
            $sellerEmail = 'seller@localmart.com';
            $sellerName = 'Seller LocalMart';
            
            // Envoyer l'email au seller générique
            Mail::to($sellerEmail)->send(new OrderPlacedMail($order, (object)[
                'name' => $sellerName,
                'email' => $sellerEmail
            ]));
            
            \Log::info("Email envoyé au seller {$sellerEmail} pour la commande #{$order->id}");
            return true;
             
        } catch (\Exception $e) {
            \Log::error("Erreur lors de l'envoi de l'email au seller: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Envoyer une notification à l'admin
     */
    public function notifyAdmin(Order $order)
    {
        try {
            $admin = User::whereHas('roles', function($query) {
                $query->where('name', 'admin');
            })->first();
            
            if ($admin && $admin->email) {
                Mail::to($admin->email)->send(new OrderPlacedMail($order));
                \Log::info("Email envoyé à l'admin {$admin->email} pour la commande #{$order->id}");
                return true;
            }
            
        } catch (\Exception $e) {
            \Log::error("Erreur lors de l'envoi de l'email à l'admin: " . $e->getMessage());
            return false;
        }
        
        return false;
    }
    
    /**
     * Envoyer une confirmation au client
     */
    public function notifyCustomer(Order $order)
    {
        try {
            if ($order->user && $order->user->email) {
                Mail::to($order->user->email)->send(new OrderPlacedMail($order));
                \Log::info("Email de confirmation envoyé au client {$order->user->email} pour la commande #{$order->id}");
                return true;
            }
            
        } catch (\Exception $e) {
            \Log::error("Erreur lors de l'envoi de l'email au client: " . $e->getMessage());
            return false;
        }
        
        return false;
    }
    
    /**
     * Récupérer le seller à partir de la commande
     */
    private function getSellerFromOrder(Order $order)
    {
        // Si la commande a des items, récupérer le seller du premier produit
        if ($order->items && $order->items->count() > 0) {
            $firstItem = $order->items->first();
            if ($firstItem->product && $firstItem->product->seller) {
                return $firstItem->product->seller;
            }
        }
        
        // Alternative: chercher un seller par défaut
        return User::whereHas('roles', function($query) {
            $query->where('name', 'seller');
        })->first();
    }
    
    /**
     * Envoyer toutes les notifications pour une nouvelle commande
     */
    public function sendOrderNotifications(Order $order)
    {
        $results = [
            'seller' => $this->notifySeller($order),
            'admin' => $this->notifyAdmin($order),
            'customer' => $this->notifyCustomer($order),
        ];
        
        return $results;
    }
}
