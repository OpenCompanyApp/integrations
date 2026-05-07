<?php

namespace OpenCompany\Integrations\Pushover;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Pushover REST API.
 *
 * Handles form-encoded authentication, endpoint dispatch, response parsing, and API error reporting.
 */
class PushoverService
{
    /**
     * @param  string  $apiKey  Pushover application API token.
     * @param  string  $userKey  Default Pushover user or group key for user-scoped calls.
     * @param  string  $baseUrl  Base URL for the Pushover API.
     * @param  string  $teamToken  Optional Pushover Teams API token for team membership calls.
     */
    public function __construct(
        private string $apiKey = '',
        private string $userKey = '',
        private string $baseUrl = 'https://api.pushover.net/1',
        private string $teamToken = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with the required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->userKey);
    }

    /**
     * Check whether the service has a Pushover Teams API token.
     */
    public function isTeamConfigured(): bool
    {
        return !empty($this->teamToken);
    }

    /**
     * Get the configured user key.
     */
    public function getUserKey(): string
    {
        return $this->userKey;
    }

    /*
    |--------------------------------------------------------------------------
    | Messages
    |--------------------------------------------------------------------------
    */

    /**
     * Send a push notification message.
     *
     * @param  string  $message  Notification message body or pre-encrypted message payload.
     * @param  string|null  $title  Optional title for the notification.
     * @param  int|null  $priority  Message priority (-2 to 2).
     * @param  array<string, mixed>  $extra  Additional supported message parameters.
     * @return array<string, mixed>
     */
    public function sendMessage(string $message, ?string $title = null, ?int $priority = null, array $extra = []): array
    {
        $data = array_merge($extra, [
            'message' => $message,
        ]);

        if ($title !== null) {
            $data['title'] = $title;
        }

        if ($priority !== null) {
            $data['priority'] = $priority;
        }

        return $this->request('POST', '/messages.json', $data);
    }

    /**
     * Get the monthly message limit and remaining quota for the application token.
     *
     * @return array<string, mixed>
     */
    public function getApplicationLimits(): array
    {
        return $this->request('GET', '/apps/limits.json', [], includeUser: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Sounds and validation
    |--------------------------------------------------------------------------
    */

    /**
     * List available notification sounds.
     *
     * @return array<string, mixed>
     */
    public function listSounds(): array
    {
        return $this->request('GET', '/sounds.json', [], includeUser: false);
    }

    /**
     * Validate a user or group key, optionally scoped to a device.
     *
     * @param  string|null  $userKey  User or group key to validate; defaults to the configured user key.
     * @param  string|null  $device  Optional device name to validate.
     * @return array<string, mixed>
     */
    public function validateUser(?string $userKey = null, ?string $device = null): array
    {
        $data = [
            'user' => $userKey ?: $this->userKey,
        ];

        if ($device !== null && $device !== '') {
            $data['device'] = $device;
        }

        return $this->request('POST', '/users/validate.json', $data, includeUser: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Emergency receipts
    |--------------------------------------------------------------------------
    */

    /**
     * Get acknowledgement and retry status for an emergency message receipt.
     *
     * @param  string  $receipt  Pushover receipt identifier returned by an emergency message.
     * @return array<string, mixed>
     */
    public function getReceipt(string $receipt): array
    {
        return $this->request('GET', "/receipts/{$receipt}.json", [], includeUser: false);
    }

    /**
     * Cancel retries for an active emergency message receipt.
     *
     * @param  string  $receipt  Pushover receipt identifier to cancel.
     * @return array<string, mixed>
     */
    public function cancelReceipt(string $receipt): array
    {
        return $this->request('POST', "/receipts/{$receipt}/cancel.json", [], includeUser: false);
    }

    /**
     * Cancel retries for all active emergency receipts matching a tag.
     *
     * @param  string  $tag  Tag supplied on emergency messages.
     * @return array<string, mixed>
     */
    public function cancelReceiptsByTag(string $tag): array
    {
        return $this->request('POST', "/receipts/cancel_by_tag/{$tag}.json", [], includeUser: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Subscriptions
    |--------------------------------------------------------------------------
    */

    /**
     * Migrate a collected user key to a subscription-scoped user key.
     *
     * @param  string  $subscription  Pushover subscription code.
     * @param  string  $userKey  Existing Pushover user key.
     * @param  array<string, mixed>  $data  Optional device_name and sound fields.
     * @return array<string, mixed>
     */
    public function migrateSubscriptionUser(string $subscription, string $userKey, array $data = []): array
    {
        return $this->request('POST', '/subscriptions/migrate.json', array_merge($data, [
            'subscription' => $subscription,
            'user' => $userKey,
        ]), includeUser: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Teams
    |--------------------------------------------------------------------------
    */

    /**
     * Get Pushover team information and users.
     *
     * @return array<string, mixed>
     */
    public function getTeam(): array
    {
        if (! $this->isTeamConfigured()) {
            throw new RuntimeException('Pushover team token is not configured.');
        }

        return $this->request('GET', '/teams.json', [], includeUser: false, token: $this->teamToken);
    }

    /**
     * Add a user to a Pushover team.
     *
     * @param  array<string, mixed>  $data  Team user fields (email, name, password, instant, admin, group).
     * @return array<string, mixed>
     */
    public function addTeamUser(array $data): array
    {
        if (! $this->isTeamConfigured()) {
            throw new RuntimeException('Pushover team token is not configured.');
        }

        return $this->request('POST', '/teams/add_user.json', $data, includeUser: false, token: $this->teamToken);
    }

    /**
     * Remove a user from a Pushover team by email address.
     *
     * @param  string  $email  Team user's email address.
     * @return array<string, mixed>
     */
    public function removeTeamUser(string $email): array
    {
        if (! $this->isTeamConfigured()) {
            throw new RuntimeException('Pushover team token is not configured.');
        }

        return $this->request('POST', '/teams/remove_user.json', [
            'email' => $email,
        ], includeUser: false, token: $this->teamToken);
    }

    /*
    |--------------------------------------------------------------------------
    | Delivery groups
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new Pushover delivery group.
     *
     * @param  string  $name  Group name.
     * @return array<string, mixed>
     */
    public function createGroup(string $name): array
    {
        return $this->request('POST', '/groups.json', ['name' => $name], includeUser: false);
    }

    /**
     * List delivery groups owned by the application token's account.
     *
     * @return array<string, mixed>
     */
    public function listGroups(): array
    {
        return $this->request('GET', '/groups.json', [], includeUser: false);
    }

    /**
     * Get a delivery group's name and member list.
     *
     * @param  string  $groupKey  Delivery group key.
     * @return array<string, mixed>
     */
    public function getGroup(string $groupKey): array
    {
        return $this->request('GET', "/groups/{$groupKey}.json", [], includeUser: false);
    }

    /**
     * Add a user to a delivery group.
     *
     * @param  string  $groupKey  Delivery group key.
     * @param  string  $userKey  Pushover user key.
     * @param  array<string, mixed>  $data  Optional device and memo fields.
     * @return array<string, mixed>
     */
    public function addGroupUser(string $groupKey, string $userKey, array $data = []): array
    {
        return $this->request('POST', "/groups/{$groupKey}/add_user.json", array_merge($data, [
            'user' => $userKey,
        ]), includeUser: false);
    }

    /**
     * Remove a user from a delivery group.
     *
     * @param  string  $groupKey  Delivery group key.
     * @param  string  $userKey  Pushover user key.
     * @param  string|null  $device  Optional device name to match.
     * @return array<string, mixed>
     */
    public function removeGroupUser(string $groupKey, string $userKey, ?string $device = null): array
    {
        return $this->groupUserAction($groupKey, 'remove_user', $userKey, $device);
    }

    /**
     * Temporarily disable a user in a delivery group.
     *
     * @param  string  $groupKey  Delivery group key.
     * @param  string  $userKey  Pushover user key.
     * @param  string|null  $device  Optional device name to match.
     * @return array<string, mixed>
     */
    public function disableGroupUser(string $groupKey, string $userKey, ?string $device = null): array
    {
        return $this->groupUserAction($groupKey, 'disable_user', $userKey, $device);
    }

    /**
     * Re-enable a user in a delivery group.
     *
     * @param  string  $groupKey  Delivery group key.
     * @param  string  $userKey  Pushover user key.
     * @param  string|null  $device  Optional device name to match.
     * @return array<string, mixed>
     */
    public function enableGroupUser(string $groupKey, string $userKey, ?string $device = null): array
    {
        return $this->groupUserAction($groupKey, 'enable_user', $userKey, $device);
    }

    /**
     * Rename a delivery group.
     *
     * @param  string  $groupKey  Delivery group key.
     * @param  string  $name  New group name.
     * @return array<string, mixed>
     */
    public function renameGroup(string $groupKey, string $name): array
    {
        return $this->request('POST', "/groups/{$groupKey}/rename.json", [
            'name' => $name,
        ], includeUser: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Glances
    |--------------------------------------------------------------------------
    */

    /**
     * Update Pushover glance/widget data for the configured user.
     *
     * @param  array<string, mixed>  $data  Glance fields (device, title, text, subtext, count, percent).
     * @return array<string, mixed>
     */
    public function updateGlance(array $data): array
    {
        return $this->request('POST', '/glances.json', $data);
    }

    /*
    |--------------------------------------------------------------------------
    | Licensing
    |--------------------------------------------------------------------------
    */

    /**
     * Get remaining license credits for the application token.
     *
     * @return array<string, mixed>
     */
    public function getLicenseCredits(): array
    {
        return $this->request('GET', '/licenses.json', [], includeUser: false);
    }

    /**
     * Assign a prepaid license credit to a Pushover user or email address.
     *
     * @param  array<string, mixed>  $data  License assignment fields (user, email, os).
     * @return array<string, mixed>
     */
    public function assignLicense(array $data): array
    {
        return $this->request('POST', '/licenses/assign.json', $data, includeUser: false);
    }

    /**
     * Run a group membership mutation endpoint.
     *
     * @param  string  $groupKey  Delivery group key.
     * @param  string  $action  Pushover group user action slug.
     * @param  string  $userKey  Pushover user key.
     * @param  string|null  $device  Optional device name to match.
     * @return array<string, mixed>
     */
    private function groupUserAction(string $groupKey, string $action, string $userKey, ?string $device = null): array
    {
        $data = ['user' => $userKey];

        if ($device !== null && $device !== '') {
            $data['device'] = $device;
        }

        return $this->request('POST', "/groups/{$groupKey}/{$action}.json", $data, includeUser: false);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query or form parameters.
     * @param  bool  $includeUser  Whether to include the configured user key.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $includeUser = true, ?string $token = null): array
    {
        $response = $this->rawRequest($method, $path, $data, $includeUser, $token);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pushover API.
     *
     * Pushover authenticates via form parameters (user_key and token/app_key)
     * rather than HTTP headers, so credentials are sent in every request body.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Form parameters for the request.
     * @param  bool  $includeUser  Whether to include the configured user key.
     * @param  string|null  $token  Optional token override, used for Teams API calls.
     * @return Response The raw HTTP response.
     *
     * @throws RuntimeException If credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $includeUser = true, ?string $token = null): Response
    {
        $requestToken = $token ?: $this->apiKey;

        if (!$requestToken) {
            throw new RuntimeException('Pushover API key or team token is not configured.');
        }

        if ($includeUser && !$this->userKey && empty($data['user'])) {
            throw new RuntimeException('Pushover user key is not configured.');
        }

        $url = $this->baseUrl . $path;

        $data['token'] = $requestToken;

        if ($includeUser && empty($data['user'])) {
            $data['user'] = $this->userKey;
        }

        try {
            $http = Http::asForm()->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $json = $response->json();
                $errors = $json['errors'] ?? [];

                Log::error("Pushover API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'errors' => $errors,
                ]);

                $errorMessage = !empty($errors)
                    ? implode('; ', $errors)
                    : "HTTP {$response->status()}: {$body}";

                throw new RuntimeException("Pushover API error: {$errorMessage}");
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Pushover API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Pushover API: {$e->getMessage()}");
        }
    }
}
