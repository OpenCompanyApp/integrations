<?php

namespace OpenCompany\Integrations\Klaviyo;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoCreateEvent;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoCreateList;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoCreateProfile;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoGetEvent;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoGetFlow;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoGetList;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoGetProfile;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoListCampaigns;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoListEvents;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoListFlows;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoListListProfiles;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoListLists;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoListProfiles;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoSubscribeProfile;
use OpenCompany\Integrations\Klaviyo\Tools\KlaviyoUpdateProfile;

/**
 * Registers all Klaviyo tools and provides integration metadata, configuration schema, and connection testing.
 */
class KlaviyoToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'klaviyo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Klaviyo',
            'description' => 'Email & SMS marketing platform — manage profiles, events, lists, flows, and campaigns.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:klaviyo',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Klaviyo',
            'description' => 'Connect Klaviyo to manage profiles, track events, build lists, and automate flows.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:klaviyo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.klaviyo.com/en/reference/api_overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'name' => 'api_key',
                'label' => 'Private API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Klaviyo private API key.',
                'placeholder' => 'pk_live_xxxxxxxxxxxxxxxxxx',
            ],
        ];
    }

    /** @param array<string, mixed> $config */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = $config['api_key'] ?? '';
            $service = new KlaviyoService(apiKey: $apiKey);

            if (! $service->isConfigured()) {
                return [
                    'success' => false,
                    'error' => 'Klaviyo API key is not configured.',
                ];
            }

            $result = $service->getAccount();
            $data = $result['data'][0] ?? $result['data'] ?? [];

            return [
                'success' => true,
                'message' => sprintf(
                    'Connected to Klaviyo account "%s".',
                    $data['attributes']['name'] ?? $data['id'] ?? 'Unknown',
                ),
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'klaviyo_create_profile' => [
                'class' => KlaviyoCreateProfile::class,
                'type' => 'write',
                'name' => 'Create Profile',
                'description' => 'Create a new Klaviyo profile.',
                'icon' => 'ph:user-plus',
            ],
            'klaviyo_get_profile' => [
                'class' => KlaviyoGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get a single Klaviyo profile by ID.',
                'icon' => 'ph:user',
            ],
            'klaviyo_update_profile' => [
                'class' => KlaviyoUpdateProfile::class,
                'type' => 'write',
                'name' => 'Update Profile',
                'description' => 'Update an existing Klaviyo profile.',
                'icon' => 'ph:pencil-simple',
            ],
            'klaviyo_list_profiles' => [
                'class' => KlaviyoListProfiles::class,
                'type' => 'read',
                'name' => 'List Profiles',
                'description' => 'List Klaviyo profiles with cursor-based pagination.',
                'icon' => 'ph:users',
            ],
            'klaviyo_subscribe_profile' => [
                'class' => KlaviyoSubscribeProfile::class,
                'type' => 'write',
                'name' => 'Subscribe Profile',
                'description' => 'Subscribe a profile to a Klaviyo list.',
                'icon' => 'ph:envelope',
            ],
            'klaviyo_create_event' => [
                'class' => KlaviyoCreateEvent::class,
                'type' => 'write',
                'name' => 'Create Event',
                'description' => 'Track a new event for a Klaviyo profile.',
                'icon' => 'ph:lightning',
            ],
            'klaviyo_get_event' => [
                'class' => KlaviyoGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get a single Klaviyo event by ID.',
                'icon' => 'ph:lightning',
            ],
            'klaviyo_list_events' => [
                'class' => KlaviyoListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List Klaviyo events with optional filtering.',
                'icon' => 'ph:lightning',
            ],
            'klaviyo_list_lists' => [
                'class' => KlaviyoListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all Klaviyo lists.',
                'icon' => 'ph:folder',
            ],
            'klaviyo_create_list' => [
                'class' => KlaviyoCreateList::class,
                'type' => 'write',
                'name' => 'Create List',
                'description' => 'Create a new Klaviyo list.',
                'icon' => 'ph:folder-plus',
            ],
            'klaviyo_get_list' => [
                'class' => KlaviyoGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get a single Klaviyo list by ID.',
                'icon' => 'ph:folder',
            ],
            'klaviyo_list_list_profiles' => [
                'class' => KlaviyoListListProfiles::class,
                'type' => 'read',
                'name' => 'List List Profiles',
                'description' => 'List profiles that belong to a specific Klaviyo list.',
                'icon' => 'ph:users',
            ],
            'klaviyo_list_flows' => [
                'class' => KlaviyoListFlows::class,
                'type' => 'read',
                'name' => 'List Flows',
                'description' => 'List all Klaviyo flows.',
                'icon' => 'ph:flow-arrow',
            ],
            'klaviyo_get_flow' => [
                'class' => KlaviyoGetFlow::class,
                'type' => 'read',
                'name' => 'Get Flow',
                'description' => 'Get a single Klaviyo flow by ID.',
                'icon' => 'ph:flow-arrow',
            ],
            'klaviyo_list_campaigns' => [
                'class' => KlaviyoListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List all Klaviyo campaigns.',
                'icon' => 'ph:envelope',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/klaviyo.md';
    }

    public function credentialFields(): array
    {
        return [
            'api_key' => [
                'label' => 'Private API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Klaviyo private API key.',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): KlaviyoService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new KlaviyoService(
                apiKey: $creds->get('klaviyo', 'api_key', '', $account),
            );
        }

        return app(KlaviyoService::class);
    }
}
