<?php

namespace OpenCompany\Integrations\Linear;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Linear\Tools\LinearCreateIssue;
use OpenCompany\Integrations\Linear\Tools\LinearGetIssue;
use OpenCompany\Integrations\Linear\Tools\LinearUpdateIssue;
use OpenCompany\Integrations\Linear\Tools\LinearSearchIssues;
use OpenCompany\Integrations\Linear\Tools\LinearListIssues;
use OpenCompany\Integrations\Linear\Tools\LinearDeleteIssue;
use OpenCompany\Integrations\Linear\Tools\LinearCreateComment;
use OpenCompany\Integrations\Linear\Tools\LinearListComments;
use OpenCompany\Integrations\Linear\Tools\LinearGetTeams;
use OpenCompany\Integrations\Linear\Tools\LinearListProjects;
use OpenCompany\Integrations\Linear\Tools\LinearCreateProject;
use OpenCompany\Integrations\Linear\Tools\LinearUpdateProject;
use OpenCompany\Integrations\Linear\Tools\LinearListInitiatives;
use OpenCompany\Integrations\Linear\Tools\LinearCreateInitiative;
use OpenCompany\Integrations\Linear\Tools\LinearListLabels;
use OpenCompany\Integrations\Linear\Tools\LinearAddLabel;
use OpenCompany\Integrations\Linear\Tools\LinearRemoveLabel;
use OpenCompany\Integrations\Linear\Tools\LinearGetCurrentUser;
use OpenCompany\Integrations\Linear\Tools\LinearListWorkflows;
use OpenCompany\Integrations\Linear\Tools\LinearRawQuery;

/**
 * Registers all available Linear tools and provides integration metadata, configuration schema, and connection testing.
 */
class LinearToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'linear';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'issues, projects, teams',
            'description' => 'Project management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:linear',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Linear',
            'description' => 'Issues, projects, teams, cycles, and workflows',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:linear',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.linear.app',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Personal API Key',
                'placeholder' => 'lin_api_...',
                'hint' => 'Generate at Linear → Settings → API → Personal API Keys. Starts with <code>lin_api_</code>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Generate one at Linear → Settings → API.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post('https://api.linear.app/graphql', [
                'query' => '{ viewer { id name } }',
            ]);

            $body = $response->json() ?? [];

            if (isset($body['errors'])) {
                $messages = array_map(fn (array $err) => $err['message'] ?? json_encode($err), $body['errors']);

                return [
                    'success' => false,
                    'error' => 'Linear API error: ' . implode('; ', $messages),
                ];
            }

            $name = $body['data']['viewer']['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Linear as \"{$name}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Issues
            'linear_create_issue' => [
                'class' => LinearCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue in Linear.',
                'icon' => 'ph:plus-circle',
            ],
            'linear_get_issue' => [
                'class' => LinearGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get a single issue by ID with full details.',
                'icon' => 'ph:clipboard-text',
            ],
            'linear_update_issue' => [
                'class' => LinearUpdateIssue::class,
                'type' => 'write',
                'name' => 'Update Issue',
                'description' => 'Update an existing issue.',
                'icon' => 'ph:pencil-simple',
            ],
            'linear_search_issues' => [
                'class' => LinearSearchIssues::class,
                'type' => 'read',
                'name' => 'Search Issues',
                'description' => 'Search issues across teams with filters.',
                'icon' => 'ph:magnifying-glass',
            ],
            'linear_list_issues' => [
                'class' => LinearListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues for a team with pagination.',
                'icon' => 'ph:list-checks',
            ],
            'linear_delete_issue' => [
                'class' => LinearDeleteIssue::class,
                'type' => 'write',
                'name' => 'Delete Issue',
                'description' => 'Delete an issue.',
                'icon' => 'ph:trash',
            ],
            'linear_create_comment' => [
                'class' => LinearCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Add a comment to an issue.',
                'icon' => 'ph:chat-circle',
            ],
            'linear_list_comments' => [
                'class' => LinearListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments on an issue.',
                'icon' => 'ph:chat-circle',
            ],
            // Teams & Projects
            'linear_get_teams' => [
                'class' => LinearGetTeams::class,
                'type' => 'read',
                'name' => 'Get Teams',
                'description' => 'Get all teams and their members.',
                'icon' => 'ph:users',
            ],
            'linear_list_projects' => [
                'class' => LinearListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects with pagination.',
                'icon' => 'ph:folder',
            ],
            'linear_create_project' => [
                'class' => LinearCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new project.',
                'icon' => 'ph:plus-circle',
            ],
            'linear_update_project' => [
                'class' => LinearUpdateProject::class,
                'type' => 'write',
                'name' => 'Update Project',
                'description' => 'Update a project.',
                'icon' => 'ph:pencil-simple',
            ],
            'linear_list_initiatives' => [
                'class' => LinearListInitiatives::class,
                'type' => 'read',
                'name' => 'List Initiatives',
                'description' => 'List initiatives.',
                'icon' => 'ph:flag',
            ],
            'linear_create_initiative' => [
                'class' => LinearCreateInitiative::class,
                'type' => 'write',
                'name' => 'Create Initiative',
                'description' => 'Create a new initiative.',
                'icon' => 'ph:plus-circle',
            ],
            // Labels & Metadata
            'linear_list_labels' => [
                'class' => LinearListLabels::class,
                'type' => 'read',
                'name' => 'List Labels',
                'description' => 'List issue labels, optionally filtered by team.',
                'icon' => 'ph:tag',
            ],
            'linear_add_label' => [
                'class' => LinearAddLabel::class,
                'type' => 'write',
                'name' => 'Add Label',
                'description' => 'Add a label to an issue.',
                'icon' => 'ph:tag',
            ],
            'linear_remove_label' => [
                'class' => LinearRemoveLabel::class,
                'type' => 'write',
                'name' => 'Remove Label',
                'description' => 'Remove a label from an issue.',
                'icon' => 'ph:tag',
            ],
            'linear_get_current_user' => [
                'class' => LinearGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:robot',
            ],
            'linear_list_workflows' => [
                'class' => LinearListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List workflow states for a team.',
                'icon' => 'ph:flow-arrow',
            ],
            'linear_raw_query' => [
                'class' => LinearRawQuery::class,
                'type' => 'read',
                'name' => 'Raw Query',
                'description' => 'Execute an arbitrary GraphQL query against the Linear API.',
                'icon' => 'ph:code',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/linear.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the LinearService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): LinearService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new LinearService(
                apiKey: $creds->get('linear', 'api_key', '', $account),
            );
        }

        return app(LinearService::class);
    }
}
