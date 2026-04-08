<?php

namespace OpenCompany\Integrations\Formstack;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * FormstackService — HTTP client for the Formstack v2 API.
 *
 * Wraps all Formstack REST endpoints used by the integration tools.
 * Authentication uses an OAuth2 Bearer access token passed via the
 * `Authorization` header.
 *
 * @see https://www.formstack.com/docs/api/v2
 */
class FormstackService
{
    /**
     * Create a new FormstackService instance.
     *
     * @param  string  $accessToken  OAuth2 bearer token for the Formstack API.
     * @param  string  $baseUrl      Base URL of the Formstack API (defaults to https://www.formstack.com/api/v2).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://www.formstack.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all forms in the authenticated user's account.
     *
     * @param  int  $page    Page number for pagination (default 1).
     * @param  int  $perPage Number of results per page (default 25, max 200).
     * @param  string|null  $search  Optional search string to filter forms by name.
     * @return array<string, mixed> API response containing forms and pagination metadata.
     *
     * @see https://www.formstack.com/docs/api/v2/form#get-all-forms
     */
    public function listForms(int $page = 1, int $perPage = 25, ?string $search = null): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];
        if ($search !== null) {
            $params['search'] = $search;
        }

        return $this->request('GET', '/form', $params);
    }

    /**
     * Get details for a specific form, including its field structure.
     *
     * @param  int  $formId  The numeric ID of the form.
     * @return array<string, mixed> Form details including name, fields, and metadata.
     *
     * @see https://www.formstack.com/docs/api/v2/form#get-a-specific-form
     */
    public function getForm(int $formId): array
    {
        return $this->request('GET', '/form/' . $formId);
    }

    /**
     * List submissions for a specific form.
     *
     * @param  int  $formId  The numeric ID of the form.
     * @param  int  $page    Page number for pagination (default 1).
     * @param  int  $perPage Number of results per page (default 25, max 200).
     * @param  bool  $expandData Whether to expand submission data (default false).
     * @return array<string, mixed> API response containing submissions and pagination metadata.
     *
     * @see https://www.formstack.com/docs/api/v2/submission#get-submissions-for-a-form
     */
    public function listSubmissions(int $formId, int $page = 1, int $perPage = 25, bool $expandData = false): array
    {
        $params = [
            'page' => $page,
            'per_page' => $perPage,
        ];
        if ($expandData) {
            $params['expand_data'] = '1';
        }

        return $this->request('GET', '/form/' . $formId . '/submission', $params);
    }

    /**
     * Get details of a specific submission.
     *
     * @param  int  $submissionId  The numeric ID of the submission.
     * @return array<string, mixed> Submission details including field data and metadata.
     *
     * @see https://www.formstack.com/docs/api/v2/submission#get-a-specific-submission
     */
    public function getSubmission(int $submissionId): array
    {
        return $this->request('GET', '/submission/' . $submissionId);
    }

    /**
     * Create a new submission for a form.
     *
     * @param  int  $formId  The numeric ID of the form to submit to.
     * @param  array<string, mixed>  $fields  Associative array of field values (field_key => value).
     * @return array<string, mixed> Created submission details.
     *
     * @see https://www.formstack.com/docs/api/v2/submission#create-a-submission
     */
    public function createSubmission(int $formId, array $fields): array
    {
        return $this->request('POST', '/form/' . $formId . '/submission', $fields);
    }

    /**
     * Delete a submission.
     *
     * @param  int  $submissionId  The numeric ID of the submission to delete.
     * @return array<string, mixed> Deletion confirmation.
     *
     * @see https://www.formstack.com/docs/api/v2/submission#delete-a-submission
     */
    public function deleteSubmission(int $submissionId): array
    {
        return $this->request('DELETE', '/submission/' . $submissionId);
    }

    /**
     * List all folders in the authenticated user's account.
     *
     * @return array<string, mixed> API response containing folders.
     *
     * @see https://www.formstack.com/docs/api/v2/folder#get-all-folders
     */
    public function listFolders(): array
    {
        return $this->request('GET', '/folder');
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> User profile details.
     *
     * @see https://www.formstack.com/docs/api/v2/user#get-the-current-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/form/123").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Formstack API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Formstack access token is not configured.');
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
                    Log::warning("Formstack API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Formstack API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or your access token may be invalid.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Formstack API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Formstack API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Formstack API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Formstack API: {$e->getMessage()}");
        }
    }
}
