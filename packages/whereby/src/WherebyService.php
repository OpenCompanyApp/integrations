<?php

namespace OpenCompany\Integrations\Whereby;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WherebyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.whereby.dev/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    public function listRooms(array $params = []): array
    {
        return $this->request('GET', '/rooms', $params);
    }

    public function getRoom(string $roomName): array
    {
        return $this->request('GET', '/rooms/' . $roomName);
    }

    public function createRoom(array $params = []): array
    {
        return $this->request('POST', '/rooms', $params);
    }

    public function deleteRoom(string $roomName): array
    {
        return $this->request('DELETE', '/rooms/' . $roomName);
    }

    public function listMeetings(array $params = []): array
    {
        return $this->request('GET', '/meetings', $params);
    }

    public function getMeeting(string $meetingId): array
    {
        return $this->request('GET', '/meetings/' . $meetingId);
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Whereby access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Whereby API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Whereby API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Whereby API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Whereby API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Whereby API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Whereby API: {$e->getMessage()}");
        }
    }
}
