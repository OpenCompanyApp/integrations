<?php

namespace OpenCompany\Integrations\SecEdgar;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for SEC EDGAR public data APIs.
 *
 * Handles CIK normalization, endpoint routing, SEC fair-access User-Agent
 * headers, response parsing, and EDGAR error normalization.
 */
class SecEdgarService
{
    /**
     * @param  string  $userAgent  Identifiable User-Agent required by SEC fair-access guidance.
     * @param  string  $dataBaseUrl  data.sec.gov base URL.
     * @param  string  $wwwBaseUrl  www.sec.gov base URL for ticker mapping files.
     */
    public function __construct(
        private string $userAgent = 'OpenCompanyIntegrations/1.0 agent@example.test',
        private string $dataBaseUrl = 'https://data.sec.gov',
        private string $wwwBaseUrl = 'https://www.sec.gov',
    ) {
        $this->dataBaseUrl = rtrim($this->dataBaseUrl, '/');
        $this->wwwBaseUrl = rtrim($this->wwwBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->userAgent) !== '';
    }

    /**
     * Retrieve current submissions history for a filer.
     *
     * @return array<string, mixed>
     */
    public function submissions(string|int $cik): array
    {
        return $this->dataGet('submissions/CIK'.$this->normalizeCik($cik).'.json');
    }

    /**
     * Retrieve an additional paginated submissions JSON file listed by the submissions endpoint.
     *
     * @return array<string, mixed>
     */
    public function submissionFile(string $file): array
    {
        if (!preg_match('/^CIK\d{10}-submissions-\d{3}\.json$/', $file)) {
            throw new RuntimeException('file must look like CIK0000000000-submissions-001.json.');
        }

        return $this->dataGet('submissions/'.$file);
    }

    /**
     * Retrieve all standardized XBRL company facts for a CIK.
     *
     * @return array<string, mixed>
     */
    public function companyFacts(string|int $cik): array
    {
        return $this->dataGet('api/xbrl/companyfacts/CIK'.$this->normalizeCik($cik).'.json');
    }

    /**
     * Retrieve all facts for a single CIK, taxonomy, and tag.
     *
     * @return array<string, mixed>
     */
    public function companyConcept(string|int $cik, string $taxonomy, string $tag): array
    {
        return $this->dataGet('api/xbrl/companyconcept/CIK'.$this->normalizeCik($cik).'/'.rawurlencode($taxonomy).'/'.rawurlencode($tag).'.json');
    }

    /**
     * Retrieve a frame of XBRL facts across reporting entities.
     *
     * @return array<string, mixed>
     */
    public function frames(string $taxonomy, string $tag, string $unit, string $period): array
    {
        return $this->dataGet('api/xbrl/frames/'.rawurlencode($taxonomy).'/'.rawurlencode($tag).'/'.rawurlencode($unit).'/'.rawurlencode($period).'.json');
    }

    /**
     * Retrieve SEC company ticker mapping JSON.
     *
     * @return array<string, mixed>
     */
    public function companyTickers(): array
    {
        return $this->wwwGet('files/company_tickers.json');
    }

    /**
     * Retrieve SEC company ticker/exchange mapping JSON.
     *
     * @return array<string, mixed>
     */
    public function companyTickersExchange(): array
    {
        return $this->wwwGet('files/company_tickers_exchange.json');
    }

    /**
     * Return official SEC bulk archive URLs without downloading the large ZIP files.
     *
     * @return array<string, mixed>
     */
    public function bulkArchives(): array
    {
        return [
            'submissions_zip' => $this->wwwBaseUrl.'/Archives/edgar/daily-index/bulkdata/submissions.zip',
            'companyfacts_zip' => $this->wwwBaseUrl.'/Archives/edgar/daily-index/xbrl/companyfacts.zip',
            'updated' => 'SEC republishes bulk archives nightly at approximately 3:00 a.m. ET.',
        ];
    }

    /**
     * Execute a GET request against data.sec.gov.
     *
     * @return array<string, mixed>
     */
    private function dataGet(string $path): array
    {
        return $this->get($this->dataBaseUrl.'/'.ltrim($path, '/'), $path);
    }

    /**
     * Execute a GET request against www.sec.gov.
     *
     * @return array<string, mixed>
     */
    private function wwwGet(string $path): array
    {
        return $this->get($this->wwwBaseUrl.'/'.ltrim($path, '/'), $path);
    }

    /**
     * Execute a SEC request with required headers.
     *
     * @return array<string, mixed>
     */
    private function get(string $url, string $path): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('SEC EDGAR User-Agent is not configured.');
        }

        try {
            $response = Http::acceptJson()
                ->withUserAgent($this->userAgent)
                ->timeout(60)
                ->get($url);

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SEC EDGAR API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to SEC EDGAR API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a CIK to the SEC's 10-digit API form.
     */
    private function normalizeCik(string|int $cik): string
    {
        $digits = preg_replace('/\D+/', '', (string) $cik) ?? '';
        if ($digits === '' || strlen($digits) > 10) {
            throw new RuntimeException('cik must contain 1 to 10 digits.');
        }

        return str_pad($digits, 10, '0', STR_PAD_LEFT);
    }

    /**
     * Parse SEC JSON responses and normalize errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
            $message = is_string($message) ? $message : $response->body();
            Log::error("SEC EDGAR API error: {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('SEC EDGAR API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }
}
