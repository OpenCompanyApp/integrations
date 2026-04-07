<?php

namespace OpenCompany\Integrations\Dgraph;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Dgraph GraphQL API covering schema, types, indexes, nodes, mutations, queries, and auth.
 *
 * Wraps HTTP calls to Dgraph's GraphQL endpoint and handles authentication
 * via bearer token, request routing, and error reporting.
 */
class DgraphService
{
    /**
     * @param  string  $bearerToken  Dgraph API token
     * @param  string  $baseUrl      Dgraph GraphQL API base URL (default https://api.dgraph.io/graphql)
     */
    public function __construct(
        private string $bearerToken = '',
        private string $baseUrl = 'https://api.dgraph.io/graphql',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->bearerToken) && ! empty($this->baseUrl);
    }

    private function baseUrl(): string
    {
        return rtrim($this->baseUrl, '/');
    }

    // ── Schema ────────────────────────────────────────────────

    /**
     * List the full GraphQL schema.
     *
     * @return array<string, mixed>
     */
    public function listSchema(): array
    {
        $query = <<<'GQL'
        query {
            schema {
                types {
                    name
                    fields {
                        name
                        type {
                            name
                        }
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query);
    }

    /**
     * Get the schema for a specific type.
     *
     * @param  string  $typeName  The type name to retrieve schema for
     * @return array<string, mixed>
     */
    public function getSchema(string $typeName): array
    {
        $query = <<<'GQL'
        query ($name: String!) {
            schema(type: $name) {
                types {
                    name
                    fields {
                        name
                        type {
                            name
                        }
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query, ['name' => $typeName]);
    }

    // ── Types ─────────────────────────────────────────────────

    /**
     * List all types in the schema.
     *
     * @return array<string, mixed>
     */
    public function listTypes(): array
    {
        $query = <<<'GQL'
        query {
            schema {
                types {
                    name
                }
            }
        }
        GQL;

        return $this->graphql($query);
    }

    // ── Indexes ───────────────────────────────────────────────

    /**
     * List all indexes in the schema.
     *
     * @return array<string, mixed>
     */
    public function listIndexes(): array
    {
        $query = <<<'GQL'
        query {
            schema {
                types {
                    name
                    fields {
                        name
                        directives {
                            name
                            args {
                                name
                                value
                            }
                        }
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query);
    }

    // ── Nodes ─────────────────────────────────────────────────

    /**
     * Get a node by type and ID.
     *
     * @param  string  $type   The type of the node
     * @param  string  $id     The node ID
     * @return array<string, mixed>
     */
    public function getNode(string $type, string $id): array
    {
        $queryName = 'get' . ucfirst($type);
        $gql = <<<GQL
        query (\$id: ID!) {
            {$queryName}(id: \$id) {
                id
                ... on {$type} {
                    __typename
                }
            }
        }
        GQL;

        return $this->graphql($gql, ['id' => $id]);
    }

    // ── Mutations ─────────────────────────────────────────────

    /**
     * Execute a GraphQL mutation.
     *
     * @param  string  $mutation  The GraphQL mutation string
     * @param  array<string, mixed>  $variables  Variables for the mutation
     * @return array<string, mixed>
     */
    public function mutate(string $mutation, array $variables = []): array
    {
        return $this->graphql($mutation, $variables);
    }

    /**
     * Drop (delete) data via a mutation.
     *
     * @param  string  $mutation  The GraphQL drop/delete mutation string
     * @param  array<string, mixed>  $variables  Variables for the mutation
     * @return array<string, mixed>
     */
    public function dropMutation(string $mutation, array $variables = []): array
    {
        return $this->graphql($mutation, $variables);
    }

    // ── Query ─────────────────────────────────────────────────

    /**
     * Execute a custom GraphQL query.
     *
     * @param  string  $query       The GraphQL query string
     * @param  array<string, mixed>  $variables  Variables for the query
     * @return array<string, mixed>
     */
    public function query(string $query, array $variables = []): array
    {
        return $this->graphql($query, $variables);
    }

    // ── Auth ──────────────────────────────────────────────────

    /**
     * Get the current authenticated user information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        $query = <<<'GQL'
        query {
            currentUser {
                id
                name
                email
            }
        }
        GQL;

        return $this->graphql($query);
    }

    // ── GraphQL ───────────────────────────────────────────────

    /**
     * Execute a GraphQL request against the Dgraph API.
     *
     * @param  string  $query       GraphQL query or mutation string
     * @param  array<string, mixed>  $variables  Query variables
     * @return array<string, mixed>
     */
    private function graphql(string $query, array $variables = []): array
    {
        if (! $this->bearerToken) {
            throw new \RuntimeException('Dgraph bearer token is not configured.');
        }

        $url = $this->baseUrl();

        try {
            $headers = [
                'Authorization' => 'Bearer ' . $this->bearerToken,
                'Content-Type' => 'application/json',
            ];

            $payload = ['query' => $query];
            if (! empty($variables)) {
                $payload['variables'] = $variables;
            }

            $response = Http::withHeaders($headers)
                ->timeout(30)
                ->post($url, $payload);

            if (! $response->successful()) {
                $respBody = $response->json() ?? [];
                $err = $respBody['error']['message'] ?? $respBody['message'] ?? $respBody['error'] ?? $response->body();

                Log::error("Dgraph API error: POST {$url}", [
                    'status' => $response->status(),
                    'error' => $err,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Dgraph API error (' . $response->status() . '): ' . $msg);
            }

            $json = $response->json() ?? [];

            // Check for GraphQL errors
            if (isset($json['errors']) && ! empty($json['errors'])) {
                $messages = array_map(fn ($e) => $e['message'] ?? json_encode($e), $json['errors']);
                $errorMsg = implode('; ', $messages);

                Log::error("Dgraph GraphQL error", [
                    'errors' => $json['errors'],
                ]);

                throw new \RuntimeException('Dgraph GraphQL error: ' . $errorMsg);
            }

            return $json['data'] ?? $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Dgraph API connection error: POST {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException('Failed to connect to Dgraph API: ' . $e->getMessage());
        }
    }
}
