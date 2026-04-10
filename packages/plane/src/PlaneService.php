<?php

namespace OpenCompany\Integrations\Plane;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Plane.so REST API.
 *
 * Handles authentication via X-Api-Key header, error logging, and response parsing.
 * All tool classes delegate to this service — they never make HTTP calls directly.
 */
class PlaneService
{
    private string $baseUrl;

    private string $configuredBaseUrl;

    private ?string $workspaceSlug;

    /**
     * @param  string  $apiKey  Plane.so API token
     * @param  string  $baseUrl  API base URL (defaults to https://api.plane.so)
     */
    public function __construct(
        private string $apiKey = '',
        string $baseUrl = 'https://api.plane.so',
        ?string $workspaceSlug = null,
    ) {
        $this->configuredBaseUrl = trim($baseUrl);
        $this->baseUrl = self::normalizeBaseUrl($baseUrl);
        $this->workspaceSlug = self::normalizeWorkspaceSlug($workspaceSlug)
            ?? self::inferWorkspaceSlugFromUrl($baseUrl);
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    public static function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = trim($baseUrl);

        if ($baseUrl === '') {
            return 'https://api.plane.so';
        }

        $parts = parse_url($baseUrl);
        if ($parts === false || ! isset($parts['scheme'], $parts['host'])) {
            return rtrim($baseUrl, '/');
        }

        $authority = $parts['host'];
        if (isset($parts['port'])) {
            $authority .= ':'.$parts['port'];
        }

        return $parts['scheme'].'://'.$authority;
    }

    public static function inferWorkspaceSlugFromUrl(string $baseUrl): ?string
    {
        $parts = parse_url(trim($baseUrl));
        if ($parts === false) {
            return null;
        }

        $path = trim((string) ($parts['path'] ?? ''), '/');
        if ($path === '') {
            return null;
        }

        $segments = array_values(array_filter(explode('/', $path), static fn (string $segment): bool => $segment !== ''));
        if ($segments === []) {
            return null;
        }

        if ($segments[0] === 'api') {
            return isset($segments[2]) && $segments[1] === 'v1'
                ? self::normalizeWorkspaceSlug($segments[2])
                : null;
        }

        return self::normalizeWorkspaceSlug($segments[0]);
    }

    public static function normalizeWorkspaceSlug(?string $workspaceSlug): ?string
    {
        $workspaceSlug = trim((string) $workspaceSlug);

        return $workspaceSlug !== '' ? trim($workspaceSlug, '/') : null;
    }

    public function defaultWorkspaceSlug(): ?string
    {
        return $this->workspaceSlug;
    }

    public function resolveWorkspaceSlug(?string $workspaceSlug = null): string
    {
        $resolved = self::normalizeWorkspaceSlug($workspaceSlug) ?? $this->workspaceSlug;

        if ($resolved === null) {
            throw new \RuntimeException('Plane.so workspace slug is required. Configure a default workspace slug or pass workspace_slug explicitly.');
        }

        return $resolved;
    }

    // ──────────────────────────────────────────────
    //  Workspaces
    // ──────────────────────────────────────────────

    /**
     * List workspaces the authenticated user belongs to.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        if ($this->workspaceSlug !== null) {
            return [$this->workspaceSummary($this->workspaceSlug)];
        }

        return $this->request('GET', '/api/workspaces/');
    }

    /**
     * Get a workspace by slug.
     *
     * @return array<string, mixed>
     */
    public function getWorkspace(string $slug): array
    {
        try {
            return $this->request('GET', "/api/workspaces/{$slug}/");
        } catch (\RuntimeException $e) {
            if (! str_contains($e->getMessage(), 'Plane.so API error (404)')) {
                throw $e;
            }

            return $this->workspaceSummary($slug);
        }
    }

    // ──────────────────────────────────────────────
    //  Projects
    // ──────────────────────────────────────────────

    /**
     * List projects in a workspace.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listProjects(?string $workspaceSlug = null, array $params = []): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/", $params);
    }

    /**
     * Get a single project.
     *
     * @return array<string, mixed>
     */
    public function getProject(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/");
    }

    /**
     * Create a project.
     *
     * @param  array<string, mixed>  $data  Project fields
     * @return array<string, mixed>
     */
    public function createProject(?string $workspaceSlug, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/", $data);
    }

    // ──────────────────────────────────────────────
    //  Issues / Work Items
    // ──────────────────────────────────────────────

    /**
     * List issues in a project.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listIssues(?string $workspaceSlug, string $projectId, array $params = []): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/", $params);
    }

    /**
     * Get a single issue.
     *
     * @return array<string, mixed>
     */
    public function getIssue(?string $workspaceSlug, string $projectId, string $issueId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/");
    }

    /**
     * Create an issue.
     *
     * @param  array<string, mixed>  $data  Issue fields (name, description_html, state, priority, assignees, labels, etc.)
     * @return array<string, mixed>
     */
    public function createIssue(?string $workspaceSlug, string $projectId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/", $data);
    }

    /**
     * Update an issue.
     *
     * @param  array<string, mixed>  $data  Fields to update
     * @return array<string, mixed>
     */
    public function updateIssue(?string $workspaceSlug, string $projectId, string $issueId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('PATCH', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/", $data);
    }

    /**
     * Delete an issue.
     */
    public function deleteIssue(?string $workspaceSlug, string $projectId, string $issueId): void
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        $this->request('DELETE', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/");
    }

    // ──────────────────────────────────────────────
    //  Issue Comments
    // ──────────────────────────────────────────────

    /**
     * List comments on an issue.
     *
     * @return array<string, mixed>
     */
    public function listComments(?string $workspaceSlug, string $projectId, string $issueId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/comments/");
    }

    /**
     * Add a comment to an issue.
     *
     * @param  array<string, mixed>  $data  Comment fields (comment_html)
     * @return array<string, mixed>
     */
    public function createComment(?string $workspaceSlug, string $projectId, string $issueId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/comments/", $data);
    }

    // ──────────────────────────────────────────────
    //  Cycles
    // ──────────────────────────────────────────────

    /**
     * List cycles in a project.
     *
     * @return array<string, mixed>
     */
    public function listCycles(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/cycles/");
    }

    /**
     * Get a single cycle.
     *
     * @return array<string, mixed>
     */
    public function getCycle(?string $workspaceSlug, string $projectId, string $cycleId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/cycles/{$cycleId}/");
    }

    /**
     * Add an issue to a cycle.
     *
     * @return array<string, mixed>
     */
    public function addIssueToCycle(?string $workspaceSlug, string $projectId, string $cycleId, string $issueId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/cycles/{$cycleId}/cycle-issues/", [
            'issue' => $issueId,
        ]);
    }

    // ──────────────────────────────────────────────
    //  Modules
    // ──────────────────────────────────────────────

    /**
     * List modules in a project.
     *
     * @return array<string, mixed>
     */
    public function listModules(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/modules/");
    }

    /**
     * Get a single module.
     *
     * @return array<string, mixed>
     */
    public function getModule(?string $workspaceSlug, string $projectId, string $moduleId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/modules/{$moduleId}/");
    }

    /**
     * Add an issue to a module.
     *
     * @return array<string, mixed>
     */
    public function addIssueToModule(?string $workspaceSlug, string $projectId, string $moduleId, string $issueId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/modules/{$moduleId}/module-issues/", [
            'issue' => $issueId,
        ]);
    }

    // ──────────────────────────────────────────────
    //  Search
    // ──────────────────────────────────────────────

    /**
     * Search issues across a workspace.
     *
     * @param  array<string, mixed>  $params  Search parameters (search, project, etc.)
     * @return array<string, mixed>
     */
    public function searchIssues(?string $workspaceSlug, array $params = []): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/search/", $params);
    }

    // ──────────────────────────────────────────────
    //  Issue Activities
    // ──────────────────────────────────────────────

    /**
     * List activity events on an issue.
     *
     * @return array<string, mixed>
     */
    public function listActivities(?string $workspaceSlug, string $projectId, string $issueId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/activities/");
    }

    // ──────────────────────────────────────────────
    //  Issue Links
    // ──────────────────────────────────────────────

    /**
     * Create a link on an issue.
     *
     * @param  array<string, mixed>  $data  Link fields (title, url)
     * @return array<string, mixed>
     */
    public function createIssueLink(?string $workspaceSlug, string $projectId, string $issueId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/links/", $data);
    }

    // ──────────────────────────────────────────────
    //  Issue Relations
    // ──────────────────────────────────────────────

    /**
     * List relations on an issue.
     *
     * @return array<string, mixed>
     */
    public function listIssueRelations(?string $workspaceSlug, string $projectId, string $issueId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/issues/{$issueId}/relations/");
    }

    // ──────────────────────────────────────────────
    //  States
    // ──────────────────────────────────────────────

    /**
     * List states in a project.
     *
     * @return array<string, mixed>
     */
    public function listStates(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/states/");
    }

    /**
     * Create a state in a project.
     *
     * @param  array<string, mixed>  $data  State fields (name, group, color, description, slug)
     * @return array<string, mixed>
     */
    public function createState(?string $workspaceSlug, string $projectId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/states/", $data);
    }

    // ──────────────────────────────────────────────
    //  Labels
    // ──────────────────────────────────────────────

    /**
     * List labels in a project.
     *
     * @return array<string, mixed>
     */
    public function listLabels(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/labels/");
    }

    /**
     * Create a label in a project.
     *
     * @param  array<string, mixed>  $data  Label fields (name, color, description, parent)
     * @return array<string, mixed>
     */
    public function createLabel(?string $workspaceSlug, string $projectId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/labels/", $data);
    }

    // ──────────────────────────────────────────────
    //  Members
    // ──────────────────────────────────────────────

    /**
     * List workspace members.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaceMembers(?string $workspaceSlug = null): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/members/");
    }

    /**
     * List project members.
     *
     * @return array<string, mixed>
     */
    public function listProjectMembers(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/members/");
    }

    // ──────────────────────────────────────────────
    //  Cycles (additional)
    // ──────────────────────────────────────────────

    /**
     * Create a cycle in a project.
     *
     * @param  array<string, mixed>  $data  Cycle fields (name, description, start_date, end_date)
     * @return array<string, mixed>
     */
    public function createCycle(?string $workspaceSlug, string $projectId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/cycles/", $data);
    }

    // ──────────────────────────────────────────────
    //  Modules (additional)
    // ──────────────────────────────────────────────

    /**
     * Create a module in a project.
     *
     * @param  array<string, mixed>  $data  Module fields (name, description, status, start_date, target_date)
     * @return array<string, mixed>
     */
    public function createModule(?string $workspaceSlug, string $projectId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/modules/", $data);
    }

    // ──────────────────────────────────────────────
    //  Project Archive
    // ──────────────────────────────────────────────

    /**
     * Archive a project.
     *
     * @return array<string, mixed>
     */
    public function archiveProject(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/archive/");
    }

    // ──────────────────────────────────────────────
    //  Pages
    // ──────────────────────────────────────────────

    /**
     * List pages in a project.
     *
     * @return array<string, mixed>
     */
    public function listPages(?string $workspaceSlug, string $projectId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/pages/");
    }

    /**
     * Get a single page.
     *
     * @return array<string, mixed>
     */
    public function getPage(?string $workspaceSlug, string $projectId, string $pageId): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/pages/{$pageId}/");
    }

    /**
     * Create a page.
     *
     * @param  array<string, mixed>  $data  Page fields (name, description_html)
     * @return array<string, mixed>
     */
    public function createPage(?string $workspaceSlug, string $projectId, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/projects/{$projectId}/pages/", $data);
    }

    // ──────────────────────────────────────────────
    //  Users
    // ──────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        try {
            return $this->request('GET', '/api/v1/users/me/');
        } catch (\RuntimeException $e) {
            if ($this->workspaceSlug === null) {
                throw $e;
            }

            $message = $e->getMessage();
            if (
                ! str_contains($message, 'Plane.so API error (404)')
                && ! str_contains($message, 'Plane.so API error (401)')
            ) {
                throw $e;
            }

            $workspaceSlug = $this->resolveWorkspaceSlug();
            $this->listProjects($workspaceSlug, ['limit' => 1]);

            return [
                'id' => null,
                'display_name' => "Workspace access verified ({$workspaceSlug})",
                'email' => null,
                'workspace_slug' => $workspaceSlug,
                'is_active' => true,
            ];
        }
    }

    // ──────────────────────────────────────────────
    //  Webhooks
    // ──────────────────────────────────────────────

    /**
     * List webhooks for a workspace.
     *
     * @return array<string, mixed>
     */
    public function listWebhooks(?string $workspaceSlug = null): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('GET', "/api/v1/workspaces/{$workspaceSlug}/webhooks/");
    }

    /**
     * Create a webhook.
     *
     * @param  array<string, mixed>  $data  Webhook fields (url, events, is_active)
     * @return array<string, mixed>
     */
    public function createWebhook(?string $workspaceSlug, array $data): array
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        return $this->request('POST', "/api/v1/workspaces/{$workspaceSlug}/webhooks/", $data);
    }

    /**
     * Delete a webhook.
     */
    public function deleteWebhook(?string $workspaceSlug, string $webhookId): void
    {
        $workspaceSlug = $this->resolveWorkspaceSlug($workspaceSlug);

        $this->request('DELETE', "/api/v1/workspaces/{$workspaceSlug}/webhooks/{$webhookId}/");
    }

    // ──────────────────────────────────────────────
    //  HTTP
    // ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE') {
            return [];
        }

        $payload = $response->json() ?? [];

        if (is_array($payload) && isset($payload['results']) && is_array($payload['results'])) {
            return $payload['results'];
        }

        return $payload;
    }

    /**
     * Make a raw HTTP request to the Plane.so API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Plane.so API key is not configured.');
        }

        try {
            $attempts = $this->candidatePaths($path);
            $response = null;
            $attemptedPath = $path;

            foreach ($attempts as $candidatePath) {
                $attemptedPath = $candidatePath;
                $response = $this->sendRequest($method, $candidatePath, $data);

                if ($response->successful()) {
                    return $response;
                }

                if (! $this->shouldRetryWithLegacyPath($path, $candidatePath, $response)) {
                    break;
                }
            }

            if ($response !== null && ! $response->successful()) {
                $error = $response->json('detail')
                    ?? $response->json('error')
                    ?? $response->body();
                $message = is_string($error) ? $error : json_encode($error);
                $message = $this->augmentErrorMessage($attemptedPath, $response, $message ?: 'Unknown Plane.so API error');

                Log::error("Plane.so API error: {$method} {$attemptedPath}", [
                    'status' => $response->status(),
                    'error' => $message,
                ]);
                throw new \RuntimeException("Plane.so API error ({$response->status()}): {$message}");
            }
        } catch (ConnectionException $e) {
            Log::error("Plane.so API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Plane.so API: {$e->getMessage()}");
        }

        throw new \RuntimeException('Plane.so API request failed before a response was received.');
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function sendRequest(string $method, string $path, array $data): Response
    {
        $http = Http::withHeaders([
            'X-Api-Key' => $this->apiKey,
            'Content-Type' => 'application/json',
        ])->timeout(30);

        $url = $this->baseUrl.$path;

        return match (strtoupper($method)) {
            'GET' => $http->get($url, $data),
            'POST' => $http->post($url, $data),
            'PUT' => $http->put($url, $data),
            'PATCH' => $http->patch($url, $data),
            'DELETE' => $http->delete($url, $data),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };
    }

    /**
     * @return list<string>
     */
    private function candidatePaths(string $path): array
    {
        $paths = [$path];

        if (str_starts_with($path, '/api/v1/')) {
            $paths[] = '/api/'.substr($path, strlen('/api/v1/'));
        }

        return array_values(array_unique($paths));
    }

    private function shouldRetryWithLegacyPath(string $originalPath, string $attemptedPath, Response $response): bool
    {
        return str_starts_with($originalPath, '/api/v1/')
            && $attemptedPath === $originalPath
            && $response->status() === 404;
    }

    private function augmentErrorMessage(string $path, Response $response, string $message): string
    {
        $normalizedMessage = strtolower($message);

        if (
            $response->status() === 401
            && str_contains($normalizedMessage, 'authentication credentials were not provided')
        ) {
            return $message.' Hint: confirm the API token is valid and that your self-hosted proxy forwards the x-api-key header.';
        }

        if (
            $response->status() === 404
            && $this->configuredBaseUrl !== ''
            && self::normalizeBaseUrl($this->configuredBaseUrl) !== rtrim($this->configuredBaseUrl, '/')
        ) {
            return $message.' Hint: use the Plane site origin only (for example '.$this->baseUrl.'), not a workspace URL or /api path.';
        }

        if ($response->status() === 404 && str_starts_with($path, '/api/v1/')) {
            return $message.' Hint: this self-hosted Plane instance may use an older API layout without /api/v1/.';
        }

        return $message;
    }

    /**
     * @return array<string, mixed>
     */
    private function workspaceSummary(string $slug): array
    {
        $projects = $this->listProjects($slug, ['limit' => 1]);

        return [
            'id' => null,
            'slug' => $slug,
            'name' => $slug,
            'owner' => null,
            'project_count_hint' => count($projects),
        ];
    }
}
