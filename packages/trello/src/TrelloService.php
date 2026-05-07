<?php

namespace OpenCompany\Integrations\Trello;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Trello REST API.
 *
 * Handles bearer-token authentication, board/list/card endpoints, and normalized API errors.
 */
class TrelloService
{
    /**
     * @param  string  $accessToken  Trello API access token
     * @param  string  $baseUrl  Trello API base URL
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.trello.com/1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List boards for the authenticated member.
     *
     * @param  array<string, mixed>  $params  Query params (filter, fields, limit)
     * @return array<string, mixed>
     */
    public function listBoards(array $params = []): array
    {
        return $this->request('GET', '/members/me/boards', $params);
    }

    /**
     * Get a board by ID.
     *
     * @param  string  $id  Board ID
     * @return array<string, mixed>
     */
    public function getBoard(string $id): array
    {
        return $this->request('GET', "/boards/{$id}");
    }

    /**
     * List all lists on a board.
     *
     * @param  string  $id  Board ID
     * @return array<string, mixed>
     */
    public function listLists(string $id): array
    {
        return $this->request('GET', "/boards/{$id}/lists");
    }

    /**
     * Get a list by ID.
     *
     * @param  string  $id  List ID
     * @return array<string, mixed>
     */
    public function getList(string $id): array
    {
        return $this->request('GET', "/lists/{$id}");
    }

    /**
     * List all cards in a list.
     *
     * @param  string  $id     List ID
     * @param  array<string, mixed>  $params  Query params (limit, before)
     * @return array<string, mixed>
     */
    public function listCards(string $id, array $params = []): array
    {
        return $this->request('GET', "/lists/{$id}/cards", $params);
    }

    /**
     * Create a new card.
     *
     * @param  array<string, mixed>  $data  Card fields (name, idList, desc, etc.)
     * @return array<string, mixed>
     */
    public function createCard(array $data): array
    {
        return $this->request('POST', '/cards', $data);
    }

    /**
     * Get the currently authenticated member.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/members/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/boards/123").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Trello API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Trello API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Trello API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Trello API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Trello API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Trello API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Trello API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Trello API: {$e->getMessage()}");
        }
    }
}
