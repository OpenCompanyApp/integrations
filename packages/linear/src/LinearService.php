<?php

namespace OpenCompany\Integrations\Linear;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Linear GraphQL API covering issues, projects, teams, labels, and workflows.
 *
 * All operations are performed via GraphQL queries and mutations against the single
 * Linear endpoint. Handles authentication, error reporting, and rate-limit awareness.
 */
class LinearService
{
    private const BASE_URL = 'https://api.linear.app/graphql';

    /**
     * @param  string  $apiKey  Linear personal access token (starts with `lin_api_`)
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Issues ─────────────────────────────────────────────

    /**
     * Create a new issue.
     *
     * @param  array<string, mixed>  $input  IssueCreateInput fields
     * @return array<string, mixed>
     */
    public function createIssue(array $input): array
    {
        $query = <<<'GQL'
        mutation IssueCreate($input: IssueCreateInput!) {
            issueCreate(input: $input) {
                success
                issue {
                    id
                    identifier
                    title
                    url
                    state { id name }
                    assignee { id name }
                    priority
                    labels { nodes { id name } }
                }
            }
        }
        GQL;

        return $this->graphql($query, ['input' => $input]);
    }

    /**
     * Get a single issue by ID.
     *
     * @return array<string, mixed>
     */
    public function getIssue(string $id): array
    {
        $query = <<<'GQL'
        query Issue($id: String!) {
            issue(id: $id) {
                id
                identifier
                title
                description
                url
                state { id name type }
                assignee { id name email }
                priority
                labels { nodes { id name color } }
                team { id name key }
                createdAt
                updatedAt
                comments {
                    nodes {
                        id
                        body
                        user { id name }
                        createdAt
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query, ['id' => $id]);
    }

    /**
     * Update an existing issue.
     *
     * @param  string  $id  Issue ID or identifier
     * @param  array<string, mixed>  $input  Fields to update
     * @return array<string, mixed>
     */
    public function updateIssue(string $id, array $input): array
    {
        $query = <<<'GQL'
        mutation IssueUpdate($id: String!, $input: IssueUpdateInput!) {
            issueUpdate(id: $id, input: $input) {
                success
                issue {
                    id
                    identifier
                    title
                    url
                    state { id name }
                    assignee { id name }
                    priority
                    labels { nodes { id name } }
                }
            }
        }
        GQL;

        return $this->graphql($query, ['id' => $id, 'input' => $input]);
    }

    /**
     * Search issues using filter criteria.
     *
     * @param  array<string, mixed>  $filter  IssueFilter fields
     * @param  int  $first  Number of results to return
     * @return array<string, mixed>
     */
    public function searchIssues(array $filter = [], int $first = 20): array
    {
        $query = <<<'GQL'
        query Issues($filter: IssueFilter, $first: Int) {
            issues(filter: $filter, first: $first) {
                nodes {
                    id
                    identifier
                    title
                    description
                    state { id name }
                    assignee { id name }
                    priority
                    team { id name key }
                    labels { nodes { id name } }
                    createdAt
                    updatedAt
                }
                pageInfo {
                    hasNextPage
                    endCursor
                }
            }
        }
        GQL;

        return $this->graphql($query, ['filter' => $filter, 'first' => $first]);
    }

    /**
     * List issues for a team with optional filters and cursor pagination.
     *
     * @param  string  $teamId  Team ID to list issues for
     * @param  array<string, mixed>  $filter  Additional issue filter fields
     * @param  int  $first  Number of results per page
     * @param  string|null  $after  Cursor for pagination
     * @return array<string, mixed>
     */
    public function listIssues(string $teamId, array $filter = [], int $first = 25, ?string $after = null): array
    {
        $filter['team'] = ['id' => ['eq' => $teamId]];

        $query = <<<'GQL'
        query Issues($filter: IssueFilter, $first: Int, $after: String) {
            issues(filter: $filter, first: $first, after: $after) {
                nodes {
                    id
                    identifier
                    title
                    state { id name }
                    assignee { id name }
                    priority
                    labels { nodes { id name } }
                    createdAt
                    updatedAt
                }
                pageInfo {
                    hasNextPage
                    endCursor
                }
            }
        }
        GQL;

        return $this->graphql($query, ['filter' => $filter, 'first' => $first, 'after' => $after]);
    }

    /**
     * Delete an issue.
     *
     * @return array<string, mixed>
     */
    public function deleteIssue(string $id): array
    {
        $query = <<<'GQL'
        mutation IssueDelete($id: String!) {
            issueDelete(id: $id) {
                success
            }
        }
        GQL;

        return $this->graphql($query, ['id' => $id]);
    }

    // ── Comments ───────────────────────────────────────────

    /**
     * Create a comment on an issue.
     *
     * @param  string  $issueId  Issue ID to comment on
     * @param  string  $body  Comment body text (markdown supported)
     * @return array<string, mixed>
     */
    public function createComment(string $issueId, string $body): array
    {
        $query = <<<'GQL'
        mutation CommentCreate($input: CommentCreateInput!) {
            commentCreate(input: $input) {
                success
                comment {
                    id
                    body
                    user { id name }
                    createdAt
                }
            }
        }
        GQL;

        return $this->graphql($query, ['input' => ['issueId' => $issueId, 'body' => $body]]);
    }

    /**
     * List comments on an issue.
     *
     * @return array<string, mixed>
     */
    public function listComments(string $issueId): array
    {
        $query = <<<'GQL'
        query IssueComments($id: String!) {
            issue(id: $id) {
                comments {
                    nodes {
                        id
                        body
                        user { id name }
                        createdAt
                        updatedAt
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query, ['id' => $issueId]);
    }

    // ── Teams ──────────────────────────────────────────────

    /**
     * Get all teams the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function getTeams(): array
    {
        $query = <<<'GQL'
        query Teams {
            teams {
                nodes {
                    id
                    name
                    key
                    description
                    icon
                    members {
                        nodes {
                            id
                            name
                            email
                        }
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query);
    }

    // ── Projects ───────────────────────────────────────────

    /**
     * List projects with optional pagination.
     *
     * @param  int  $first  Number of results per page
     * @param  string|null  $after  Cursor for pagination
     * @return array<string, mixed>
     */
    public function listProjects(int $first = 25, ?string $after = null): array
    {
        $query = <<<'GQL'
        query Projects($first: Int, $after: String) {
            projects(first: $first, after: $after) {
                nodes {
                    id
                    name
                    description
                    state
                    startDate
                    targetDate
                    lead { id name }
                    teams {
                        nodes { id name key }
                    }
                    createdAt
                    updatedAt
                }
                pageInfo {
                    hasNextPage
                    endCursor
                }
            }
        }
        GQL;

        return $this->graphql($query, ['first' => $first, 'after' => $after]);
    }

    /**
     * Create a new project.
     *
     * @param  array<string, mixed>  $input  ProjectCreateInput fields
     * @return array<string, mixed>
     */
    public function createProject(array $input): array
    {
        $query = <<<'GQL'
        mutation ProjectCreate($input: ProjectCreateInput!) {
            projectCreate(input: $input) {
                success
                project {
                    id
                    name
                    description
                    state
                    url
                    teams {
                        nodes { id name key }
                    }
                }
            }
        }
        GQL;

        return $this->graphql($query, ['input' => $input]);
    }

    /**
     * Update a project.
     *
     * @param  string  $id  Project ID
     * @param  array<string, mixed>  $input  Fields to update
     * @return array<string, mixed>
     */
    public function updateProject(string $id, array $input): array
    {
        $query = <<<'GQL'
        mutation ProjectUpdate($id: String!, $input: ProjectUpdateInput!) {
            projectUpdate(id: $id, input: $input) {
                success
                project {
                    id
                    name
                    description
                    state
                    url
                }
            }
        }
        GQL;

        return $this->graphql($query, ['id' => $id, 'input' => $input]);
    }

    // ── Initiatives ────────────────────────────────────────

    /**
     * List initiatives with optional limit.
     *
     * @return array<string, mixed>
     */
    public function listInitiatives(int $first = 25): array
    {
        $query = <<<'GQL'
        query Initiatives($first: Int) {
            initiatives(first: $first) {
                nodes {
                    id
                    name
                    description
                    state
                    startDate
                    targetDate
                    projects {
                        nodes { id name }
                    }
                    createdAt
                    updatedAt
                }
                pageInfo {
                    hasNextPage
                    endCursor
                }
            }
        }
        GQL;

        return $this->graphql($query, ['first' => $first]);
    }

    /**
     * Create a new initiative.
     *
     * @param  array<string, mixed>  $input  InitiativeCreateInput fields
     * @return array<string, mixed>
     */
    public function createInitiative(array $input): array
    {
        $query = <<<'GQL'
        mutation InitiativeCreate($input: InitiativeCreateInput!) {
            initiativeCreate(input: $input) {
                success
                initiative {
                    id
                    name
                    description
                    state
                }
            }
        }
        GQL;

        return $this->graphql($query, ['input' => $input]);
    }

    // ── Labels ─────────────────────────────────────────────

    /**
     * List issue labels, optionally filtered by team.
     *
     * @return array<string, mixed>
     */
    public function listLabels(?string $teamId = null): array
    {
        $filter = [];
        if ($teamId !== null && $teamId !== '') {
            $filter['team'] = ['id' => ['eq' => $teamId]];
        }

        $query = <<<'GQL'
        query IssueLabels($filter: IssueLabelFilter) {
            issueLabels(filter: $filter) {
                nodes {
                    id
                    name
                    color
                    description
                    team { id name }
                }
            }
        }
        GQL;

        return $this->graphql($query, empty($filter) ? [] : ['filter' => $filter]);
    }

    // ── Workflows ──────────────────────────────────────────

    /**
     * List workflow states, optionally filtered by team.
     *
     * @return array<string, mixed>
     */
    public function listWorkflowStates(?string $teamId = null): array
    {
        $filter = [];
        if ($teamId !== null && $teamId !== '') {
            $filter['team'] = ['id' => ['eq' => $teamId]];
        }

        $query = <<<'GQL'
        query WorkflowStates($filter: WorkflowStateFilter) {
            workflowStates(filter: $filter) {
                nodes {
                    id
                    name
                    type
                    color
                    team { id name }
                }
            }
        }
        GQL;

        return $this->graphql($query, empty($filter) ? [] : ['filter' => $filter]);
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
        query Viewer {
            viewer {
                id
                name
                email
                avatarUrl
            }
        }
        GQL;

        return $this->graphql($query);
    }

    // ── Raw Query ──────────────────────────────────────────

    /**
     * Execute an arbitrary GraphQL query or mutation.
     *
     * @param  string  $query  GraphQL document (query or mutation)
     * @param  array<string, mixed>  $variables  Variables to pass
     * @return array<string, mixed>
     */
    public function rawQuery(string $query, array $variables = []): array
    {
        return $this->graphql($query, $variables);
    }

    // ── Connection Test ────────────────────────────────────

    /**
     * Test the connection by querying the current viewer.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $result = $this->graphql('{ viewer { id name } }');

            $name = $result['data']['viewer']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Linear as \"{$name}\".",
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
     * Execute a GraphQL operation against the Linear API.
     *
     * @param  string  $query  GraphQL query or mutation document
     * @param  array<string, mixed>  $variables  Operation variables
     * @return array<string, mixed>  Parsed response data
     *
     * @throws \RuntimeException  On API errors or connection failure
     */
    private function graphql(string $query, array $variables = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Linear API key is not configured.');
        }

        $payload = ['query' => $query];
        if (! empty($variables)) {
            $payload['variables'] = $variables;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30)->post(self::BASE_URL, $payload);

            $body = $response->json() ?? [];

            if (isset($body['errors']) && is_array($body['errors'])) {
                $messages = array_map(function (array $err) {
                    return $err['message'] ?? json_encode($err);
                }, $body['errors']);

                $msg = implode('; ', $messages);

                Log::error('Linear GraphQL error', [
                    'errors' => $body['errors'],
                ]);

                throw new \RuntimeException('Linear API error: ' . $msg);
            }

            return $body;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Linear API connection error', [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Linear API: {$e->getMessage()}");
        }
    }
}
