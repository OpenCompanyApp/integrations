<?php

namespace OpenCompany\Integrations\DepsDev;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the deps.dev Open Source Insights API.
 *
 * Handles stable v3 endpoint routing, path encoding, query parameter
 * normalization, system validation, and API error normalization.
 */
class DepsDevService
{
    private const SYSTEMS = ['GO', 'RUBYGEMS', 'NPM', 'CARGO', 'MAVEN', 'PYPI', 'NUGET'];

    /**
     * @param  string  $baseUrl  deps.dev API base URL.
     */
    public function __construct(private string $baseUrl = 'https://api.deps.dev/v3')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    /**
     * Retrieve package metadata and available versions.
     *
     * @return array<string, mixed>
     */
    public function package(string $system, string $name): array
    {
        return $this->request('/systems/'.$this->system($system).'/packages/'.$this->encode($name));
    }

    /**
     * Retrieve metadata for one package version.
     *
     * @return array<string, mixed>
     */
    public function version(string $system, string $name, string $version): array
    {
        return $this->request($this->versionPath($system, $name, $version));
    }

    /**
     * Retrieve declared dependency requirements for one package version.
     *
     * @return array<string, mixed>
     */
    public function requirements(string $system, string $name, string $version): array
    {
        return $this->request($this->versionPath($system, $name, $version).':requirements');
    }

    /**
     * Retrieve the resolved dependency graph for one package version.
     *
     * @return array<string, mixed>
     */
    public function dependencies(string $system, string $name, string $version): array
    {
        return $this->request($this->versionPath($system, $name, $version).':dependencies');
    }

    /**
     * Retrieve project metadata for a source repository.
     *
     * @return array<string, mixed>
     */
    public function project(string $id): array
    {
        return $this->request('/projects/'.$this->encode($id));
    }

    /**
     * Retrieve package versions mapped to a source project.
     *
     * @return array<string, mixed>
     */
    public function projectPackageVersions(string $id): array
    {
        return $this->request('/projects/'.$this->encode($id).':packageversions');
    }

    /**
     * Retrieve one OSV advisory by ID.
     *
     * @return array<string, mixed>
     */
    public function advisory(string $id): array
    {
        return $this->request('/advisories/'.$this->encode($id));
    }

    /**
     * Query package versions by content hash, version key, or both.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function query(array $params): array
    {
        $query = $this->queryParams($params);
        if ($query === []) {
            throw new RuntimeException('hash_type/hash_value or system/name/version is required.');
        }

        return $this->request('/query', $query);
    }

    /**
     * Execute a deps.dev GET request.
     *
     * @param  array<string, mixed>  $query  Query-string parameters.
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
            Log::error('deps.dev API connection error: '.$path, ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to deps.dev API: '.$e->getMessage());
        }
    }

    /**
     * Build a version resource path.
     */
    private function versionPath(string $system, string $name, string $version): string
    {
        return '/systems/'.$this->system($system).'/packages/'.$this->encode($name).'/versions/'.$this->encode($version);
    }

    /**
     * Normalize and validate a deps.dev package system.
     */
    private function system(string $system): string
    {
        $system = strtoupper(trim($system));
        if (!in_array($system, self::SYSTEMS, true)) {
            throw new RuntimeException('system must be one of: '.implode(', ', self::SYSTEMS).'.');
        }

        return $system;
    }

    /**
     * Build query endpoint parameters using deps.dev field names.
     *
     * @param  array<string, mixed>  $params  Tool arguments.
     * @return array<string, mixed>
     */
    private function queryParams(array $params): array
    {
        $query = [];
        if (($params['hash_type'] ?? '') !== '') {
            $query['hash.type'] = strtoupper((string) $params['hash_type']);
        }
        if (($params['hash_value'] ?? '') !== '') {
            $query['hash.value'] = (string) $params['hash_value'];
        }
        if (($params['system'] ?? '') !== '') {
            $query['versionKey.system'] = $this->system((string) $params['system']);
        }
        if (($params['name'] ?? '') !== '') {
            $query['versionKey.name'] = (string) $params['name'];
        }
        if (($params['version'] ?? '') !== '') {
            $query['versionKey.version'] = (string) $params['version'];
        }

        if ((isset($query['hash.type']) xor isset($query['hash.value']))) {
            throw new RuntimeException('hash_type and hash_value must be provided together.');
        }
        if ((isset($query['versionKey.system']) || isset($query['versionKey.name']) || isset($query['versionKey.version']))
            && (!isset($query['versionKey.system'], $query['versionKey.name'], $query['versionKey.version']))) {
            throw new RuntimeException('system, name, and version must be provided together for versionKey queries.');
        }

        return $query;
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
            $message = is_array($json) ? ($json['message'] ?? $json['error'] ?? null) : null;
            $message = is_string($message) && $message !== '' ? $message : $response->body();
            Log::error('deps.dev API error: '.$path, ['status' => $response->status(), 'error' => $message]);

            throw new RuntimeException('deps.dev API error ('.$response->status().'): '.$message);
        }

        if (is_array($json)) {
            return $json;
        }

        return ['body' => $response->body(), 'status' => $response->status()];
    }

    private function encode(string $value): string
    {
        return rawurlencode(trim($value));
    }
}
