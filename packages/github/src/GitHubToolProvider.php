<?php

namespace OpenCompany\Integrations\GitHub;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GitHub\Tools\GitHubAddLabels;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateBranch;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateGist;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateIssue;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateIssueComment;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateOrUpdateFile;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateRelease;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateRepo;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreateReview;
use OpenCompany\Integrations\GitHub\Tools\GitHubCreatePullRequest;
use OpenCompany\Integrations\GitHub\Tools\GitHubDispatchWorkflow;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetCommit;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetCurrentUser;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetFileContent;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetIssue;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetPullRequest;
use OpenCompany\Integrations\GitHub\Tools\GitHubGetRepo;
use OpenCompany\Integrations\GitHub\Tools\GitHubListBranches;
use OpenCompany\Integrations\GitHub\Tools\GitHubListCommits;
use OpenCompany\Integrations\GitHub\Tools\GitHubListIssues;
use OpenCompany\Integrations\GitHub\Tools\GitHubListPullRequestReviews;
use OpenCompany\Integrations\GitHub\Tools\GitHubListPullRequests;
use OpenCompany\Integrations\GitHub\Tools\GitHubListReleases;
use OpenCompany\Integrations\GitHub\Tools\GitHubListRepos;
use OpenCompany\Integrations\GitHub\Tools\GitHubListWorkflowRuns;
use OpenCompany\Integrations\GitHub\Tools\GitHubMergePullRequest;
use OpenCompany\Integrations\GitHub\Tools\GitHubSearchIssues;
use OpenCompany\Integrations\GitHub\Tools\GitHubSearchRepos;
use OpenCompany\Integrations\GitHub\Tools\GitHubUpdateIssue;
use OpenCompany\Integrations\GitHub\Tools\GitHubUpdatePullRequest;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the GitHub integration and its tools with the integration platform.
 *
 * Provides repository, issue, pull request, commit, branch, release,
 * gist, and workflow management tools via the GitHub REST API.
 */
class GitHubToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'github';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'GitHub',
            'description' => 'GitHub integration for code collaboration',
            'icon' => 'mdi:github',
            'logo' => 'mdi:github',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'GitHub',
            'description' => 'Manage repositories, issues, pull requests, commits, releases, and workflows on GitHub.',
            'icon' => 'mdi:github',
            'logo' => 'mdi:github',
            'category' => 'productivity',
            'docs_url' => 'https://docs.github.com/en/rest',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'ghp_...',
                'hint' => 'Generate a Personal Access Token at <a href="https://github.com/settings/tokens" target="_blank">GitHub Settings → Developer settings → Personal access tokens</a>. Tokens start with <code>ghp_</code>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
            ])->timeout(10)->get('https://api.github.com/user');

            if ($response->successful()) {
                $user = $response->json();
                $login = $user['login'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to GitHub as @{$login}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'GitHub API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            'github_list_repos' => [
                'class' => GitHubListRepos::class,
                'type' => 'read',
                'name' => 'List Repositories',
                'description' => 'List repositories for the authenticated user.',
                'icon' => 'mdi:source-repository',
            ],
            'github_get_repo' => [
                'class' => GitHubGetRepo::class,
                'type' => 'read',
                'name' => 'Get Repository',
                'description' => 'Get details for a specific repository.',
                'icon' => 'mdi:source-repository',
            ],
            'github_create_repo' => [
                'class' => GitHubCreateRepo::class,
                'type' => 'write',
                'name' => 'Create Repository',
                'description' => 'Create a new repository for the authenticated user.',
                'icon' => 'mdi:source-repository-plus',
            ],
            'github_search_repos' => [
                'class' => GitHubSearchRepos::class,
                'type' => 'read',
                'name' => 'Search Repositories',
                'description' => 'Search for repositories on GitHub.',
                'icon' => 'mdi:magnify',
            ],
            'github_list_issues' => [
                'class' => GitHubListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues in a repository.',
                'icon' => 'mdi:ticket-outline',
            ],
            'github_get_issue' => [
                'class' => GitHubGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get details for a specific issue.',
                'icon' => 'mdi:ticket-outline',
            ],
            'github_create_issue' => [
                'class' => GitHubCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue in a repository.',
                'icon' => 'mdi:ticket-plus-outline',
            ],
            'github_update_issue' => [
                'class' => GitHubUpdateIssue::class,
                'type' => 'write',
                'name' => 'Update Issue',
                'description' => 'Update an existing issue.',
                'icon' => 'mdi:ticket-edit-outline',
            ],
            'github_add_labels' => [
                'class' => GitHubAddLabels::class,
                'type' => 'write',
                'name' => 'Add Labels',
                'description' => 'Add labels to an issue.',
                'icon' => 'mdi:label-outline',
            ],
            'github_create_issue_comment' => [
                'class' => GitHubCreateIssueComment::class,
                'type' => 'write',
                'name' => 'Create Issue Comment',
                'description' => 'Add a comment to an issue or pull request.',
                'icon' => 'mdi:comment-plus-outline',
            ],
            'github_list_pull_requests' => [
                'class' => GitHubListPullRequests::class,
                'type' => 'read',
                'name' => 'List Pull Requests',
                'description' => 'List pull requests in a repository.',
                'icon' => 'mdi:source-merge',
            ],
            'github_get_pull_request' => [
                'class' => GitHubGetPullRequest::class,
                'type' => 'read',
                'name' => 'Get Pull Request',
                'description' => 'Get details for a specific pull request.',
                'icon' => 'mdi:source-merge',
            ],
            'github_create_pull_request' => [
                'class' => GitHubCreatePullRequest::class,
                'type' => 'write',
                'name' => 'Create Pull Request',
                'description' => 'Create a new pull request.',
                'icon' => 'mdi:source-merge',
            ],
            'github_update_pull_request' => [
                'class' => GitHubUpdatePullRequest::class,
                'type' => 'write',
                'name' => 'Update Pull Request',
                'description' => 'Update an existing pull request.',
                'icon' => 'mdi:source-merge',
            ],
            'github_merge_pull_request' => [
                'class' => GitHubMergePullRequest::class,
                'type' => 'write',
                'name' => 'Merge Pull Request',
                'description' => 'Merge a pull request.',
                'icon' => 'mdi:source-merge',
            ],
            'github_list_pull_request_reviews' => [
                'class' => GitHubListPullRequestReviews::class,
                'type' => 'read',
                'name' => 'List Pull Request Reviews',
                'description' => 'List reviews on a pull request.',
                'icon' => 'mdi:eye-outline',
            ],
            'github_create_review' => [
                'class' => GitHubCreateReview::class,
                'type' => 'write',
                'name' => 'Create Review',
                'description' => 'Create a review on a pull request.',
                'icon' => 'mdi:eye-plus-outline',
            ],
            'github_list_commits' => [
                'class' => GitHubListCommits::class,
                'type' => 'read',
                'name' => 'List Commits',
                'description' => 'List commits in a repository.',
                'icon' => 'mdi:source-commit',
            ],
            'github_get_commit' => [
                'class' => GitHubGetCommit::class,
                'type' => 'read',
                'name' => 'Get Commit',
                'description' => 'Get details for a specific commit.',
                'icon' => 'mdi:source-commit',
            ],
            'github_get_file_content' => [
                'class' => GitHubGetFileContent::class,
                'type' => 'read',
                'name' => 'Get File Content',
                'description' => 'Get the content of a file in a repository.',
                'icon' => 'mdi:file-document-outline',
            ],
            'github_create_or_update_file' => [
                'class' => GitHubCreateOrUpdateFile::class,
                'type' => 'write',
                'name' => 'Create or Update File',
                'description' => 'Create or update a file in a repository.',
                'icon' => 'mdi:file-edit-outline',
            ],
            'github_create_branch' => [
                'class' => GitHubCreateBranch::class,
                'type' => 'write',
                'name' => 'Create Branch',
                'description' => 'Create a new branch in a repository.',
                'icon' => 'mdi:source-branch',
            ],
            'github_list_branches' => [
                'class' => GitHubListBranches::class,
                'type' => 'read',
                'name' => 'List Branches',
                'description' => 'List branches in a repository.',
                'icon' => 'mdi:source-branch',
            ],
            'github_list_releases' => [
                'class' => GitHubListReleases::class,
                'type' => 'read',
                'name' => 'List Releases',
                'description' => 'List releases in a repository.',
                'icon' => 'mdi:tag-outline',
            ],
            'github_create_release' => [
                'class' => GitHubCreateRelease::class,
                'type' => 'write',
                'name' => 'Create Release',
                'description' => 'Create a new release in a repository.',
                'icon' => 'mdi:tag-plus-outline',
            ],
            'github_search_issues' => [
                'class' => GitHubSearchIssues::class,
                'type' => 'read',
                'name' => 'Search Issues',
                'description' => 'Search for issues and pull requests across GitHub.',
                'icon' => 'mdi:magnify',
            ],
            'github_get_current_user' => [
                'class' => GitHubGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'mdi:account-outline',
            ],
            'github_create_gist' => [
                'class' => GitHubCreateGist::class,
                'type' => 'write',
                'name' => 'Create Gist',
                'description' => 'Create a new GitHub gist.',
                'icon' => 'mdi:code-braces',
            ],
            'github_list_workflow_runs' => [
                'class' => GitHubListWorkflowRuns::class,
                'type' => 'read',
                'name' => 'List Workflow Runs',
                'description' => 'List GitHub Actions workflow runs for a repository.',
                'icon' => 'mdi:play-circle-outline',
            ],
            'github_dispatch_workflow' => [
                'class' => GitHubDispatchWorkflow::class,
                'type' => 'write',
                'name' => 'Dispatch Workflow',
                'description' => 'Trigger a GitHub Actions workflow run.',
                'icon' => 'mdi:play-circle-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/github.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new GitHubService(
                apiKey: $creds->get('github', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(GitHubService::class));
    }
}
