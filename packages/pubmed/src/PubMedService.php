<?php

namespace OpenCompany\Integrations\PubMed;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use SimpleXMLElement;

/**
 * HTTP client for PubMed and the NCBI Entrez E-utilities.
 *
 * Handles utility endpoint mapping, query normalization, JSON/XML/text parsing,
 * and E-utilities error conversion for all supported tools.
 */
class PubMedService
{
    /**
     * @param  string  $baseUrl  NCBI E-utilities base URL.
     */
    public function __construct(
        private string $baseUrl = 'https://eutils.ncbi.nlm.nih.gov/entrez/eutils',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Run an ESearch query against PubMed or another Entrez database.
     *
     * @param  array<string, mixed>  $params  ESearch parameters such as db, term, retmax, sort, and usehistory.
     * @return array<string, mixed>
     */
    public function search(array $params): array
    {
        return $this->get('esearch', $params);
    }

    /**
     * Retrieve document summaries by UID list or History server query.
     *
     * @param  array<string, mixed>  $params  ESummary parameters such as db, id, query_key, WebEnv, retstart, and retmax.
     * @return array<string, mixed>
     */
    public function summary(array $params): array
    {
        return $this->get('esummary', $params);
    }

    /**
     * Fetch full records by UID list or History server query.
     *
     * @param  array<string, mixed>  $params  EFetch parameters such as db, id, query_key, WebEnv, rettype, and retmode.
     * @return array<string, mixed>
     */
    public function fetch(array $params): array
    {
        return $this->get('efetch', $params);
    }

    /**
     * Retrieve links between Entrez records or LinkOut URLs.
     *
     * @param  array<string, mixed>  $params  ELink parameters such as dbfrom, db, id, cmd, and linkname.
     * @return array<string, mixed>
     */
    public function link(array $params): array
    {
        return $this->get('elink', $params);
    }

    /**
     * Retrieve Entrez database metadata and available fields or links.
     *
     * @param  array<string, mixed>  $params  EInfo parameters such as db, retmode, and version.
     * @return array<string, mixed>
     */
    public function info(array $params = []): array
    {
        return $this->get('einfo', $params);
    }

    /**
     * Post UID lists to the NCBI History server for later summary/fetch/link calls.
     *
     * @param  array<string, mixed>  $query  EPost query parameters such as db and retmode.
     * @param  array<string, mixed>  $body  EPost form body, usually id.
     * @return array<string, mixed>
     */
    public function postIds(array $query, array $body): array
    {
        return $this->post('epost', $query, $body);
    }

    /**
     * Retrieve spelling suggestions for a single query term.
     *
     * @param  array<string, mixed>  $params  ESpell parameters such as db and term.
     * @return array<string, mixed>
     */
    public function spell(array $params): array
    {
        return $this->get('espell', $params);
    }

    /**
     * Run a global Entrez query and return counts across databases.
     *
     * @param  array<string, mixed>  $params  EGQuery parameters such as term.
     * @return array<string, mixed>
     */
    public function globalQuery(array $params): array
    {
        return $this->get('egquery', $params);
    }

    /**
     * Match formatted citation strings to PubMed IDs.
     *
     * @param  array<string, mixed>  $query  ECitMatch query parameters such as db and retmode.
     * @param  array<string, mixed>  $body  ECitMatch form body containing bdata.
     * @return array<string, mixed>
     */
    public function citationMatch(array $query, array $body): array
    {
        return $this->post('ecitmatch', $query, $body);
    }

    /**
     * Make a GET request to an E-utility endpoint.
     *
     * @param  array<string, mixed>  $query  Utility query parameters.
     * @return array<string, mixed>
     */
    public function get(string $utility, array $query = []): array
    {
        $path = $this->pathFor($utility);

        try {
            $response = Http::accept('application/json, application/xml;q=0.9, text/xml;q=0.8, text/plain;q=0.7, */*;q=0.5')
                ->withUserAgent('OpenCompany Integrations pubmed/1.0 (mailto:agent@example.test)')
                ->timeout(60)
                ->get($this->baseUrl.'/'.$path, $this->normalizeParams($query));

            return $this->parseResponse($response, 'GET', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PubMed E-utilities connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to PubMed E-utilities: {$e->getMessage()}");
        }
    }

    /**
     * Make a form-encoded POST request to an E-utility endpoint.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     * @param  array<string, mixed>  $body  Form body parameters.
     * @return array<string, mixed>
     */
    public function post(string $utility, array $query = [], array $body = []): array
    {
        $path = $this->pathFor($utility);
        $normalizedQuery = $this->normalizeParams($query);
        $url = $this->baseUrl.'/'.$path;

        if ($normalizedQuery !== []) {
            $url .= '?'.http_build_query($normalizedQuery, '', '&', PHP_QUERY_RFC3986);
        }

        try {
            $response = Http::asForm()
                ->accept('application/json, application/xml;q=0.9, text/xml;q=0.8, text/plain;q=0.7, */*;q=0.5')
                ->withUserAgent('OpenCompany Integrations pubmed/1.0 (mailto:agent@example.test)')
                ->timeout(60)
                ->post($url, $this->normalizeParams($body));

            return $this->parseResponse($response, 'POST', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PubMed E-utilities connection error: {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to PubMed E-utilities: {$e->getMessage()}");
        }
    }

    /**
     * Normalize array and boolean parameters for E-utilities requests.
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

            if ($value === '') {
                continue;
            }

            $normalized[$key] = is_bool($value) ? ($value ? 'y' : 'n') : $value;
        }

        return $normalized;
    }

    /**
     * Resolve an E-utility name to its official endpoint filename.
     */
    private function pathFor(string $utility): string
    {
        $utility = strtolower(trim($utility));

        return match ($utility) {
            'esearch', 'search' => 'esearch.fcgi',
            'esummary', 'summary' => 'esummary.fcgi',
            'efetch', 'fetch' => 'efetch.fcgi',
            'elink', 'link' => 'elink.fcgi',
            'einfo', 'info' => 'einfo.fcgi',
            'epost', 'post' => 'epost.fcgi',
            'espell', 'spell' => 'espell.fcgi',
            'egquery', 'global', 'globalquery' => 'egquery.fcgi',
            'ecitmatch', 'citationmatch' => 'ecitmatch.cgi',
            default => throw new RuntimeException("Unsupported PubMed E-utility: {$utility}."),
        };
    }

    /**
     * Parse JSON, XML, or text responses and convert obvious API errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $method, string $path): array
    {
        $contentType = (string) $response->header('Content-Type', '');
        $body = $response->body();
        $json = null;

        if (str_contains(strtolower($contentType), 'json')) {
            $json = $response->json();
        }

        if (!$response->successful()) {
            $message = $this->errorMessage($json) ?? $this->errorMessageFromXml($body) ?? $body;
            Log::error("PubMed E-utilities API error: {$method} {$path}", ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('PubMed E-utilities API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            $message = $this->errorMessage($json);
            if ($message !== null) {
                throw new RuntimeException('PubMed E-utilities API error ('.$response->status().'): '.$message);
            }

            return $json;
        }

        if ($this->looksLikeXml($contentType, $body)) {
            $xml = $this->parseXml($body);
            $message = $this->errorMessageFromParsedXml($xml);
            if ($message !== null) {
                throw new RuntimeException('PubMed E-utilities API error ('.$response->status().'): '.$message);
            }

            return [
                'xml' => $xml,
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
     * Extract a readable error message from JSON E-utilities payloads.
     */
    private function errorMessage(mixed $json): ?string
    {
        if (!is_array($json)) {
            return null;
        }

        foreach (['error', 'ERROR', 'Error'] as $key) {
            if (isset($json[$key]) && is_scalar($json[$key])) {
                return (string) $json[$key];
            }
        }

        foreach ($json as $value) {
            if (is_array($value)) {
                $message = $this->errorMessage($value);
                if ($message !== null) {
                    return $message;
                }
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
     * Parse an XML response into a compact nested array.
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

    /**
     * Extract an E-utilities XML error from raw response text.
     */
    private function errorMessageFromXml(string $body): ?string
    {
        return $this->errorMessageFromParsedXml($this->parseXml($body));
    }

    /**
     * Extract an E-utilities XML error from a parsed response tree.
     *
     * @param  array<string, mixed>|string  $node  Parsed XML tree.
     */
    private function errorMessageFromParsedXml(array|string $node): ?string
    {
        if (is_string($node)) {
            return null;
        }

        foreach (['ERROR', 'Error'] as $key) {
            if (isset($node[$key]) && is_scalar($node[$key])) {
                return (string) $node[$key];
            }
        }

        foreach ($node as $value) {
            if (is_array($value) || is_string($value)) {
                $message = $this->errorMessageFromParsedXml($value);
                if ($message !== null) {
                    return $message;
                }
            }
        }

        return null;
    }
}
