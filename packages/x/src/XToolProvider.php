<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\X\Tools\XCreateTweet;
use OpenCompany\Integrations\X\Tools\XGetCurrentUser;
use OpenCompany\Integrations\X\Tools\XGetTweet;
use OpenCompany\Integrations\X\Tools\XGetUser;
use OpenCompany\Integrations\X\Tools\XGetUserByUsername;
use OpenCompany\Integrations\X\Tools\XListTweets;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class XToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'x';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Twitter / X',
            'description' => 'Social media',
            'icon' => 'ph:twitter-logo',
            'logo' => 'simple-icons:x',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Twitter / X',
            'description' => 'Read and post tweets, look up user profiles via the Twitter API v2',
            'icon' => 'ph:twitter-logo',
            'logo' => 'simple-icons:x',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://developer.x.com/en/docs/twitter-api',
        ];
    }public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.twitter.com/2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param class-string<Tool> $class Fully-qualified tool class name
     * @param array<string, mixed> $context Runtime context (may include 'account' key)
     */
    public function createTool(string $class, array $context = []): Tool
    {        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the XService, with optional account-specific credentials.
     *
     * When `$context['account']` is set, creates a fresh service with that
     * account's credentials. Otherwise falls back to the container singleton.
     *
     * @param array<string, mixed> $context Runtime context
     */
    private function resolveService(array $context = []): XService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new XService(
                accessToken: $creds->get('x', 'access_token', '', $account),
                baseUrl: $creds->get('x', 'base_url', 'https://api.twitter.com/2', $account),
            );
        }

        return app(XService::class);
    }
}
