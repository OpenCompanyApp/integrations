<?php

namespace OpenCompany\Integrations\Arxiv;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use SimpleXMLElement;

/**
 * HTTP client for the official arXiv Atom API.
 *
 * Handles query parameter normalization, Atom XML parsing, and arXiv error
 * conversion for search and ID-based metadata lookup.
 */
class ArxivService
{
    private const ATOM_NS = 'http://www.w3.org/2005/Atom';
    private const OPENSEARCH_NS = 'http://a9.com/-/spec/opensearch/1.1/';
    private const ARXIV_NS = 'http://arxiv.org/schemas/atom';

    /**
     * @param  string  $baseUrl  Official arXiv query endpoint.
     * @param  string  $oaiBaseUrl  Official arXiv OAI-PMH endpoint.
     */
    public function __construct(
        private string $baseUrl = 'https://export.arxiv.org/api/query',
        private string $oaiBaseUrl = 'https://oaipmh.arxiv.org/oai',
    ) {}

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Query arXiv by search expression, id list, paging, and sort options.
     *
     * @param  array<string, mixed>  $params  Query parameters accepted by the arXiv query interface.
     * @return array<string, mixed>
     */
    public function query(array $params = []): array
    {
        $query = $this->normalizeQuery($params);

        try {
            $response = Http::accept('application/atom+xml, application/xml;q=0.9, */*;q=0.8')
                ->withUserAgent('OpenCompany Integrations arxiv/1.0')
                ->timeout(60)
                ->get($this->baseUrl, $query);

            return $this->parseResponse($response);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('arXiv API connection error', ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to arXiv API: {$e->getMessage()}");
        }
    }

    /**
     * Retrieve one or more arXiv records by ID.
     *
     * @param  array<int, string>|string  $ids  arXiv IDs such as 2103.15348 or 2103.15348v1.
     * @return array<string, mixed>
     */
    public function getByIds(array|string $ids): array
    {
        $idList = is_array($ids) ? $ids : [$ids];

        return $this->query([
            'id_list' => $idList,
            'max_results' => max(1, count($idList)),
        ]);
    }

    /**
     * Search arXiv by author name.
     *
     * @param  string  $author  Author query text.
     * @param  array<string, mixed>  $params  Paging and sort options.
     * @return array<string, mixed>
     */
    public function searchByAuthor(string $author, array $params = []): array
    {
        return $this->query(array_merge($params, ['search_query' => 'au:"'.$this->escapeQueryValue($author).'"']));
    }

    /**
     * Search arXiv by title text.
     *
     * @param  string  $title  Title query text.
     * @param  array<string, mixed>  $params  Paging and sort options.
     * @return array<string, mixed>
     */
    public function searchByTitle(string $title, array $params = []): array
    {
        return $this->query(array_merge($params, ['search_query' => 'ti:"'.$this->escapeQueryValue($title).'"']));
    }

    /**
     * Search arXiv by category.
     *
     * @param  string  $category  arXiv category such as cs.AI.
     * @param  array<string, mixed>  $params  Paging and sort options.
     * @return array<string, mixed>
     */
    public function searchByCategory(string $category, array $params = []): array
    {
        return $this->query(array_merge([
            'search_query' => 'cat:'.$category,
            'sortBy' => 'submittedDate',
            'sortOrder' => 'descending',
        ], $params));
    }

    /**
     * Search arXiv with recent submissions first.
     *
     * @param  string  $searchQuery  arXiv search expression.
     * @param  array<string, mixed>  $params  Paging options.
     * @return array<string, mixed>
     */
    public function searchRecent(string $searchQuery, array $params = []): array
    {
        return $this->query(array_merge([
            'search_query' => $searchQuery,
            'sortBy' => 'submittedDate',
            'sortOrder' => 'descending',
        ], $params));
    }

    /**
     * Query the official OAI-PMH metadata endpoint.
     *
     * @param  string  $verb  OAI-PMH verb.
     * @param  array<string, mixed>  $params  Verb parameters.
     * @return array<string, mixed>
     */
    public function oai(string $verb, array $params = []): array
    {
        $query = $this->normalizeOaiQuery($verb, $params);

        try {
            $response = Http::accept('application/xml, text/xml;q=0.9, */*;q=0.8')
                ->withUserAgent('OpenCompany Integrations arxiv/1.0')
                ->timeout(60)
                ->get($this->oaiBaseUrl, $query);

            return $this->parseOaiResponse($response);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('arXiv OAI-PMH connection error', ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to arXiv OAI-PMH API: {$e->getMessage()}");
        }
    }

    /**
     * Identify the arXiv OAI-PMH repository.
     *
     * @return array<string, mixed>
     */
    public function oaiIdentify(): array
    {
        return $this->oai('Identify');
    }

    /**
     * List available OAI-PMH metadata formats.
     *
     * @param  string|null  $identifier  Optional OAI identifier.
     * @return array<string, mixed>
     */
    public function oaiListMetadataFormats(?string $identifier = null): array
    {
        return $this->oai('ListMetadataFormats', ['identifier' => $identifier]);
    }

    /**
     * List OAI-PMH sets.
     *
     * @param  string|null  $resumptionToken  Optional resumption token.
     * @return array<string, mixed>
     */
    public function oaiListSets(?string $resumptionToken = null): array
    {
        return $this->oai('ListSets', ['resumptionToken' => $resumptionToken]);
    }

    /**
     * List OAI-PMH identifiers.
     *
     * @param  array<string, mixed>  $params  metadataPrefix, from, until, set, or resumptionToken.
     * @return array<string, mixed>
     */
    public function oaiListIdentifiers(array $params = []): array
    {
        return $this->oai('ListIdentifiers', $params);
    }

    /**
     * List OAI-PMH metadata records.
     *
     * @param  array<string, mixed>  $params  metadataPrefix, from, until, set, or resumptionToken.
     * @return array<string, mixed>
     */
    public function oaiListRecords(array $params = []): array
    {
        return $this->oai('ListRecords', $params);
    }

    /**
     * Get a single OAI-PMH metadata record.
     *
     * @param  string  $identifier  OAI identifier such as oai:arXiv.org:2103.15348.
     * @param  string  $metadataPrefix  Metadata prefix such as arXiv, arXivRaw, or oai_dc.
     * @return array<string, mixed>
     */
    public function oaiGetRecord(string $identifier, string $metadataPrefix = 'arXiv'): array
    {
        return $this->oai('GetRecord', [
            'identifier' => $identifier,
            'metadataPrefix' => $metadataPrefix,
        ]);
    }

    /**
     * Normalize query parameters to arXiv's exact parameter names.
     *
     * @param  array<string, mixed>  $params  User query parameters.
     * @return array<string, scalar>
     */
    private function normalizeQuery(array $params): array
    {
        $allowed = ['search_query', 'id_list', 'start', 'max_results', 'sortBy', 'sortOrder'];
        $query = [];

        foreach ($allowed as $key) {
            if (!array_key_exists($key, $params) || $params[$key] === null || $params[$key] === '') {
                continue;
            }

            $value = $params[$key];
            if ($key === 'id_list' && is_array($value)) {
                $value = implode(',', array_values(array_filter($value, static fn (mixed $id): bool => $id !== null && $id !== '')));
            }

            if ($value !== '') {
                $query[$key] = is_bool($value) ? (int) $value : $value;
            }
        }

        return $query;
    }

    /**
     * Normalize OAI-PMH parameters and reject unsupported verbs early.
     *
     * @param  array<string, mixed>  $params  OAI-PMH parameters.
     * @return array<string, scalar>
     */
    private function normalizeOaiQuery(string $verb, array $params): array
    {
        $allowedVerbs = ['Identify', 'ListMetadataFormats', 'ListSets', 'ListIdentifiers', 'ListRecords', 'GetRecord'];

        if (!in_array($verb, $allowedVerbs, true)) {
            throw new RuntimeException('Unsupported arXiv OAI-PMH verb: '.$verb);
        }

        $allowedParams = ['identifier', 'metadataPrefix', 'set', 'from', 'until', 'resumptionToken'];
        $query = ['verb' => $verb];

        if (($params['resumptionToken'] ?? null) !== null && $params['resumptionToken'] !== '') {
            return ['verb' => $verb, 'resumptionToken' => (string) $params['resumptionToken']];
        }

        foreach ($allowedParams as $key) {
            if (array_key_exists($key, $params) && $params[$key] !== null && $params[$key] !== '') {
                $query[$key] = is_bool($params[$key]) ? (int) $params[$key] : (string) $params[$key];
            }
        }

        return $query;
    }

    /**
     * Parse an arXiv Atom feed into compact agent-friendly arrays.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response): array
    {
        $body = $response->body();
        if (!$response->successful()) {
            Log::error('arXiv API error', ['status' => $response->status(), 'body' => $body]);

            throw new RuntimeException('arXiv API error ('.$response->status().'): '.$body);
        }

        $feed = @simplexml_load_string($body, SimpleXMLElement::class, LIBXML_NONET | LIBXML_NOCDATA);
        if (!$feed instanceof SimpleXMLElement) {
            throw new RuntimeException('arXiv API returned invalid Atom XML.');
        }

        $entries = [];
        foreach ($feed->entry as $entry) {
            $entries[] = $this->parseEntry($entry);
        }

        return [
            'title' => $this->text($feed->title ?? null),
            'id' => $this->text($feed->id ?? null),
            'updated' => $this->text($feed->updated ?? null),
            'total_results' => $this->namespacedInt($feed, self::OPENSEARCH_NS, 'totalResults'),
            'start_index' => $this->namespacedInt($feed, self::OPENSEARCH_NS, 'startIndex'),
            'items_per_page' => $this->namespacedInt($feed, self::OPENSEARCH_NS, 'itemsPerPage'),
            'entries' => $entries,
        ];
    }

    /**
     * Parse an OAI-PMH XML response into a normalized nested array.
     *
     * @return array<string, mixed>
     */
    private function parseOaiResponse(Response $response): array
    {
        $body = $response->body();
        if (!$response->successful()) {
            Log::error('arXiv OAI-PMH API error', ['status' => $response->status(), 'body' => $body]);

            throw new RuntimeException('arXiv OAI-PMH API error ('.$response->status().'): '.$body);
        }

        $xml = @simplexml_load_string($body, SimpleXMLElement::class, LIBXML_NONET | LIBXML_NOCDATA);
        if (!$xml instanceof SimpleXMLElement) {
            throw new RuntimeException('arXiv OAI-PMH API returned invalid XML.');
        }

        $errors = [];
        foreach ($xml->error as $error) {
            $errors[] = [
                'code' => (string) ($error['code'] ?? ''),
                'message' => $this->text($error),
            ];
        }

        return [
            'response_date' => $this->text($xml->responseDate ?? null),
            'request' => $this->oaiRequest($xml),
            'errors' => $errors,
            'data' => $this->xmlChildrenToArray($xml),
        ];
    }

    /**
     * Parse the OAI request element and attributes.
     *
     * @return array<string, mixed>
     */
    private function oaiRequest(SimpleXMLElement $xml): array
    {
        $request = $xml->request;
        $attrs = [];

        foreach (($request?->attributes() ?? []) as $key => $value) {
            $attrs[(string) $key] = (string) $value;
        }

        return [
            'url' => $this->text($request ?? null),
            'attributes' => $attrs,
        ];
    }

    /**
     * Recursively convert SimpleXML children into arrays while preserving attributes.
     *
     * @return array<string, mixed>
     */
    private function xmlChildrenToArray(SimpleXMLElement $xml): array
    {
        $result = [];

        foreach ($xml->children() as $name => $child) {
            if (in_array($name, ['responseDate', 'request', 'error'], true)) {
                continue;
            }

            $value = $this->xmlNodeToArray($child);

            if (array_key_exists($name, $result)) {
                if (!is_array($result[$name]) || !array_is_list($result[$name])) {
                    $result[$name] = [$result[$name]];
                }

                $result[$name][] = $value;
            } else {
                $result[$name] = $value;
            }
        }

        return $result;
    }

    /**
     * Convert one XML node into an array or string.
     *
     * @return array<string, mixed>|string
     */
    private function xmlNodeToArray(SimpleXMLElement $xml): array|string
    {
        $attrs = [];
        foreach ($xml->attributes() as $key => $value) {
            $attrs[(string) $key] = (string) $value;
        }

        $children = [];
        foreach ($xml->children() as $name => $child) {
            $value = $this->xmlNodeToArray($child);

            if (array_key_exists($name, $children)) {
                if (!is_array($children[$name]) || !array_is_list($children[$name])) {
                    $children[$name] = [$children[$name]];
                }

                $children[$name][] = $value;
            } else {
                $children[$name] = $value;
            }
        }

        $text = $this->text($xml);

        if ($attrs === [] && $children === []) {
            return $text;
        }

        return array_filter([
            '_attributes' => $attrs,
            '_text' => $children === [] ? $text : null,
            'children' => $children,
        ], static fn (mixed $value): bool => $value !== null && $value !== []);
    }

    /**
     * Parse a single Atom entry.
     *
     * @return array<string, mixed>
     */
    private function parseEntry(SimpleXMLElement $entry): array
    {
        $arxiv = $entry->children(self::ARXIV_NS);
        $links = $this->parseLinks($entry);
        $id = $this->text($entry->id ?? null);

        return [
            'id' => $id,
            'arxiv_id' => $this->extractArxivId($id),
            'title' => $this->text($entry->title ?? null),
            'summary' => $this->text($entry->summary ?? null),
            'published' => $this->text($entry->published ?? null),
            'updated' => $this->text($entry->updated ?? null),
            'authors' => $this->parseAuthors($entry),
            'primary_category' => $this->primaryCategory($arxiv),
            'categories' => $this->parseCategories($entry),
            'doi' => $this->text($arxiv->doi ?? null),
            'journal_ref' => $this->text($arxiv->journal_ref ?? null),
            'comment' => $this->text($arxiv->comment ?? null),
            'links' => $links,
            'abs_url' => $this->firstLink($links, 'alternate') ?? $id,
            'pdf_url' => $this->firstPdfLink($links),
        ];
    }

    /**
     * Parse Atom authors from an entry.
     *
     * @return array<int, string>
     */
    private function parseAuthors(SimpleXMLElement $entry): array
    {
        $authors = [];
        foreach ($entry->author as $author) {
            $name = $this->text($author->name ?? null);
            if ($name !== '') {
                $authors[] = $name;
            }
        }

        return $authors;
    }

    /**
     * Parse Atom category terms from an entry.
     *
     * @return array<int, string>
     */
    private function parseCategories(SimpleXMLElement $entry): array
    {
        $categories = [];
        foreach ($entry->category as $category) {
            $term = (string) ($category['term'] ?? '');
            if ($term !== '') {
                $categories[] = $term;
            }
        }

        return $categories;
    }

    /**
     * Parse Atom links from an entry.
     *
     * @return array<int, array<string, string>>
     */
    private function parseLinks(SimpleXMLElement $entry): array
    {
        $links = [];
        foreach ($entry->link as $link) {
            $attrs = $link->attributes();
            $links[] = [
                'href' => (string) ($attrs['href'] ?? ''),
                'rel' => (string) ($attrs['rel'] ?? ''),
                'type' => (string) ($attrs['type'] ?? ''),
                'title' => (string) ($attrs['title'] ?? ''),
            ];
        }

        return $links;
    }

    /**
     * Read a namespaced integer element from the feed.
     */
    private function namespacedInt(SimpleXMLElement $xml, string $namespace, string $name): int
    {
        $children = $xml->children($namespace);

        return (int) ($children->{$name} ?? 0);
    }

    /**
     * Extract the arXiv primary category term.
     */
    private function primaryCategory(SimpleXMLElement $arxiv): string
    {
        $attrs = $arxiv->primary_category->attributes();

        return (string) ($attrs['term'] ?? '');
    }

    /**
     * Return the first link href with the requested rel value.
     *
     * @param  array<int, array<string, string>>  $links  Parsed Atom links.
     */
    private function firstLink(array $links, string $rel): ?string
    {
        foreach ($links as $link) {
            if (($link['rel'] ?? '') === $rel && ($link['href'] ?? '') !== '') {
                return $link['href'];
            }
        }

        return null;
    }

    /**
     * Return the first PDF link href.
     *
     * @param  array<int, array<string, string>>  $links  Parsed Atom links.
     */
    private function firstPdfLink(array $links): ?string
    {
        foreach ($links as $link) {
            if (($link['title'] ?? '') === 'pdf' || ($link['type'] ?? '') === 'application/pdf') {
                return ($link['href'] ?? '') !== '' ? $link['href'] : null;
            }
        }

        return null;
    }

    /**
     * Extract the canonical arXiv ID from an abstract URL.
     */
    private function extractArxivId(string $id): string
    {
        return str_contains($id, '/abs/') ? substr($id, strrpos($id, '/abs/') + 5) : $id;
    }

    /**
     * Convert SimpleXML text content into normalized plain text.
     */
    private function text(mixed $value): string
    {
        return trim(preg_replace('/\s+/', ' ', (string) $value) ?? '');
    }

    /**
     * Escape a quoted arXiv query value.
     */
    private function escapeQueryValue(string $value): string
    {
        return str_replace('"', '\"', $value);
    }
}
