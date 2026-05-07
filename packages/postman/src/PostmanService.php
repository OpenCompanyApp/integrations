<?php

namespace OpenCompany\Integrations\Postman;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Postman API.
 *
 * Handles X-Api-Key authentication, stable resource endpoint mapping, response
 * parsing, and normalized Postman API errors.
 */
class PostmanService
{
    private const DEFAULT_BASE_URL = 'https://api.getpostman.com';

    private const OPERATIONS = [
        'me_get' => ['GET', '/me', [], 'read', 'Get Authenticated User', 'Get the API key owner and usage metadata.'],
        'workspaces_list' => ['GET', '/workspaces', [], 'read', 'List Workspaces', 'List accessible Postman workspaces.'],
        'workspaces_create' => ['POST', '/workspaces', [], 'write', 'Create Workspace', 'Create a Postman workspace.'],
        'workspaces_get' => ['GET', '/workspaces/{workspace_id}', ['workspace_id'], 'read', 'Get Workspace', 'Retrieve a workspace.'],
        'workspaces_update' => ['PUT', '/workspaces/{workspace_id}', ['workspace_id'], 'write', 'Update Workspace', 'Update a workspace.'],
        'workspaces_delete' => ['DELETE', '/workspaces/{workspace_id}', ['workspace_id'], 'write', 'Delete Workspace', 'Delete a workspace.'],
        'collections_list' => ['GET', '/collections', [], 'read', 'List Collections', 'List accessible Postman collections.'],
        'collections_create' => ['POST', '/collections', [], 'write', 'Create Collection', 'Create a Postman collection.'],
        'collections_get' => ['GET', '/collections/{collection_uid}', ['collection_uid'], 'read', 'Get Collection', 'Retrieve a collection.'],
        'collections_update' => ['PUT', '/collections/{collection_uid}', ['collection_uid'], 'write', 'Update Collection', 'Replace a collection.'],
        'collections_delete' => ['DELETE', '/collections/{collection_uid}', ['collection_uid'], 'write', 'Delete Collection', 'Delete a collection.'],
        'collection_forks_list' => ['GET', '/collections/{collection_uid}/forks', ['collection_uid'], 'read', 'List Collection Forks', 'List forks for a collection.'],
        'collection_fork_create' => ['POST', '/collections/fork/{collection_uid}', ['collection_uid'], 'write', 'Fork Collection', 'Create a fork of a collection.'],
        'collection_pull_requests_list' => ['GET', '/collections/{collection_uid}/pull-requests', ['collection_uid'], 'read', 'List Collection Pull Requests', 'List pull requests for a collection.'],
        'environments_list' => ['GET', '/environments', [], 'read', 'List Environments', 'List accessible environments.'],
        'environments_create' => ['POST', '/environments', [], 'write', 'Create Environment', 'Create an environment.'],
        'environments_get' => ['GET', '/environments/{environment_uid}', ['environment_uid'], 'read', 'Get Environment', 'Retrieve an environment.'],
        'environments_update' => ['PUT', '/environments/{environment_uid}', ['environment_uid'], 'write', 'Update Environment', 'Replace an environment.'],
        'environments_delete' => ['DELETE', '/environments/{environment_uid}', ['environment_uid'], 'write', 'Delete Environment', 'Delete an environment.'],
        'globals_get' => ['GET', '/globals', [], 'read', 'Get Globals', 'Retrieve global variables.'],
        'globals_update' => ['PUT', '/globals', [], 'write', 'Update Globals', 'Update global variables.'],
        'apis_list' => ['GET', '/apis', [], 'read', 'List APIs', 'List APIs or specifications.'],
        'apis_create' => ['POST', '/apis', [], 'write', 'Create API', 'Create an API record.'],
        'apis_get' => ['GET', '/apis/{api_id}', ['api_id'], 'read', 'Get API', 'Retrieve an API record.'],
        'apis_update' => ['PUT', '/apis/{api_id}', ['api_id'], 'write', 'Update API', 'Update an API record.'],
        'apis_delete' => ['DELETE', '/apis/{api_id}', ['api_id'], 'write', 'Delete API', 'Delete an API record.'],
        'api_versions_list' => ['GET', '/apis/{api_id}/versions', ['api_id'], 'read', 'List API Versions', 'List versions for an API.'],
        'api_versions_create' => ['POST', '/apis/{api_id}/versions', ['api_id'], 'write', 'Create API Version', 'Create an API version.'],
        'api_versions_get' => ['GET', '/apis/{api_id}/versions/{version_id}', ['api_id', 'version_id'], 'read', 'Get API Version', 'Retrieve an API version.'],
        'api_versions_update' => ['PUT', '/apis/{api_id}/versions/{version_id}', ['api_id', 'version_id'], 'write', 'Update API Version', 'Update an API version.'],
        'api_versions_delete' => ['DELETE', '/apis/{api_id}/versions/{version_id}', ['api_id', 'version_id'], 'write', 'Delete API Version', 'Delete an API version.'],
        'api_schemas_list' => ['GET', '/apis/{api_id}/versions/{version_id}/schemas', ['api_id', 'version_id'], 'read', 'List API Schemas', 'List schemas for an API version.'],
        'api_schemas_create' => ['POST', '/apis/{api_id}/versions/{version_id}/schemas', ['api_id', 'version_id'], 'write', 'Create API Schema', 'Create a schema for an API version.'],
        'api_schemas_get' => ['GET', '/apis/{api_id}/versions/{version_id}/schemas/{schema_id}', ['api_id', 'version_id', 'schema_id'], 'read', 'Get API Schema', 'Retrieve an API schema.'],
        'api_schemas_update' => ['PUT', '/apis/{api_id}/versions/{version_id}/schemas/{schema_id}', ['api_id', 'version_id', 'schema_id'], 'write', 'Update API Schema', 'Update an API schema.'],
        'api_schemas_delete' => ['DELETE', '/apis/{api_id}/versions/{version_id}/schemas/{schema_id}', ['api_id', 'version_id', 'schema_id'], 'write', 'Delete API Schema', 'Delete an API schema.'],
        'mocks_list' => ['GET', '/mocks', [], 'read', 'List Mock Servers', 'List mock servers.'],
        'mocks_create' => ['POST', '/mocks', [], 'write', 'Create Mock Server', 'Create a mock server.'],
        'mocks_get' => ['GET', '/mocks/{mock_id}', ['mock_id'], 'read', 'Get Mock Server', 'Retrieve a mock server.'],
        'mocks_update' => ['PUT', '/mocks/{mock_id}', ['mock_id'], 'write', 'Update Mock Server', 'Update a mock server.'],
        'mocks_delete' => ['DELETE', '/mocks/{mock_id}', ['mock_id'], 'write', 'Delete Mock Server', 'Delete a mock server.'],
        'mocks_call_logs_list' => ['GET', '/mocks/{mock_id}/call-logs', ['mock_id'], 'read', 'List Mock Call Logs', 'List calls received by a mock server.'],
        'monitors_list' => ['GET', '/monitors', [], 'read', 'List Monitors', 'List monitors.'],
        'monitors_create' => ['POST', '/monitors', [], 'write', 'Create Monitor', 'Create a monitor.'],
        'monitors_get' => ['GET', '/monitors/{monitor_id}', ['monitor_id'], 'read', 'Get Monitor', 'Retrieve a monitor.'],
        'monitors_update' => ['PUT', '/monitors/{monitor_id}', ['monitor_id'], 'write', 'Update Monitor', 'Update a monitor.'],
        'monitors_delete' => ['DELETE', '/monitors/{monitor_id}', ['monitor_id'], 'write', 'Delete Monitor', 'Delete a monitor.'],
        'monitors_run' => ['POST', '/monitors/{monitor_id}/run', ['monitor_id'], 'write', 'Run Monitor', 'Run a monitor immediately.'],
        'webhooks_create' => ['POST', '/webhooks', [], 'write', 'Create Webhook', 'Create a collection webhook.'],
        'webhooks_get' => ['GET', '/webhooks/{webhook_id}', ['webhook_id'], 'read', 'Get Webhook', 'Retrieve a webhook.'],
        'webhooks_delete' => ['DELETE', '/webhooks/{webhook_id}', ['webhook_id'], 'write', 'Delete Webhook', 'Delete a webhook.'],
        'users_list' => ['GET', '/users', [], 'read', 'List Users', 'List team users when the plan permits it.'],
        'users_get' => ['GET', '/users/{user_id}', ['user_id'], 'read', 'Get User', 'Retrieve a team user.'],
        'groups_list' => ['GET', '/user-groups', [], 'read', 'List User Groups', 'List team user groups.'],
        'groups_get' => ['GET', '/user-groups/{group_id}', ['group_id'], 'read', 'Get User Group', 'Retrieve a user group.'],
        'workspace_roles_list' => ['GET', '/workspaces/{workspace_id}/roles', ['workspace_id'], 'read', 'List Workspace Roles', 'List roles for a workspace.'],
        'workspace_roles_update' => ['PUT', '/workspaces/{workspace_id}/roles', ['workspace_id'], 'write', 'Update Workspace Roles', 'Update workspace role assignments.'],
        'billing_get' => ['GET', '/billing', [], 'read', 'Get Billing', 'Get billing information when the plan permits it.'],
    ];

    /**
     * @param  string  $apiKey  Postman API key.
     * @param  string  $baseUrl  Postman API base URL.
     */
    public function __construct(private string $apiKey = '', private string $baseUrl = self::DEFAULT_BASE_URL)
    {
        $this->baseUrl = rtrim($this->baseUrl ?: self::DEFAULT_BASE_URL, '/');
    }

    /** Check whether the service has been configured with an API key. */
    public function isConfigured(): bool { return trim($this->apiKey) !== ''; }

    /**
     * Return the documented Postman operation map.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function operations(): array { return self::OPERATIONS; }

    /**
     * Call a documented Postman operation.
     *
     * @param  string  $operation  Operation key from operations().
     * @param  array<string, mixed>  $params  Path, query, or JSON body fields.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $params = []): array
    {
        $definition = self::OPERATIONS[$operation] ?? null;
        if ($definition === null) { throw new RuntimeException("Unsupported Postman operation: {$operation}"); }
        [$method, $path, $required] = $definition;
        foreach ($required as $field) { if (($params[$field] ?? '') === '') { throw new RuntimeException($field.' is required.'); } }
        return $this->request($method, $this->interpolatePath($path, $params), $params);
    }

    /** @param array<string, mixed> $query @return array<string, mixed> */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }
    /** @param array<string, mixed> $payload @return array<string, mixed> */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }
    /** @param array<string, mixed> $payload @return array<string, mixed> */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }
    /** @param array<string, mixed> $payload @return array<string, mixed> */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }
    /** @param array<string, mixed> $query @return array<string, mixed> */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /** @param array<string, mixed> $data @return array<string, mixed> */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) { throw new RuntimeException('Postman API key is not configured.'); }
        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) { $this->throwApiError($method, $path, $response); }
        return $this->decodeResponse($response);
    }

    /** @param array<string, mixed> $data */
    private function rawRequest(string $method, string $path, array $data): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders(['X-Api-Key' => $this->apiKey])->acceptJson()->timeout(30);
        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asJson()->post($url, $data),
                'PUT' => $http->asJson()->put($url, $data),
                'PATCH' => $http->asJson()->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported Postman method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Postman API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException('Failed to connect to Postman API: '.$e->getMessage());
        }
    }

    /** Throw a normalized Postman API error. */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['error']['message'] ?? $json['message'] ?? $json['error'] ?? '') : trim($response->body());
        Log::error("Postman API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);
        throw new RuntimeException('Postman API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /** @return array<string, mixed> */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') { return ['success' => true, 'status' => $response->status()]; }
        $json = $response->json();
        return is_array($json) ? ['status' => $response->status(), 'data' => $json] : ['status' => $response->status(), 'value' => $body];
    }

    /** @param array<string, mixed> $params */
    private function interpolatePath(string $path, array &$params): string
    {
        return preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use (&$params): string {
            $key = $matches[1]; $value = $params[$key] ?? null;
            if ($value === null || $value === '') { throw new RuntimeException($key.' is required.'); }
            unset($params[$key]); return rawurlencode((string) $value);
        }, $path) ?? $path;
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) { throw new RuntimeException('Postman API path must be a non-empty relative path.'); }
        return '/'.ltrim($path, '/');
    }
}
