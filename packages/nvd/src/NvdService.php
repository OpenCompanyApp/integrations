<?php

namespace OpenCompany\Integrations\Nvd;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the NIST National Vulnerability Database APIs.
 *
 * Handles optional apiKey authentication, NVD 2.0 endpoint routing, query
 * parameter normalization, flag parameters, response parsing, and error logging.
 */
class NvdService
{
    /**
     * @param  string  $apiKey  Optional NVD API key for higher rate limits.
     * @param  string  $baseUrl  NVD REST API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://services.nvd.nist.gov/rest/json',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    public function hasApiKey(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Search CVE records using official NVD 2.0 filters.
     *
     * @param  array<string, mixed>  $params  CVE query filters.
     * @return array<string, mixed>
     */
    public function cves(array $params = []): array
    {
        return $this->request('/cves/2.0', $params, $this->cveMap(), $this->cveFlags());
    }

    /**
     * Retrieve CVE records by a specific CVE ID.
     *
     * @return array<string, mixed>
     */
    public function cveById(string $cveId): array
    {
        return $this->cves(['cve_id' => strtoupper(trim($cveId))]);
    }

    /**
     * Search CVE change-history events.
     *
     * @param  array<string, mixed>  $params  Change-history filters.
     * @return array<string, mixed>
     */
    public function cveHistory(array $params = []): array
    {
        return $this->request('/cvehistory/2.0', $params, [
            'change_start_date' => 'changeStartDate',
            'change_end_date' => 'changeEndDate',
            'cve_id' => 'cveId',
            'event_name' => 'eventName',
            'results_per_page' => 'resultsPerPage',
            'start_index' => 'startIndex',
        ]);
    }

    /**
     * Search CPE dictionary records.
     *
     * @param  array<string, mixed>  $params  CPE query filters.
     * @return array<string, mixed>
     */
    public function cpes(array $params = []): array
    {
        return $this->request('/cpes/2.0', $params, [
            'cpe_name_id' => 'cpeNameId',
            'cpe_match_string' => 'cpeMatchString',
            'keyword_search' => 'keywordSearch',
            'keyword_exact_match' => 'keywordExactMatch',
            'last_mod_start_date' => 'lastModStartDate',
            'last_mod_end_date' => 'lastModEndDate',
            'match_criteria_id' => 'matchCriteriaId',
            'results_per_page' => 'resultsPerPage',
            'start_index' => 'startIndex',
        ], ['keyword_exact_match']);
    }

    /**
     * Retrieve CPE dictionary records by cpeNameId UUID.
     *
     * @return array<string, mixed>
     */
    public function cpeByNameId(string $cpeNameId): array
    {
        return $this->cpes(['cpe_name_id' => trim($cpeNameId)]);
    }

    /**
     * Search CPE match criteria records.
     *
     * @param  array<string, mixed>  $params  Match criteria filters.
     * @return array<string, mixed>
     */
    public function cpeMatch(array $params = []): array
    {
        return $this->request('/cpematch/2.0', $params, [
            'cve_id' => 'cveId',
            'last_mod_start_date' => 'lastModStartDate',
            'last_mod_end_date' => 'lastModEndDate',
            'match_criteria_id' => 'matchCriteriaId',
            'match_string_search' => 'matchStringSearch',
            'results_per_page' => 'resultsPerPage',
            'start_index' => 'startIndex',
        ]);
    }

    /**
     * Retrieve CPE match criteria by matchCriteriaId UUID.
     *
     * @return array<string, mixed>
     */
    public function cpeMatchByCriteriaId(string $matchCriteriaId): array
    {
        return $this->cpeMatch(['match_criteria_id' => trim($matchCriteriaId)]);
    }

    /**
     * Search NVD data-source metadata.
     *
     * @param  array<string, mixed>  $params  Source filters.
     * @return array<string, mixed>
     */
    public function sources(array $params = []): array
    {
        return $this->request('/source/2.0', $params, [
            'last_mod_start_date' => 'lastModStartDate',
            'last_mod_end_date' => 'lastModEndDate',
            'results_per_page' => 'resultsPerPage',
            'source_identifier' => 'sourceIdentifier',
            'start_index' => 'startIndex',
        ]);
    }

    /**
     * Retrieve source metadata by sourceIdentifier.
     *
     * @return array<string, mixed>
     */
    public function sourceByIdentifier(string $sourceIdentifier): array
    {
        return $this->sources(['source_identifier' => trim($sourceIdentifier)]);
    }

    /**
     * Execute an NVD GET request.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @param  array<string, string>  $map  Snake-case to NVD query name map.
     * @param  list<string>  $flags  Boolean flag parameters that are sent without values when true.
     * @return array<string, mixed>
     */
    private function request(string $path, array $params, array $map, array $flags = []): array
    {
        try {
            $request = Http::acceptJson()->timeout(60);
            if ($this->hasApiKey()) {
                $request = $request->withHeaders(['apiKey' => $this->apiKey]);
            }

            $response = $request->get($this->baseUrl.$path.$this->queryString($params, $map, $flags));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('NVD API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to NVD API: '.$e->getMessage());
        }
    }

    /**
     * Build a query string that preserves NVD's valueless boolean flags.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @param  array<string, string>  $map  Snake-case to NVD query name map.
     * @param  list<string>  $flags  Boolean flag parameters.
     */
    private function queryString(array $params, array $map, array $flags): string
    {
        $query = [];
        $flagKeys = [];
        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (in_array($key, $flags, true)) {
                if ((bool) $value) {
                    $flagKeys[] = $map[$key] ?? $key;
                }
                continue;
            }

            $query[$map[$key] ?? $key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
        }

        $parts = [];
        if ($query !== []) {
            $parts[] = http_build_query($query, '', '&', PHP_QUERY_RFC3986);
        }
        foreach ($flagKeys as $flagKey) {
            $parts[] = rawurlencode($flagKey);
        }

        return $parts === [] ? '' : '?'.implode('&', $parts);
    }

    /**
     * Parse NVD JSON responses and normalize HTTP errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = null;
            if (is_array($json)) {
                $message = $json['message'] ?? $json['error'] ?? null;
            }
            $message = is_string($message) && $message !== '' ? $message : ($response->header('message') ?: $response->body());
            Log::error('NVD API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('NVD API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Return CVE endpoint parameter mappings.
     *
     * @return array<string, string>
     */
    private function cveMap(): array
    {
        return [
            'cpe_name' => 'cpeName',
            'cve_id' => 'cveId',
            'cve_tag' => 'cveTag',
            'cvss_v2_metrics' => 'cvssV2Metrics',
            'cvss_v2_severity' => 'cvssV2Severity',
            'cvss_v3_metrics' => 'cvssV3Metrics',
            'cvss_v3_severity' => 'cvssV3Severity',
            'cvss_v4_metrics' => 'cvssV4Metrics',
            'cvss_v4_severity' => 'cvssV4Severity',
            'cwe_id' => 'cweId',
            'has_cert_alerts' => 'hasCertAlerts',
            'has_cert_notes' => 'hasCertNotes',
            'has_kev' => 'hasKev',
            'has_oval' => 'hasOval',
            'is_vulnerable' => 'isVulnerable',
            'kev_start_date' => 'kevStartDate',
            'kev_end_date' => 'kevEndDate',
            'keyword_search' => 'keywordSearch',
            'keyword_exact_match' => 'keywordExactMatch',
            'last_mod_start_date' => 'lastModStartDate',
            'last_mod_end_date' => 'lastModEndDate',
            'no_rejected' => 'noRejected',
            'pub_start_date' => 'pubStartDate',
            'pub_end_date' => 'pubEndDate',
            'results_per_page' => 'resultsPerPage',
            'source_identifier' => 'sourceIdentifier',
            'start_index' => 'startIndex',
            'version_end' => 'versionEnd',
            'version_end_type' => 'versionEndType',
            'version_start' => 'versionStart',
            'version_start_type' => 'versionStartType',
            'virtual_match_string' => 'virtualMatchString',
        ];
    }

    /**
     * Return CVE endpoint valueless boolean flags.
     *
     * @return list<string>
     */
    private function cveFlags(): array
    {
        return ['has_cert_alerts', 'has_cert_notes', 'has_kev', 'has_oval', 'is_vulnerable', 'keyword_exact_match', 'no_rejected'];
    }
}
