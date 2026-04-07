<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Support\Facades\Http;

class VercelService
{
    private string $baseUrl = 'https://api.vercel.com/v2';

    public function __construct(private string $token = '')
    {
    }

    public function isConfigured(): bool
    {
        return ! empty($this->token);
    }

    /* ------------------------------------------------------------------
     *  Projects
     * ------------------------------------------------------------------ */

    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/projects', $params);
    }

    public function getProject(string $id): array
    {
        return $this->request('GET', "/projects/{$id}");
    }

    /* ------------------------------------------------------------------
     *  Deployments
     * ------------------------------------------------------------------ */

    public function listDeployments(array $params = []): array
    {
        return $this->request('GET', '/deployments', $params);
    }

    public function getDeployment(string $id): array
    {
        return $this->request('GET', "/deployments/{$id}");
    }

    /* ------------------------------------------------------------------
     *  Domains
     * ------------------------------------------------------------------ */

    public function listDomains(array $params = []): array
    {
        return $this->request('GET', '/domains', $params);
    }

    /* ------------------------------------------------------------------
     *  Teams
     * ------------------------------------------------------------------ */

    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    /* ------------------------------------------------------------------
     *  User
     * ------------------------------------------------------------------ */

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /* ------------------------------------------------------------------
     *  HTTP helper
     * ------------------------------------------------------------------ */

    private function request(string $method, string $path, array $query = []): array
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->token}",
            'Accept' => 'application/json',
        ])->{$method}("{$this->baseUrl}{$path}", $method === 'GET' ? $query : null);

        return $response->json() ?? [];
    }
}
