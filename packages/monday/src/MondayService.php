<?php

namespace OpenCompany\Integrations\Monday;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Monday.com GraphQL API.
 *
 * Wraps HTTP calls to Monday.com's single GraphQL endpoint at
 * `https://api.monday.com/v2`.  All operations (queries and mutations)
 * are sent as POST requests with a JSON body containing `query` and
 * optional `variables`.
 *
 * Authentication uses a Personal Access Token sent directly in the
 * `Authorization` header (no "Bearer" prefix).
 */
class MondayService
{
    private const BASE_URL = 'https://api.monday.com/v2';

    /**
     * @param  string  $apiToken  Monday.com Personal Access Token
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->graphql('{ me { id name email } }');
    }

    // ── GraphQL ─────────────────────────────────────────────

    /**
     * Execute a GraphQL query or mutation against the Monday.com API.
     *
     * Sends the API token directly in the Authorization header (no "Bearer" prefix).
     * The query string and optional variables are JSON-encoded in the POST body.
     *
     * @param  string               $query      GraphQL query or mutation string
     * @param  array<string, mixed>  $variables  Optional variables for the GraphQL operation
     * @return array<string, mixed>
     */
    public function graphql(string $query, array $variables = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Monday.com API token is not configured.');
        }

        $payload = ['query' => $query];

        if (! empty($variables)) {
            $payload['variables'] = $variables;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post(self::BASE_URL, $payload);

            if (! $response->successful()) {
                Log::error('Monday.com API error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Monday.com API error ({$response->status()}): {$response->body()}");
            }

            $json = $response->json();

            if (isset($json['errors']) && ! empty($json['errors'])) {
                $messages = array_map(fn (array $e) => $e['message'] ?? json_encode($e), $json['errors']);
                $errorMsg = implode('; ', $messages);

                Log::error('Monday.com GraphQL error', ['errors' => $json['errors']]);

                throw new \RuntimeException("Monday.com GraphQL error: {$errorMsg}");
            }

            return $json['data'] ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Monday.com API connection error', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Monday.com API: {$e->getMessage()}");
        }
    }
}
