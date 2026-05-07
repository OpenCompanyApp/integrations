<?php

namespace OpenCompany\Integrations\OpenLibrary;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Open Library APIs.
 *
 * Handles public JSON endpoint routing, identifier normalization, query
 * shaping, legacy books lookup parameters, cover URL construction, and errors.
 */
class OpenLibraryService
{
    /**
     * @param  string  $baseUrl  Open Library base URL.
     * @param  string  $coversBaseUrl  Open Library covers base URL.
     */
    public function __construct(
        private string $baseUrl = 'https://openlibrary.org',
        private string $coversBaseUrl = 'https://covers.openlibrary.org',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->coversBaseUrl = rtrim($this->coversBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Search books and works.
     *
     * @param  array<string, mixed>  $params  Search, sort, field, language, and pagination parameters.
     * @return array<string, mixed>
     */
    public function searchBooks(array $params): array
    {
        if (($params['q'] ?? '') === '' && ($params['title'] ?? '') === '' && ($params['author'] ?? '') === '') {
            throw new RuntimeException('q, title, or author is required.');
        }

        return $this->get('/search.json', $this->only($params, ['q', 'title', 'author', 'subject', 'place', 'person', 'publisher', 'fields', 'sort', 'lang', 'offset', 'limit', 'page']));
    }

    /**
     * Search authors.
     *
     * @param  array<string, mixed>  $params  q, offset, and limit parameters.
     * @return array<string, mixed>
     */
    public function searchAuthors(array $params): array
    {
        if (($params['q'] ?? '') === '') {
            throw new RuntimeException('q is required.');
        }

        return $this->get('/search/authors.json', $this->only($params, ['q', 'offset', 'limit']));
    }

    /**
     * Retrieve one work by Open Library work ID.
     *
     * @return array<string, mixed>
     */
    public function work(string $id): array
    {
        return $this->get('/works/'.$this->id($id).'.json');
    }

    /**
     * Retrieve editions for a work.
     *
     * @param  array<string, mixed>  $params  offset and limit parameters.
     * @return array<string, mixed>
     */
    public function workEditions(string $id, array $params = []): array
    {
        return $this->get('/works/'.$this->id($id).'/editions.json', $this->only($params, ['offset', 'limit']));
    }

    /**
     * Retrieve ratings for a work.
     *
     * @return array<string, mixed>
     */
    public function workRatings(string $id): array
    {
        return $this->get('/works/'.$this->id($id).'/ratings.json');
    }

    /**
     * Retrieve bookshelves for a work.
     *
     * @return array<string, mixed>
     */
    public function workBookshelves(string $id): array
    {
        return $this->get('/works/'.$this->id($id).'/bookshelves.json');
    }

    /**
     * Retrieve one edition by Open Library edition ID.
     *
     * @return array<string, mixed>
     */
    public function edition(string $id): array
    {
        return $this->get('/books/'.$this->id($id).'.json');
    }

    /**
     * Retrieve an edition by ISBN 10 or 13.
     *
     * @return array<string, mixed>
     */
    public function isbn(string $isbn): array
    {
        return $this->get('/isbn/'.$this->encode($isbn).'.json');
    }

    /**
     * Retrieve one or more books by ISBN, LCCN, OCLC, or OLID bibkeys.
     *
     * @param  array<string, mixed>  $params  bibkeys and jscmd options.
     * @return array<string, mixed>
     */
    public function books(array $params): array
    {
        if (($params['bibkeys'] ?? '') === '') {
            throw new RuntimeException('bibkeys is required.');
        }

        return $this->get('/api/books', ['bibkeys' => $params['bibkeys'], 'format' => 'json', 'jscmd' => (string) ($params['jscmd'] ?? 'data')]);
    }

    /**
     * Retrieve one author by Open Library author ID.
     *
     * @return array<string, mixed>
     */
    public function author(string $id): array
    {
        return $this->get('/authors/'.$this->id($id).'.json');
    }

    /**
     * Retrieve works by an author.
     *
     * @param  array<string, mixed>  $params  offset and limit parameters.
     * @return array<string, mixed>
     */
    public function authorWorks(string $id, array $params = []): array
    {
        return $this->get('/authors/'.$this->id($id).'/works.json', $this->only($params, ['offset', 'limit']));
    }

    /**
     * Retrieve works for a subject.
     *
     * @param  array<string, mixed>  $params  details, offset, and limit parameters.
     * @return array<string, mixed>
     */
    public function subject(string $subject, array $params = []): array
    {
        $query = $this->only($params, ['offset', 'limit']);
        if (($params['details'] ?? false) === true) {
            $query['details'] = 'true';
        }

        return $this->get('/subjects/'.$this->slug($subject).'.json', $query);
    }

    /**
     * Retrieve recent changes, optionally by date and kind.
     *
     * @param  array<string, mixed>  $params  year, month, day, kind, limit, offset, and bot filters.
     * @return array<string, mixed>
     */
    public function recentChanges(array $params = []): array
    {
        $segments = array_values(array_filter([(string) ($params['year'] ?? ''), (string) ($params['month'] ?? ''), (string) ($params['day'] ?? ''), (string) ($params['kind'] ?? '')]));
        $path = '/recentchanges'.($segments !== [] ? '/'.implode('/', array_map([$this, 'encode'], $segments)) : '').'.json';
        $query = $this->only($params, ['limit', 'offset']);
        if (array_key_exists('bot', $params)) {
            $query['bot'] = $params['bot'] ? 'true' : 'false';
        }

        return $this->get($path, $query);
    }

    /**
     * Build a cover image URL by ISBN, OLID, OCLC, LCCN, or cover ID.
     *
     * @return array<string, mixed>
     */
    public function coverUrl(string $type, string $value, string $size = 'M'): array
    {
        $type = strtolower(trim($type));
        $map = ['isbn' => 'isbn', 'olid' => 'olid', 'oclc' => 'oclc', 'lccn' => 'lccn', 'id' => 'id'];
        if (!isset($map[$type])) {
            throw new RuntimeException('type must be one of: isbn, olid, oclc, lccn, id.');
        }

        $size = strtoupper(trim($size));
        if (!in_array($size, ['S', 'M', 'L'], true)) {
            throw new RuntimeException('size must be one of: S, M, L.');
        }

        return ['url' => $this->coversBaseUrl.'/b/'.$map[$type].'/'.$this->encode($value).'-'.$size.'.jpg'];
    }

    /**
     * Execute a JSON GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function get(string $path, array $query = []): array
    {
        try {
            $response = Http::acceptJson()
                ->timeout(60)
                ->get($this->baseUrl.$path, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

            return $this->parseResponse($response, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Open Library API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Open Library API: '.$e->getMessage());
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
            $message = is_array($json) ? (string) ($json['error'] ?? $json['message'] ?? '') : trim(strip_tags($response->body()));
            Log::error('Open Library API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('Open Library API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
        }

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Keep only known query parameters.
     *
     * @param  array<string, mixed>  $params  Tool parameters.
     * @param  list<string>  $keys  Allowed keys.
     * @return array<string, mixed>
     */
    private function only(array $params, array $keys): array
    {
        return array_intersect_key($params, array_flip($keys));
    }

    private function id(string $id): string
    {
        $id = trim($id);
        $id = preg_replace('#^/(works|books|authors)/#', '', $id) ?? $id;

        return $this->encode($id);
    }

    private function slug(string $value): string
    {
        return $this->encode(str_replace(' ', '_', strtolower(trim($value))));
    }

    private function encode(string $value): string
    {
        return rawurlencode(trim($value));
    }
}
