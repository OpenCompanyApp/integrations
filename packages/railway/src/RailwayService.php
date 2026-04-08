<?php

namespace OpenCompany\Integrations\Railway;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RailwayService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://backboard.railway.app/graphql/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        $query = <<<'GRAPHQL'
query {
    viewer {
        id
        name
        email
        avatar
        isVerified
        isOnboarded
    }
}
GRAPHQL;

        return $this->graphql($query);
    }

    /**
     * List all projects the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        $query = <<<'GRAPHQL'
query {
    viewer {
        projects {
            edges {
                node {
                    id
                    name
                    description
                    createdAt
                    updatedAt
                    isPublic
                    team {
                        id
                        name
                    }
                }
            }
        }
    }
}
GRAPHQL;

        return $this->graphql($query);
    }

    /**
     * Get detailed information about a specific project.
     *
     * @param  string  $projectId  The project ID
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array
    {
        $query = <<<'GRAPHQL'
query GetProject($projectId: String!) {
    project(id: $projectId) {
        id
        name
        description
        createdAt
        updatedAt
        isPublic
        team {
            id
            name
        }
        environments {
            edges {
                node {
                    id
                    name
                    isEphemeral
                }
            }
        }
        plugins {
            edges {
                node {
                    id
                    name
                }
            }
        }
    }
}
GRAPHQL;

        return $this->graphql($query, ['projectId' => $projectId]);
    }

    /**
     * Create a new project.
     *
     * @param  string  $name  The project name
     *  string|null  $description  Optional project description
     * @return array<string, mixed>
     */
    public function createProject(string $name, ?string $description = null): array
    {
        $query = <<<'GRAPHQL'
mutation CreateProject($name: String!, $description: String) {
    projectCreate(input: { name: $name, description: $description }) {
        project {
            id
            name
            description
            createdAt
            updatedAt
        }
    }
}
GRAPHQL;

        $variables = ['name' => $name];
        if ($description !== null) {
            $variables['description'] = $description;
        }

        return $this->graphql($query, $variables);
    }

    /**
     * List services for a specific project.
     *
     * @param  string  $projectId  The project ID
     * @return array<string, mixed>
     */
    public function listServices(string $projectId): array
    {
        $query = <<<'GRAPHQL'
query ListServices($projectId: String!) {
    project(id: $projectId) {
        services {
            edges {
                node {
                    id
                    name
                    createdAt
                    updatedAt
                    isForked
                    repo {
                        id
                        name
                    }
                }
            }
        }
    }
}
GRAPHQL;

        return $this->graphql($query, ['projectId' => $projectId]);
    }

    /**
     * Get detailed information about a specific service.
     *
     * @param  string  $serviceId  The service ID
     * @return array<string, mixed>
     */
    public function getService(string $serviceId): array
    {
        $query = <<<'GRAPHQL'
query GetService($serviceId: String!) {
    service(id: $serviceId) {
        id
        name
        createdAt
        updatedAt
        isForked
        repo {
            id
            name
            fullName
            branch
        }
        source {
            ... on ServiceSourceRepo {
                repo
                branch
            }
            ... on ServiceSourceImage {
                image
            }
            ... on ServiceSourceTemplate {
                templateName
            }
        }
    }
}
GRAPHQL;

        return $this->graphql($query, ['serviceId' => $serviceId]);
    }

    /**
     * List deployments for a specific service.
     *
     * @param  string  $serviceId  The service ID
     * @param  string|null  $environmentId  Optional environment ID to filter by
     * @param  int  $limit  Maximum number of deployments to return (default: 20)
     * @return array<string, mixed>
     */
    public function listDeployments(string $serviceId, ?string $environmentId = null, int $limit = 20): array
    {
        $query = <<<'GRAPHQL'
query ListDeployments($serviceId: String!, $environmentId: String, $limit: Int!) {
    deployments(serviceId: $serviceId, environmentId: $environmentId, first: $limit) {
        edges {
            node {
                id
                status
                createdAt
                updatedAt
                environment {
                    id
                    name
                }
                service {
                    id
                    name
                }
                creator {
                    id
                    name
                    email
                }
            }
        }
    }
}
GRAPHQL;

        $variables = [
            'serviceId' => $serviceId,
            'limit' => $limit,
        ];

        if ($environmentId !== null) {
            $variables['environmentId'] = $environmentId;
        }

        return $this->graphql($query, $variables);
    }

    /**
     * Execute a GraphQL query against the Railway API.
     *
     * @param  string  $query  The GraphQL query or mutation
     * @param  array<string, mixed>  $variables  Optional query variables
     * @return array<string, mixed>
     */
    private function graphql(string $query, array $variables = []): array
    {
        $response = $this->rawRequest($query, $variables);

        $json = $response->json();

        if (isset($json['errors']) && !empty($json['errors'])) {
            $messages = array_map(fn ($e) => $e['message'] ?? 'Unknown error', $json['errors']);
            throw new \RuntimeException('Railway GraphQL error: ' . implode('; ', $messages));
        }

        return $json['data'] ?? $json ?? [];
    }

    /**
     * Make a raw HTTP request to the Railway GraphQL API.
     *
     * @param  string  $query  The GraphQL query or mutation
     * @param  array<string, mixed>  $variables  Query variables
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $query, array $variables = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Railway access token is not configured.');
        }

        $url = $this->baseUrl;

        $body = ['query' => $query];
        if (!empty($variables)) {
            $body['variables'] = $variables;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($url, $body);

            if ($response->status() === 401) {
                throw new \RuntimeException('Railway API authentication failed. Check your access token.');
            }

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $responseBody = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($responseBody), '<!DOCTYPE')) {
                    Log::warning('Railway API returned HTML', [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Railway API endpoint not available (HTTP {$response->status()}). Check your base URL and access token.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error('Railway API error', [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Railway API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Railway API connection error', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Railway API: {$e->getMessage()}");
        }
    }
}
