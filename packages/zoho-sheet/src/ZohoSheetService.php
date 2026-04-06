<?php

namespace OpenCompany\Integrations\ZohoSheet;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * ZohoSheetService — HTTP client for the Zoho Sheet API v2.
 *
 * Handles authentication via Bearer token, configurable base URL,
 * and all API methods used by the Zoho Sheet tools.
 *
 * @see https://sheet.zoho.com/apidoc.html Zoho Sheet API Documentation
 */
class ZohoSheetService
{
    /**
     * Create a new ZohoSheetService instance.
     *
     * @param  string  $accessToken  OAuth access token for Zoho API authentication.
     * @param  string  $baseUrl  Base URL for the Zoho Sheet API (default: https://sheet.zoho.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://sheet.zoho.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all spreadsheets accessible to the authenticated user.
     *
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $perPage  Number of spreadsheets per page.
     * @return array<string, mixed> API response containing spreadsheet list.
     */
    public function listSpreadsheets(int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/api/v2/spreadsheets', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get details of a specific spreadsheet.
     *
     * @param  string  $id  The spreadsheet resource ID.
     * @return array<string, mixed> API response containing spreadsheet details.
     */
    public function getSpreadsheet(string $id): array
    {
        return $this->request('GET', '/api/v2/spreadsheets/' . urlencode($id));
    }

    /**
     * List all worksheets within a spreadsheet.
     *
     * @param  string  $id  The spreadsheet resource ID.
     * @return array<string, mixed> API response containing worksheet list.
     */
    public function listWorksheets(string $id): array
    {
        return $this->request('GET', '/api/v2/spreadsheets/' . urlencode($id) . '/worksheets');
    }

    /**
     * Get details of a specific worksheet within a spreadsheet.
     *
     * @param  string  $id  The spreadsheet resource ID.
     * @param  string  $worksheetId  The worksheet resource ID.
     * @return array<string, mixed> API response containing worksheet details.
     */
    public function getWorksheet(string $id, string $worksheetId): array
    {
        return $this->request('GET', '/api/v2/spreadsheets/' . urlencode($id) . '/worksheets/' . urlencode($worksheetId));
    }

    /**
     * List rows in a specific worksheet with pagination.
     *
     * @param  string  $id  The spreadsheet resource ID.
     * @param  string  $worksheetId  The worksheet resource ID.
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $perPage  Number of rows per page.
     * @return array<string, mixed> API response containing row data.
     */
    public function listRows(string $id, string $worksheetId, int $page = 1, int $perPage = 25): array
    {
        return $this->request('GET', '/api/v2/spreadsheets/' . urlencode($id) . '/worksheets/' . urlencode($worksheetId) . '/rows', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Create a new row in a specific worksheet.
     *
     * @param  string  $id  The spreadsheet resource ID.
     * @param  string  $worksheetId  The worksheet resource ID.
     * @param  array<string, mixed>  $data  Row data as key-value pairs (column header → value).
     * @return array<string, mixed> API response containing created row details.
     */
    public function createRow(string $id, string $worksheetId, array $data): array
    {
        return $this->request('POST', '/api/v2/spreadsheets/' . urlencode($id) . '/worksheets/' . urlencode($worksheetId) . '/rows', [
            'data' => $data,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed> API response containing user profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zoho Sheet API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoho Sheet access token is not configured.');
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
                    Log::warning("Zoho Sheet API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoho Sheet API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Zoho Sheet API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zoho Sheet API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Sheet API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Sheet API: {$e->getMessage()}");
        }
    }
}
