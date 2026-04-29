<?php

namespace OpenCompany\Integrations\Fellow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fellow\Tools\FellowListMeetings;
use OpenCompany\Integrations\Fellow\Tools\FellowGetMeeting;
use OpenCompany\Integrations\Fellow\Tools\FellowCreateNote;
use OpenCompany\Integrations\Fellow\Tools\FellowListActionItems;
use OpenCompany\Integrations\Fellow\Tools\FellowListGoals;
use OpenCompany\Integrations\Fellow\Tools\FellowGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FellowToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Return the machine name for this integration.
     */
    public function appName(): string
    {
        return 'fellow';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Fellow',
            'description' => 'Fellow meeting management integration for Laravel — list meetings, manage notes…',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Fellow',
            'description' => 'Fellow meeting management integration for Laravel — list meetings, manage notes, action items, and goals.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Return the configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Fellow API access token',
                'hint' => 'Generate an access token in your Fellow account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.fellow.app/v2',
                'hint' => 'Override only if using a custom Fellow instance',
                'default' => 'https://api.fellow.app/v2',
            ],
        ];
    }

    /**
     * Test the connection to the Fellow API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.fellow.app/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to Fellow API as {$name}.",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Fellow API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Return validation rules for the integration configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'fellow_list_meetings' => [
                'class' => FellowListMeetings::class,
                'type' => 'read',
                'name' => 'List Meetings',
                'description' => 'List meetings with optional date filters and pagination.',
                'icon' => 'ph:calendar',
            ],
            'fellow_get_meeting' => [
                'class' => FellowGetMeeting::class,
                'type' => 'read',
                'name' => 'Get Meeting',
                'description' => 'Get details of a specific meeting.',
                'icon' => 'ph:calendar-check',
            ],
            'fellow_create_note' => [
                'class' => FellowCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Create a note for a specific meeting.',
                'icon' => 'ph:note-pencil',
            ],
            'fellow_list_action_items' => [
                'class' => FellowListActionItems::class,
                'type' => 'read',
                'name' => 'List Action Items',
                'description' => 'List action items with pagination.',
                'icon' => 'ph:check-square',
            ],
            'fellow_list_goals' => [
                'class' => FellowListGoals::class,
                'type' => 'read',
                'name' => 'List Goals',
                'description' => 'List goals from Fellow.',
                'icon' => 'ph:target',
            ],
            'fellow_get_current_user' => [
                'class' => FellowGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Fellow user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Return the path to the Lua API docs file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fellow.md';
    }

    /**
     * Return the credential fields for the integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.fellow.app/v2'],
        ];
    }

    /**
     * Confirm this is a registered integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific context.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FellowService(
                accessToken: $creds->get('fellow', 'access_token', '', $account),
                baseUrl: $creds->get('fellow', 'url', 'https://api.fellow.app/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(FellowService::class));
    }
}
