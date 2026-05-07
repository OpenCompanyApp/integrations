<?php

namespace OpenCompany\Integrations\RestCountries;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the REST Countries v3.1 API.
 *
 * Handles path routing, optional field filtering, the required all-endpoint
 * field default, and error normalization for public country data lookups.
 */
class RestCountriesService
{
    private const DEFAULT_ALL_FIELDS = 'name,cca2,cca3,capital,region,subregion,population,flags';

    /**
     * @param  string  $baseUrl  REST Countries v3.1 base URL.
     */
    public function __construct(private string $baseUrl = 'https://restcountries.com/v3.1')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Retrieve all countries. REST Countries requires a fields filter here.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function all(array $params = []): array
    {
        return $this->request('/all', $this->query(['fields' => (string) ($params['fields'] ?? self::DEFAULT_ALL_FIELDS)]));
    }

    /**
     * Search countries by common or official name.
     *
     * @param  array<string, mixed>  $params  fields and full_text options.
     * @return array<string, mixed>
     */
    public function name(string $name, array $params = []): array
    {
        $query = $this->query($params);
        if (($params['full_text'] ?? false) === true) {
            $query['fullText'] = 'true';
        }

        return $this->request('/name/'.$this->encode($name), $query);
    }

    /**
     * Retrieve one country by cca2, ccn3, cca3, or cioc code.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function alpha(string $code, array $params = []): array
    {
        return $this->request('/alpha/'.$this->encode($code), $this->query($params));
    }

    /**
     * Retrieve countries by multiple country codes.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function alphaCodes(string $codes, array $params = []): array
    {
        return $this->request('/alpha', ['codes' => $codes] + $this->query($params));
    }

    /**
     * Search countries by currency code or name.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function currency(string $currency, array $params = []): array
    {
        return $this->request('/currency/'.$this->encode($currency), $this->query($params));
    }

    /**
     * Search countries by language code or name.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function language(string $language, array $params = []): array
    {
        return $this->request('/lang/'.$this->encode($language), $this->query($params));
    }

    /**
     * Search countries by capital city.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function capital(string $capital, array $params = []): array
    {
        return $this->request('/capital/'.$this->encode($capital), $this->query($params));
    }

    /**
     * Filter countries by region.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function region(string $region, array $params = []): array
    {
        return $this->request('/region/'.$this->encode($region), $this->query($params));
    }

    /**
     * Filter countries by subregion.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function subregion(string $subregion, array $params = []): array
    {
        return $this->request('/subregion/'.$this->encode($subregion), $this->query($params));
    }

    /**
     * Search countries by demonym.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function demonym(string $demonym, array $params = []): array
    {
        return $this->request('/demonym/'.$this->encode($demonym), $this->query($params));
    }

    /**
     * Search countries by translated country name.
     *
     * @param  array<string, mixed>  $params  fields filter.
     * @return array<string, mixed>
     */
    public function translation(string $translation, array $params = []): array
    {
        return $this->request('/translation/'.$this->encode($translation), $this->query($params));
    }

    /**
     * Retrieve independent or non-independent countries.
     *
     * @param  array<string, mixed>  $params  status and fields filter.
     * @return array<string, mixed>
     */
    public function independent(bool $status, array $params = []): array
    {
        return $this->request('/independent', ['status' => $status ? 'true' : 'false'] + $this->query($params));
    }

    /**
     * Execute a REST Countries GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $path, array $query = []): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->get($this->baseUrl.$path, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('REST Countries API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to REST Countries API: '.$e->getMessage());
        }
    }

    /**
     * Parse JSON responses and normalize API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $path): array
    {
        $json = $response->json();

        if (!$response->successful()) {
            $message = is_array($json) ? (string) ($json['message'] ?? $json['status'] ?? '') : trim(strip_tags($response->body()));
            Log::error('REST Countries API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('REST Countries API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return ['data' => is_array($json) ? $json : $response->body(), 'status' => $response->status()];
    }

    /**
     * Build optional field filtering query.
     *
     * @param  array<string, mixed>  $params  Tool parameters.
     * @return array<string, mixed>
     */
    private function query(array $params): array
    {
        if (($params['fields'] ?? '') === '') {
            return [];
        }

        $fields = array_values(array_filter(array_map('trim', explode(',', (string) $params['fields']))));
        if (count($fields) > 10) {
            throw new RuntimeException('fields may contain at most 10 comma-separated field names.');
        }

        return ['fields' => implode(',', $fields)];
    }

    private function encode(string $value): string
    {
        return rawurlencode(trim($value));
    }
}
