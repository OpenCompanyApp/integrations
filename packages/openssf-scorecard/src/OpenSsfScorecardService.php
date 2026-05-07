<?php

namespace OpenCompany\Integrations\OpenSsfScorecard;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the OpenSSF Scorecard public API.
 *
 * Handles project path normalization, result and badge endpoints, individual
 * check extraction, viewer URL construction, and API error normalization.
 */
class OpenSsfScorecardService
{
    /**
     * @param  string  $baseUrl  OpenSSF Scorecard API base URL.
     * @param  string  $viewerBaseUrl  Scorecard viewer base URL.
     */
    public function __construct(
        private string $baseUrl = 'https://api.securityscorecards.dev',
        private string $viewerBaseUrl = 'https://securityscorecards.dev/viewer',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->viewerBaseUrl = rtrim($this->viewerBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Retrieve a published Scorecard result for a repository.
     *
     * @param  array<string, mixed>  $params  Repository and optional commit arguments.
     * @return array<string, mixed>
     */
    public function result(array $params): array
    {
        $repo = $this->repoParts($params);
        $query = [];
        if (($params['commit'] ?? '') !== '') {
            $query['commit'] = (string) $params['commit'];
        }

        return $this->requestJson('/projects/'.$repo['platform'].'/'.$repo['org'].'/'.$repo['repo'], $query);
    }

    /**
     * Retrieve one named check from a published Scorecard result.
     *
     * @param  array<string, mixed>  $params  Repository, optional commit, and check name.
     * @return array<string, mixed>
     */
    public function check(array $params): array
    {
        $name = strtolower(trim((string) ($params['check'] ?? '')));
        if ($name === '') {
            throw new RuntimeException('check is required.');
        }

        $result = $this->result($params);
        foreach (($result['checks'] ?? []) as $check) {
            if (is_array($check) && strtolower((string) ($check['name'] ?? '')) === $name) {
                return $check + ['repo' => $result['repo'] ?? null, 'date' => $result['date'] ?? null];
            }
        }

        throw new RuntimeException('Scorecard check not found.');
    }

    /**
     * Retrieve the repository Scorecard badge SVG.
     *
     * @param  array<string, mixed>  $params  Repository and optional badge style arguments.
     * @return array{body: string, status: int, content_type: string|null}
     */
    public function badge(array $params): array
    {
        $repo = $this->repoParts($params);
        $query = [];
        if (($params['style'] ?? '') !== '') {
            $query['style'] = (string) $params['style'];
        }

        $response = $this->send('/projects/'.$repo['platform'].'/'.$repo['org'].'/'.$repo['repo'].'/badge', $query, false);

        return ['body' => $response->body(), 'status' => $response->status(), 'content_type' => $response->header('content-type')];
    }

    /**
     * Build the public Scorecard viewer URL for a repository.
     *
     * @param  array<string, mixed>  $params  Repository arguments.
     * @return array{uri: string, url: string}
     */
    public function viewerUrl(array $params): array
    {
        $repo = $this->repoParts($params);
        $uri = $repo['platform'].'/'.$repo['org'].'/'.$repo['repo'];

        return ['uri' => $uri, 'url' => $this->viewerBaseUrl.'/?'.http_build_query(['uri' => $uri], '', '&', PHP_QUERY_RFC3986)];
    }

    /**
     * Execute and parse a JSON Scorecard API request.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     * @return array<string, mixed>
     */
    private function requestJson(string $path, array $query = []): array
    {
        $response = $this->send($path, $query);
        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Execute an OpenSSF Scorecard GET request.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
     */
    private function send(string $path, array $query = [], bool $acceptJson = true): Response
    {
        try {
            $request = Http::timeout(60);
            $request = $acceptJson ? $request->acceptJson() : $request->accept('*/*');
            $response = $request->get($this->baseUrl.$path, array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== ''));

            if (!$response->successful()) {
                $this->throwResponseError($response, $path);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('OpenSSF Scorecard API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to OpenSSF Scorecard API: '.$e->getMessage());
        }
    }

    /**
     * Parse repository arguments into Scorecard API path segments.
     *
     * @param  array<string, mixed>  $params  Repository arguments.
     * @return array{platform: string, org: string, repo: string}
     */
    private function repoParts(array $params): array
    {
        if (($params['uri'] ?? '') !== '') {
            $parts = explode('/', trim((string) $params['uri'], '/'));
            if (count($parts) < 3) {
                throw new RuntimeException('uri must look like github.com/org/repo.');
            }

            return ['platform' => rawurlencode($parts[0]), 'org' => rawurlencode($parts[1]), 'repo' => rawurlencode(implode('/', array_slice($parts, 2)))];
        }

        foreach (['platform', 'org', 'repo'] as $key) {
            if (($params[$key] ?? '') === '') {
                throw new RuntimeException($key.' is required.');
            }
        }

        return [
            'platform' => rawurlencode((string) $params['platform']),
            'org' => rawurlencode((string) $params['org']),
            'repo' => rawurlencode((string) $params['repo']),
        ];
    }

    /**
     * Convert an API error response into a runtime exception.
     */
    private function throwResponseError(Response $response, string $path): never
    {
        $json = $response->json();
        $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
        $message = is_string($message) && $message !== '' ? $message : $response->body();
        Log::error('OpenSSF Scorecard API error: '.$path, ['status' => $response->status(), 'error' => $message]);

        throw new RuntimeException('OpenSSF Scorecard API error ('.$response->status().'): '.$message);
    }
}
