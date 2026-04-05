<?php

namespace OpenCompany\Integrations\Stripe;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Stripe API service for making requests to the Stripe REST API.
 */
class StripeService
{
    private const BASE_URL = 'https://api.stripe.com/v1';

    /**
     * @param  string  $apiKey  Stripe secret API key
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Balance ────────────────────────────────────────────

    /**
     * Get the current account balance.
     *
     * @return array<string, mixed>
     */
    public function getBalance(): array
    {
        return $this->request('GET', '/balance');
    }

    // ── Customers ──────────────────────────────────────────

    /**
     * Create a customer.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createCustomer(array $data): array
    {
        return $this->request('POST', '/customers', $data);
    }

    /**
     * Get a customer by ID.
     *
     * @return array<string, mixed>
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', "/customers/{$id}");
    }

    /**
     * Update a customer.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateCustomer(string $id, array $data): array
    {
        return $this->request('POST', "/customers/{$id}", $data);
    }

    /**
     * List customers.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/customers', $params);
    }

    /**
     * Delete a customer.
     *
     * @return array<string, mixed>
     */
    public function deleteCustomer(string $id): array
    {
        return $this->request('DELETE', "/customers/{$id}");
    }

    // ── Products ───────────────────────────────────────────

    /**
     * Create a product.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createProduct(array $data): array
    {
        return $this->request('POST', '/products', $data);
    }

    /**
     * Get a product by ID.
     *
     * @return array<string, mixed>
     */
    public function getProduct(string $id): array
    {
        return $this->request('GET', "/products/{$id}");
    }

    /**
     * List products.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products', $params);
    }

    // ── Prices ─────────────────────────────────────────────

    /**
     * Create a price.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createPrice(array $data): array
    {
        return $this->request('POST', '/prices', $data);
    }

    /**
     * List prices.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listPrices(array $params = []): array
    {
        return $this->request('GET', '/prices', $params);
    }

    // ── Payment Intents ────────────────────────────────────

    /**
     * Create a payment intent.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createPaymentIntent(array $data): array
    {
        return $this->request('POST', '/payment_intents', $data);
    }

    /**
     * Get a payment intent by ID.
     *
     * @return array<string, mixed>
     */
    public function getPaymentIntent(string $id): array
    {
        return $this->request('GET', "/payment_intents/{$id}");
    }

    /**
     * Update a payment intent.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updatePaymentIntent(string $id, array $data): array
    {
        return $this->request('POST', "/payment_intents/{$id}", $data);
    }

    /**
     * Confirm a payment intent.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function confirmPaymentIntent(string $id, array $data = []): array
    {
        return $this->request('POST', "/payment_intents/{$id}/confirm", $data);
    }

    /**
     * Cancel a payment intent.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function cancelPaymentIntent(string $id, array $data = []): array
    {
        return $this->request('POST', "/payment_intents/{$id}/cancel", $data);
    }

    /**
     * Capture a payment intent.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function capturePaymentIntent(string $id, array $data = []): array
    {
        return $this->request('POST', "/payment_intents/{$id}/capture", $data);
    }

    // ── Invoices ───────────────────────────────────────────

    /**
     * Create an invoice.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createInvoice(array $data): array
    {
        return $this->request('POST', '/invoices', $data);
    }

    /**
     * Get an invoice by ID.
     *
     * @return array<string, mixed>
     */
    public function getInvoice(string $id): array
    {
        return $this->request('GET', "/invoices/{$id}");
    }

    /**
     * List invoices.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listInvoices(array $params = []): array
    {
        return $this->request('GET', '/invoices', $params);
    }

    /**
     * Pay an invoice.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function payInvoice(string $id, array $data = []): array
    {
        return $this->request('POST', "/invoices/{$id}/pay", $data);
    }

    /**
     * Void an invoice.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function voidInvoice(string $id, array $data = []): array
    {
        return $this->request('POST', "/invoices/{$id}/void", $data);
    }

    // ── Subscriptions ──────────────────────────────────────

    /**
     * Create a subscription.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createSubscription(array $data): array
    {
        return $this->request('POST', '/subscriptions', $data);
    }

    /**
     * Get a subscription by ID.
     *
     * @return array<string, mixed>
     */
    public function getSubscription(string $id): array
    {
        return $this->request('GET', "/subscriptions/{$id}");
    }

    /**
     * Cancel (delete) a subscription.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function cancelSubscription(string $id, array $params = []): array
    {
        return $this->request('DELETE', "/subscriptions/{$id}", $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Stripe.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Stripe API key is not configured.');
        }

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->asForm()->post(self::BASE_URL . $path, $data),
                'DELETE' => $http->asForm()->delete(self::BASE_URL . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $json['error']['message'] ?? $response->body();
                $code = $json['error']['code'] ?? '';
                $type = $json['error']['type'] ?? '';

                Log::error("Stripe API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                    'type' => $type,
                    'code' => $code,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);
                if ($code) {
                    $msg .= " (code: {$code})";
                }

                throw new \RuntimeException('Stripe API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Stripe API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Stripe API: {$e->getMessage()}");
        }
    }
}
