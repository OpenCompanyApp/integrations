<?php

namespace OpenCompany\Integrations\Linkedin;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinListPosts;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinGetPost;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinCreatePost;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinListOrganizations;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinGetOrganization;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinListAdAccounts;
use OpenCompany\Integrations\Linkedin\Tools\LinkedinGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all LinkedIn tools and provides integration metadata, configuration schema, and connection testing.
 */
class LinkedinToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'linkedin';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'LinkedIn',
            'description' => 'Professional networking and marketing platform',
            'icon' => 'ph:linkedin-logo',
            'logo' => 'simple-icons:linkedin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'LinkedIn',
            'description' => 'Professional networking platform – posts, organizations, and ad accounts',
            'icon' => 'ph:linkedin-logo',
            'logo' => 'simple-icons:linkedin',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/linkedin/marketing/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'AQV...',
                'hint' => 'LinkedIn OAuth 2.0 access token with marketing permissions. Generate via LinkedIn Developer Portal.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.linkedin.com/v2',
                'hint' => 'Override only if using a custom LinkedIn API endpoint. Defaults to <code>https://api.linkedin.com/v2</code>.',
                'default' => 'https://api.linkedin.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.linkedin.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate one via LinkedIn Developer Portal.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $localized = $data['localizedFirstName'] ?? $data['firstName'] ?? '';
                $localizedLast = $data['localizedLastName'] ?? $data['lastName'] ?? '';
                $name = trim($localized . ' ' . $localizedLast);

                return [
                    'success' => true,
                    'message' => "Connected to LinkedIn as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $body['error_description'] ?? $body['error'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'LinkedIn API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Posts
            'linkedin_list_posts' => [
                'class' => LinkedinListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List LinkedIn UGC posts for an author.',
                'icon' => 'ph:list',
            ],
            'linkedin_get_post' => [
                'class' => LinkedinGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Retrieve a LinkedIn UGC post by ID.',
                'icon' => 'ph:article',
            ],
            'linkedin_create_post' => [
                'class' => LinkedinCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new LinkedIn UGC post.',
                'icon' => 'ph:pen',
            ],
            // Organizations
            'linkedin_list_organizations' => [
                'class' => LinkedinListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List LinkedIn organizations (company pages) the user has access to.',
                'icon' => 'ph:buildings',
            ],
            'linkedin_get_organization' => [
                'class' => LinkedinGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Retrieve a LinkedIn organization by ID.',
                'icon' => 'ph:building-office',
            ],
            // Ad Accounts
            'linkedin_list_ad_accounts' => [
                'class' => LinkedinListAdAccounts::class,
                'type' => 'read',
                'name' => 'List Ad Accounts',
                'description' => 'List LinkedIn ad accounts.',
                'icon' => 'ph:megaphone',
            ],
            'linkedin_get_current_user' => [
                'class' => LinkedinGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated LinkedIn user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/linkedin.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.linkedin.com/v2'],
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
     * Resolve the LinkedinService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): LinkedinService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new LinkedinService(
                accessToken: $creds->get('linkedin', 'access_token', '', $account),
                baseUrl: $creds->get('linkedin', 'base_url', 'https://api.linkedin.com/v2', $account),
            );
        }

        return app(LinkedinService::class);
    }
}
