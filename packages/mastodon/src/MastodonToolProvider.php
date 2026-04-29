<?php

namespace OpenCompany\Integrations\Mastodon;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mastodon\Tools\MastodonListStatuses;
use OpenCompany\Integrations\Mastodon\Tools\MastodonGetStatus;
use OpenCompany\Integrations\Mastodon\Tools\MastodonCreateStatus;
use OpenCompany\Integrations\Mastodon\Tools\MastodonListAccounts;
use OpenCompany\Integrations\Mastodon\Tools\MastodonGetAccount;
use OpenCompany\Integrations\Mastodon\Tools\MastodonGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * MastodonToolProvider — registers Mastodon tools with the integration core.
 *
 * Implements ConfigurableIntegration for multi-account support, configuration
 * schema, connection testing, and credential field definitions.
 */
class MastodonToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'mastodon';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mastodon',
            'description' => 'Social networking',
            'icon' => 'ph:mastodon-logo',
            'logo' => 'simple-icons:mastodon',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mastodon',
            'description' => 'Decentralized social networking — post statuses, browse timelines, and manage accounts.',
            'icon' => 'ph:mastodon-logo',
            'logo' => 'simple-icons:mastodon',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://docs.joinmastodon.org/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Mastodon access token',
                'hint' => 'Create an access token in your Mastodon account under Settings → Development → New Application',
                'required' => true,
            ],
            [
                'key' => 'instance_url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://mastodon.social',
                'hint' => 'The base URL of your Mastodon instance (e.g., <code>https://mastodon.social</code>)',
                'default' => 'https://mastodon.social',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['instance_url'] ?? 'https://mastodon.social', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/accounts/verify_credentials');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Mastodon API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Mastodon API error ({$response->status()}): {$error}",
                ];
            }

            $username = $json['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Mastodon as @{$username} on " . parse_url($baseUrl, PHP_URL_HOST) . ".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'instance_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'mastodon_list_statuses' => [
                'class' => MastodonListStatuses::class,
                'type' => 'read',
                'name' => 'List Statuses',
                'description' => 'Browse statuses from a timeline (home, local, public).',
                'icon' => 'ph:list',
            ],
            'mastodon_get_status' => [
                'class' => MastodonGetStatus::class,
                'type' => 'read',
                'name' => 'Get Status',
                'description' => 'Retrieve a single status (toot) by ID.',
                'icon' => 'ph:chat-circle-text',
            ],
            'mastodon_create_status' => [
                'class' => MastodonCreateStatus::class,
                'type' => 'write',
                'name' => 'Create Status',
                'description' => 'Publish a new status (toot) on Mastodon.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mastodon_list_accounts' => [
                'class' => MastodonListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List followers of a Mastodon account.',
                'icon' => 'ph:users',
            ],
            'mastodon_get_account' => [
                'class' => MastodonGetAccount::class,
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Retrieve a Mastodon account profile by ID.',
                'icon' => 'ph:user-circle',
            ],
            'mastodon_get_current_user' => [
                'class' => MastodonGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s Mastodon profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mastodon.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'instance_url', 'type' => 'url', 'label' => 'Instance URL', 'required' => false, 'default' => 'https://mastodon.social'],
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

            $service = new MastodonService(
                accessToken: $creds->get('mastodon', 'access_token', '', $account),
                baseUrl: $creds->get('mastodon', 'instance_url', 'https://mastodon.social', $account),
            );

            return new $class($service);
        }

        return new $class(app(MastodonService::class));
    }
}
