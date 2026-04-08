<?php

namespace OpenCompany\Integrations\NewRelic;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewRelicService
{
    public function __construct(
        private string $apiKey = '',
        private string $accountId = '',
        private string $baseUrl = 'https://api.newrelic.com/graphql',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->accountId);
    }

    /**
     * Get the currently authenticated New Relic user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        $query = <<<'GRAPHQL'
        {
            actor {
                user {
                    email
                    id
                    name
                }
            }
        }
        GRAPHQL;

        return $this->graphql($query);
    }

    /**
     * List APM applications for the configured account.
     *
     * @return array<string, mixed>
     */
    public function listApplications(): array
    {
        $accountId = $this->accountId;
        $query = <<<GRAPHQL
        {
            actor {
                account(id: {$accountId}) {
                    applications {
                        results {
                            guid
                            name
                            applicationId
                            reporting
                            language
                            healthStatus
                        }
                    }
                }
            }
        }
        GRAPHQL;

        $data = $this->graphql($query);

        return $data['actor']['account']['applications']['results'] ?? [];
    }

    /**
     * Get a single APM application by its application ID.
     *
     * @param  int|string  $applicationId
     * @return array<string, mixed>
     */
    public function getApplication(int|string $applicationId): array
    {
        $accountId = $this->accountId;
        $query = <<<GRAPHQL
        {
            actor {
                account(id: {$accountId}) {
                    application(id: {$applicationId}) {
                        guid
                        name
                        applicationId
                        reporting
                        language
                        healthStatus
                        settings {
                            appApdexThreshold
                            endUserApdexThreshold
                        }
                    }
                }
            }
        }
        GRAPHQL;

        $data = $this->graphql($query);

        return $data['actor']['account']['application'] ?? [];
    }

    /**
     * List deployments for a given application GUID.
     *
     * @param  string  $applicationGuid
     * @return array<string, mixed>
     */
    public function listDeployments(string $applicationGuid): array
    {
        $query = <<<'GRAPHQL'
        query($guid: EntityGuid!) {
            actor {
                entity(guid: $guid) {
                    ... on ApmApplicationEntity {
                        deployments {
                            deployments {
                                changelog
                                description
                                revision
                                timestamp
                                user
                            }
                        }
                    }
                }
            }
        }
        GRAPHQL;

        $data = $this->graphql($query, ['guid' => $applicationGuid]);

        return $data['actor']['entity']['deployments']['deployments'] ?? [];
    }

    /**
     * Create a deployment marker for an application.
     *
     * @param  string  $applicationGuid
     * @param  string  $revision
     * @param  string  $description
     * @param  string  $user
     * @param  string  $changelog
     * @return array<string, mixed>
     */
    public function createDeployment(
        string $applicationGuid,
        string $revision,
        string $description = '',
        string $user = '',
        string $changelog = '',
    ): array {
        $accountId = $this->accountId;
        $mutation = <<<'GRAPHQL'
        mutation($accountId: Int!, $applicationGuid: EntityGuid!, $revision: String!, $description: String, $user: String, $changelog: String) {
            deploymentMarkerCreate(
                accountId: $accountId,
                applicationGuid: $applicationGuid,
                revision: $revision,
                description: $description,
                user: $user,
                changelog: $changelog
            ) {
                deploymentMarker {
                    guid
                    revision
                    timestamp
                }
                errors {
                    description
                    type
                }
            }
        }
        GRAPHQL;

        $variables = [
            'accountId' => (int) $accountId,
            'applicationGuid' => $applicationGuid,
            'revision' => $revision,
            'description' => $description,
            'user' => $user,
            'changelog' => $changelog,
        ];

        $data = $this->graphql($mutation, $variables);

        return $data['deploymentMarkerCreate'] ?? [];
    }

    /**
     * List alert policies for the configured account.
     *
     * @return array<string, mixed>
     */
    public function listAlertPolicies(): array
    {
        $accountId = $this->accountId;
        $query = <<<GRAPHQL
        {
            actor {
                account(id: {$accountId}) {
                    alerts {
                        policiesSearch {
                            policies {
                                id
                                name
                                incidentPreference
                            }
                        }
                    }
                }
            }
        }
        GRAPHQL;

        $data = $this->graphql($query);

        return $data['actor']['account']['alerts']['policiesSearch']['policies'] ?? [];
    }

    /**
     * List dashboards for the configured account.
     *
     * @return array<string, mixed>
     */
    public function listDashboards(): array
    {
        $accountId = $this->accountId;
        $query = <<<GRAPHQL
        {
            actor {
                account(id: {$accountId}) {
                    dashboards {
                        results {
                            guid
                            title
                            createdAt
                            updatedAt
                            owner {
                                email
                            }
                        }
                    }
                }
            }
        }
        GRAPHQL;

        $data = $this->graphql($query);

        return $data['actor']['account']['dashboards']['results'] ?? [];
    }

    /**
     * Execute a GraphQL query against the New Relic NerdGraph API.
     *
     * @param  string  $query  GraphQL query or mutation string.
     * @param  array<string, mixed>  $variables  GraphQL variables.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException
     */
    private function graphql(string $query, array $variables = []): array
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('New Relic API key is not configured.');
        }

        $body = ['query' => $query];
        if (!empty($variables)) {
            $body['variables'] = $variables;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->baseUrl, $body);

            $json = $response->json();

            if ($json === null) {
                throw new \RuntimeException('New Relic API returned an invalid response.');
            }

            if (isset($json['errors'])) {
                $messages = array_map(fn ($e) => $e['message'] ?? json_encode($e), $json['errors']);
                throw new \RuntimeException('New Relic GraphQL error: ' . implode('; ', $messages));
            }

            return $json['data'] ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('New Relic API connection error', ['error' => $e->getMessage()]);
            throw new \RuntimeException('Failed to connect to New Relic API: ' . $e->getMessage());
        }
    }
}
