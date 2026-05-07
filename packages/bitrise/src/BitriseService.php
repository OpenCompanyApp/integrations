<?php

namespace OpenCompany\Integrations\Bitrise;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Bitrise API v0.1.
 *
 * Handles access-token authentication, path encoding, JSON response parsing,
 * and normalized API errors for app, build, webhook, artifact, secret, and file endpoints.
 */
class BitriseService
{
    /**
     * @param  string  $apiToken  Bitrise personal access token or Workspace API token.
     * @param  string  $baseUrl  Bitrise API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.bitrise.io/v0.1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: 'https://api.bitrise.io/v0.1', '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * List accessible apps.
     *
     * @param  array<string, mixed>  $query  Pagination and filter parameters.
     * @return array<string, mixed>
     */
    public function listApps(array $query = []): array { return $this->request('GET', '/apps', $query); }

    /**
     * Register a new app.
     *
     * @param  array<string, mixed>  $payload  App registration payload.
     * @return array<string, mixed>
     */
    public function registerApp(array $payload): array { return $this->request('POST', '/apps/register', $payload); }

    /**
     * Get one app.
     *
     * @return array<string, mixed>
     */
    public function getApp(string $appSlug): array { return $this->request('GET', $this->appPath($appSlug)); }

    /**
     * Update app settings.
     *
     * @param  array<string, mixed>  $payload  App update payload.
     * @return array<string, mixed>
     */
    public function updateApp(string $appSlug, array $payload): array { return $this->request('PATCH', $this->appPath($appSlug), $payload); }

    /**
     * Delete one app.
     *
     * @return array<string, mixed>
     */
    public function deleteApp(string $appSlug): array { return $this->request('DELETE', $this->appPath($appSlug)); }

    /**
     * Get app bitrise.yml.
     *
     * @return array<string, mixed>
     */
    public function getBitriseYml(string $appSlug): array { return $this->request('GET', $this->appPath($appSlug).'/bitrise.yml'); }

    /**
     * Upload app bitrise.yml.
     *
     * @param  array<string, mixed>  $payload  YAML upload payload.
     * @return array<string, mixed>
     */
    public function uploadBitriseYml(string $appSlug, array $payload): array { return $this->request('POST', $this->appPath($appSlug).'/bitrise.yml', $payload); }

    /**
     * Get bitrise.yml storage configuration.
     *
     * @return array<string, mixed>
     */
    public function getBitriseYmlConfig(string $appSlug): array { return $this->request('GET', $this->appPath($appSlug).'/bitrise.yml/config'); }

    /**
     * Update bitrise.yml storage configuration.
     *
     * @param  array<string, mixed>  $payload  Config update payload.
     * @return array<string, mixed>
     */
    public function updateBitriseYmlConfig(string $appSlug, array $payload): array { return $this->request('PUT', $this->appPath($appSlug).'/bitrise.yml/config', $payload); }

    /**
     * List repository branches for an app.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listBranches(string $appSlug, array $query = []): array { return $this->request('GET', $this->appPath($appSlug).'/branches', $query); }

    /**
     * Register SSH key details for a new app.
     *
     * @param  array<string, mixed>  $payload  SSH key payload.
     * @return array<string, mixed>
     */
    public function registerSshKey(string $appSlug, array $payload): array { return $this->request('POST', $this->appPath($appSlug).'/register-ssh-key', $payload); }

    /**
     * Finish a new app registration.
     *
     * @param  array<string, mixed>  $payload  Finish payload.
     * @return array<string, mixed>
     */
    public function finishApp(string $appSlug, array $payload): array { return $this->request('POST', $this->appPath($appSlug).'/finish', $payload); }

    /**
     * List apps for a Workspace.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listOrganizationApps(string $organizationSlug, array $query = []): array { return $this->request('GET', '/organizations/'.$this->segment($organizationSlug).'/apps', $query); }

    /**
     * List apps for a user.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listUserApps(string $userSlug, array $query = []): array { return $this->request('GET', '/users/'.$this->segment($userSlug).'/apps', $query); }

    /**
     * List Workspace groups assigned to a role on an app.
     *
     * @return array<string, mixed>
     */
    public function getRoleGroups(string $appSlug, string $roleName): array { return $this->request('GET', $this->appPath($appSlug).'/roles/'.$this->segment($roleName)); }

    /**
     * Replace Workspace groups assigned to a role on an app.
     *
     * @param  array<string, mixed>  $payload  Groups payload.
     * @return array<string, mixed>
     */
    public function setRoleGroups(string $appSlug, string $roleName, array $payload): array { return $this->request('PUT', $this->appPath($appSlug).'/roles/'.$this->segment($roleName), $payload); }

    /**
     * Update app email notification settings.
     *
     * @param  array<string, mixed>  $payload  Email notification payload.
     * @return array<string, mixed>
     */
    public function updateEmailNotifications(string $appSlug, array $payload): array { return $this->request('PATCH', $this->appPath($appSlug).'/update-email-notifications', $payload); }

    /**
     * Migrate machine type settings for apps owned by a user.
     *
     * @param  array<string, mixed>  $payload  Machine migration payload.
     * @return array<string, mixed>
     */
    public function migrateUserAppMachineTypes(string $userSlug, array $payload): array { return $this->request('PATCH', '/user/'.$this->segment($userSlug).'/apps/machine_types', $payload); }

    /**
     * Migrate machine type settings for apps owned by a Workspace.
     *
     * @param  array<string, mixed>  $payload  Machine migration payload.
     * @return array<string, mixed>
     */
    public function migrateOrganizationAppMachineTypes(string $organizationSlug, array $payload): array { return $this->request('PATCH', '/organizations/'.$this->segment($organizationSlug).'/apps/machine_types', $payload); }

    /**
     * Trigger a new app build.
     *
     * @param  array<string, mixed>  $payload  Build trigger payload.
     * @return array<string, mixed>
     */
    public function triggerBuild(string $appSlug, array $payload): array { return $this->request('POST', $this->appPath($appSlug).'/builds', $payload); }

    /**
     * Abort one app build.
     *
     * @param  array<string, mixed>  $payload  Abort options.
     * @return array<string, mixed>
     */
    public function abortBuild(string $appSlug, string $buildSlug, array $payload = []): array { return $this->request('POST', $this->buildPath($appSlug, $buildSlug).'/abort', $payload); }

    /**
     * List recent app builds.
     *
     * @param  array<string, mixed>  $query  Build filters and pagination.
     * @return array<string, mixed>
     */
    public function listAppBuilds(string $appSlug, array $query = []): array { return $this->request('GET', $this->appPath($appSlug).'/builds', $query); }

    /**
     * List archived app builds.
     *
     * @param  array<string, mixed>  $query  Build filters and pagination.
     * @return array<string, mixed>
     */
    public function listArchivedBuilds(string $appSlug, array $query = []): array { return $this->request('GET', $this->appPath($appSlug).'/archived-builds', $query); }

    /**
     * List workflows that have been triggered for an app.
     *
     * @return array<string, mixed>
     */
    public function listBuildWorkflows(string $appSlug): array { return $this->request('GET', $this->appPath($appSlug).'/build-workflows'); }

    /**
     * Get one app build.
     *
     * @return array<string, mixed>
     */
    public function getBuild(string $appSlug, string $buildSlug): array { return $this->request('GET', $this->buildPath($appSlug, $buildSlug)); }

    /**
     * Get the bitrise.yml used by one build.
     *
     * @return array<string, mixed>
     */
    public function getBuildBitriseYml(string $appSlug, string $buildSlug): array { return $this->request('GET', $this->buildPath($appSlug, $buildSlug).'/bitrise.yml'); }

    /**
     * Get one build log.
     *
     * @return array<string, mixed>
     */
    public function getBuildLog(string $appSlug, string $buildSlug): array { return $this->request('GET', $this->buildPath($appSlug, $buildSlug).'/log'); }

    /**
     * List builds accessible to the authenticated account.
     *
     * @param  array<string, mixed>  $query  Build filters and pagination.
     * @return array<string, mixed>
     */
    public function listBuilds(array $query = []): array { return $this->request('GET', '/builds', $query); }

    /**
     * Register an incoming webhook for an app.
     *
     * @param  array<string, mixed>  $payload  Webhook registration payload.
     * @return array<string, mixed>
     */
    public function registerWebhook(string $appSlug, array $payload = []): array { return $this->request('POST', $this->appPath($appSlug).'/register-webhook', $payload); }

    /**
     * List outgoing webhooks for an app.
     *
     * @return array<string, mixed>
     */
    public function listOutgoingWebhooks(string $appSlug): array { return $this->request('GET', $this->appPath($appSlug).'/outgoing-webhooks'); }

    /**
     * Create an outgoing webhook for an app.
     *
     * @param  array<string, mixed>  $payload  Webhook payload.
     * @return array<string, mixed>
     */
    public function createOutgoingWebhook(string $appSlug, array $payload): array { return $this->request('POST', $this->appPath($appSlug).'/outgoing-webhooks', $payload); }

    /**
     * Update an outgoing webhook for an app.
     *
     * @param  array<string, mixed>  $payload  Webhook update payload.
     * @return array<string, mixed>
     */
    public function updateOutgoingWebhook(string $appSlug, string $webhookSlug, array $payload): array { return $this->request('PUT', $this->appPath($appSlug).'/outgoing-webhooks/'.$this->segment($webhookSlug), $payload); }

    /**
     * Delete an outgoing webhook for an app.
     *
     * @return array<string, mixed>
     */
    public function deleteOutgoingWebhook(string $appSlug, string $webhookSlug): array { return $this->request('DELETE', $this->appPath($appSlug).'/outgoing-webhooks/'.$this->segment($webhookSlug)); }

    /**
     * List build artifacts.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listArtifacts(string $appSlug, string $buildSlug, array $query = []): array { return $this->request('GET', $this->buildPath($appSlug, $buildSlug).'/artifacts', $query); }

    /**
     * Get one build artifact.
     *
     * @return array<string, mixed>
     */
    public function getArtifact(string $appSlug, string $buildSlug, string $artifactSlug): array { return $this->request('GET', $this->artifactPath($appSlug, $buildSlug, $artifactSlug)); }

    /**
     * Update one build artifact.
     *
     * @param  array<string, mixed>  $payload  Artifact update payload.
     * @return array<string, mixed>
     */
    public function updateArtifact(string $appSlug, string $buildSlug, string $artifactSlug, array $payload): array { return $this->request('PATCH', $this->artifactPath($appSlug, $buildSlug, $artifactSlug), $payload); }

    /**
     * Delete one build artifact.
     *
     * @return array<string, mixed>
     */
    public function deleteArtifact(string $appSlug, string $buildSlug, string $artifactSlug): array { return $this->request('DELETE', $this->artifactPath($appSlug, $buildSlug, $artifactSlug)); }

    /**
     * List app secrets.
     *
     * @return array<string, mixed>
     */
    public function listSecrets(string $appSlug): array { return $this->request('GET', $this->appPath($appSlug).'/secrets'); }

    /**
     * Get the value of an unprotected app secret.
     *
     * @return array<string, mixed>
     */
    public function getSecretValue(string $appSlug, string $secretName): array { return $this->request('GET', $this->appPath($appSlug).'/secrets/'.$this->segment($secretName).'/value'); }

    /**
     * Create or update an app secret.
     *
     * @param  array<string, mixed>  $payload  Secret payload.
     * @return array<string, mixed>
     */
    public function putSecret(string $appSlug, string $secretName, array $payload): array { return $this->request('PUT', $this->appPath($appSlug).'/secrets/'.$this->segment($secretName), $payload); }

    /**
     * Delete an app secret.
     *
     * @return array<string, mixed>
     */
    public function deleteSecret(string $appSlug, string $secretName): array { return $this->request('DELETE', $this->appPath($appSlug).'/secrets/'.$this->segment($secretName)); }

    /**
     * List Android keystore files.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listAndroidKeystoreFiles(string $appSlug, array $query = []): array { return $this->request('GET', $this->appPath($appSlug).'/android-keystore-files', $query); }

    /**
     * Create an Android keystore file upload record.
     *
     * @param  array<string, mixed>  $payload  Keystore payload.
     * @return array<string, mixed>
     */
    public function createAndroidKeystoreFile(string $appSlug, array $payload): array { return $this->request('POST', $this->appPath($appSlug).'/android-keystore-files', $payload); }

    /**
     * Delete an Android keystore file.
     *
     * @return array<string, mixed>
     */
    public function deleteAndroidKeystoreFile(string $appSlug, string $fileSlug): array { return $this->request('DELETE', $this->appPath($appSlug).'/android-keystore-files/'.$this->segment($fileSlug)); }

    /**
     * Execute a safe raw GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PUT request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array { return $this->request('PATCH', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch a Bitrise API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Bitrise API token is required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Bitrise.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Authorization' => $this->apiToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Bitrise method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Bitrise API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Bitrise API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Bitrise API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Bitrise API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Bitrise API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Bitrise response.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body];
    }

    private function appPath(string $appSlug): string
    {
        return '/apps/'.$this->segment($appSlug);
    }

    private function buildPath(string $appSlug, string $buildSlug): string
    {
        return $this->appPath($appSlug).'/builds/'.$this->segment($buildSlug);
    }

    private function artifactPath(string $appSlug, string $buildSlug, string $artifactSlug): string
    {
        return $this->buildPath($appSlug, $buildSlug).'/artifacts/'.$this->segment($artifactSlug);
    }

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Bitrise API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
