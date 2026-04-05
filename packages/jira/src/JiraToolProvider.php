<?php

namespace OpenCompany\Integrations\Jira;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Jira\Tools\JiraAddAttachment;
use OpenCompany\Integrations\Jira\Tools\JiraAddComment;
use OpenCompany\Integrations\Jira\Tools\JiraAssignIssue;
use OpenCompany\Integrations\Jira\Tools\JiraCreateIssue;
use OpenCompany\Integrations\Jira\Tools\JiraCreateVersion;
use OpenCompany\Integrations\Jira\Tools\JiraDeleteIssue;
use OpenCompany\Integrations\Jira\Tools\JiraGetIssue;
use OpenCompany\Integrations\Jira\Tools\JiraGetIssueTypes;
use OpenCompany\Integrations\Jira\Tools\JiraGetTransitions;
use OpenCompany\Integrations\Jira\Tools\JiraGetUser;
use OpenCompany\Integrations\Jira\Tools\JiraListBoards;
use OpenCompany\Integrations\Jira\Tools\JiraListComments;
use OpenCompany\Integrations\Jira\Tools\JiraListPriorities;
use OpenCompany\Integrations\Jira\Tools\JiraListProjects;
use OpenCompany\Integrations\Jira\Tools\JiraListSprintIssues;
use OpenCompany\Integrations\Jira\Tools\JiraListSprints;
use OpenCompany\Integrations\Jira\Tools\JiraSearchIssues;
use OpenCompany\Integrations\Jira\Tools\JiraSearchUsers;
use OpenCompany\Integrations\Jira\Tools\JiraTransitionIssue;
use OpenCompany\Integrations\Jira\Tools\JiraUpdateIssue;

/**
 * Registers the Jira integration and its tools with the integration platform.
 *
 * Provides issue, project, board, sprint, user, and workflow management
 * tools via the Jira Cloud REST API.
 */
class JiraToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'jira';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'issues, projects, boards, sprints, workflows',
            'description' => 'Jira integration for project management and issue tracking',
            'icon' => 'simple-icons:jira',
            'logo' => 'simple-icons:jira',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Jira',
            'description' => 'Manage issues, projects, boards, sprints, and workflows on Jira Cloud.',
            'icon' => 'simple-icons:jira',
            'logo' => 'simple-icons:jira',
            'category' => 'productivity',
            'docs_url' => 'https://developer.atlassian.com/cloud/jira/platform/rest/v3/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'ATATT3xFfGF0...',
                'hint' => 'Generate a Personal Access Token at <a href="https://id.atlassian.com/manage-profile/security/api-tokens" target="_blank">Atlassian Account Security → API tokens</a>.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Jira Domain URL',
                'placeholder' => 'https://mycompany.atlassian.net',
                'hint' => 'Your Jira Cloud domain URL (e.g. https://mycompany.atlassian.net).',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = $config['base_url'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No Jira domain URL provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/rest/api/3/myself');

            if ($response->successful()) {
                $user = $response->json();
                $displayName = $user['displayName'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Jira as {$displayName}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['errorMessages'][0] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Jira API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            'jira_create_issue' => [
                'class' => JiraCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue in a Jira project.',
                'icon' => 'mdi:ticket-plus-outline',
            ],
            'jira_get_issue' => [
                'class' => JiraGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get details for a specific Jira issue.',
                'icon' => 'mdi:ticket-outline',
            ],
            'jira_update_issue' => [
                'class' => JiraUpdateIssue::class,
                'type' => 'write',
                'name' => 'Update Issue',
                'description' => 'Update an existing Jira issue.',
                'icon' => 'mdi:ticket-edit-outline',
            ],
            'jira_search_issues' => [
                'class' => JiraSearchIssues::class,
                'type' => 'read',
                'name' => 'Search Issues',
                'description' => 'Search for Jira issues using JQL.',
                'icon' => 'mdi:magnify',
            ],
            'jira_add_comment' => [
                'class' => JiraAddComment::class,
                'type' => 'write',
                'name' => 'Add Comment',
                'description' => 'Add a comment to a Jira issue.',
                'icon' => 'mdi:comment-plus-outline',
            ],
            'jira_list_comments' => [
                'class' => JiraListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments on a Jira issue.',
                'icon' => 'mdi:comment-text-outline',
            ],
            'jira_get_transitions' => [
                'class' => JiraGetTransitions::class,
                'type' => 'read',
                'name' => 'Get Transitions',
                'description' => 'Get available transitions for a Jira issue.',
                'icon' => 'mdi:swap-horizontal',
            ],
            'jira_transition_issue' => [
                'class' => JiraTransitionIssue::class,
                'type' => 'write',
                'name' => 'Transition Issue',
                'description' => 'Transition (change status of) a Jira issue.',
                'icon' => 'mdi:swap-horizontal-bold',
            ],
            'jira_assign_issue' => [
                'class' => JiraAssignIssue::class,
                'type' => 'write',
                'name' => 'Assign Issue',
                'description' => 'Assign a Jira issue to a user.',
                'icon' => 'mdi:account-arrow-right-outline',
            ],
            'jira_delete_issue' => [
                'class' => JiraDeleteIssue::class,
                'type' => 'write',
                'name' => 'Delete Issue',
                'description' => 'Delete a Jira issue.',
                'icon' => 'mdi:ticket-minus-outline',
            ],
            'jira_list_projects' => [
                'class' => JiraListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List Jira projects accessible to the authenticated user.',
                'icon' => 'mdi:folder-outline',
            ],
            'jira_get_issue_types' => [
                'class' => JiraGetIssueTypes::class,
                'type' => 'read',
                'name' => 'Get Issue Types',
                'description' => 'Get all available issue types.',
                'icon' => 'mdi:tag-outline',
            ],
            'jira_get_user' => [
                'class' => JiraGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get details for a specific Jira user.',
                'icon' => 'mdi:account-outline',
            ],
            'jira_search_users' => [
                'class' => JiraSearchUsers::class,
                'type' => 'read',
                'name' => 'Search Users',
                'description' => 'Search for Jira users.',
                'icon' => 'mdi:account-search-outline',
            ],
            'jira_list_priorities' => [
                'class' => JiraListPriorities::class,
                'type' => 'read',
                'name' => 'List Priorities',
                'description' => 'List all available issue priorities.',
                'icon' => 'mdi:flag-outline',
            ],
            'jira_list_boards' => [
                'class' => JiraListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List Jira agile boards.',
                'icon' => 'mdi:view-dashboard-outline',
            ],
            'jira_list_sprints' => [
                'class' => JiraListSprints::class,
                'type' => 'read',
                'name' => 'List Sprints',
                'description' => 'List sprints for a Jira board.',
                'icon' => 'mdi:run-fast',
            ],
            'jira_list_sprint_issues' => [
                'class' => JiraListSprintIssues::class,
                'type' => 'read',
                'name' => 'List Sprint Issues',
                'description' => 'List issues in a Jira sprint.',
                'icon' => 'mdi:format-list-bulleted',
            ],
            'jira_create_version' => [
                'class' => JiraCreateVersion::class,
                'type' => 'write',
                'name' => 'Create Version',
                'description' => 'Create a new version (release) in a Jira project.',
                'icon' => 'mdi:tag-plus-outline',
            ],
            'jira_add_attachment' => [
                'class' => JiraAddAttachment::class,
                'type' => 'write',
                'name' => 'Add Attachment',
                'description' => 'Add a file attachment to a Jira issue.',
                'icon' => 'mdi:paperclip',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return null;
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Jira Domain URL', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new JiraService(
                apiToken: $creds->get('jira', 'api_token', '', $account),
                baseUrl: $creds->get('jira', 'base_url', 'https://your-domain.atlassian.net', $account),
            );

            return new $class($service);
        }

        return new $class(app(JiraService::class));
    }
}
