<?php

namespace OpenCompany\Integrations\ClinicalTrialsGov;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the ClinicalTrials.gov REST API v2.
 *
 * Handles endpoint routing, pipe-delimited query encoding, mixed response
 * formats, and ClinicalTrials.gov error normalization for all tools.
 */
class ClinicalTrialsGovService
{
    /**
     * @param  string  $baseUrl  ClinicalTrials.gov REST API v2 base URL.
     */
    public function __construct(
        private string $baseUrl = 'https://clinicaltrials.gov/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Search or list clinical studies.
     *
     * @param  array<string, mixed>  $query  Study search, filter, paging, fields, sort, and format parameters.
     * @return array<string, mixed>
     */
    public function listStudies(array $query = []): array
    {
        return $this->get('studies', $query);
    }

    /**
     * Fetch a single study by NCT ID.
     *
     * @param  array<string, mixed>  $query  Format, markupFormat, and fields parameters.
     * @return array<string, mixed>
     */
    public function fetchStudy(string $nctId, array $query = []): array
    {
        return $this->get('studies/'.rawurlencode($nctId), $query);
    }

    /**
     * Retrieve the study data model field tree.
     *
     * @param  array<string, mixed>  $query  includeIndexedOnly and includeHistoricOnly parameters.
     * @return array<string, mixed>
     */
    public function metadata(array $query = []): array
    {
        return $this->get('studies/metadata', $query);
    }

    /**
     * Retrieve search documents and search areas.
     *
     * @return array<string, mixed>
     */
    public function searchAreas(): array
    {
        return $this->get('studies/search-areas');
    }

    /**
     * Retrieve enum types and values.
     *
     * @return array<string, mixed>
     */
    public function enums(): array
    {
        return $this->get('studies/enums');
    }

    /**
     * Retrieve study JSON size statistics.
     *
     * @return array<string, mixed>
     */
    public function sizeStats(): array
    {
        return $this->get('stats/size');
    }

    /**
     * Retrieve value statistics for study leaf fields.
     *
     * @param  array<string, mixed>  $query  types and fields filters.
     * @return array<string, mixed>
     */
    public function fieldValuesStats(array $query = []): array
    {
        return $this->get('stats/field/values', $query);
    }

    /**
     * Retrieve size statistics for list/array fields.
     *
     * @param  array<string, mixed>  $query  fields filters.
     * @return array<string, mixed>
     */
    public function fieldSizesStats(array $query = []): array
    {
        return $this->get('stats/field/sizes', $query);
    }

    /**
     * Retrieve API and data version information.
     *
     * @return array<string, mixed>
     */
    public function version(): array
    {
        return $this->get('version');
    }

    /**
     * Make a GET request to a ClinicalTrials.gov API path.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function get(string $path, array $query = []): array
    {
        try {
            $response = Http::accept('application/json, text/csv;q=0.9, application/fhir+json;q=0.8, application/zip;q=0.7, text/plain;q=0.6, */*;q=0.5')
                ->withUserAgent('OpenCompany Integrations clinicaltrials-gov/1.0 (mailto:agent@example.test)')
                ->timeout(60)
                ->get($this->urlWithQuery($this->baseUrl.'/'.ltrim($path, '/'), $query));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ClinicalTrials.gov API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to ClinicalTrials.gov API: {$e->getMessage()}");
        }
    }

    /**
     * Build a URL with API-compatible query parameters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $normalized = $this->normalizeQuery($query);

        return $normalized === [] ? $url : $url.'?'.http_build_query($normalized, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Normalize arrays to pipe-delimited values and booleans to true/false.
     *
     * @param  array<string, mixed>  $query  Raw query parameters.
     * @return array<string, scalar>
     */
    private function normalizeQuery(array $query): array
    {
        $normalized = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = implode('|', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized;
    }

    /**
     * Parse JSON and non-JSON responses, converting plain-text errors to exceptions.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $contentType = (string) $response->header('Content-Type', '');
        $body = $response->body();
        $json = str_contains(strtolower($contentType), 'json') ? $response->json() : null;

        if (!$response->successful()) {
            $message = is_array($json) ? $this->errorMessage($json) : null;
            $message ??= trim($body) !== '' ? trim($body) : 'Unknown ClinicalTrials.gov error.';
            Log::error("ClinicalTrials.gov API error: {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('ClinicalTrials.gov API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            $message = $this->errorMessage($json);
            if ($message !== null) {
                throw new RuntimeException('ClinicalTrials.gov API error ('.$response->status().'): '.$message);
            }

            return $json;
        }

        return [
            'body' => $body,
            'status' => $response->status(),
            'content_type' => $contentType,
            'headers' => [
                'x-total-count' => $response->header('x-total-count'),
                'x-next-page-token' => $response->header('x-next-page-token'),
            ],
        ];
    }

    /**
     * Extract a readable error message from JSON responses.
     */
    private function errorMessage(array $json): ?string
    {
        foreach (['error', 'message', 'errorMessage'] as $key) {
            if (isset($json[$key]) && is_scalar($json[$key])) {
                return (string) $json[$key];
            }
        }

        return null;
    }
}
