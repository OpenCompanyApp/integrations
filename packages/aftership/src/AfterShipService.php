<?php

namespace OpenCompany\Integrations\AfterShip;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the AfterShip Tracking API.
 *
 * Handles API-key authentication, versioned endpoint dispatch, body envelopes,
 * required-parameter validation, and API error normalization for all tools.
 */
class AfterShipService
{
    /**
     * @param  string  $apiKey  AfterShip API key.
     * @param  string  $baseUrl  Versioned AfterShip Tracking API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = 'https://api.aftership.com/tracking/2026-01')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * List trackings.
     *
     * @param  array<string, mixed>  $params  Pagination, courier, status, tag, date, language, and field filters.
     * @return array<string, mixed>
     */
    public function listTrackings(array $params = []): array
    {
        return $this->get('trackings', $params);
    }

    /**
     * Create a tracking.
     *
     * @param  array<string, mixed>  $params  Tracking fields or a full tracking object.
     * @return array<string, mixed>
     */
    public function createTracking(array $params): array
    {
        $tracking = $this->bodyObject($params, 'tracking');
        $this->requireBody($tracking, ['tracking_number'], 'tracking');

        return $this->post('trackings', ['tracking' => $tracking]);
    }

    /**
     * Get a tracking by ID.
     *
     * @param  array<string, mixed>  $params  Tracking ID.
     * @return array<string, mixed>
     */
    public function getTracking(array $params): array
    {
        return $this->get('trackings/'.$this->requiredPath($params, 'id'));
    }

    /**
     * Update a tracking by ID.
     *
     * @param  array<string, mixed>  $params  Tracking ID plus fields or a full tracking object.
     * @return array<string, mixed>
     */
    public function updateTracking(array $params): array
    {
        $id = $this->requiredPath($params, 'id');
        unset($params['id']);
        $tracking = $this->bodyObject($params, 'tracking');

        return $this->put('trackings/'.$id, ['tracking' => $tracking]);
    }

    /**
     * Delete a tracking by ID.
     *
     * @param  array<string, mixed>  $params  Tracking ID.
     * @return array<string, mixed>
     */
    public function deleteTracking(array $params): array
    {
        return $this->delete('trackings/'.$this->requiredPath($params, 'id'));
    }

    /**
     * Retrack an expired tracking by ID.
     *
     * @param  array<string, mixed>  $params  Tracking ID.
     * @return array<string, mixed>
     */
    public function retrackTracking(array $params): array
    {
        return $this->post('trackings/'.$this->requiredPath($params, 'id').'/retrack');
    }

    /**
     * Mark a tracking as completed by ID.
     *
     * @param  array<string, mixed>  $params  Tracking ID and optional completion details.
     * @return array<string, mixed>
     */
    public function markTrackingCompleted(array $params): array
    {
        $id = $this->requiredPath($params, 'id');
        unset($params['id']);

        return $this->post('trackings/'.$id.'/mark-as-completed', $params);
    }

    /**
     * List supported couriers.
     *
     * @param  array<string, mixed>  $params  Optional language and slug filters.
     * @return array<string, mixed>
     */
    public function listCouriers(array $params = []): array
    {
        return $this->get('couriers', $params);
    }

    /**
     * Detect courier candidates for a tracking.
     *
     * @param  array<string, mixed>  $params  Tracking number and optional account/location hints.
     * @return array<string, mixed>
     */
    public function detectCourier(array $params): array
    {
        $this->requireBody($params, ['tracking_number'], 'courier detection');

        return $this->post('couriers/detect', ['tracking' => $params]);
    }

    /**
     * List courier connections.
     *
     * @param  array<string, mixed>  $params  Optional courier and pagination filters.
     * @return array<string, mixed>
     */
    public function listCourierConnections(array $params = []): array
    {
        return $this->get('courier-connections', $params);
    }

    /**
     * Create courier connections.
     *
     * @param  array<string, mixed>  $params  Courier connection payload or list.
     * @return array<string, mixed>
     */
    public function createCourierConnections(array $params): array
    {
        return $this->post('courier-connections', $params);
    }

    /**
     * Get a courier connection by ID.
     *
     * @param  array<string, mixed>  $params  Courier connection ID.
     * @return array<string, mixed>
     */
    public function getCourierConnection(array $params): array
    {
        return $this->get('courier-connections/'.$this->requiredPath($params, 'id'));
    }

    /**
     * Update a courier connection by ID.
     *
     * @param  array<string, mixed>  $params  Courier connection ID plus patch payload.
     * @return array<string, mixed>
     */
    public function updateCourierConnection(array $params): array
    {
        $id = $this->requiredPath($params, 'id');
        unset($params['id']);

        return $this->patch('courier-connections/'.$id, $params);
    }

    /**
     * Delete a courier connection by ID.
     *
     * @param  array<string, mixed>  $params  Courier connection ID.
     * @return array<string, mixed>
     */
    public function deleteCourierConnection(array $params): array
    {
        return $this->delete('courier-connections/'.$this->requiredPath($params, 'id'));
    }

    /**
     * Predict estimated delivery date for one shipment.
     *
     * @param  array<string, mixed>  $params  EDD prediction payload.
     * @return array<string, mixed>
     */
    public function predictEstimatedDeliveryDate(array $params): array
    {
        return $this->post('estimated-delivery-date/predict', $params);
    }

    /**
     * Predict estimated delivery dates for multiple shipments.
     *
     * @param  array<string, mixed>  $params  Batch EDD prediction payload.
     * @return array<string, mixed>
     */
    public function batchPredictEstimatedDeliveryDate(array $params): array
    {
        return $this->post('estimated-delivery-date/batch-predict', $params);
    }

    /**
     * Execute an AfterShip GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $path, array $query = []): array
    {
        return $this->request('get', $path, query: $query);
    }

    /**
     * Execute an AfterShip POST request.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function post(string $path, array $body = []): array
    {
        return $this->request('post', $path, body: $body);
    }

    /**
     * Execute an AfterShip PUT request.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function put(string $path, array $body = []): array
    {
        return $this->request('put', $path, body: $body);
    }

    /**
     * Execute an AfterShip PATCH request.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function patch(string $path, array $body = []): array
    {
        return $this->request('patch', $path, body: $body);
    }

    /**
     * Execute an AfterShip DELETE request.
     *
     * @return array<string, mixed>
     */
    private function delete(string $path): array
    {
        return $this->request('delete', $path);
    }

    /**
     * Execute an AfterShip HTTP request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('AfterShip API key is required.');
        }

        try {
            $pending = Http::acceptJson()
                ->asJson()
                ->withHeaders(['as-api-key' => $this->apiKey])
                ->timeout(60);

            $url = $this->baseUrl.'/'.$path;
            $response = match ($method) {
                'get' => $pending->get($url, $this->clean($query)),
                'post' => $pending->post($url, $this->clean($body)),
                'put' => $pending->put($url, $this->clean($body)),
                'patch' => $pending->patch($url, $this->clean($body)),
                'delete' => $pending->delete($url),
                default => throw new RuntimeException('Unsupported AfterShip HTTP method.'),
            };

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('AfterShip API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to AfterShip API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize AfterShip errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();
        if (!$response->successful()) {
            $meta = is_array($json) ? ($json['meta'] ?? []) : [];
            $message = is_array($meta) ? (string) ($meta['message'] ?? '') : '';
            $code = is_array($meta) ? (string) ($meta['code'] ?? '') : '';
            if ($message === '') {
                $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : trim(strip_tags($response->body()));
            }
            Log::error('AfterShip API error: '.$path, ['status' => $response->status(), 'code' => $code, 'error' => $message]);

            throw new RuntimeException('AfterShip API error'.($code !== '' ? ' '.$code : '').' ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Extract a named object payload or use top-level fields as the object.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array<string, mixed>
     */
    private function bodyObject(array $params, string $key): array
    {
        return isset($params[$key]) && is_array($params[$key]) ? $params[$key] : $params;
    }

    /**
     * Validate body fields.
     *
     * @param  array<string, mixed>  $body  Body payload.
     * @param  list<string>  $required  Required field names.
     */
    private function requireBody(array $body, array $required, string $label): void
    {
        foreach ($required as $field) {
            if (!array_key_exists($field, $body) || trim((string) $body[$field]) === '') {
                throw new RuntimeException($field.' is required for '.$label.'.');
            }
        }
    }

    /**
     * Validate and URL-encode a required path parameter.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     */
    private function requiredPath(array $params, string $field): string
    {
        if (!array_key_exists($field, $params) || trim((string) $params[$field]) === '') {
            throw new RuntimeException($field.' is required.');
        }

        return rawurlencode((string) $params[$field]);
    }

    /**
     * Remove null and empty-string values recursively.
     *
     * @param  array<string, mixed>  $input  Input values.
     * @return array<string, mixed>
     */
    private function clean(array $input): array
    {
        $clean = [];
        foreach ($input as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }
            $clean[$key] = is_array($value) ? $this->clean($value) : $value;
        }

        return $clean;
    }
}
