<?php

namespace OpenCompany\Integrations\EuropePmc;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use SimpleXMLElement;

/**
 * HTTP client for Europe PMC public APIs.
 *
 * Handles the Articles REST API, Annotations API, and GRIST grants API with
 * shared query encoding, response parsing, and error normalization.
 */
class EuropePmcService
{
    /**
     * @param  string  $restBaseUrl  Europe PMC Articles REST API base URL.
     * @param  string  $annotationsBaseUrl  Europe PMC Annotations API base URL.
     * @param  string  $gristBaseUrl  Europe PMC GRIST grants API base URL.
     */
    public function __construct(
        private string $restBaseUrl = 'https://www.ebi.ac.uk/europepmc/webservices/rest',
        private string $annotationsBaseUrl = 'https://www.ebi.ac.uk/europepmc/annotations_api',
        private string $gristBaseUrl = 'https://www.ebi.ac.uk/europepmc/GristAPI/rest',
    ) {
        $this->restBaseUrl = rtrim($this->restBaseUrl, '/');
        $this->annotationsBaseUrl = rtrim($this->annotationsBaseUrl, '/');
        $this->gristBaseUrl = rtrim($this->gristBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Make a GET request to the Articles REST API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function get(string $path, array $query = []): array
    {
        return $this->request('GET', $this->restBaseUrl, $path, $query);
    }

    /**
     * Make a form-encoded POST request to the Articles REST API.
     *
     * @param  array<string, mixed>  $params  Form parameters.
     * @return array<string, mixed>
     */
    public function post(string $path, array $params = []): array
    {
        return $this->request('POST', $this->restBaseUrl, $path, [], $params);
    }

    /**
     * Make a GET request to the Annotations API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function annotations(string $path, array $query = []): array
    {
        return $this->request('GET', $this->annotationsBaseUrl, $path, $query);
    }

    /**
     * Search the GRIST grants database.
     *
     * @param  array<string, mixed>  $query  GRIST parameters, including query.
     * @return array<string, mixed>
     */
    public function grants(array $query): array
    {
        $search = (string) ($query['query'] ?? '');
        if ($search === '') {
            throw new RuntimeException('query is required.');
        }

        unset($query['query']);

        return $this->request('GET', $this->gristBaseUrl, 'get/query='.rawurlencode($search), $query);
    }

    /**
     * Execute an HTTP request and parse the response.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     * @param  array<string, mixed>  $body  Form body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $baseUrl, string $path, array $query = [], array $body = []): array
    {
        $url = $this->urlWithQuery($baseUrl.'/'.ltrim($path, '/'), $query);

        try {
            $pending = Http::accept('application/json, application/xml;q=0.9, text/xml;q=0.8, text/plain;q=0.7, */*;q=0.5')
                ->withUserAgent('OpenCompany Integrations europe-pmc/1.0 (mailto:agent@example.test)')
                ->timeout(60);

            $response = $method === 'POST'
                ? $pending->asForm()->post($url, $this->normalizeParams($body))
                : $pending->get($url);

            return $this->parseResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Europe PMC API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Europe PMC API: {$e->getMessage()}");
        }
    }

    /**
     * Build a URL with encoded query parameters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $params = $this->normalizeParams($query);

        return $params === [] ? $url : $url.'?'.http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * Normalize array and boolean parameters for Europe PMC requests.
     *
     * @param  array<string, mixed>  $params  Raw query or body parameters.
     * @return array<string, scalar>
     */
    private function normalizeParams(array $params): array
    {
        $normalized = [];

        foreach ($params as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_array($value)) {
                $value = implode(',', array_map(static fn (mixed $item): string => (string) $item, array_filter($value, static fn (mixed $item): bool => $item !== null && $item !== '')));
            }

            if ($value !== '') {
                $normalized[$key] = is_bool($value) ? ($value ? 'true' : 'false') : $value;
            }
        }

        return $normalized;
    }

    /**
     * Parse JSON, XML, and text responses while normalizing errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $method, string $path): array
    {
        $contentType = (string) $response->header('Content-Type', '');
        $body = $response->body();
        $json = str_contains(strtolower($contentType), 'json') ? $response->json() : null;

        if (!$response->successful()) {
            $message = $this->errorMessage($json) ?? $body;
            Log::error("Europe PMC API error: {$method} {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('Europe PMC API error ('.$response->status().'): '.$message);
        }

        $message = $this->errorMessage($json);
        if ($message !== null) {
            throw new RuntimeException('Europe PMC API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        if ($this->looksLikeXml($contentType, $body)) {
            return [
                'xml' => $this->parseXml($body),
                'status' => $response->status(),
                'content_type' => $contentType,
            ];
        }

        return [
            'body' => $body,
            'status' => $response->status(),
            'content_type' => $contentType,
        ];
    }

    /**
     * Extract a readable error message from JSON API responses.
     */
    private function errorMessage(mixed $json): ?string
    {
        if (!is_array($json)) {
            return null;
        }

        foreach (['error', 'message', 'errorMessage'] as $key) {
            if (isset($json[$key]) && is_scalar($json[$key])) {
                return (string) $json[$key];
            }
        }

        return null;
    }

    /**
     * Determine whether a response should be parsed as XML.
     */
    private function looksLikeXml(string $contentType, string $body): bool
    {
        $contentType = strtolower($contentType);

        return str_contains($contentType, 'xml') || str_starts_with(ltrim($body), '<');
    }

    /**
     * Parse XML into a compact nested array.
     *
     * @return array<string, mixed>
     */
    private function parseXml(string $body): array
    {
        $previous = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($body);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        if (!$xml instanceof SimpleXMLElement) {
            return ['_text' => $body];
        }

        return $this->xmlNodeToArray($xml);
    }

    /**
     * Convert a SimpleXML node into nested arrays with attributes and text.
     *
     * @return array<string, mixed>|string
     */
    private function xmlNodeToArray(SimpleXMLElement $node): array|string
    {
        $result = [];
        $attributes = [];

        foreach ($node->attributes() as $key => $value) {
            $attributes[(string) $key] = (string) $value;
        }

        if ($attributes !== []) {
            $result['_attributes'] = $attributes;
        }

        foreach ($node->children() as $childName => $child) {
            $value = $this->xmlNodeToArray($child);

            if (array_key_exists($childName, $result)) {
                if (!is_array($result[$childName]) || !array_is_list($result[$childName])) {
                    $result[$childName] = [$result[$childName]];
                }

                $result[$childName][] = $value;
            } else {
                $result[$childName] = $value;
            }
        }

        $text = trim((string) $node);
        if ($text !== '') {
            if ($result === []) {
                return $text;
            }

            $result['_text'] = $text;
        }

        return $result;
    }
}
