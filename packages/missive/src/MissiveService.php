<?php

namespace OpenCompany\Integrations\Missive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service client for the Missive Public API.
 *
 * Handles authentication, HTTP requests, and error handling for all
 * Missive API interactions (analytics, conversations, drafts, posts, contacts,
 * labels, teams, hooks, tasks, users, and organizations).
 *
 * @see https://missiveapp.com/docs/developers/rest-api/endpoints
 */
class MissiveService
{
    /**
     * Create a new MissiveService instance.
     *
     * @param  string  $accessToken  Bearer token for the Missive Public API.
     * @param  string  $baseUrl      Base URL for the Missive API (configurable for testing).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://public.missiveapp.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List conversations with optional filters and pagination.
     *
     * @param  array  $params  Query parameters (inbox, assignee, state, limit, offset, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listConversations(array $params = []): array
    {
        return $this->request('GET', '/conversations', $params);
    }

    /**
     * Get a single conversation by ID.
     *
     * @param  string  $id  The conversation UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getConversation(string $id): array
    {
        return $this->request('GET', '/conversations/' . urlencode($id));
    }

    /**
     * List messages in a conversation.
     *
     * @param  string  $conversationId  The conversation UUID.
     * @param  array<string, mixed>  $params  Query parameters such as limit and until.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listConversationMessages(string $conversationId, array $params = []): array
    {
        return $this->request('GET', '/conversations/' . urlencode($conversationId) . '/messages', $params);
    }

    /**
     * List comments in a conversation.
     *
     * @param  string  $conversationId  The conversation UUID.
     * @param  array<string, mixed>  $params  Query parameters such as limit and until.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listConversationComments(string $conversationId, array $params = []): array
    {
        return $this->request('GET', '/conversations/' . urlencode($conversationId) . '/comments', $params);
    }

    /**
     * List drafts in a conversation.
     *
     * @param  string  $conversationId  The conversation UUID.
     * @param  array<string, mixed>  $params  Query parameters such as limit and until.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listConversationDrafts(string $conversationId, array $params = []): array
    {
        return $this->request('GET', '/conversations/' . urlencode($conversationId) . '/drafts', $params);
    }

    /**
     * List posts in a conversation.
     *
     * @param  string  $conversationId  The conversation UUID.
     * @param  array<string, mixed>  $params  Query parameters such as limit and until.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listConversationPosts(string $conversationId, array $params = []): array
    {
        return $this->request('GET', '/conversations/' . urlencode($conversationId) . '/posts', $params);
    }

    /**
     * Merge one conversation into another.
     *
     * @param  string  $conversationId  Source conversation UUID.
     * @param  array<string, mixed>  $data  Merge payload including target and optional subject.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function mergeConversation(string $conversationId, array $data): array
    {
        return $this->request('POST', '/conversations/' . urlencode($conversationId) . '/merge', $data);
    }

    /**
     * Create a comment on a conversation.
     *
     * @param  array  $data  Comment payload (conversation_id, body, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createComment(array $data): array
    {
        return $this->request('POST', '/comments', $data);
    }

    // ── Drafts, messages, and posts ───────────────────────

    /**
     * Create a draft or send it immediately when the payload includes send=true.
     *
     * @param  array<string, mixed>  $data  Draft payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createDraft(array $data): array
    {
        return $this->request('POST', '/drafts', $data);
    }

    /**
     * Delete a draft by ID.
     *
     * @param  string  $draftId  The draft UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function deleteDraft(string $draftId): array
    {
        return $this->request('DELETE', '/drafts/' . urlencode($draftId));
    }

    /**
     * List messages matching an email Message-ID.
     *
     * @param  array<string, mixed>  $params  Query parameters including email_message_id.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * Create a post in a conversation.
     *
     * @param  array<string, mixed>  $data  Post payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createPost(array $data): array
    {
        return $this->request('POST', '/posts', $data);
    }

    /**
     * Delete a post by ID.
     *
     * @param  string  $postId  The post UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function deletePost(string $postId): array
    {
        return $this->request('DELETE', '/posts/' . urlencode($postId));
    }

    /**
     * List tasks with optional filters and pagination.
     *
     * @param  array  $params  Query parameters (state, assignee, limit, offset, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Get a single task by ID.
     *
     * @param  string  $taskId  The task UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getTask(string $taskId): array
    {
        return $this->request('GET', '/tasks/' . urlencode($taskId));
    }

    /**
     * Create a new task.
     *
     * @param  array  $data  Task payload (title, description, assignee, due_date, etc.).
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
    }

    /**
     * Update a task by ID.
     *
     * @param  string  $taskId  The task UUID.
     * @param  array<string, mixed>  $data  Task attributes to update.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function updateTask(string $taskId, array $data): array
    {
        return $this->request('PATCH', '/tasks/' . urlencode($taskId), $data);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * Create one or more contacts.
     *
     * @param  array<string, mixed>  $data  Contact payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createContacts(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    /**
     * List contacts.
     *
     * @param  array<string, mixed>  $params  Query parameters such as contact_book, search, limit, offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a contact by ID.
     *
     * @param  string  $contactId  The contact UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/contacts/' . urlencode($contactId));
    }

    /**
     * Update one or more contacts by comma-separated IDs.
     *
     * @param  string  $contactIds  One or more contact IDs, comma separated.
     * @param  array<string, mixed>  $data  Contact attributes to update.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function updateContacts(string $contactIds, array $data): array
    {
        return $this->request('PATCH', '/contacts/' . $this->encodeCommaSeparatedIds($contactIds), $data);
    }

    /**
     * List contact books.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listContactBooks(array $params = []): array
    {
        return $this->request('GET', '/contact_books', $params);
    }

    /**
     * List contact groups or organizations in a contact book.
     *
     * @param  array<string, mixed>  $params  Query parameters including contact_book and kind.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listContactGroups(array $params = []): array
    {
        return $this->request('GET', '/contact_groups', $params);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List organizations the authenticated user is part of.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->request('GET', '/organizations', $params);
    }

    /**
     * List users in accessible organizations.
     *
     * @param  array<string, mixed>  $params  Query parameters such as organization, limit, offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * List teams in accessible organizations.
     *
     * @param  array<string, mixed>  $params  Query parameters such as organization, limit, offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    /**
     * Create one or more teams.
     *
     * @param  array<string, mixed>  $data  Team payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createTeams(array $data): array
    {
        return $this->request('POST', '/teams', $data);
    }

    /**
     * List shared labels in accessible organizations.
     *
     * @param  array<string, mixed>  $params  Query parameters such as organization, limit, offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listSharedLabels(array $params = []): array
    {
        return $this->request('GET', '/shared_labels', $params);
    }

    // ── Responses, analytics, and webhooks ─────────────────

    /**
     * List canned responses.
     *
     * @param  array<string, mixed>  $params  Query parameters such as organization, limit, offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listResponses(array $params = []): array
    {
        return $this->request('GET', '/responses', $params);
    }

    /**
     * Get a canned response by ID.
     *
     * @param  string  $responseId  The response UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getResponse(string $responseId): array
    {
        return $this->request('GET', '/responses/' . urlencode($responseId));
    }

    /**
     * Create one or more canned responses.
     *
     * @param  array<string, mixed>  $data  Response payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createResponses(array $data): array
    {
        return $this->request('POST', '/responses', $data);
    }

    /**
     * Update one or more canned responses by comma-separated IDs.
     *
     * @param  string  $responseIds  One or more response IDs, comma separated.
     * @param  array<string, mixed>  $data  Response attributes to update.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function updateResponses(string $responseIds, array $data): array
    {
        return $this->request('PATCH', '/responses/' . $this->encodeCommaSeparatedIds($responseIds), $data);
    }

    /**
     * Delete one or more canned responses by comma-separated IDs.
     *
     * @param  string  $responseIds  One or more response IDs, comma separated.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function deleteResponses(string $responseIds): array
    {
        return $this->request('DELETE', '/responses/' . $this->encodeCommaSeparatedIds($responseIds));
    }

    /**
     * Create an analytics report.
     *
     * @param  array<string, mixed>  $data  Analytics report payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createAnalyticsReport(array $data): array
    {
        return $this->request('POST', '/analytics/reports', $data);
    }

    /**
     * Get an analytics report by ID.
     *
     * @param  string  $reportId  The report UUID returned by createAnalyticsReport.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function getAnalyticsReport(string $reportId): array
    {
        return $this->request('GET', '/analytics/reports/' . urlencode($reportId));
    }

    /**
     * List webhook subscriptions.
     *
     * @param  array<string, mixed>  $params  Query parameters such as organization, limit, offset.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function listHooks(array $params = []): array
    {
        return $this->request('GET', '/hooks', $params);
    }

    /**
     * Create a webhook subscription.
     *
     * @param  array<string, mixed>  $data  Hook payload.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function createHook(array $data): array
    {
        return $this->request('POST', '/hooks', $data);
    }

    /**
     * Delete a webhook subscription.
     *
     * @param  string  $hookId  The hook UUID.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function deleteHook(string $hookId): array
    {
        return $this->request('DELETE', '/hooks/' . urlencode($hookId));
    }

    // ── Generic API ────────────────────────────────────────

    /**
     * Call a documented Missive API GET endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Call a documented Missive API POST endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $body);
    }

    /**
     * Call a documented Missive API PATCH endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function apiPatch(string $path, array $body = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $body);
    }

    /**
     * Call a documented Missive API DELETE endpoint.
     *
     * @param  string  $path  Endpoint path relative to /v1.
     * @param  array<string, mixed>  $params  Request parameters.
     * @return array<string, mixed> Parsed JSON response.
     */
    public function apiDelete(string $path, array $params = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (relative to base URL).
     * @param  array   $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Missive API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (relative to base URL).
     * @param  array   $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException On connection failure or non-successful response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Missive access token is not configured.');
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
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Missive API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Missive API endpoint not available (HTTP {$response->status()}). Check the API URL.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Missive API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Missive API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Missive API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Missive API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a user-supplied path for generic API helpers.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);
        $path = preg_replace('#^https?://[^/]+/v1#', '', $path) ?? $path;
        $path = preg_replace('#^/v1#', '', $path) ?? $path;
        $path = '/' . ltrim($path, '/');

        if ($path === '/') {
            throw new \InvalidArgumentException('A Missive API path is required.');
        }

        return $path;
    }

    /**
     * Encode path IDs while preserving comma-separated bulk update syntax.
     */
    private function encodeCommaSeparatedIds(string $ids): string
    {
        return implode(',', array_map('rawurlencode', array_map('trim', explode(',', $ids))));
    }
}
