<?php

namespace OpenCompany\Integrations\Adyen;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Adyen API HTTP client.
 *
 * Handles authentication via x-API-key header and provides methods for
 * interacting with the Adyen Checkout and Management APIs.
 *
 * @see https://docs.adyen.com/api-explorer/
 */
class AdyenService
{
    /**
     * Create a new AdyenService instance.
     *
     * @param  string  $apiKey           The Adyen API key (x-API-key).
     * @param  string  $merchantAccount  The merchant account code.
     * @param  string  $baseUrl          Base URL for the Adyen API (test or live).
     */
    public function __construct(
        private string $apiKey = '',
        private string $merchantAccount = '',
        private string $baseUrl = 'https://checkout-test.adyen.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->merchantAccount);
    }

    /**
     * Get the configured merchant account.
     */
    public function getMerchantAccount(): string
    {
        return $this->merchantAccount;
    }

    /**
     * List transactions from the Adyen transaction feed.
     *
     * @param  array  $params  Query/filter parameters (page, size, etc.).
     * @return array<string, mixed>
     */
    public function listTransactions(array $params = []): array
    {
        $body = array_merge(['merchantAccountCode' => $this->merchantAccount], $params);

        return $this->request('POST', '/checkout/v67/transactionFeed', $body);
    }

    /**
     * Get a single transaction by its PSP reference.
     *
     * @param  string  $pspReference  The PSP reference of the transaction.
     * @return array<string, mixed>
     */
    public function getTransaction(string $pspReference): array
    {
        return $this->request('GET', '/checkout/v67/transactions/' . urlencode($pspReference), [
            'merchantAccountCode' => $this->merchantAccount,
        ]);
    }

    /**
     * Make a payment through the Adyen Checkout API.
     *
     * @param  array  $data  Payment data including amount, paymentMethod, reference, etc.
     * @return array<string, mixed>
     */
    public function makePayment(array $data): array
    {
        $body = array_merge(['merchantAccount' => $this->merchantAccount], $data);

        return $this->request('POST', '/checkout/v71/payments', $body);
    }

    /**
     * List shopper logs / stored payment methods for recurring shoppers.
     *
     * @param  array  $params  Query parameters (limit, page, shopperReference, etc.).
     * @return array<string, mixed>
     */
    public function listShopperLogs(array $params = []): array
    {
        $query = array_merge(['merchantAccount' => $this->merchantAccount], $params);

        return $this->request('GET', '/checkout/v71/storedPaymentMethods', $query);
    }

    /**
     * Capture a previously authorized payment.
     *
     * @param  string  $pspReference  The PSP reference of the payment to capture.
     * @param  array   $data          Capture data including amount (value + currency).
     * @return array<string, mixed>
     */
    public function capturePayment(string $pspReference, array $data): array
    {
        $body = array_merge(['merchantAccount' => $this->merchantAccount], $data);

        return $this->request('POST', '/checkout/v71/payments/' . urlencode($pspReference) . '/captures', $body);
    }

    /**
     * Refund a payment.
     *
     * @param  string  $pspReference  The PSP reference of the payment to refund.
     * @param  array   $data          Refund data including amount (value + currency).
     * @return array<string, mixed>
     */
    public function refundPayment(string $pspReference, array $data): array
    {
        $body = array_merge(['merchantAccount' => $this->merchantAccount], $data);

        return $this->request('POST', '/checkout/v71/payments/' . urlencode($pspReference) . '/refunds', $body);
    }

    /**
     * List stores for the configured merchant account.
     *
     * @param  array  $params  Query parameters (limit, page, etc.).
     * @return array<string, mixed>
     */
    public function listStores(array $params = []): array
    {
        $query = array_merge(['merchantAccount' => $this->merchantAccount], $params);

        return $this->request('GET', '/checkout/v71/stores', $query);
    }

    /**
     * Get current merchant information.
     *
     * Uses the paymentMethods endpoint as a health check to verify
     * the API key and merchant account are valid.
     *
     * @return array<string, mixed>
     */
    public function getCurrentMerchant(): array
    {
        return $this->request('POST', '/checkout/v67/paymentMethods', [
            'merchantAccount' => $this->merchantAccount,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Adyen API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Request body or query parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Adyen API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'x-API-key' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('errorType') ?? $response->body();

                Log::error("Adyen API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Adyen API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Adyen API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Adyen API: {$e->getMessage()}");
        }
    }
}
