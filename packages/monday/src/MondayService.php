<?php

namespace OpenCompany\Integrations\Monday;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Monday.com GraphQL API covering boards, items, workspaces, and users.
 *
 * All operations are performed via GraphQL queries and mutations against the single
 * Monday.com API v2 endpoint. Handles Bearer authentication and error reporting.
 */
class MondayService
{
    private const BASE_URL = 'https://api.monday.com/v2';

    /**
     * @param  string  $apiToken  Monday.com API token (personal or OAuth)
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Boards ─────────────────────────────────────────────

    /**
     * List boards the authenticated user has access to.
     *
     * @param  int  $limit  Number of boards to return
     * @param  int|null  $workspaceId  Optional workspace ID to filter by
     * @return array<string, mixed>
     */
    public function listBoards(int $limit = 25, ?int $workspaceId = null): array
    {
        $query = <<<'GQL'
        query($limit: Int!, $workspaceIds: [Int]) {
            boards(limit: $limit, workspaceIds: $workspaceIds) {
                id
                name
                description
                board_kind
                workspace {
                    id
                    name
                }
                owner {
                    id
                    name
                }
                items_count
                created_at
                updated_at
            }
        }
        GQL;

        $variables = [
            'limit' => $limit,
            'workspaceIds' => $workspaceId !== null ? [$workspaceId] : null,
        ];

        return $this->graphql($query, $variables);
    }

    /**
     * Get a single board by ID with its columns and groups.
     *
     * @return array<string, mixed>
     */
    public function getBoard(int $boardId): array
    {
        $query = <<<'GQL'
        query($boardId: [Int!]) {
            boards(ids: $boardId) {
                id
                name
                description
                board_kind
                state
                workspace {
                    id
                    name
                }
                owner {
                    id
                    name
                }
                items_count
                columns {
                    id
                    title
                    type
                    archived
                }
                groups {
                    id
                    title
                    color
                    position
                    deleted
                }
                created_at
                updated_at
            }
        }
        GQL;

        return $this->graphql($query, ['boardId' => [$boardId]]);
    }

    // ── Items ──────────────────────────────────────────────

    /**
     * List items on a board with optional pagination.
     *
     * @param  int  $boardId  Board ID to list items for
     * @param  int  $limit  Number of items per page
     * @param  int  $page  Page number (1-based)
     * @return array<string, mixed>
     */
    public function listItems(int $boardId, int $limit = 25, int $page = 1): array
    {
        $query = <<<'GQL'
        query($boardId: [Int!], $limit: Int!, $page: Int) {
            boards(ids: $boardId) {
                items(limit: $limit, page: $page) {
                    id
                    name
                    state
                    group {
                        id
                        title
                    }
                    creator {
                        id
                        name
                    }
                    created_at
                    updated_at
                }
            }
        }
        GQL;

        return $this->graphql($query, [
            'boardId' => [$boardId],
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single item by ID with its column values.
     *
     * @return array<string, mixed>
     */
    public function getItem(int $itemId): array
    {
        $query = <<<'GQL'
        query($itemId: [Int!]) {
            items(ids: $itemId) {
                id
                name
                state
                board {
                    id
                    name
                }
                group {
                    id
                    title
                }
                creator {
                    id
                    name
                }
                column_values {
                    id
                    title
                    type
                    text
                    value
                }
                created_at
                updated_at
            }
        }
        GQL;

        return $this->graphql($query, ['itemId' => [$itemId]]);
    }

    /**
     * Create a new item on a board.
     *
     * @param  int  $boardId  Board ID to create the item on
     * @param  string  $itemName  Name of the new item
     * @param  string|null  $groupId  Optional group ID to place the item in
     * @param  array<string, mixed>|null  $columnValues  Optional column values to set
     * @return array<string, mixed>
     */
    public function createItem(int $boardId, string $itemName, ?string $groupId = null, ?array $columnValues = null): array
    {
        $query = <<<'GQL'
        mutation CreateItem($boardId: Int!, $itemName: String!, $groupId: String, $columnValues: JSON) {
            create_item(
                board_id: $boardId,
                item_name: $itemName,
                group_id: $groupId,
                column_values: $columnValues,
                create_labels_if_missing: true
            ) {
                id
                name
                state
                board {
                    id
                    name
                }
                group {
                    id
                    title
                }
                created_at
            }
        }
        GQL;

        $variables = [
            'boardId' => $boardId,
            'itemName' => $itemName,
            'groupId' => $groupId,
            'columnValues' => $columnValues !== null ? json_encode($columnValues) : null,
        ];

        return $this->graphql($query, $variables);
    }

    // ── Workspaces ─────────────────────────────────────────

    /**
     * List workspaces the authenticated user has access to.
     *
     * @param  int  $limit  Number of workspaces to return
     * @return array<string, mixed>
     */
    public function listWorkspaces(int $limit = 50): array
    {
        $query = <<<'GQL'
        query($limit: Int!) {
            workspaces(limit: $limit) {
                id
                name
                description
                kind
                owners_count
                subscribers_count
                is_deleted
                created_at
            }
        }
        GQL;

        return $this->graphql($query, ['limit' => $limit]);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        $query = <<<'GQL'
        query {
            me {
                id
                name
                email
                avatar_url
                title
                country_code
                location
                phone
                timezone
                join_date
                enabled
            }
        }
        GQL;

        return $this->graphql($query);
    }

    // ── Connection Test ────────────────────────────────────

    /**
     * Test the connection by querying the current user.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $result = $this->graphql('{ me { id name } }');

            $name = $result['data']['me']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Monday.com as \"{$name}\".",
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    // ── GraphQL Transport ──────────────────────────────────

    /**
     * Execute a GraphQL operation against the Monday.com API.
     *
     * @param  string  $query  GraphQL query or mutation document
     * @param  array<string, mixed>  $variables  Operation variables
     * @return array<string, mixed>  Parsed response data
     *
     * @throws \RuntimeException  On API errors or connection failure
     */
    private function graphql(string $query, array $variables = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Monday.com API token is not configured.');
        }

        $payload = ['query' => $query];
        if (! empty($variables)) {
            $payload['variables'] = $variables;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post(self::BASE_URL, $payload);

            $body = $response->json() ?? [];

            if (isset($body['errors']) && is_array($body['errors'])) {
                $messages = array_map(function (array $err) {
                    return $err['message'] ?? json_encode($err);
                }, $body['errors']);

                $msg = implode('; ', $messages);

                Log::error('Monday.com GraphQL error', [
                    'errors' => $body['errors'],
                ]);

                throw new \RuntimeException('Monday.com API error: ' . $msg);
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Monday.com API connection error', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Monday.com API: {$e->getMessage()}");
        }
    }
}
