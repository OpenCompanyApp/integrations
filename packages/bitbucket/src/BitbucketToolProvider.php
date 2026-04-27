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
    }public function credentialFields(): array
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
