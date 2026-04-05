<?php

namespace OpenCompany\Integrations\AcuityScheduling;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AcuitySchedulingService
{
    /**
     * Create a new Acuity Scheduling service instance.
     *
     * @param  string  $accessToken  The OAuth access token for the Acuity API.
     * @param  string  $baseUrl  The base URL for the Acuity API (defaults to https://acuityscheduling.com/api/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://acuityscheduling.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
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
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
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
        if (!$this->accessToken) {
            throw new \RuntimeException('Acuity Scheduling access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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
}
