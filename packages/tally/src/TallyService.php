<?php

namespace OpenCompany\Integrations\Tally;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Tally REST API.
 *
 * Handles bearer authentication, API versioning, error logging, and request
 * dispatch for forms, submissions, workspaces, organizations, and webhooks.
 */
class TallyService
{
    /**
     * @param  string  $accessToken  Tally API bearer token.
     * @param  string  $baseUrl  Tally API base URL.
     * @param  string  $apiVersion  Optional Tally API version date.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.tally.so',
        private string $apiVersion = '2026-02-05',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    // -- Users -------------------------------------------------------------

    /**
     * Fetch the authenticated user profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // -- Forms -------------------------------------------------------------

    /**
     * List forms with optional workspace filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters: page, limit, workspaceIds.
     * @return array<string, mixed>
     */
    public function listForms(array $params = []): array
    {
        return $this->request('GET', '/forms', $params);
    }

    /**
     * Create a form from blocks, settings, a template, or a workspace target.
     *
     * @param  array<string, mixed>  $payload  Form creation payload.
     * @return array<string, mixed>
     */
    public function createForm(array $payload): array
    {
        return $this->request('POST', '/forms', $payload);
    }

    /**
     * Fetch a form with its blocks and settings.
     *
     * @param  string  $formId  Tally form ID.
     * @return array<string, mixed>
     */
    public function getForm(string $formId): array
    {
        return $this->request('GET', '/forms/'.$this->encode($formId));
    }

    /**
     * Update a form's name, status, blocks, or settings.
     *
     * @param  string  $formId  Tally form ID.
     * @param  array<string, mixed>  $payload  Partial form update payload.
     * @return array<string, mixed>
     */
    public function updateForm(string $formId, array $payload): array
    {
        return $this->request('PATCH', '/forms/'.$this->encode($formId), $payload);
    }

    /**
     * Delete a form and move it to trash.
     *
     * @param  string  $formId  Tally form ID.
     * @return array<string, mixed>
     */
    public function deleteForm(string $formId): array
    {
        return $this->request('DELETE', '/forms/'.$this->encode($formId));
    }

    /**
     * List questions for a form.
     *
     * @param  string  $formId  Tally form ID.
     * @return array<string, mixed>
     */
    public function listQuestions(string $formId): array
    {
        return $this->request('GET', '/forms/'.$this->encode($formId).'/questions');
    }

    /**
     * Update a question title.
     *
     * @param  string  $formId  Tally form ID.
     * @param  string  $questionId  Tally question ID.
     * @param  string  $title  New question title.
     * @return array<string, mixed>
     */
    public function updateQuestion(string $formId, string $questionId, string $title): array
    {
        return $this->request('PATCH', '/forms/'.$this->encode($formId).'/questions/'.$this->encode($questionId), [
            'title' => $title,
        ]);
    }

    /**
     * List blocks for a form.
     *
     * @param  string  $formId  Tally form ID.
     * @return array<string, mixed>
     */
    public function listBlocks(string $formId): array
    {
        return $this->request('GET', '/forms/'.$this->encode($formId).'/blocks');
    }

    /**
     * Replace a form's blocks.
     *
     * @param  string  $formId  Tally form ID.
     * @param  array<int, array<string, mixed>>  $blocks  Tally block payloads.
     * @return array<string, mixed>
     */
    public function updateBlocks(string $formId, array $blocks): array
    {
        return $this->request('PATCH', '/forms/'.$this->encode($formId).'/blocks', [
            'blocks' => $blocks,
        ]);
    }

    // -- Submissions -------------------------------------------------------

    /**
     * List submissions for a form with status and cursor filters.
     *
     * @param  string  $formId  Tally form ID.
     * @param  array<string, mixed>  $params  Query parameters: page, limit, filter, startDate, endDate, afterId.
     * @return array<string, mixed>
     */
    public function listSubmissions(string $formId, array $params = []): array
    {
        return $this->request('GET', '/forms/'.$this->encode($formId).'/submissions', $params);
    }

    /**
     * Fetch a specific form submission.
     *
     * @param  string  $formId  Tally form ID.
     * @param  string  $submissionId  Tally submission ID.
     * @return array<string, mixed>
     */
    public function getSubmission(string $formId, string $submissionId): array
    {
        return $this->request('GET', '/forms/'.$this->encode($formId).'/submissions/'.$this->encode($submissionId));
    }

    /**
     * Delete a specific form submission.
     *
     * @param  string  $formId  Tally form ID.
     * @param  string  $submissionId  Tally submission ID.
     * @return array<string, mixed>
     */
    public function deleteSubmission(string $formId, string $submissionId): array
    {
        return $this->request('DELETE', '/forms/'.$this->encode($formId).'/submissions/'.$this->encode($submissionId));
    }

    // -- Workspaces --------------------------------------------------------

    /**
     * List workspaces.
     *
     * @param  array<string, mixed>  $params  Query parameters: page.
     * @return array<string, mixed>
     */
    public function listWorkspaces(array $params = []): array
    {
        return $this->request('GET', '/workspaces', $params);
    }

    /**
     * Create a workspace.
     *
     * @param  string  $name  Workspace name.
     * @return array<string, mixed>
     */
    public function createWorkspace(string $name): array
    {
        return $this->request('POST', '/workspaces', ['name' => $name]);
    }

    /**
     * Fetch a workspace with associated members.
     *
     * @param  string  $workspaceId  Tally workspace ID.
     * @return array<string, mixed>
     */
    public function getWorkspace(string $workspaceId): array
    {
        return $this->request('GET', '/workspaces/'.$this->encode($workspaceId));
    }

    /**
     * Rename a workspace.
     *
     * @param  string  $workspaceId  Tally workspace ID.
     * @param  string  $name  New workspace name.
     * @return array<string, mixed>
     */
    public function updateWorkspace(string $workspaceId, string $name): array
    {
        return $this->request('PATCH', '/workspaces/'.$this->encode($workspaceId), ['name' => $name]);
    }

    /**
     * Delete a workspace and move associated forms to trash.
     *
     * @param  string  $workspaceId  Tally workspace ID.
     * @return array<string, mixed>
     */
    public function deleteWorkspace(string $workspaceId): array
    {
        return $this->request('DELETE', '/workspaces/'.$this->encode($workspaceId));
    }

    // -- Organizations -----------------------------------------------------

    /**
     * List users in an organization.
     *
     * @param  string  $organizationId  Tally organization ID.
     * @return array<string, mixed>
     */
    public function listOrganizationUsers(string $organizationId): array
    {
        return $this->request('GET', '/organizations/'.$this->encode($organizationId).'/users');
    }

    /**
     * Remove a user from an organization.
     *
     * @param  string  $organizationId  Tally organization ID.
     * @param  string  $userId  Tally user ID.
     * @return array<string, mixed>
     */
    public function removeOrganizationUser(string $organizationId, string $userId): array
    {
        return $this->request('DELETE', '/organizations/'.$this->encode($organizationId).'/users/'.$this->encode($userId));
    }

    /**
     * List pending organization invites.
     *
     * @param  string  $organizationId  Tally organization ID.
     * @return array<string, mixed>
     */
    public function listOrganizationInvites(string $organizationId): array
    {
        return $this->request('GET', '/organizations/'.$this->encode($organizationId).'/invites');
    }

    /**
     * Create organization invites for one or more workspaces.
     *
     * @param  string  $organizationId  Tally organization ID.
     * @param  array<int, string>  $workspaceIds  Workspace IDs to grant access to.
     * @param  string  $emails  Comma- or semicolon-separated email addresses.
     * @return array<string, mixed>
     */
    public function createOrganizationInvite(string $organizationId, array $workspaceIds, string $emails): array
    {
        return $this->request('POST', '/organizations/'.$this->encode($organizationId).'/invites', [
            'workspaceIds' => $workspaceIds,
            'emails' => $emails,
        ]);
    }

    /**
     * Cancel a pending organization invite.
     *
     * @param  string  $organizationId  Tally organization ID.
     * @param  string  $inviteId  Tally invite ID.
     * @return array<string, mixed>
     */
    public function cancelOrganizationInvite(string $organizationId, string $inviteId): array
    {
        return $this->request('DELETE', '/organizations/'.$this->encode($organizationId).'/invites/'.$this->encode($inviteId));
    }

    // -- Webhooks ----------------------------------------------------------

    /**
     * List webhooks.
     *
     * @param  array<string, mixed>  $params  Query parameters: page, limit.
     * @return array<string, mixed>
     */
    public function listWebhooks(array $params = []): array
    {
        return $this->request('GET', '/webhooks', $params);
    }

    /**
     * Create a webhook.
     *
     * @param  array<string, mixed>  $payload  Webhook creation payload.
     * @return array<string, mixed>
     */
    public function createWebhook(array $payload): array
    {
        return $this->request('POST', '/webhooks', $payload);
    }

    /**
     * Update a webhook.
     *
     * @param  string  $webhookId  Tally webhook ID.
     * @param  array<string, mixed>  $payload  Webhook update payload.
     * @return array<string, mixed>
     */
    public function updateWebhook(string $webhookId, array $payload): array
    {
        return $this->request('PATCH', '/webhooks/'.$this->encode($webhookId), $payload);
    }

    /**
     * Delete a webhook.
     *
     * @param  string  $webhookId  Tally webhook ID.
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $webhookId): array
    {
        return $this->request('DELETE', '/webhooks/'.$this->encode($webhookId));
    }

    /**
     * List webhook delivery events.
     *
     * @param  string  $webhookId  Tally webhook ID.
     * @param  array<string, mixed>  $params  Query parameters: page.
     * @return array<string, mixed>
     */
    public function listWebhookEvents(string $webhookId, array $params = []): array
    {
        return $this->request('GET', '/webhooks/'.$this->encode($webhookId).'/events', $params);
    }

    /**
     * Retry a webhook delivery event.
     *
     * @param  string  $webhookId  Tally webhook ID.
     * @param  string  $eventId  Tally webhook event ID.
     * @return array<string, mixed>
     */
    public function retryWebhookEvent(string $webhookId, string $eventId): array
    {
        return $this->request('POST', '/webhooks/'.$this->encode($webhookId).'/events/'.$this->encode($eventId));
    }

    // -- Generic API escape hatch -----------------------------------------

    /**
     * Send a GET request to an arbitrary Tally API path.
     *
     * @param  string  $path  API path under the Tally base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to an arbitrary Tally API path.
     *
     * @param  string  $path  API path under the Tally base URL.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PATCH request to an arbitrary Tally API path.
     *
     * @param  string  $path  API path under the Tally base URL.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to an arbitrary Tally API path.
     *
     * @param  string  $path  API path under the Tally base URL.
     * @param  array<string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Dispatch a raw HTTP request to Tally.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->accessToken) {
            throw new RuntimeException('Tally access token is not configured.');
        }

        $method = strtoupper($method);
        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->accessToken,
                'Content-Type' => 'application/json',
                'tally-version' => $this->apiVersion,
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("Tally API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Tally API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Tally API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Tally API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a caller-supplied path into an API-relative path.
     */
    private function normalizePath(string $path): string
    {
        return '/'.ltrim($path, '/');
    }

    /**
     * Encode a path segment without treating slashes as path separators.
     */
    private function encode(string $value): string
    {
        return rawurlencode($value);
    }
}
