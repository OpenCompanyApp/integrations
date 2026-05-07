<?php

namespace OpenCompany\Integrations\EasyPost;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the EasyPost API v2.
 *
 * Handles Basic API-key authentication, documented endpoint mapping, request
 * body wrapping, response parsing, and normalized API errors.
 */
class EasyPostService
{
    private const DEFAULT_BASE_URL = 'https://api.easypost.com/v2';

    private const OPERATIONS = [
        'addresses_create' => ['POST', '/addresses', [], 'write', 'Create Address', 'Create an EasyPost address.', 'address'],
        'addresses_get' => ['GET', '/addresses/{address_id}', ['address_id'], 'read', 'Get Address', 'Retrieve an EasyPost address.'],
        'addresses_verify' => ['POST', '/addresses/{address_id}/verify', ['address_id'], 'write', 'Verify Address', 'Verify an address by ID.'],
        'parcels_create' => ['POST', '/parcels', [], 'write', 'Create Parcel', 'Create an EasyPost parcel.', 'parcel'],
        'parcels_get' => ['GET', '/parcels/{parcel_id}', ['parcel_id'], 'read', 'Get Parcel', 'Retrieve an EasyPost parcel.'],
        'customs_items_create' => ['POST', '/customs_items', [], 'write', 'Create Customs Item', 'Create a customs item.', 'customs_item'],
        'customs_items_get' => ['GET', '/customs_items/{customs_item_id}', ['customs_item_id'], 'read', 'Get Customs Item', 'Retrieve a customs item.'],
        'customs_infos_create' => ['POST', '/customs_infos', [], 'write', 'Create Customs Info', 'Create customs info for international shipments.', 'customs_info'],
        'customs_infos_get' => ['GET', '/customs_infos/{customs_info_id}', ['customs_info_id'], 'read', 'Get Customs Info', 'Retrieve customs info.'],
        'shipments_create' => ['POST', '/shipments', [], 'write', 'Create Shipment', 'Create a shipment and retrieve rates.', 'shipment'],
        'shipments_buy' => ['POST', '/shipments/{shipment_id}/buy', ['shipment_id'], 'write', 'Buy Shipment', 'Buy a shipment label using a selected rate.'],
        'shipments_list' => ['GET', '/shipments', [], 'read', 'List Shipments', 'List shipments with pagination filters.'],
        'shipments_get' => ['GET', '/shipments/{shipment_id}', ['shipment_id'], 'read', 'Get Shipment', 'Retrieve a shipment.'],
        'shipments_label' => ['GET', '/shipments/{shipment_id}/label', ['shipment_id'], 'read', 'Get Shipment Label', 'Retrieve or regenerate a shipment label.'],
        'shipments_insure' => ['POST', '/shipments/{shipment_id}/insure', ['shipment_id'], 'write', 'Insure Shipment', 'Add insurance to a purchased shipment.'],
        'shipments_refund' => ['POST', '/shipments/{shipment_id}/refund', ['shipment_id'], 'write', 'Refund Shipment', 'Request a refund for one shipment.'],
        'trackers_create' => ['POST', '/trackers', [], 'write', 'Create Tracker', 'Create a tracker for a tracking code.', 'tracker'],
        'trackers_list' => ['GET', '/trackers', [], 'read', 'List Trackers', 'List trackers with pagination filters.'],
        'trackers_get' => ['GET', '/trackers/{tracker_id}', ['tracker_id'], 'read', 'Get Tracker', 'Retrieve a tracker.'],
        'orders_create' => ['POST', '/orders', [], 'write', 'Create Order', 'Create a multi-parcel order.', 'order'],
        'orders_buy' => ['POST', '/orders/{order_id}/buy', ['order_id'], 'write', 'Buy Order', 'Buy labels for an order.'],
        'orders_get' => ['GET', '/orders/{order_id}', ['order_id'], 'read', 'Get Order', 'Retrieve an order.'],
        'batches_create' => ['POST', '/batches', [], 'write', 'Create Batch', 'Create a batch of shipments.', 'batch'],
        'batches_add_shipments' => ['POST', '/batches/{batch_id}/add_shipments', ['batch_id'], 'write', 'Add Batch Shipments', 'Add shipments to a batch.'],
        'batches_remove_shipments' => ['POST', '/batches/{batch_id}/remove_shipments', ['batch_id'], 'write', 'Remove Batch Shipments', 'Remove shipments from a batch.'],
        'batches_buy' => ['POST', '/batches/{batch_id}/buy', ['batch_id'], 'write', 'Buy Batch', 'Buy all buyable shipments in a batch.'],
        'batches_label' => ['POST', '/batches/{batch_id}/label', ['batch_id'], 'write', 'Generate Batch Label', 'Generate consolidated labels for a batch.'],
        'batches_scan_form' => ['POST', '/batches/{batch_id}/scan_form', ['batch_id'], 'write', 'Create Batch Scan Form', 'Create a scan form for a batch.'],
        'batches_list' => ['GET', '/batches', [], 'read', 'List Batches', 'List batches with pagination filters.'],
        'batches_get' => ['GET', '/batches/{batch_id}', ['batch_id'], 'read', 'Get Batch', 'Retrieve a batch.'],
        'pickups_create' => ['POST', '/pickups', [], 'write', 'Create Pickup', 'Create a carrier pickup.', 'pickup'],
        'pickups_buy' => ['POST', '/pickups/{pickup_id}/buy', ['pickup_id'], 'write', 'Buy Pickup', 'Purchase a pickup rate.'],
        'pickups_cancel' => ['POST', '/pickups/{pickup_id}/cancel', ['pickup_id'], 'write', 'Cancel Pickup', 'Cancel a scheduled pickup.'],
        'pickups_list' => ['GET', '/pickups', [], 'read', 'List Pickups', 'List pickups with pagination filters.'],
        'pickups_get' => ['GET', '/pickups/{pickup_id}', ['pickup_id'], 'read', 'Get Pickup', 'Retrieve a pickup.'],
        'scan_forms_create' => ['POST', '/scan_forms', [], 'write', 'Create Scan Form', 'Create a scan form.', 'scan_form'],
        'scan_forms_list' => ['GET', '/scan_forms', [], 'read', 'List Scan Forms', 'List scan forms with pagination filters.'],
        'scan_forms_get' => ['GET', '/scan_forms/{scan_form_id}', ['scan_form_id'], 'read', 'Get Scan Form', 'Retrieve a scan form.'],
        'refunds_create' => ['POST', '/refunds', [], 'write', 'Create Refunds', 'Bulk request refunds by carrier and tracking codes.', 'refund'],
        'refunds_list' => ['GET', '/refunds', [], 'read', 'List Refunds', 'List refunds with pagination filters.'],
        'refunds_get' => ['GET', '/refunds/{refund_id}', ['refund_id'], 'read', 'Get Refund', 'Retrieve a refund.'],
        'insurances_create' => ['POST', '/insurances', [], 'write', 'Create Insurance', 'Create standalone shipment insurance.', 'insurance'],
        'insurances_list' => ['GET', '/insurances', [], 'read', 'List Insurances', 'List insurance records with pagination filters.'],
        'insurances_get' => ['GET', '/insurances/{insurance_id}', ['insurance_id'], 'read', 'Get Insurance', 'Retrieve an insurance record.'],
        'insurances_refund' => ['POST', '/insurances/{insurance_id}/refund', ['insurance_id'], 'write', 'Refund Insurance', 'Refund an insurance record.'],
        'carrier_accounts_list' => ['GET', '/carrier_accounts', [], 'read', 'List Carrier Accounts', 'List carrier accounts.'],
        'carrier_accounts_get' => ['GET', '/carrier_accounts/{carrier_account_id}', ['carrier_account_id'], 'read', 'Get Carrier Account', 'Retrieve a carrier account.'],
        'carrier_accounts_create' => ['POST', '/carrier_accounts', [], 'write', 'Create Carrier Account', 'Create a carrier account.', 'carrier_account'],
        'carrier_accounts_update' => ['PUT', '/carrier_accounts/{carrier_account_id}', ['carrier_account_id'], 'write', 'Update Carrier Account', 'Update a carrier account.', 'carrier_account'],
        'carrier_accounts_delete' => ['DELETE', '/carrier_accounts/{carrier_account_id}', ['carrier_account_id'], 'write', 'Delete Carrier Account', 'Delete a carrier account.'],
        'carrier_types_list' => ['GET', '/carrier_types', [], 'read', 'List Carrier Types', 'List available carrier account types.'],
        'webhooks_create' => ['POST', '/webhooks', [], 'write', 'Create Webhook', 'Create a webhook endpoint.', 'webhook'],
        'webhooks_list' => ['GET', '/webhooks', [], 'read', 'List Webhooks', 'List webhook endpoints.'],
        'webhooks_get' => ['GET', '/webhooks/{webhook_id}', ['webhook_id'], 'read', 'Get Webhook', 'Retrieve a webhook endpoint.'],
        'webhooks_update' => ['PUT', '/webhooks/{webhook_id}', ['webhook_id'], 'write', 'Update Webhook', 'Update a webhook endpoint.', 'webhook'],
        'webhooks_delete' => ['DELETE', '/webhooks/{webhook_id}', ['webhook_id'], 'write', 'Delete Webhook', 'Delete a webhook endpoint.'],
        'events_list' => ['GET', '/events', [], 'read', 'List Events', 'List webhook events.'],
        'events_get' => ['GET', '/events/{event_id}', ['event_id'], 'read', 'Get Event', 'Retrieve a webhook event.'],
        'reports_create' => ['POST', '/reports/{report_type}', ['report_type'], 'write', 'Create Report', 'Create a report by report type.', 'report'],
        'reports_list' => ['GET', '/reports/{report_type}', ['report_type'], 'read', 'List Reports', 'List reports by report type.'],
        'reports_get' => ['GET', '/reports/{report_type}/{report_id}', ['report_type', 'report_id'], 'read', 'Get Report', 'Retrieve one report by type.'],
        'api_keys_list' => ['GET', '/api_keys', [], 'read', 'List API Keys', 'List EasyPost API keys visible to the credential.'],
    ];

    /**
     * @param  string  $apiKey  EasyPost API key.
     * @param  string  $baseUrl  EasyPost API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Return the documented EasyPost operation map.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function operations(): array
    {
        return self::OPERATIONS;
    }

    /**
     * Call a documented EasyPost operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or body fields.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) {
            throw new RuntimeException("Unsupported EasyPost operation: {$operation}");
        }

        [$method, $path, $required] = $definition;
        foreach ($required as $field) {
            if (($params[$field] ?? '') === '') {
                throw new RuntimeException($field.' is required.');
            }
        }

        $path = $this->interpolatePath($path, $params);
        $bodyKey = $definition[6] ?? null;

        return $this->request($method, $path, $this->shapeData($params, is_string($bodyKey) ? $bodyKey : null));
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  string  $path  Relative EasyPost API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  string  $path  Relative EasyPost API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PUT request.
     *
     * @param  string  $path  Relative EasyPost API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  string  $path  Relative EasyPost API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  string  $path  Relative EasyPost API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch an authenticated EasyPost request.
     *
     * @param  array<string, mixed>  $data  Query or body fields.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('EasyPost API key is not configured.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request.
     *
     * @param  array<string, mixed>  $data  Query or JSON body fields.
     */
    private function rawRequest(string $method, string $path, array $data): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withBasicAuth($this->apiKey, '')->acceptJson()->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asJson()->post($url, $data),
                'PUT' => $http->asJson()->put($url, $data),
                'PATCH' => $http->asJson()->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported EasyPost method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("EasyPost API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to EasyPost API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized EasyPost API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) data_get($json, 'error.message', data_get($json, 'error', data_get($json, 'message', ''))) : trim($response->body());

        Log::error("EasyPost API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('EasyPost API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode JSON, text, or empty EasyPost responses.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        $json = $response->json();
        if (is_array($json)) {
            return ['status' => $response->status(), 'data' => $json];
        }

        return ['status' => $response->status(), 'value' => $body];
    }

    /**
     * Wrap top-level request fields in the documented EasyPost resource key.
     *
     * @param  array<string, mixed>  $params  Request data after path interpolation.
     * @return array<string, mixed>
     */
    private function shapeData(array $params, ?string $bodyKey): array
    {
        if ($bodyKey === null || $params === [] || array_key_exists($bodyKey, $params)) {
            return $params;
        }

        return [$bodyKey => $params];
    }

    /**
     * Interpolate path variables and remove them from request data.
     *
     * @param  array<string, mixed>  $params  Request data.
     */
    private function interpolatePath(string $path, array &$params): string
    {
        return preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use (&$params): string {
            $key = $matches[1];
            $value = $params[$key] ?? null;
            if ($value === null || $value === '') {
                throw new RuntimeException($key.' is required.');
            }

            unset($params[$key]);

            return rawurlencode((string) $value);
        }, $path) ?? $path;
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('EasyPost API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
