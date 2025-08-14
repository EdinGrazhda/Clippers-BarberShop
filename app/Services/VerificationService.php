<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VerificationService
{
    /**
     * Generate and send a 4-digit verification code
     */
    public function sendVerificationCode(string $email, string $customerName): string
    {
        // Generate a 4-digit random code
        $code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store the code in cache for 10 minutes
        $cacheKey = 'verification_code_' . md5($email);
        Cache::put($cacheKey, $code, now()->addMinutes(10));
        
        // Send email with the verification code
        $this->sendVerificationEmail($email, $customerName, $code);
        
        return $code; // For debugging purposes, remove in production
    }
    
    /**
     * Verify the provided code against the stored code
     */
    public function verifyCode(string $email, string $providedCode): bool
    {
        $cacheKey = 'verification_code_' . md5($email);
        $storedCode = Cache::get($cacheKey);
        
        if (!$storedCode) {
            return false; // Code expired or doesn't exist
        }
        
        if ($storedCode === $providedCode) {
            // Code is correct, remove from cache
            Cache::forget($cacheKey);
            return true;
        }
        
        return false;
    }
    
    /**
     * Send verification email
     */
    private function sendVerificationEmail(string $email, string $customerName, string $code): void
    {
        $subject = 'Clippers Barbershop - Verify Your Appointment';
        $message = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: linear-gradient(135deg, #f59e0b, #eab308); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { background: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
                .code { font-size: 32px; font-weight: bold; color: #f59e0b; text-align: center; background: white; padding: 20px; border-radius: 8px; margin: 20px 0; letter-spacing: 8px; }
                .footer { text-align: center; margin-top: 20px; color: #666; font-size: 14px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>✂️ Clippers Barbershop</h1>
                    <p>Appointment Verification</p>
                </div>
                <div class='content'>
                    <h2>Hello {$customerName}!</h2>
                    <p>Thank you for booking an appointment with Clippers Barbershop. To complete your booking, please use the verification code below:</p>
                    
                    <div class='code'>{$code}</div>
                    
                    <p><strong>Important:</strong></p>
                    <ul>
                        <li>This code will expire in 10 minutes</li>
                        <li>Enter this code in the booking form to confirm your appointment</li>
                        <li>Do not share this code with anyone</li>
                    </ul>
                    
                    <p>If you didn't request this appointment, please ignore this email.</p>
                </div>
                <div class='footer'>
                    <p>© 2025 Clippers Barbershop - Your Style, Our Craft</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        // For development, log the code so it can be tested
        Log::info('Verification email content for ' . $email, ['code' => $code, 'subject' => $subject]);
        
        // Send email using Laravel's Mail facade
        try {
            Mail::send([], [], function ($mail) use ($email, $customerName, $subject, $message) {
                $mail->to($email, $customerName)
                     ->from('edingrazhda17@gmail.com', 'Clippers Barbershop')
                     ->subject($subject)
                     ->html($message);
            });
            
            Log::info('Verification email sent successfully to ' . $email);
        } catch (\Exception $e) {
            Log::error('Failed to send verification email: ' . $e->getMessage());
            throw new \Exception('Failed to send verification email. Please try again.');
        }
    }
    
    /**
     * Check if a verification code exists for the email
     */
    public function hasActiveCode(string $email): bool
    {
        $cacheKey = 'verification_code_' . md5($email);
        return Cache::has($cacheKey);
    }
}
