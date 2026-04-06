<?php

namespace OpenCompany\Integrations\Memberstack;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MemberstackService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.memberstack.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List members with pagination.
     *
     * @param  int  $limit  Number of members per page (max 100).
     * @param  int  $page   Page number (1-based).
     */
    public function listMembers(int $limit = 50, int $page = 1): array
    {
        return $this->request('GET', '/v1/members', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single member by ID.
     */
    public function getMember(string $id): array
    {
        return $this->request('GET', '/v1/members/' . urlencode($id));
    }

    /**
     * Create a new member.
     *
     * @param  string  $email     Member email address.
     * @param  string|null  $password  Optional password.
     * @param  string|null  $planId    Optional plan ID to assign.
     * @param  array|null   $metadata  Optional custom metadata key/value pairs.
     */
    public function createMember(string $email, ?string $password = null, ?string $planId = null, ?array $metadata = null): array
    {
        $data = ['email' => $email];

        if ($password !== null) {
            $data['password'] = $password;
        }
        if ($planId !== null) {
            $data['planId'] = $planId;
        }
        if ($metadata !== null) {
            $data['metadata'] = $metadata;
        }

        return $this->request('POST', '/v1/members', $data);
    }

    /**
     * Update an existing member.
     *
     * @param  string  $id        Member ID.
     * @param  string|null  $email     New email address.
     * @param  string|null  $planId    New plan ID to assign.
     * @param  array|null   $metadata  Custom metadata to merge.
     */
    public function updateMember(string $id, ?string $email = null, ?string $planId = null, ?array $metadata = null): array
    {
        $data = [];

        if ($email !== null) {
            $data['email'] = $email;
        }
        if ($planId !== null) {
            $data['planId'] = $planId;
        }
        if ($metadata !== null) {
            $data['metadata'] = $metadata;
        }

        return $this->request('PUT', '/v1/members/' . urlencode($id), $data);
    }

    /**
     * Delete a member by ID.
     */
    public function deleteMember(string $id): void
    {
        $this->request('DELETE', '/v1/members/' . urlencode($id));
    }

    /**
     * List all available plans.
     */
    public function listPlans(): array
    {
        return $this->request('GET', '/v1/plans');
    }

    /**
     * Get the currently authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Memberstack API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Memberstack access token is not configured.');
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
                    Log::warning("Memberstack API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Memberstack API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Memberstack API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Memberstack API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Memberstack API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Memberstack API: {$e->getMessage()}");
        }
    }
}
