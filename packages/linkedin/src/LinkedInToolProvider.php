<?php

namespace OpenCompany\Integrations\LinkedIn;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInCreatePost;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInGetCurrentUser;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInGetOrganization;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInGetProfile;
use OpenCompany\Integrations\LinkedIn\Tools\LinkedInListConnections;

/**
 * Tool provider for the LinkedIn integration.
 *
 * Implements ConfigurableIntegration for multi-account support and provides
 * configuration schema, connection testing, and tool instantiation.
 */
class LinkedInToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'linkedin';
    }

    /**
     * Get metadata for the app display in the integration marketplace.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'profile, connections, posts, organizations',
            'description' => 'Professional social network',
            'icon' => 'ph:linkedin-logo',
            'logo' => 'simple-icons:linkedin',
        ];
    }

    /**
     * Get integration metadata for display and categorization.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'LinkedIn',
            'description' => 'Professional networking and social media platform',
            'icon' => 'ph:linkedin-logo',
            'logo' => 'simple-icons:linkedin',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://learn.microsoft.com/en-us/linkedin/shared/api-guide/concepts',
        ];
    }

    /**
     * Get the configuration schema for LinkedIn integration setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your LinkedIn OAuth2 access token',
                'hint' => 'Generate an access token via LinkedIn OAuth2 with the required scopes (r_liteprofile, r_emailaddress, w_member_social, r_organization_social)',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.linkedin.com/v2',
                'hint' => 'Use <code>https://api.linkedin.com/v2</code> for the standard LinkedIn API',
                'default' => 'https://api.linkedin.com/v2',
            ],
        ];
    }

    /**
     * Test the LinkedIn API connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config  The configuration to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.linkedin.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach LinkedIn API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            $firstName = $json['localizedFirstName'] ?? 'User';
            $lastName = $json['localizedLastName'] ?? '';

            return [
                'success' => true,
                'message' => "Connected to LinkedIn as {$firstName} {$lastName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the LinkedIn configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of available LinkedIn tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'linkedin_get_profile' => [
                'class' => LinkedInGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => "Get the authenticated user's LinkedIn profile.",
                'icon' => 'ph:user',
            ],
            'linkedin_get_current_user' => [
                'class' => LinkedInGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => "Get the authenticated user's LinkedIn identity and basic info.",
                'icon' => 'ph:identification-card',
            ],
            'linkedin_list_connections' => [
                'class' => LinkedInListConnections::class,
                'type' => 'read',
                'name' => 'List Connections',
                'description' => "List the authenticated user's 1st-degree connections.",
                'icon' => 'ph:users',
            ],
            'linkedin_create_post' => [
                'class' => LinkedInCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a post on behalf of the authenticated LinkedIn user.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'linkedin_get_organization' => [
                'class' => LinkedInGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => "Get a LinkedIn organization's details by ID.",
                'icon' => 'ph:buildings',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/linkedin.md';
    }

    /**
     * Get the credential fields for the LinkedIn integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'LinkedIn API URL', 'required' => false, 'default' => 'https://api.linkedin.com/v2'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new LinkedInService(
                accessToken: $creds->get('linkedin', 'access_token', '', $account),
                baseUrl: $creds->get('linkedin', 'url', 'https://api.linkedin.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(LinkedInService::class));
    }
}
