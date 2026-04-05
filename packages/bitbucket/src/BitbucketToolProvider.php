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

/**
 * Registers the Bitbucket integration and its tools with the integration platform.
 *
 * Provides repository, issue, pull request, branch, commit, and file
 * management tools via the Bitbucket Cloud REST API.
 */
class BitbucketToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'bitbucket';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'repos, issues, pull requests, branches, commits',
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
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'App Password / OAuth Token',
                'placeholder' => 'ATBBt...',
                'hint' => 'Generate an App Password at <a href="https://bitbucket.org/account/settings/app-passwords/" target="_blank">Bitbucket Settings → App Passwords</a> or use an OAuth token.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection by fetching the authenticated user.
     *
     * @param  array<string, mixed>  $config  Configuration containing the api_key
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.bitbucket.org/2.0/user');

            if ($response->successful()) {
                $user = $response->json();
                $username = $user['username'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Bitbucket as @{$username}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['error']['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Bitbucket API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            'bitbucket_list_repos' => [
                'class' => BitbucketListRepos::class,
                'type' => 'read',
                'name' => 'List Repositories',
                'description' => 'List repositories in a Bitbucket workspace.',
                'icon' => 'mdi:source-repository',
            ],
            'bitbucket_get_repo' => [
                'class' => BitbucketGetRepo::class,
                'type' => 'read',
                'name' => 'Get Repository',
                'description' => 'Get details for a specific Bitbucket repository.',
                'icon' => 'mdi:source-repository',
            ],
            'bitbucket_create_repo' => [
                'class' => BitbucketCreateRepo::class,
                'type' => 'write',
                'name' => 'Create Repository',
                'description' => 'Create a new repository in a Bitbucket workspace.',
                'icon' => 'mdi:source-repository-plus',
            ],
            'bitbucket_list_issues' => [
                'class' => BitbucketListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues in a Bitbucket repository.',
                'icon' => 'mdi:ticket-outline',
            ],
            'bitbucket_get_issue' => [
                'class' => BitbucketGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get details for a specific Bitbucket issue.',
                'icon' => 'mdi:ticket-outline',
            ],
            'bitbucket_create_issue' => [
                'class' => BitbucketCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue in a Bitbucket repository.',
                'icon' => 'mdi:ticket-plus-outline',
            ],
            'bitbucket_update_issue' => [
                'class' => BitbucketUpdateIssue::class,
                'type' => 'write',
                'name' => 'Update Issue',
                'description' => 'Update an existing Bitbucket issue.',
                'icon' => 'mdi:ticket-edit-outline',
            ],
            'bitbucket_list_pull_requests' => [
                'class' => BitbucketListPullRequests::class,
                'type' => 'read',
                'name' => 'List Pull Requests',
                'description' => 'List pull requests in a Bitbucket repository.',
                'icon' => 'mdi:source-merge',
            ],
            'bitbucket_get_pull_request' => [
                'class' => BitbucketGetPullRequest::class,
                'type' => 'read',
                'name' => 'Get Pull Request',
                'description' => 'Get details for a specific Bitbucket pull request.',
                'icon' => 'mdi:source-merge',
            ],
            'bitbucket_create_pull_request' => [
                'class' => BitbucketCreatePullRequest::class,
                'type' => 'write',
                'name' => 'Create Pull Request',
                'description' => 'Create a new pull request in a Bitbucket repository.',
                'icon' => 'mdi:source-merge',
            ],
            'bitbucket_merge_pull_request' => [
                'class' => BitbucketMergePullRequest::class,
                'type' => 'write',
                'name' => 'Merge Pull Request',
                'description' => 'Merge a Bitbucket pull request.',
                'icon' => 'mdi:source-merge',
            ],
            'bitbucket_list_branches' => [
                'class' => BitbucketListBranches::class,
                'type' => 'read',
                'name' => 'List Branches',
                'description' => 'List branches in a Bitbucket repository.',
                'icon' => 'mdi:source-branch',
            ],
            'bitbucket_create_branch' => [
                'class' => BitbucketCreateBranch::class,
                'type' => 'write',
                'name' => 'Create Branch',
                'description' => 'Create a new branch in a Bitbucket repository.',
                'icon' => 'mdi:source-branch',
            ],
            'bitbucket_list_commits' => [
                'class' => BitbucketListCommits::class,
                'type' => 'read',
                'name' => 'List Commits',
                'description' => 'List commits in a Bitbucket repository.',
                'icon' => 'mdi:source-commit',
            ],
            'bitbucket_get_file' => [
                'class' => BitbucketGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get the content of a file from a Bitbucket repository.',
                'icon' => 'mdi:file-document-outline',
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
    {
        $account = $context['account'] ?? null;

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
