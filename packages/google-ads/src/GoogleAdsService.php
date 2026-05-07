<?php

namespace OpenCompany\Integrations\GoogleAds;

use App\Models\IntegrationSetting;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Google Ads REST API.
 *
 * Handles OAuth refresh, Google Ads headers, request-id capture, versioned endpoints,
 * guarded mutates, conversion uploads, and normalized error responses for tools.
 */
class GoogleAdsService
{
    private const BASE_URL = 'https://googleads.googleapis.com';

    /**
     * @param  string  $clientId  OAuth client ID
     * @param  string  $clientSecret  OAuth client secret
     * @param  string  $accessToken  OAuth access token
     * @param  string  $refreshToken  OAuth refresh token for CLI/manual setup
     * @param  int|null  $expiresAt  Unix timestamp when the access token expires
     * @param  string  $developerToken  Google Ads API developer token
     * @param  string  $managerCustomerId  Optional manager account ID used as login-customer-id
     * @param  string  $defaultCustomerId  Optional default operating customer ID
     * @param  string  $linkedCustomerId  Optional linked-customer-id for analytics-app conversion uploads
     * @param  string  $apiVersion  Google Ads API version such as v24
     */
    public function __construct(
        private string $clientId = '',
        private string $clientSecret = '',
        private string $accessToken = '',
        private string $refreshToken = '',
        private ?int $expiresAt = null,
        private string $developerToken = '',
        private string $managerCustomerId = '',
        private string $defaultCustomerId = '',
        private string $linkedCustomerId = '',
        private string $apiVersion = 'v24',
    ) {
        $this->managerCustomerId = $this->normalizeCustomerId($this->managerCustomerId);
        $this->defaultCustomerId = $this->normalizeCustomerId($this->defaultCustomerId);
        $this->linkedCustomerId = $this->normalizeCustomerId($this->linkedCustomerId);
        $this->apiVersion = preg_match('/^v\d+$/', $this->apiVersion) ? $this->apiVersion : 'v24';
    }

    public function isConfigured(): bool
    {
        return $this->developerToken !== ''
            && ($this->accessToken !== '' || ($this->refreshToken !== '' && $this->clientId !== '' && $this->clientSecret !== ''));
    }

    /**
     * Return configuration diagnostics without exposing secrets.
     *
     * @return array<string, mixed>
     */
    public function diagnostics(): array
    {
        return [
            'configured' => $this->isConfigured(),
            'apiVersion' => $this->apiVersion,
            'hasRefreshToken' => $this->refreshToken !== '',
            'hasManagerCustomerId' => $this->managerCustomerId !== '',
            'defaultCustomerId' => $this->defaultCustomerId ?: null,
            'supportsCliManualTokenSetup' => true,
            'oauthScope' => 'https://www.googleapis.com/auth/adwords',
        ];
    }

    /**
     * Normalize a Google Ads customer ID by stripping dashes and whitespace.
     */
    public function normalizeCustomerId(?string $customerId): string
    {
        return preg_replace('/\D+/', '', (string) $customerId) ?? '';
    }

    /**
     * Build a Google Ads resource name.
     */
    public function resourceName(string $resource, string|int $id, ?string $customerId = null): string
    {
        $customerId = $this->customerId($customerId);

        return "customers/{$customerId}/{$resource}/{$id}";
    }

    /**
     * Resolve the provided customer ID or configured default customer ID.
     */
    public function resolveCustomerId(?string $customerId = null): string
    {
        return $this->customerId($customerId);
    }

    /**
     * List customers directly accessible to the OAuth user.
     *
     * @return array<string, mixed>
     */
    public function listAccessibleCustomers(): array
    {
        return $this->request('GET', '/customers:listAccessibleCustomers', customerId: null, includeLoginCustomer: false);
    }

    /**
     * Execute a GAQL Search request.
     *
     * @param  array<string, mixed>  $options  page_token, validate_only, return_summary_row, return_total_results_count, omit_results
     * @return array<string, mixed>
     */
    public function search(string $query, ?string $customerId = null, array $options = []): array
    {
        $body = ['query' => $query];

        if (! empty($options['page_token'])) {
            $body['pageToken'] = (string) $options['page_token'];
        }
        if (! empty($options['page_size'])) {
            $body['pageSize'] = max(1, min(10000, (int) $options['page_size']));
        }
        if (array_key_exists('validate_only', $options)) {
            $body['validateOnly'] = (bool) $options['validate_only'];
        }

        $settings = [];
        foreach (['return_summary_row' => 'returnSummaryRow', 'return_total_results_count' => 'returnTotalResultsCount', 'omit_results' => 'omitResults'] as $arg => $field) {
            if (array_key_exists($arg, $options)) {
                $settings[$field] = (bool) $options[$arg];
            }
        }
        if ($settings !== []) {
            $body['searchSettings'] = $settings;
        }

        return $this->request('POST', '/customers/' . $this->customerId($customerId) . '/googleAds:search', $body);
    }

    /**
     * Execute a GAQL SearchStream request.
     *
     * @return array<string, mixed>
     */
    public function searchStream(string $query, ?string $customerId = null): array
    {
        return $this->request('POST', '/customers/' . $this->customerId($customerId) . '/googleAds:searchStream', [
            'query' => $query,
        ]);
    }

    /**
     * Run a resource-specific mutate request.
     *
     * @param  array<int, array<string, mixed>>  $operations
     * @return array<string, mixed>
     */
    public function mutateResource(string $resource, array $operations, ?string $customerId = null, array $options = []): array
    {
        $this->assertOperationLimit($operations);

        $body = [
            'operations' => $operations,
        ];
        foreach (['partial_failure' => 'partialFailure', 'validate_only' => 'validateOnly', 'response_content_type' => 'responseContentType'] as $arg => $field) {
            if (array_key_exists($arg, $options)) {
                $body[$field] = $arg === 'response_content_type' ? $options[$arg] : (bool) $options[$arg];
            }
        }

        return $this->request('POST', '/customers/' . $this->customerId($customerId) . '/' . trim($resource, '/') . ':mutate', $body);
    }

    /**
     * Run a mixed GoogleAdsService mutate request.
     *
     * @param  array<int, array<string, mixed>>  $mutateOperations
     * @return array<string, mixed>
     */
    public function mutate(array $mutateOperations, ?string $customerId = null, array $options = []): array
    {
        $this->assertOperationLimit($mutateOperations);

        $body = ['mutateOperations' => $mutateOperations];
        foreach (['partial_failure' => 'partialFailure', 'validate_only' => 'validateOnly', 'response_content_type' => 'responseContentType'] as $arg => $field) {
            if (array_key_exists($arg, $options)) {
                $body[$field] = $arg === 'response_content_type' ? $options[$arg] : (bool) $options[$arg];
            }
        }

        return $this->request('POST', '/customers/' . $this->customerId($customerId) . '/googleAds:mutate', $body);
    }

    /**
     * Generate keyword ideas through KeywordPlanIdeaService.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function generateKeywordIdeas(array $body, ?string $customerId = null): array
    {
        return $this->request('POST', '/customers/' . $this->customerId($customerId) . ':generateKeywordIdeas', $body);
    }

    /**
     * Upload click conversions using ConversionUploadService.
     *
     * @param  array<int, array<string, mixed>>  $conversions
     * @return array<string, mixed>
     */
    public function uploadClickConversions(array $conversions, ?string $customerId = null, array $options = []): array
    {
        if (count($conversions) > 2000) {
            throw new \InvalidArgumentException('Google Ads allows at most 2,000 click conversions per request.');
        }

        return $this->request('POST', '/customers/' . $this->customerId($customerId) . ':uploadClickConversions', [
            'conversions' => $conversions,
            'partialFailure' => (bool) ($options['partial_failure'] ?? true),
            'validateOnly' => (bool) ($options['validate_only'] ?? false),
            'debugEnabled' => (bool) ($options['debug_enabled'] ?? false),
            'jobId' => $options['job_id'] ?? null,
        ]);
    }

    /**
     * Upload call conversions using ConversionUploadService.
     *
     * @param  array<int, array<string, mixed>>  $conversions
     * @return array<string, mixed>
     */
    public function uploadCallConversions(array $conversions, ?string $customerId = null, array $options = []): array
    {
        if (count($conversions) > 2000) {
            throw new \InvalidArgumentException('Google Ads allows at most 2,000 call conversions per request.');
        }

        return $this->request('POST', '/customers/' . $this->customerId($customerId) . ':uploadCallConversions', [
            'conversions' => $conversions,
            'partialFailure' => (bool) ($options['partial_failure'] ?? true),
            'validateOnly' => (bool) ($options['validate_only'] ?? false),
        ]);
    }

    /**
     * Create a complete Search campaign using a single mixed mutate request.
     *
     * @param  array<string, mixed>  $spec
     * @return array<string, mixed>
     */
    public function createSearchCampaign(array $spec, ?string $customerId = null, bool $validateOnly = false): array
    {
        $customerId = $this->customerId($customerId);
        $budgetTempId = -1;
        $campaignTempId = -2;
        $adGroupTempId = -3;

        $budgetMicros = $this->moneyToMicros($spec['daily_budget'] ?? $spec['budget_micros'] ?? 0);
        $campaignResource = "customers/{$customerId}/campaigns/{$campaignTempId}";
        $adGroupResource = "customers/{$customerId}/adGroups/{$adGroupTempId}";
        $operations = [
            ['campaignBudgetOperation' => ['create' => [
                'resourceName' => "customers/{$customerId}/campaignBudgets/{$budgetTempId}",
                'name' => $spec['budget_name'] ?? (($spec['name'] ?? 'Search Campaign') . ' Budget'),
                'amountMicros' => (string) $budgetMicros,
                'deliveryMethod' => 'STANDARD',
                'explicitlyShared' => false,
            ]]],
            ['campaignOperation' => ['create' => [
                'resourceName' => $campaignResource,
                'name' => $spec['name'] ?? ('Search Campaign ' . date('YmdHis')),
                'status' => $spec['status'] ?? 'PAUSED',
                'advertisingChannelType' => 'SEARCH',
                'campaignBudget' => "customers/{$customerId}/campaignBudgets/{$budgetTempId}",
                'networkSettings' => [
                    'targetGoogleSearch' => $spec['target_google_search'] ?? true,
                    'targetSearchNetwork' => $spec['target_search_network'] ?? true,
                    'targetContentNetwork' => $spec['target_content_network'] ?? false,
                    'targetPartnerSearchNetwork' => $spec['target_partner_search_network'] ?? false,
                ],
                'startDate' => $spec['start_date'] ?? date('Ymd', strtotime('+1 day')),
                'endDate' => $spec['end_date'] ?? null,
                'maximizeConversions' => $spec['maximize_conversions'] ?? new \stdClass(),
            ]]],
            ['adGroupOperation' => ['create' => [
                'resourceName' => $adGroupResource,
                'campaign' => $campaignResource,
                'name' => $spec['ad_group_name'] ?? 'Default Ad Group',
                'status' => $spec['ad_group_status'] ?? 'PAUSED',
                'type' => 'SEARCH_STANDARD',
            ]]],
        ];

        foreach ($spec['keywords'] ?? [] as $keyword) {
            $operations[] = ['adGroupCriterionOperation' => ['create' => [
                'adGroup' => $adGroupResource,
                'status' => $keyword['status'] ?? 'ENABLED',
                'keyword' => [
                    'text' => $keyword['text'],
                    'matchType' => $keyword['match_type'] ?? 'BROAD',
                ],
                'negative' => (bool) ($keyword['negative'] ?? false),
            ]]];
        }

        foreach ($spec['locations'] ?? [] as $locationId) {
            $operations[] = ['campaignCriterionOperation' => ['create' => [
                'campaign' => $campaignResource,
                'location' => ['geoTargetConstant' => 'geoTargetConstants/' . $locationId],
            ]]];
        }

        foreach ($spec['language_ids'] ?? [] as $languageId) {
            $operations[] = ['campaignCriterionOperation' => ['create' => [
                'campaign' => $campaignResource,
                'language' => ['languageConstant' => 'languageConstants/' . $languageId],
            ]]];
        }

        if (! empty($spec['responsive_search_ad'])) {
            $ad = $spec['responsive_search_ad'];
            $operations[] = ['adGroupAdOperation' => ['create' => [
                'adGroup' => $adGroupResource,
                'status' => $ad['status'] ?? 'PAUSED',
                'ad' => [
                    'finalUrls' => $ad['final_urls'] ?? $spec['final_urls'] ?? [],
                    'responsiveSearchAd' => [
                        'headlines' => array_map(fn ($text) => is_array($text) ? $text : ['text' => $text], $ad['headlines'] ?? []),
                        'descriptions' => array_map(fn ($text) => is_array($text) ? $text : ['text' => $text], $ad['descriptions'] ?? []),
                        'path1' => $ad['path1'] ?? null,
                        'path2' => $ad['path2'] ?? null,
                    ],
                ],
            ]]];
        }

        return $this->mutate($operations, $customerId, ['validate_only' => $validateOnly]);
    }

    /**
     * Create a Performance Max campaign through mixed mutate operations.
     *
     * @param  array<string, mixed>  $spec
     * @return array<string, mixed>
     */
    public function createPerformanceMaxCampaign(array $spec, ?string $customerId = null, bool $validateOnly = false): array
    {
        $customerId = $this->customerId($customerId);
        $budgetTempId = -1;
        $campaignTempId = -2;
        $assetGroupTempId = -3;
        $campaignResource = "customers/{$customerId}/campaigns/{$campaignTempId}";
        $assetGroupResource = "customers/{$customerId}/assetGroups/{$assetGroupTempId}";

        $operations = [
            ['campaignBudgetOperation' => ['create' => [
                'resourceName' => "customers/{$customerId}/campaignBudgets/{$budgetTempId}",
                'name' => $spec['budget_name'] ?? (($spec['name'] ?? 'Performance Max Campaign') . ' Budget'),
                'amountMicros' => (string) $this->moneyToMicros($spec['daily_budget'] ?? $spec['budget_micros'] ?? 0),
                'deliveryMethod' => 'STANDARD',
                'explicitlyShared' => false,
            ]]],
            ['campaignOperation' => ['create' => [
                'resourceName' => $campaignResource,
                'name' => $spec['name'] ?? ('Performance Max Campaign ' . date('YmdHis')),
                'status' => $spec['status'] ?? 'PAUSED',
                'advertisingChannelType' => 'PERFORMANCE_MAX',
                'campaignBudget' => "customers/{$customerId}/campaignBudgets/{$budgetTempId}",
                'startDate' => $spec['start_date'] ?? date('Ymd', strtotime('+1 day')),
                'endDate' => $spec['end_date'] ?? null,
                'maximizeConversionValue' => $spec['maximize_conversion_value'] ?? new \stdClass(),
                'brandGuidelinesEnabled' => (bool) ($spec['brand_guidelines_enabled'] ?? false),
            ]]],
            ['assetGroupOperation' => ['create' => [
                'resourceName' => $assetGroupResource,
                'campaign' => $campaignResource,
                'name' => $spec['asset_group_name'] ?? 'Default Asset Group',
                'status' => $spec['asset_group_status'] ?? 'PAUSED',
                'finalUrls' => $spec['final_urls'] ?? [],
            ]]],
        ];

        $nextAssetId = -10;
        foreach ($spec['text_assets'] ?? [] as $fieldType => $texts) {
            foreach ((array) $texts as $text) {
                $assetResource = "customers/{$customerId}/assets/{$nextAssetId}";
                $operations[] = ['assetOperation' => ['create' => [
                    'resourceName' => $assetResource,
                    'textAsset' => ['text' => $text],
                    'name' => substr($fieldType . ' ' . md5($text), 0, 120),
                ]]];
                $operations[] = ['assetGroupAssetOperation' => ['create' => [
                    'assetGroup' => $assetGroupResource,
                    'asset' => $assetResource,
                    'fieldType' => strtoupper((string) $fieldType),
                ]]];
                $nextAssetId--;
            }
        }

        foreach ($spec['existing_assets'] ?? [] as $asset) {
            $operations[] = ['assetGroupAssetOperation' => ['create' => [
                'assetGroup' => $assetGroupResource,
                'asset' => $asset['resource_name'],
                'fieldType' => $asset['field_type'],
            ]]];
        }

        foreach ($spec['locations'] ?? [] as $locationId) {
            $operations[] = ['campaignCriterionOperation' => ['create' => [
                'campaign' => $campaignResource,
                'location' => ['geoTargetConstant' => 'geoTargetConstants/' . $locationId],
            ]]];
        }

        foreach ($spec['language_ids'] ?? [] as $languageId) {
            $operations[] = ['campaignCriterionOperation' => ['create' => [
                'campaign' => $campaignResource,
                'language' => ['languageConstant' => 'languageConstants/' . $languageId],
            ]]];
        }

        return $this->mutate($operations, $customerId, ['validate_only' => $validateOnly]);
    }

    /**
     * Perform a raw versioned Google Ads API request.
     *
     * @param  array<string, mixed>  $body
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    public function raw(string $method, string $path, array $body = [], array $query = [], ?string $customerId = null): array
    {
        return $this->request($method, $path, $body, $query, customerId: $customerId);
    }

    /**
     * Convert normal currency units or micros to micros.
     */
    public function moneyToMicros(mixed $value): int
    {
        if (is_string($value) && str_ends_with($value, 'micros')) {
            return (int) $value;
        }
        if (is_int($value) && $value > 100000) {
            return $value;
        }

        return (int) round((float) $value * 1000000);
    }

    /**
     * @param  array<int, mixed>  $operations
     */
    private function assertOperationLimit(array $operations): void
    {
        if (count($operations) > 10000) {
            throw new \InvalidArgumentException('Google Ads allows at most 10,000 mutate operations per request.');
        }
    }

    private function customerId(?string $customerId): string
    {
        $normalized = $this->normalizeCustomerId($customerId ?: $this->defaultCustomerId);
        if ($normalized === '') {
            throw new \InvalidArgumentException('A Google Ads customer_id is required.');
        }

        return $normalized;
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = [], ?string $customerId = null, bool $includeLoginCustomer = true): array
    {
        $this->ensureValidToken();

        $path = '/' . ltrim($path, '/');
        if (! str_starts_with($path, '/' . $this->apiVersion . '/')) {
            $path = '/' . $this->apiVersion . $path;
        }

        $headers = [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'developer-token' => $this->developerToken,
            'Content-Type' => 'application/json',
        ];

        if ($includeLoginCustomer && $this->managerCustomerId !== '') {
            $headers['login-customer-id'] = $this->managerCustomerId;
        }
        if ($this->linkedCustomerId !== '') {
            $headers['linked-customer-id'] = $this->linkedCustomerId;
        }

        $http = Http::withHeaders($headers)->timeout(60)->acceptJson();
        if ($query !== []) {
            $http = $http->withQueryParameters($query);
        }

        $url = self::BASE_URL . $path;
        $started = microtime(true);
        $response = match (strtoupper($method)) {
            'GET' => $http->get($url),
            'POST' => $http->post($url, $this->cleanNulls($data)),
            'PATCH' => $http->patch($url, $this->cleanNulls($data)),
            'DELETE' => $http->delete($url, $this->cleanNulls($data)),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };

        $elapsedMs = (int) round((microtime(true) - $started) * 1000);
        if (! $response->successful()) {
            $this->handleError(strtoupper($method), $path, $response, $elapsedMs);
        }

        $json = $response->json();
        $result = is_array($json) ? $json : [];
        $result['_meta'] = [
            'requestId' => $response->header('request-id'),
            'apiVersion' => $this->apiVersion,
            'elapsedMs' => $elapsedMs,
            'customerId' => $customerId ? $this->normalizeCustomerId($customerId) : null,
        ];

        return $result;
    }

    private function ensureValidToken(): void
    {
        if ($this->developerToken === '') {
            throw new \RuntimeException('Google Ads developer token is not configured.');
        }
        if ($this->accessToken === '' && $this->refreshToken !== '' && $this->clientId !== '' && $this->clientSecret !== '') {
            $this->refreshAccessToken();

            return;
        }
        if ($this->accessToken === '') {
            throw new \RuntimeException('Google Ads access token is not configured. Provide access_token, or client_id/client_secret/refresh_token for automatic CLI refresh.');
        }
        if ($this->expiresAt !== null && $this->expiresAt > time() + 60) {
            return;
        }
        if ($this->refreshToken === '' || $this->clientId === '' || $this->clientSecret === '') {
            return;
        }

        $this->refreshAccessToken();
    }

    private function refreshAccessToken(): void
    {
        $response = Http::asForm()->timeout(15)->post('https://oauth2.googleapis.com/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
            'grant_type' => 'refresh_token',
        ]);

        if (! $response->successful()) {
            $error = $response->json('error_description') ?? $response->json('error') ?? $response->body();
            throw new \RuntimeException('Failed to refresh Google Ads access token: ' . (is_string($error) ? $error : json_encode($error)));
        }

        $data = $response->json() ?? [];
        $this->accessToken = (string) ($data['access_token'] ?? '');
        $this->expiresAt = time() + (int) ($data['expires_in'] ?? 3600);

        if (class_exists(IntegrationSetting::class) && app()->bound('db')) {
            $setting = IntegrationSetting::where('integration_id', 'google_ads')->first();
            if ($setting) {
                $config = $setting->config ?? [];
                $config['access_token'] = $this->accessToken;
                $config['expires_at'] = $this->expiresAt;
                $setting->config = $config;
                $setting->save();
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function cleanNulls(array $value): array
    {
        foreach ($value as $key => $item) {
            if ($item === null) {
                unset($value[$key]);
            } elseif (is_array($item)) {
                $value[$key] = $this->cleanNulls($item);
            }
        }

        return $value;
    }

    private function handleError(string $method, string $path, Response $response, int $elapsedMs): void
    {
        $body = $response->json() ?? [];
        $requestId = $response->header('request-id');
        $error = $body['error']['message'] ?? $body['message'] ?? $response->body();
        $details = $body['error']['details'] ?? null;

        Log::error('Google Ads API error', [
            'method' => $method,
            'path' => $path,
            'status' => $response->status(),
            'request_id' => $requestId,
            'elapsed_ms' => $elapsedMs,
            'error' => $error,
        ]);

        $message = "Google Ads API error ({$response->status()})";
        if ($requestId) {
            $message .= " request-id={$requestId}";
        }
        $message .= ': ' . (is_string($error) ? $error : json_encode($error));

        if ($details !== null) {
            $message .= ' Details: ' . json_encode($details, JSON_UNESCAPED_SLASHES);
        }

        throw new \RuntimeException($message);
    }
}
