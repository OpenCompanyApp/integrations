<?php

namespace OpenCompany\Integrations\CisaKev;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for CISA Known Exploited Vulnerabilities catalog assets.
 *
 * Fetches the official JSON feed, CSV export, JSON schema, and license text,
 * and applies deterministic client-side filtering for agent-friendly lookups.
 */
class CisaKevService
{
    private const USER_AGENT = 'OpenCompany Integrations (https://opencompany.ai)';

    /**
     * @param  string  $baseUrl  CISA website base URL.
     */
    public function __construct(private string $baseUrl = 'https://www.cisa.gov')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Retrieve the full official CISA KEV JSON catalog.
     *
     * @return array<string, mixed>
     */
    public function catalog(): array
    {
        return $this->requestJson('/sites/default/files/feeds/known_exploited_vulnerabilities.json');
    }

    /**
     * Search KEV vulnerabilities with client-side filters.
     *
     * @param  array<string, mixed>  $filters  Search and pagination filters.
     * @return array<string, mixed>
     */
    public function search(array $filters = []): array
    {
        $catalog = $this->catalog();
        $items = $catalog['vulnerabilities'] ?? [];
        if (!is_array($items)) {
            $items = [];
        }

        $filtered = array_values(array_filter($items, fn (mixed $item): bool => is_array($item) && $this->matches($item, $filters)));
        usort($filtered, static fn (array $a, array $b): int => strcmp((string) ($b['dateAdded'] ?? ''), (string) ($a['dateAdded'] ?? '')));

        $total = count($filtered);
        $offset = max(0, (int) ($filters['offset'] ?? 0));
        $limit = min(500, max(1, (int) ($filters['limit'] ?? 50)));

        return [
            'catalogVersion' => $catalog['catalogVersion'] ?? null,
            'dateReleased' => $catalog['dateReleased'] ?? null,
            'total' => $total,
            'offset' => $offset,
            'limit' => $limit,
            'vulnerabilities' => array_slice($filtered, $offset, $limit),
        ];
    }

    /**
     * Retrieve one KEV catalog entry by CVE ID.
     *
     * @return array<string, mixed>
     */
    public function vulnerability(string $cveId): array
    {
        $result = $this->search(['cve_id' => strtoupper(trim($cveId)), 'limit' => 1]);
        $item = $result['vulnerabilities'][0] ?? null;
        if (!is_array($item)) {
            throw new RuntimeException('CVE not found in the CISA KEV catalog.');
        }

        return $item;
    }

    /**
     * List recently added KEV catalog entries.
     *
     * @param  array<string, mixed>  $filters  Optional since and limit values.
     * @return array<string, mixed>
     */
    public function recent(array $filters = []): array
    {
        $searchFilters = ['limit' => $filters['limit'] ?? 25];
        if (($filters['since'] ?? '') !== '') {
            $searchFilters['date_added_from'] = $filters['since'];
        }

        return $this->search($searchFilters);
    }

    /**
     * Retrieve the official CISA KEV JSON schema.
     *
     * @return array<string, mixed>
     */
    public function schema(): array
    {
        return $this->requestJson('/sites/default/files/feeds/known_exploited_vulnerabilities_schema.json');
    }

    /**
     * Retrieve the official CISA KEV CSV export.
     *
     * @return array{body: string, status: int}
     */
    public function csv(): array
    {
        return $this->requestText('/sites/default/files/csv/known_exploited_vulnerabilities.csv');
    }

    /**
     * Retrieve the official CISA KEV license text.
     *
     * @return array{body: string, status: int}
     */
    public function license(): array
    {
        return $this->requestText('/sites/default/files/licenses/kev/license.txt');
    }

    /**
     * Fetch and parse a JSON CISA asset.
     *
     * @return array<string, mixed>
     */
    private function requestJson(string $path): array
    {
        $response = $this->send($path);
        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        throw new RuntimeException('CISA KEV response was not valid JSON.');
    }

    /**
     * Fetch a text CISA asset.
     *
     * @return array{body: string, status: int}
     */
    private function requestText(string $path): array
    {
        $response = $this->send($path);

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Execute an HTTP GET against a CISA asset.
     */
    private function send(string $path): Response
    {
        try {
            $response = Http::accept('*/*')
                ->withUserAgent(self::USER_AGENT)
                ->timeout(60)
                ->get($this->baseUrl.$path);

            if (!$response->successful()) {
                Log::error('CISA KEV feed error: '.$path, ['status' => $response->status(), 'error' => $response->body()]);

                throw new RuntimeException('CISA KEV feed error ('.$response->status().'): '.$response->body());
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('CISA KEV feed connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to CISA KEV feed: '.$e->getMessage());
        }
    }

    /**
     * Decide whether one vulnerability matches all requested filters.
     *
     * @param  array<string, mixed>  $item  KEV vulnerability item.
     * @param  array<string, mixed>  $filters  Search filters.
     */
    private function matches(array $item, array $filters): bool
    {
        if (($filters['cve_id'] ?? '') !== '' && strcasecmp((string) ($item['cveID'] ?? ''), (string) $filters['cve_id']) !== 0) {
            return false;
        }
        if (($filters['vendor'] ?? '') !== '' && !str_contains(strtolower((string) ($item['vendorProject'] ?? '')), strtolower((string) $filters['vendor']))) {
            return false;
        }
        if (($filters['product'] ?? '') !== '' && !str_contains(strtolower((string) ($item['product'] ?? '')), strtolower((string) $filters['product']))) {
            return false;
        }
        if (($filters['known_ransomware_campaign_use'] ?? '') !== '' && strcasecmp((string) ($item['knownRansomwareCampaignUse'] ?? ''), (string) $filters['known_ransomware_campaign_use']) !== 0) {
            return false;
        }
        if (($filters['cwe'] ?? '') !== '' && !in_array((string) $filters['cwe'], $item['cwes'] ?? [], true)) {
            return false;
        }
        if (($filters['q'] ?? '') !== '') {
            $haystack = strtolower(implode(' ', array_map(static fn (mixed $value): string => is_array($value) ? implode(' ', $value) : (string) $value, $item)));
            if (!str_contains($haystack, strtolower((string) $filters['q']))) {
                return false;
            }
        }

        return $this->dateInRange((string) ($item['dateAdded'] ?? ''), $filters['date_added_from'] ?? null, $filters['date_added_to'] ?? null)
            && $this->dateInRange((string) ($item['dueDate'] ?? ''), $filters['due_date_from'] ?? null, $filters['due_date_to'] ?? null);
    }

    private function dateInRange(string $date, mixed $from, mixed $to): bool
    {
        return (($from ?? '') === '' || strcmp($date, (string) $from) >= 0)
            && (($to ?? '') === '' || strcmp($date, (string) $to) <= 0);
    }
}
