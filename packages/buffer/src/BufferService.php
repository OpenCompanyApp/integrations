<?php

namespace OpenCompany\Integrations\Buffer;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for Buffer REST and GraphQL APIs.
 *
 * Handles bearer-token authentication, request dispatch, error logging, and
 * response parsing for both the legacy REST surface and current GraphQL API.
 */
class BufferService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.bufferapp.com/1',
        private string $graphqlUrl = 'https://api.buffer.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->graphqlUrl = rtrim($this->graphqlUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all social media profiles connected to the Buffer account.
     *
     * @return array<string, mixed>
     */
    public function listProfiles(): array
    {
        return $this->request('GET', '/profiles.json');
    }

    /**
     * Get a single social media profile by ID.
     *
     * @param  string  $profileId  The profile ID.
     * @return array<string, mixed>
     */
    public function getProfile(string $profileId): array
    {
        return $this->request('GET', '/profiles/' . urlencode($profileId) . '.json');
    }

    /**
     * List posting schedules for a social media profile.
     *
     * @param  string  $profileId  The profile ID.
     * @return array<string, mixed>
     */
    public function listProfileSchedules(string $profileId): array
    {
        return $this->request('GET', '/profiles/' . urlencode($profileId) . '/schedules.json');
    }

    /**
     * Replace posting schedules for a social media profile.
     *
     * @param  string  $profileId  The profile ID.
     * @param  array<int, array<string, mixed>>  $schedules  Schedule definitions with days and times.
     * @return array<string, mixed>
     */
    public function updateProfileSchedules(string $profileId, array $schedules): array
    {
        $payload = array_is_list($schedules) ? ['schedules' => $schedules] : $schedules;

        return $this->request('POST', '/profiles/' . urlencode($profileId) . '/schedules/update.json', [
            ...$payload,
        ]);
    }

    /**
     * List pending (scheduled) updates for a profile.
     *
     * @param  string     $profileId  The profile ID.
     * @param  int|null  $count  Number of updates to return.
     * @param  int|null  $page  Page number for pagination.
     * @param  int|null  $since  Unix timestamp lower bound.
     * @param  bool|null  $utc  Return times in UTC.
     * @return array<string, mixed>
     */
    public function listPendingUpdates(string $profileId, ?int $count = null, ?int $page = null, ?int $since = null, ?bool $utc = null): array
    {
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($since !== null) {
            $params['since'] = $since;
        }
        if ($utc !== null) {
            $params['utc'] = $utc;
        }

        return $this->request('GET', '/profiles/' . urlencode($profileId) . '/updates/pending.json', $params);
    }

    /**
     * Create a new update (post) for one or more profiles.
     *
     * @param  string  $text              The text content of the update.
     * @param  array   $profileIds        Array of profile IDs to publish to.
     * @param  bool    $shorten           Whether to shorten links (default true).
     * @param  bool    $now               Post immediately instead of scheduling.
     * @param  string|null  $scheduledAt   ISO 8601 timestamp for scheduling.
     * @param  array|null   $media        Media attachments (photo, link, etc.).
     * @return array<string, mixed>
     */
    public function createUpdate(
        string $text,
        array $profileIds,
        bool $shorten = true,
        bool $now = false,
        bool $top = false,
        ?string $scheduledAt = null,
        ?array $media = null,
        ?array $retweet = null,
        ?bool $attachment = null,
    ): array {
        $data = [
            'text' => $text,
            'profile_ids' => $profileIds,
            'shorten' => $shorten,
            'now' => $now,
            'top' => $top,
        ];

        if ($scheduledAt !== null) {
            $data['scheduled_at'] = $scheduledAt;
        }

        if ($media !== null) {
            $data['media'] = $media;
        }
        if ($retweet !== null) {
            $data['retweet'] = $retweet;
        }
        if ($attachment !== null) {
            $data['attachment'] = $attachment;
        }

        return $this->request('POST', '/updates/create.json', $data);
    }

    /**
     * List sent (posted) updates for a profile.
     *
     * @param  string   $profileId  The profile ID.
     * @param  int|null  $count  Number of updates to return.
     * @param  int|null  $page  Page number for pagination.
     * @param  int|null  $since  Unix timestamp lower bound.
     * @param  bool|null  $utc  Return times in UTC.
     * @param  string|null  $filter  Sent update filter.
     * @return array<string, mixed>
     */
    public function listSentUpdates(string $profileId, ?int $count = null, ?int $page = null, ?int $since = null, ?bool $utc = null, ?string $filter = null): array
    {
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($since !== null) {
            $params['since'] = $since;
        }
        if ($utc !== null) {
            $params['utc'] = $utc;
        }
        if ($filter !== null) {
            $params['filter'] = $filter;
        }

        return $this->request('GET', '/profiles/' . urlencode($profileId) . '/updates/sent.json', $params);
    }

    /**
     * Get a single update by ID.
     *
     * @param  string  $updateId  The update ID.
     * @return array<string, mixed>
     */
    public function getUpdate(string $updateId): array
    {
        return $this->request('GET', '/updates/' . urlencode($updateId) . '.json');
    }

    /**
     * Reorder pending updates for a profile.
     *
     * @param  string  $profileId  The profile ID.
     * @param  array<int, string>  $order  Ordered update IDs.
     * @param  int|null  $offset  Optional offset for partial reorder.
     * @param  bool|null  $utc  Return times in UTC.
     * @return array<string, mixed>
     */
    public function reorderUpdates(string $profileId, array $order, ?int $offset = null, ?bool $utc = null): array
    {
        $data = ['order' => $order];
        if ($offset !== null) {
            $data['offset'] = $offset;
        }
        if ($utc !== null) {
            $data['utc'] = $utc;
        }

        return $this->request('POST', '/profiles/' . urlencode($profileId) . '/updates/reorder.json', $data);
    }

    /**
     * Randomize pending updates for a profile.
     *
     * @param  string  $profileId  The profile ID.
     * @param  int|null  $count  Number of updates to return.
     * @param  bool|null  $utc  Return times in UTC.
     * @return array<string, mixed>
     */
    public function shuffleUpdates(string $profileId, ?int $count = null, ?bool $utc = null): array
    {
        $data = [];
        if ($count !== null) {
            $data['count'] = $count;
        }
        if ($utc !== null) {
            $data['utc'] = $utc;
        }

        return $this->request('POST', '/profiles/' . urlencode($profileId) . '/updates/shuffle.json', $data);
    }

    /**
     * Edit an existing pending update.
     *
     * @param  string  $updateId  The update ID.
     * @param  array<string, mixed>  $payload  Update payload.
     * @return array<string, mixed>
     */
    public function updateUpdate(string $updateId, array $payload): array
    {
        return $this->request('POST', '/updates/' . urlencode($updateId) . '/update.json', $payload);
    }

    /**
     * Immediately share a pending update.
     *
     * @param  string  $updateId  The update ID.
     * @return array<string, mixed>
     */
    public function shareUpdate(string $updateId): array
    {
        return $this->request('POST', '/updates/' . urlencode($updateId) . '/share.json');
    }

    /**
     * Permanently delete a pending update.
     *
     * @param  string  $updateId  The update ID.
     * @return array<string, mixed>
     */
    public function destroyUpdate(string $updateId): array
    {
        return $this->request('POST', '/updates/' . urlencode($updateId) . '/destroy.json');
    }

    /**
     * Move a pending update to the top of the queue.
     *
     * @param  string  $updateId  The update ID.
     * @return array<string, mixed>
     */
    public function moveUpdateToTop(string $updateId): array
    {
        return $this->request('POST', '/updates/' . urlencode($updateId) . '/move_to_top.json');
    }

    /**
     * Get the number of Buffer shares for a URL.
     *
     * @param  string  $url  Absolute URL to inspect.
     * @return array<string, mixed>
     */
    public function getLinkShares(string $url): array
    {
        return $this->request('GET', '/links/shares.json', ['url' => $url]);
    }

    /**
     * Get Buffer API configuration metadata.
     *
     * @return array<string, mixed>
     */
    public function getInfoConfiguration(): array
    {
        return $this->request('GET', '/info/configuration.json');
    }

    /**
     * Get the currently authenticated Buffer user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user.json');
    }

    /**
     * Deauthorize the current Buffer API token.
     *
     * @return array<string, mixed>
     */
    public function deauthorizeUser(): array
    {
        return $this->request('POST', '/user/deauthorize.json');
    }

    /**
     * Execute a Buffer GraphQL operation against the current beta API.
     *
     * @param  string  $query  GraphQL query or mutation document.
     * @param  array<string, mixed>  $variables  GraphQL variables.
     * @param  string|null  $operationName  Optional operation name.
     * @return array<string, mixed>
     */
    public function graphql(string $query, array $variables = [], ?string $operationName = null): array
    {
        $payload = ['query' => $query];
        if ($variables !== []) {
            $payload['variables'] = $variables;
        }
        if ($operationName !== null) {
            $payload['operationName'] = $operationName;
        }

        $response = $this->rawGraphqlRequest($payload);

        return $response->json() ?? [];
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/profiles.json").
     * @param  array   $data    Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Buffer API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query params or body data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Buffer access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'PUT' => $http->asForm()->put($url, $data),
                'DELETE' => $http->asForm()->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Buffer API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Buffer API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Buffer API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Buffer API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Buffer API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Buffer API: {$e->getMessage()}");
        }
    }

    /**
     * Make a raw request to the current Buffer GraphQL API.
     *
     * @param  array<string, mixed>  $payload  GraphQL request payload.
     * @return \Illuminate\Http\Client\Response
     */
    private function rawGraphqlRequest(array $payload): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Buffer access token is not configured.');
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->graphqlUrl, $payload);

            if (!$response->successful()) {
                $error = $response->json('errors.0.message') ?? $response->json('message') ?? $response->body();
                Log::error('Buffer GraphQL API error', [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Buffer GraphQL API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Buffer GraphQL API connection error', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Buffer GraphQL API: {$e->getMessage()}");
        }
    }
}
