<?php

namespace OpenCompany\Integrations\Hootsuite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteListMessages;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteGetMessage;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteCreateMessage;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteListSocialProfiles;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteGetSocialProfile;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteListMembers;
use OpenCompany\Integrations\Hootsuite\Tools\HootsuiteGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class HootsuiteToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'hootsuite';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Hootsuite',
            'description' => 'Social media management',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:hootsuite',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hootsuite',
            'description' => 'Social media management platform — schedule posts, manage social profiles, and coordinate team members.',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:hootsuite',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.hootsuite.com/docs/api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Hootsuite access token',
                'hint' => 'Generate an access token from the Hootsuite Developer portal or via OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://platform.hootsuite.com',
                'hint' => 'Use <code>https://platform.hootsuite.com</code> for the standard API, or a custom URL if applicable',
                'default' => 'https://platform.hootsuite.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://platform.hootsuite.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/members/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Hootsuite API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Hootsuite API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = trim(($json['data']['firstName'] ?? '') . ' ' . ($json['data']['lastName'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Hootsuite API" . ($name ? " as {$name}" : '') . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'hootsuite_list_messages' => [
                'class' => HootsuiteListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List scheduled and past messages.',
                'icon' => 'ph:envelope',
            ],
            'hootsuite_get_message' => [
                'class' => HootsuiteGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific message.',
                'icon' => 'ph:envelope-open',
            ],
            'hootsuite_create_message' => [
                'class' => HootsuiteCreateMessage::class,
                'type' => 'write',
                'name' => 'Create Message',
                'description' => 'Schedule a new social media message.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'hootsuite_list_social_profiles' => [
                'class' => HootsuiteListSocialProfiles::class,
                'type' => 'read',
                'name' => 'List Social Profiles',
                'description' => 'List connected social media profiles.',
                'icon' => 'ph:users',
            ],
            'hootsuite_get_social_profile' => [
                'class' => HootsuiteGetSocialProfile::class,
                'type' => 'read',
                'name' => 'Get Social Profile',
                'description' => 'Get details of a specific social profile.',
                'icon' => 'ph:user',
            ],
            'hootsuite_list_members' => [
                'class' => HootsuiteListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List organization members.',
                'icon' => 'ph:users-three',
            ],
            'hootsuite_get_current_user' => [
                'class' => HootsuiteGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/hootsuite.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://platform.hootsuite.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new HootsuiteService(
                accessToken: $creds->get('hootsuite', 'access_token', '', $account),
                baseUrl: $creds->get('hootsuite', 'url', 'https://platform.hootsuite.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(HootsuiteService::class));
    }
}
