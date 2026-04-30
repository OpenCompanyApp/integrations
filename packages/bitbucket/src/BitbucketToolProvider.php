<?php

namespace OpenCompany\Integrations\Bitbucket;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketListRepos;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketGetRepo;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketCreateRepo;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketListIssues;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketGetIssue;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketCreateIssue;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketUpdateIssue;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketListPullRequests;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketGetPullRequest;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketCreatePullRequest;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketMergePullRequest;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketListBranches;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketCreateBranch;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketListCommits;
use OpenCompany\Integrations\Bitbucket\Tools\BitbucketGetFile;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class BitbucketToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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



public function appName(): string
    {
        return 'bitbucket';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Bitbucket',
            'description' => 'Bitbucket integration for code collaboration',
            'icon' => 'mdi:bitbucket',
            'logo' => 'mdi:bitbucket',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Bitbucket',
            'description' => 'Manage repositories, issues, pull requests, branches, commits, and files on Bitbucket Cloud.',
            'icon' => 'mdi:bitbucket',
            'logo' => 'mdi:bitbucket',
            'category' => 'productivity',
            'docs_url' => 'https://developer.atlassian.com/cloud/bitbucket/rest/',
        ];
    }
        public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
    }
public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
        ];
    }

    public function tools(): array
    {
        return [
            'bitbucket_list_repos' => [
                'class' => BitbucketListRepos::class,
                'type' => 'read',
                'name' => 'Bitbucket List Repos',
                'description' => 'List repositories in a Bitbucket workspace. Supports sorting and pagination.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_get_repo' => [
                'class' => BitbucketGetRepo::class,
                'type' => 'read',
                'name' => 'Bitbucket Get Repo',
                'description' => 'Get details for a specific Bitbucket repository by workspace and repo slug.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_create_repo' => [
                'class' => BitbucketCreateRepo::class,
                'type' => 'write',
                'name' => 'Bitbucket Create Repo',
                'description' => 'Create a new repository in a Bitbucket workspace. Optionally set description, visibility, and language.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_list_issues' => [
                'class' => BitbucketListIssues::class,
                'type' => 'read',
                'name' => 'Bitbucket List Issues',
                'description' => 'List issues in a Bitbucket repository. Supports filtering by state, kind, and priority.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_get_issue' => [
                'class' => BitbucketGetIssue::class,
                'type' => 'read',
                'name' => 'Bitbucket Get Issue',
                'description' => 'Get details for a specific issue in a Bitbucket repository.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_create_issue' => [
                'class' => BitbucketCreateIssue::class,
                'type' => 'write',
                'name' => 'Bitbucket Create Issue',
                'description' => 'Create a new issue in a Bitbucket repository. Requires a title; optionally set content, kind, priority, and assignee.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_update_issue' => [
                'class' => BitbucketUpdateIssue::class,
                'type' => 'write',
                'name' => 'Bitbucket Update Issue',
                'description' => 'Update an existing issue in a Bitbucket repository. Can change title, content, state, priority, and assignee.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_list_pull_requests' => [
                'class' => BitbucketListPullRequests::class,
                'type' => 'read',
                'name' => 'Bitbucket List Pull Requests',
                'description' => 'List pull requests in a Bitbucket repository. Supports filtering by state and pagination.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_get_pull_request' => [
                'class' => BitbucketGetPullRequest::class,
                'type' => 'read',
                'name' => 'Bitbucket Get Pull Request',
                'description' => 'Get details for a specific pull request in a Bitbucket repository.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_create_pull_request' => [
                'class' => BitbucketCreatePullRequest::class,
                'type' => 'write',
                'name' => 'Bitbucket Create Pull Request',
                'description' => 'Create a new pull request in a Bitbucket repository. Requires a title, source branch, and destination branch.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_merge_pull_request' => [
                'class' => BitbucketMergePullRequest::class,
                'type' => 'write',
                'name' => 'Bitbucket Merge Pull Request',
                'description' => 'Merge a Bitbucket pull request. Optionally provide a merge commit message.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_list_branches' => [
                'class' => BitbucketListBranches::class,
                'type' => 'read',
                'name' => 'Bitbucket List Branches',
                'description' => 'List branches in a Bitbucket repository. Supports pagination.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_create_branch' => [
                'class' => BitbucketCreateBranch::class,
                'type' => 'write',
                'name' => 'Bitbucket Create Branch',
                'description' => 'Create a new branch in a Bitbucket repository. Requires a branch name and the target commit hash.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_list_commits' => [
                'class' => BitbucketListCommits::class,
                'type' => 'read',
                'name' => 'Bitbucket List Commits',
                'description' => 'List commits in a Bitbucket repository. Supports filtering by revision and path.',
                'icon' => 'ph:wrench',
            ],
            'bitbucket_get_file' => [
                'class' => BitbucketGetFile::class,
                'type' => 'read',
                'name' => 'Bitbucket Get File',
                'description' => 'Get the raw content of a file from a Bitbucket repository at a specific revision.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/bitbucket.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'App Password / OAuth Token', 'required' => true],
        ];
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  string  $class   Fully-qualified tool class name
     * @param  array<string, mixed>  $context  Context containing optional account info
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BitbucketService(
                apiKey: $creds->get('bitbucket', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BitbucketService::class));
    }
}
