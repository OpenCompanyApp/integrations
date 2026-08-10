<?php

namespace OpenCompany\Integrations\Buffer;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Buffer\Tools\BufferCreateUpdate;
use OpenCompany\Integrations\Buffer\Tools\BufferDeauthorizeUser;
use OpenCompany\Integrations\Buffer\Tools\BufferDestroyUpdate;
use OpenCompany\Integrations\Buffer\Tools\BufferGetCurrentUser;
use OpenCompany\Integrations\Buffer\Tools\BufferGetInfoConfiguration;
use OpenCompany\Integrations\Buffer\Tools\BufferGetLinkShares;
use OpenCompany\Integrations\Buffer\Tools\BufferGetProfile;
use OpenCompany\Integrations\Buffer\Tools\BufferGetUpdate;
use OpenCompany\Integrations\Buffer\Tools\BufferGraphql;
use OpenCompany\Integrations\Buffer\Tools\BufferListPendingUpdates;
use OpenCompany\Integrations\Buffer\Tools\BufferListProfileSchedules;
use OpenCompany\Integrations\Buffer\Tools\BufferListProfiles;
use OpenCompany\Integrations\Buffer\Tools\BufferListSentUpdates;
use OpenCompany\Integrations\Buffer\Tools\BufferMoveUpdateToTop;
use OpenCompany\Integrations\Buffer\Tools\BufferReorderUpdates;
use OpenCompany\Integrations\Buffer\Tools\BufferShareUpdate;
use OpenCompany\Integrations\Buffer\Tools\BufferShuffleUpdates;
use OpenCompany\Integrations\Buffer\Tools\BufferUpdateProfileSchedules;
use OpenCompany\Integrations\Buffer\Tools\BufferUpdateUpdate;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Tool catalog and configuration metadata for Buffer.
 *
 * Exposes documented Buffer REST operations and a GraphQL operation surface
 * for the current beta API.
 */
class BufferToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'buffer';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Buffer',
            'description' => 'Social media management',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:buffer',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Buffer',
            'description' => 'Social media management platform - schedule posts, manage social profiles, review content, and call the current GraphQL API.',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:buffer',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.buffer.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Buffer access token',
                'hint' => 'Generate an access token from the Buffer developer portal or via OAuth 2.0',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.bufferapp.com/1',
                'hint' => 'Use <code>https://api.bufferapp.com/1</code> for the standard API, or a custom URL if applicable',
                'default' => 'https://api.bufferapp.com/1',
            ],
            [
                'key' => 'graphql_url',
                'type' => 'url',
                'label' => 'GraphQL API URL',
                'placeholder' => 'https://api.buffer.com',
                'hint' => 'Use <code>https://api.buffer.com</code> for the current Buffer GraphQL API.',
                'default' => 'https://api.buffer.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.bufferapp.com/1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user.json');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Buffer API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Buffer API returned an error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = trim(($json['name'] ?? '') . ' ' . ($json['email'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Buffer API" . ($name ? " as {$name}" : '') . ".",
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
            'graphql_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'buffer_list_profiles' => [
                'class' => BufferListProfiles::class,
                'type' => 'read',
                'name' => 'List Profiles',
                'description' => 'List all social media profiles connected to Buffer.',
                'icon' => 'ph:users',
            ],
            'buffer_get_profile' => [
                'class' => BufferGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get details of a specific social profile.',
                'icon' => 'ph:user',
            ],
            'buffer_list_profile_schedules' => [
                'class' => BufferListProfileSchedules::class,
                'type' => 'read',
                'name' => 'List Profile Schedules',
                'description' => 'List posting schedules for a social profile.',
                'icon' => 'ph:calendar',
            ],
            'buffer_update_profile_schedules' => [
                'class' => BufferUpdateProfileSchedules::class,
                'type' => 'write',
                'name' => 'Update Profile Schedules',
                'description' => 'Replace posting schedules for a social profile.',
                'icon' => 'ph:calendar-check',
            ],
            'buffer_list_pending_updates' => [
                'class' => BufferListPendingUpdates::class,
                'type' => 'read',
                'name' => 'List Pending Updates',
                'description' => 'List scheduled (pending) updates for a profile.',
                'icon' => 'ph:clock',
            ],
            'buffer_create_update' => [
                'class' => BufferCreateUpdate::class,
                'type' => 'write',
                'name' => 'Create Update',
                'description' => 'Create and schedule a new social media update.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'buffer_list_sent_updates' => [
                'class' => BufferListSentUpdates::class,
                'type' => 'read',
                'name' => 'List Sent Updates',
                'description' => 'List already posted (sent) updates for a profile.',
                'icon' => 'ph:check-circle',
            ],
            'buffer_get_update' => [
                'class' => BufferGetUpdate::class,
                'type' => 'read',
                'name' => 'Get Update',
                'description' => 'Get details of a specific update.',
                'icon' => 'ph:article',
            ],
            'buffer_reorder_updates' => [
                'class' => BufferReorderUpdates::class,
                'type' => 'write',
                'name' => 'Reorder Updates',
                'description' => 'Reorder pending updates for a profile.',
                'icon' => 'ph:sort-ascending',
            ],
            'buffer_shuffle_updates' => [
                'class' => BufferShuffleUpdates::class,
                'type' => 'write',
                'name' => 'Shuffle Updates',
                'description' => 'Randomize pending updates for a profile.',
                'icon' => 'ph:shuffle',
            ],
            'buffer_update_update' => [
                'class' => BufferUpdateUpdate::class,
                'type' => 'write',
                'name' => 'Update Update',
                'description' => 'Edit an existing pending update.',
                'icon' => 'ph:pencil',
            ],
            'buffer_share_update' => [
                'class' => BufferShareUpdate::class,
                'type' => 'write',
                'name' => 'Share Update',
                'description' => 'Immediately share a pending update.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'buffer_destroy_update' => [
                'class' => BufferDestroyUpdate::class,
                'type' => 'write',
                'name' => 'Destroy Update',
                'description' => 'Permanently delete a pending update.',
                'icon' => 'ph:trash',
            ],
            'buffer_move_update_to_top' => [
                'class' => BufferMoveUpdateToTop::class,
                'type' => 'write',
                'name' => 'Move Update To Top',
                'description' => 'Move a pending update to the top of the queue.',
                'icon' => 'ph:arrow-up',
            ],
            'buffer_get_link_shares' => [
                'class' => BufferGetLinkShares::class,
                'type' => 'read',
                'name' => 'Get Link Shares',
                'description' => 'Get Buffer share count for a URL.',
                'icon' => 'ph:link',
            ],
            'buffer_get_info_configuration' => [
                'class' => BufferGetInfoConfiguration::class,
                'type' => 'read',
                'name' => 'Get Info Configuration',
                'description' => 'Get Buffer API service, limit, media, and analytics metadata.',
                'icon' => 'ph:gear',
            ],
            'buffer_deauthorize_user' => [
                'class' => BufferDeauthorizeUser::class,
                'type' => 'write',
                'name' => 'Deauthorize User',
                'description' => 'Deauthorize the current Buffer API token.',
                'icon' => 'ph:sign-out',
            ],
            'buffer_graphql' => [
                'class' => BufferGraphql::class,
                'type' => 'write',
                'name' => 'GraphQL Operation',
                'description' => 'Execute a current Buffer GraphQL API query or mutation.',
                'icon' => 'ph:graph',
            ],
            'buffer_get_current_user' => [
                'class' => BufferGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/buffer.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.bufferapp.com/1'],
            ['key' => 'graphql_url', 'type' => 'url', 'label' => 'GraphQL API URL', 'required' => false, 'default' => 'https://api.buffer.com'],
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
            $creds = app(CredentialResolver::class);

            $service = new BufferService(
                accessToken: $creds->get('buffer', 'access_token', '', $account),
                baseUrl: $creds->get('buffer', 'url', 'https://api.bufferapp.com/1', $account),
                graphqlUrl: $creds->get('buffer', 'graphql_url', 'https://api.buffer.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(BufferService::class));
    }
}
