<?php

namespace OpenCompany\Integrations\CompaniesHouse;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Companies House Public Data API.
 *
 * Handles API-key Basic auth, endpoint routing, query encoding, response
 * parsing, and Companies House error normalization.
 */
class CompaniesHouseService
{
    /**
     * @param  string  $apiKey  Companies House API key used as the Basic auth username.
     * @param  string  $baseUrl  Companies House API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.company-information.service.gov.uk',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return trim($this->apiKey) !== '';
    }

    /**
     * Search across companies, officers, and disqualified officers.
     *
     * @param  array<string, mixed>  $params  Query parameters including q, items_per_page, and start_index.
     * @return array<string, mixed>
     */
    public function searchAll(array $params): array
    {
        return $this->get('/search', $params);
    }

    /**
     * Search companies by name or number.
     *
     * @param  array<string, mixed>  $params  Query parameters including q, items_per_page, and start_index.
     * @return array<string, mixed>
     */
    public function searchCompanies(array $params): array
    {
        return $this->get('/search/companies', $params);
    }

    /**
     * Search companies using advanced filters.
     *
     * @param  array<string, mixed>  $params  Advanced company search query parameters.
     * @return array<string, mixed>
     */
    public function advancedSearchCompanies(array $params): array
    {
        return $this->get('/advanced-search/companies', $params);
    }

    /**
     * Search company officers.
     *
     * @param  array<string, mixed>  $params  Query parameters including q, items_per_page, and start_index.
     * @return array<string, mixed>
     */
    public function searchOfficers(array $params): array
    {
        return $this->get('/search/officers', $params);
    }

    /**
     * Search disqualified officers.
     *
     * @param  array<string, mixed>  $params  Query parameters including q, items_per_page, and start_index.
     * @return array<string, mixed>
     */
    public function searchDisqualifiedOfficers(array $params): array
    {
        return $this->get('/search/disqualified-officers', $params);
    }

    /**
     * Retrieve the company profile for a company number.
     *
     * @return array<string, mixed>
     */
    public function companyProfile(string $companyNumber): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber));
    }

    /**
     * Retrieve the registered office address for a company.
     *
     * @return array<string, mixed>
     */
    public function registeredOfficeAddress(string $companyNumber): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/registered-office-address');
    }

    /**
     * List company officers and appointments.
     *
     * @param  array<string, mixed>  $params  Query parameters such as items_per_page, start_index, order_by, and register_type.
     * @return array<string, mixed>
     */
    public function officers(string $companyNumber, array $params = []): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/officers', $params);
    }

    /**
     * Retrieve one officer appointment on a company.
     *
     * @return array<string, mixed>
     */
    public function officerAppointment(string $companyNumber, string $appointmentId): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/appointments/'.$this->encodeSegment($appointmentId));
    }

    /**
     * List all appointments for an officer.
     *
     * @param  array<string, mixed>  $params  Query parameters such as items_per_page and start_index.
     * @return array<string, mixed>
     */
    public function officerAppointments(string $officerId, array $params = []): array
    {
        return $this->get('/officers/'.$this->encodeSegment($officerId).'/appointments', $params);
    }

    /**
     * Retrieve company registers.
     *
     * @return array<string, mixed>
     */
    public function registers(string $companyNumber): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/registers');
    }

    /**
     * List company filing history.
     *
     * @param  array<string, mixed>  $params  Query parameters such as category, items_per_page, and start_index.
     * @return array<string, mixed>
     */
    public function filingHistory(string $companyNumber, array $params = []): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/filing-history', $params);
    }

    /**
     * Retrieve one filing history item.
     *
     * @return array<string, mixed>
     */
    public function filingHistoryItem(string $companyNumber, string $transactionId): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/filing-history/'.$this->encodeSegment($transactionId));
    }

    /**
     * List company charges.
     *
     * @param  array<string, mixed>  $params  Query parameters such as items_per_page and start_index.
     * @return array<string, mixed>
     */
    public function charges(string $companyNumber, array $params = []): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/charges', $params);
    }

    /**
     * Retrieve one company charge.
     *
     * @return array<string, mixed>
     */
    public function charge(string $companyNumber, string $chargeId): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/charges/'.$this->encodeSegment($chargeId));
    }

    /**
     * Retrieve company insolvency information.
     *
     * @return array<string, mixed>
     */
    public function insolvency(string $companyNumber): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/insolvency');
    }

    /**
     * Retrieve company disclosure exemptions.
     *
     * @return array<string, mixed>
     */
    public function exemptions(string $companyNumber): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/exemptions');
    }

    /**
     * List UK establishments for an overseas company.
     *
     * @return array<string, mixed>
     */
    public function ukEstablishments(string $companyNumber): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/uk-establishments');
    }

    /**
     * List persons with significant control for a company.
     *
     * @param  array<string, mixed>  $params  Query parameters such as items_per_page, start_index, and register_view.
     * @return array<string, mixed>
     */
    public function pscList(string $companyNumber, array $params = []): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/persons-with-significant-control', $params);
    }

    /**
     * List PSC statements for a company.
     *
     * @param  array<string, mixed>  $params  Query parameters such as items_per_page and start_index.
     * @return array<string, mixed>
     */
    public function pscStatements(string $companyNumber, array $params = []): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/persons-with-significant-control-statements', $params);
    }

    /**
     * Retrieve an individual PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscIndividual(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'individual', $pscId);
    }

    /**
     * Retrieve a corporate-entity PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscCorporateEntity(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'corporate-entity', $pscId);
    }

    /**
     * Retrieve a legal-person PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscLegalPerson(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'legal-person', $pscId);
    }

    /**
     * Retrieve a super-secure PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscSuperSecure(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'super-secure', $pscId);
    }

    /**
     * Retrieve an individual beneficial owner PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscIndividualBeneficialOwner(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'individual-beneficial-owner', $pscId);
    }

    /**
     * Retrieve a corporate-entity beneficial owner PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscCorporateEntityBeneficialOwner(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'corporate-entity-beneficial-owner', $pscId);
    }

    /**
     * Retrieve a legal-person beneficial owner PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscLegalPersonBeneficialOwner(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'legal-person-beneficial-owner', $pscId);
    }

    /**
     * Retrieve a super-secure beneficial owner PSC record.
     *
     * @return array<string, mixed>
     */
    public function pscSuperSecureBeneficialOwner(string $companyNumber, string $pscId): array
    {
        return $this->pscDetail($companyNumber, 'super-secure-beneficial-owner', $pscId);
    }

    /**
     * Retrieve one PSC statement.
     *
     * @return array<string, mixed>
     */
    public function pscStatement(string $companyNumber, string $statementId): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/persons-with-significant-control-statements/'.$this->encodeSegment($statementId));
    }

    /**
     * Retrieve a natural disqualified officer record.
     *
     * @return array<string, mixed>
     */
    public function disqualifiedOfficerNatural(string $officerId): array
    {
        return $this->get('/disqualified-officers/natural/'.$this->encodeSegment($officerId));
    }

    /**
     * Retrieve a corporate disqualified officer record.
     *
     * @return array<string, mixed>
     */
    public function disqualifiedOfficerCorporate(string $officerId): array
    {
        return $this->get('/disqualified-officers/corporate/'.$this->encodeSegment($officerId));
    }

    /**
     * Execute a Companies House GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $path, array $query = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Companies House API key is not configured.');
        }

        try {
            $response = Http::acceptJson()
                ->withBasicAuth($this->apiKey, '')
                ->timeout(60)
                ->get($this->baseUrl.$path, $this->cleanQuery($query));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Companies House API connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Companies House API: {$e->getMessage()}");
        }
    }

    /**
     * Retrieve one PSC detail variant.
     *
     * @return array<string, mixed>
     */
    private function pscDetail(string $companyNumber, string $type, string $pscId): array
    {
        return $this->get('/company/'.$this->encodeSegment($companyNumber).'/persons-with-significant-control/'.$type.'/'.$this->encodeSegment($pscId));
    }

    /**
     * Encode one path segment without allowing path traversal.
     */
    private function encodeSegment(string $segment): string
    {
        $value = trim($segment);
        if ($value === '' || str_contains($value, '/')) {
            throw new RuntimeException('Path identifiers must be non-empty strings without slashes.');
        }

        return rawurlencode($value);
    }

    /**
     * Remove empty query values and comma-join array filters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function cleanQuery(array $query): array
    {
        $clean = [];
        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $items = array_values(array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== ''));
                if ($items === []) {
                    continue;
                }
                $clean[$key] = implode(',', array_map(static fn (mixed $item): string => (string) $item, $items));

                continue;
            }

            $clean[$key] = $value;
        }

        return $clean;
    }

    /**
     * Parse Companies House JSON responses and normalize errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = null;
            if (is_array($json)) {
                $message = $json['message'] ?? $json['error'] ?? $json['errors'][0]['error'] ?? null;
            }
            $error = is_string($message) ? $message : $response->body();
            Log::error("Companies House API error: {$path}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('Companies House API error ('.$response->status().'): '.$error);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }
}
