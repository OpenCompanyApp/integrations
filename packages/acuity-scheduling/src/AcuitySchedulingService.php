<?php

namespace OpenCompany\Integrations\AcuityScheduling;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Acuity Scheduling API.
 *
 * Handles Acuity API v1 authentication, request dispatch, error handling, and
 * endpoint-specific helpers used by the tool classes.
 */
class AcuitySchedulingService
{
    /**
     * Create a new Acuity Scheduling service instance.
     *
     * @param  string  $accessToken  OAuth access token for multi-user Acuity apps.
     * @param  string  $baseUrl  The base URL for the Acuity API (defaults to https://acuityscheduling.com/api/v1).
     * @param  string  $userId  Numeric Acuity user ID for Basic Auth.
     * @param  string  $apiKey  Acuity API key for Basic Auth.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://acuityscheduling.com/api/v1',
        private string $userId = '',
        private string $apiKey = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) || (!empty($this->userId) && !empty($this->apiKey));
    }

    /**
     * List appointments.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., max, minDate, maxDate, calendarID, appointmentTypeID, etc.).
     * @return array<int, array<string, mixed>>
     */
    public function listAppointments(array $params = []): array
    {
        return $this->request('GET', '/appointments', $params);
    }

    /**
     * Get a single appointment by ID.
     *
     * @param  int  $id  The appointment ID.
     * @return array<string, mixed>
     */
    public function getAppointment(int $id): array
    {
        return $this->request('GET', '/appointments/' . $id);
    }

    /**
     * Create a new appointment.
     *
     * @param  array<string, mixed>  $body  Appointment body such as datetime, appointmentTypeID, firstName, lastName, and email.
     * @return array<string, mixed>
     */
    public function createAppointment(array $body): array
    {
        return $this->request('POST', '/appointments', $body);
    }

    /**
     * Update an appointment's editable details.
     *
     * @param  int  $id  Appointment ID.
     * @param  array<string, mixed>  $body  Editable appointment fields.
     * @return array<string, mixed>
     */
    public function updateAppointment(int $id, array $body): array
    {
        return $this->request('PUT', '/appointments/' . $id, $body);
    }

    /**
     * Reschedule an appointment to a new date, time, calendar, or combination.
     *
     * @param  int  $id  Appointment ID.
     * @param  array<string, mixed>  $body  Reschedule payload such as datetime, calendarID, admin, and noEmail.
     * @return array<string, mixed>
     */
    public function rescheduleAppointment(int $id, array $body): array
    {
        return $this->request('PUT', '/appointments/' . $id . '/reschedule', $body);
    }

    /**
     * List payment transactions for an appointment.
     *
     * @param  int  $id  Appointment ID.
     * @return array<int, array<string, mixed>>
     */
    public function listAppointmentPayments(int $id): array
    {
        return $this->request('GET', '/appointments/' . $id . '/payments');
    }

    /**
     * List clients.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., search, email, max, etc.).
     * @return array<int, array<string, mixed>>
     */
    public function listClients(array $params = []): array
    {
        return $this->request('GET', '/clients', $params);
    }

    /**
     * Create a new client.
     *
     * @param  array<string, mixed>  $body  Client body such as firstName, lastName, email, and phone.
     * @return array<string, mixed>
     */
    public function createClient(array $body): array
    {
        return $this->request('POST', '/clients', $body);
    }

    /**
     * Update an existing client.
     *
     * @param  array<string, mixed>  $lookup  Query parameters used to identify the client.
     * @param  array<string, mixed>  $body  Client fields to update.
     * @return array<string, mixed>
     */
    public function updateClient(array $lookup, array $body): array
    {
        return $this->request('PUT', '/clients', array_merge($lookup, $body));
    }

    /**
     * List calendars.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listCalendars(): array
    {
        return $this->request('GET', '/calendars');
    }

    /**
     * List appointment types.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listAppointmentTypes(): array
    {
        return $this->request('GET', '/appointment-types');
    }

    /**
     * Cancel an appointment.
     *
     * @param  int  $id  The appointment ID to cancel.
     * @return array<string, mixed>
     */
    public function cancelAppointment(int $id): array
    {
        return $this->request('PUT', '/appointments/' . $id . '/cancel');
    }

    /**
     * Get available times for an appointment type.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., appointmentTypeID, date, calendarID, etc.).
     * @return array<int, array<string, mixed>>
     */
    public function getAvailability(array $params): array
    {
        return $this->request('GET', '/availability/times', $params);
    }

    /**
     * Get dates with availability for a month and appointment type.
     *
     * @param  array<string, mixed>  $params  Query parameters such as appointmentTypeID and month.
     * @return array<int, array<string, mixed>>
     */
    public function getAvailabilityDates(array $params): array
    {
        return $this->request('GET', '/availability/dates', $params);
    }

    /**
     * Get available class offerings for a month.
     *
     * @param  array<string, mixed>  $params  Query parameters such as appointmentTypeID and month.
     * @return array<int, array<string, mixed>>
     */
    public function getAvailabilityClasses(array $params): array
    {
        return $this->request('GET', '/availability/classes', $params);
    }

    /**
     * List intake forms and their fields.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listForms(): array
    {
        return $this->request('GET', '/forms');
    }

    /**
     * List products and packages.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listProducts(): array
    {
        return $this->request('GET', '/products');
    }

    /**
     * List orders with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<int, array<string, mixed>>
     */
    public function listOrders(array $params = []): array
    {
        return $this->request('GET', '/orders', $params);
    }

    /**
     * Get an order by ID.
     *
     * @param  int  $id  Order ID.
     * @return array<string, mixed>
     */
    public function getOrder(int $id): array
    {
        return $this->request('GET', '/orders/' . $id);
    }

    /**
     * Create a package or coupon certificate.
     *
     * @param  array<string, mixed>  $body  Certificate body.
     * @return array<string, mixed>
     */
    public function createCertificate(array $body): array
    {
        return $this->request('POST', '/certificates', $body);
    }

    /**
     * List calendar blocks.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<int, array<string, mixed>>
     */
    public function listBlocks(array $params = []): array
    {
        return $this->request('GET', '/blocks', $params);
    }

    /**
     * Create a calendar block.
     *
     * @param  array<string, mixed>  $body  Block body.
     * @return array<string, mixed>
     */
    public function createBlock(array $body): array
    {
        return $this->request('POST', '/blocks', $body);
    }

    /**
     * Delete a calendar block.
     *
     * @param  int  $id  Block ID.
     * @return array<string, mixed>
     */
    public function deleteBlock(int $id): array
    {
        return $this->request('DELETE', '/blocks/' . $id);
    }

    /**
     * List dynamic webhooks.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listWebhooks(): array
    {
        return $this->request('GET', '/webhooks');
    }

    /**
     * Create a dynamic webhook.
     *
     * @param  array<string, mixed>  $body  Webhook body with event and target.
     * @return array<string, mixed>
     */
    public function createWebhook(array $body): array
    {
        return $this->request('POST', '/webhooks', $body);
    }

    /**
     * Delete a dynamic webhook.
     *
     * @param  int  $id  Webhook ID.
     * @return array<string, mixed>
     */
    public function deleteWebhook(int $id): array
    {
        return $this->request('DELETE', '/webhooks/' . $id);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Call any Acuity GET API endpoint.
     *
     * @param  string  $path  API path relative to the v1 base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Call any Acuity POST API endpoint.
     *
     * @param  string  $path  API path relative to the v1 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $body);
    }

    /**
     * Call any Acuity PUT API endpoint.
     *
     * @param  string  $path  API path relative to the v1 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $body);
    }

    /**
     * Call any Acuity DELETE API endpoint.
     *
     * @param  string  $path  API path relative to the v1 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., /appointments).
     * @param  array<string, mixed>  $params  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Acuity Scheduling API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $params  Query parameters for GET requests.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $params = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Acuity Scheduling credentials are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            if ($this->userId !== '' && $this->apiKey !== '') {
                $http = $http->withBasicAuth($this->userId, $this->apiKey);
            } else {
                $http = $http->withToken($this->accessToken);
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Acuity Scheduling API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Acuity Scheduling API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Acuity Scheduling API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Acuity Scheduling API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a generic API path.
     */
    private function normalizePath(string $path): string
    {
        return '/'.ltrim($path, '/');
    }
}
