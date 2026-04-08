<?php

namespace OpenCompany\Integrations\AddEvent;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListEvents;
use OpenCompany\Integrations\AddEvent\Tools\AddEventGetEvent;
use OpenCompany\Integrations\AddEvent\Tools\AddEventCreateEvent;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListCategories;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListGroups;
use OpenCompany\Integrations\AddEvent\Tools\AddEventGetGroup;
use OpenCompany\Integrations\AddEvent\Tools\AddEventGetCurrentUser;

class AddEventToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'addevent';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'events, categories, groups',
            'description' => 'Calendar event management',
            'icon' => 'ph:calendar',
            'logo' => 'simple-icons:addevent',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'AddEvent',
            'description' => 'Calendar event management and sharing platform',
            'icon' => 'ph:calendar',
            'logo' => 'simple-icons:addevent',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.addevent.com/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your AddEvent access token',
                'hint' => 'Find your access token in your AddEvent account settings under "API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.addevent.com',
                'hint' => 'Use <code>https://api.addevent.com</code> for the default API, or a custom endpoint',
                'default' => 'https://api.addevent.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.addevent.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach AddEvent API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to AddEvent API at {$baseUrl}.",
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
            'addevent_list_events' => [
                'class' => AddEventListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List calendar events with optional pagination and category filtering.',
                'icon' => 'ph:calendar',
            ],
            'addevent_get_event' => [
                'class' => AddEventGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get details for a specific event.',
                'icon' => 'ph:calendar',
            ],
            'addevent_create_event' => [
                'class' => AddEventCreateEvent::class,
                'type' => 'write',
                'name' => 'Create Event',
                'description' => 'Create a new calendar event.',
                'icon' => 'ph:calendar-plus',
            ],
            'addevent_list_categories' => [
                'class' => AddEventListCategories::class,
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List all event categories.',
                'icon' => 'ph:folders',
            ],
            'addevent_list_groups' => [
                'class' => AddEventListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List event groups with optional pagination.',
                'icon' => 'ph:users',
            ],
            'addevent_get_group' => [
                'class' => AddEventGetGroup::class,
                'type' => 'read',
                'name' => 'Get Group',
                'description' => 'Get details for a specific group.',
                'icon' => 'ph:users',
            ],
            'addevent_get_current_user' => [
                'class' => AddEventGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/addevent.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.addevent.com'],
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

            $service = new AddEventService(
                accessToken: $creds->get('addevent', 'access_token', '', $account),
                baseUrl: $creds->get('addevent', 'url', 'https://api.addevent.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AddEventService::class));
    }
}
