<?php

namespace OpenCompany\Integrations\GitLab;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GitLab\Tools\GitLabAcceptMergeRequest;
use OpenCompany\Integrations\GitLab\Tools\GitLabCreateBranch;
use OpenCompany\Integrations\GitLab\Tools\GitLabCreateIssue;
use OpenCompany\Integrations\GitLab\Tools\GitLabCreateIssueComment;
use OpenCompany\Integrations\GitLab\Tools\GitLabCreateMergeRequest;
use OpenCompany\Integrations\GitLab\Tools\GitLabGetFile;
use OpenCompany\Integrations\GitLab\Tools\GitLabGetIssue;
use OpenCompany\Integrations\GitLab\Tools\GitLabGetMergeRequest;
use OpenCompany\Integrations\GitLab\Tools\GitLabGetProject;
use OpenCompany\Integrations\GitLab\Tools\GitLabListBranches;
use OpenCompany\Integrations\GitLab\Tools\GitLabListCommits;
use OpenCompany\Integrations\GitLab\Tools\GitLabListGroups;
use OpenCompany\Integrations\GitLab\Tools\GitLabListIssues;
use OpenCompany\Integrations\GitLab\Tools\GitLabListLabels;
use OpenCompany\Integrations\GitLab\Tools\GitLabListMergeRequests;
use OpenCompany\Integrations\GitLab\Tools\GitLabListProjectMembers;
use OpenCompany\Integrations\GitLab\Tools\GitLabListProjects;
use OpenCompany\Integrations\GitLab\Tools\GitLabSearchIssues;
use OpenCompany\Integrations\GitLab\Tools\GitLabUpdateIssue;
use OpenCompany\Integrations\GitLab\Tools\GitLabUpdateMergeRequest;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class GitLabToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }




/**
     * Get the integration app name identifier.
     */
    public function appName(): string
    {
        return 'gitlab';
    }

/**
     * Get the short metadata for the integration card.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'GitLab',
            'description' => 'GitLab integration for DevOps collaboration',
            'icon' => 'mdi:gitlab',
            'logo' => 'mdi:gitlab',
        ];
    }

/**
     * Get the detailed integration metadata for configuration UI.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'GitLab',
            'description' => 'Manage projects, issues, merge requests, branches, commits, and files on GitLab.',
            'icon' => 'mdi:gitlab',
            'logo' => 'mdi:gitlab',
            'category' => 'productivity',
            'docs_url' => 'https://docs.gitlab.com/ee/api/rest/',
        ];
    }/**
     * Get the configuration schema for the integration settings form.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'glpat-...',
                'hint' => 'Generate a Personal Access Token at <a href="https://gitlab.com/-/user_settings/personal_access_tokens" target="_blank">GitLab → Edit profile → Access Tokens</a>. Tokens start with <code>glpat-</code>.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'GitLab Base URL',
                'placeholder' => 'https://gitlab.com/api/v4',
                'hint' => 'Override for self-hosted GitLab instances. Default: https://gitlab.com/api/v4',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection to GitLab using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration values (api_token, base_url)
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://gitlab.com/api/v4';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiToken}",
                'Content-Type' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/user');

            if ($response->successful()) {
                $user = $response->json();
                $username = $user['username'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to GitLab as @{$username}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $body['error'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'GitLab API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'gitlab_create_issue' => [
                'class' => GitLabCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue in a GitLab project.',
                'icon' => 'mdi:ticket-plus-outline',
            ],
            'gitlab_get_issue' => [
                'class' => GitLabGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get details for a specific GitLab issue.',
                'icon' => 'mdi:ticket-outline',
            ],
            'gitlab_update_issue' => [
                'class' => GitLabUpdateIssue::class,
                'type' => 'write',
                'name' => 'Update Issue',
                'description' => 'Update an existing GitLab issue.',
                'icon' => 'mdi:ticket-edit-outline',
            ],
            'gitlab_list_issues' => [
                'class' => GitLabListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues in a GitLab project.',
                'icon' => 'mdi:ticket-outline',
            ],
            'gitlab_search_issues' => [
                'class' => GitLabSearchIssues::class,
                'type' => 'read',
                'name' => 'Search Issues',
                'description' => 'Search issues in a GitLab project.',
                'icon' => 'mdi:magnify',
            ],
            'gitlab_create_issue_comment' => [
                'class' => GitLabCreateIssueComment::class,
                'type' => 'write',
                'name' => 'Create Issue Comment',
                'description' => 'Add a comment to a GitLab issue.',
                'icon' => 'mdi:comment-plus-outline',
            ],
            'gitlab_create_merge_request' => [
                'class' => GitLabCreateMergeRequest::class,
                'type' => 'write',
                'name' => 'Create Merge Request',
                'description' => 'Create a new merge request in a GitLab project.',
                'icon' => 'mdi:source-merge',
            ],
            'gitlab_get_merge_request' => [
                'class' => GitLabGetMergeRequest::class,
                'type' => 'read',
                'name' => 'Get Merge Request',
                'description' => 'Get details for a specific GitLab merge request.',
                'icon' => 'mdi:source-merge',
            ],
            'gitlab_list_merge_requests' => [
                'class' => GitLabListMergeRequests::class,
                'type' => 'read',
                'name' => 'List Merge Requests',
                'description' => 'List merge requests in a GitLab project.',
                'icon' => 'mdi:source-merge',
            ],
            'gitlab_update_merge_request' => [
                'class' => GitLabUpdateMergeRequest::class,
                'type' => 'write',
                'name' => 'Update Merge Request',
                'description' => 'Update an existing GitLab merge request.',
                'icon' => 'mdi:source-merge',
            ],
            'gitlab_accept_merge_request' => [
                'class' => GitLabAcceptMergeRequest::class,
                'type' => 'write',
                'name' => 'Accept Merge Request',
                'description' => 'Accept (merge) a GitLab merge request.',
                'icon' => 'mdi:check-circle-outline',
            ],
            'gitlab_list_branches' => [
                'class' => GitLabListBranches::class,
                'type' => 'read',
                'name' => 'List Branches',
                'description' => 'List branches in a GitLab project repository.',
                'icon' => 'mdi:source-branch',
            ],
            'gitlab_create_branch' => [
                'class' => GitLabCreateBranch::class,
                'type' => 'write',
                'name' => 'Create Branch',
                'description' => 'Create a new branch in a GitLab project repository.',
                'icon' => 'mdi:source-branch',
            ],
            'gitlab_list_commits' => [
                'class' => GitLabListCommits::class,
                'type' => 'read',
                'name' => 'List Commits',
                'description' => 'List commits in a GitLab project repository.',
                'icon' => 'mdi:source-commit',
            ],
            'gitlab_get_file' => [
                'class' => GitLabGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get a file from a GitLab project repository.',
                'icon' => 'mdi:file-document-outline',
            ],
            'gitlab_list_projects' => [
                'class' => GitLabListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List GitLab projects visible to the authenticated user.',
                'icon' => 'mdi:source-repository',
            ],
            'gitlab_get_project' => [
                'class' => GitLabGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific GitLab project.',
                'icon' => 'mdi:source-repository',
            ],
            'gitlab_list_groups' => [
                'class' => GitLabListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List GitLab groups visible to the authenticated user.',
                'icon' => 'mdi:account-group-outline',
            ],
            'gitlab_list_project_members' => [
                'class' => GitLabListProjectMembers::class,
                'type' => 'read',
                'name' => 'List Project Members',
                'description' => 'List members of a GitLab project.',
                'icon' => 'mdi:account-multiple-outline',
            ],
            'gitlab_list_labels' => [
                'class' => GitLabListLabels::class,
                'type' => 'read',
                'name' => 'List Labels',
                'description' => 'List labels for a GitLab project.',
                'icon' => 'mdi:label-outline',
            ],
        ];
    }

    /**
     * Whether this provider is a toggleable integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Get the optional Lua docs path.
     */
    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/gitlab.md';
    }

    /**
     * Get the credential fields for CLI configuration prompts.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
        ];
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Optional context (may contain 'account' for multi-account)
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GitLabService(
                apiToken: $creds->get('gitlab', 'api_token', '', $account),
                baseUrl: $creds->get('gitlab', 'base_url', 'https://gitlab.com/api/v4', $account),
            );

            return new $class($service);
        }

        return new $class(app(GitLabService::class));
    }
}
