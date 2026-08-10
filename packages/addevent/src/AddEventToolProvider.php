<?php

namespace OpenCompany\Integrations\AddEvent;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AddEvent\Tools\AddEventCreateCalendar;
use OpenCompany\Integrations\AddEvent\Tools\AddEventCreateEvent;
use OpenCompany\Integrations\AddEvent\Tools\AddEventDeleteEvent;
use OpenCompany\Integrations\AddEvent\Tools\AddEventGetCalendar;
use OpenCompany\Integrations\AddEvent\Tools\AddEventGetEvent;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListCalendars;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListEvents;
use OpenCompany\Integrations\AddEvent\Tools\AddEventListTimezones;
use OpenCompany\Integrations\AddEvent\Tools\AddEventUpdateEvent;

/**
 * Tool catalog and configuration metadata for AddEvent.
 *
 * Exposes the AddEvent Calendar and Events API v2 for event and calendar
 * management.
 */
class AddEventToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['AddEvent API keys are sent as Authorization: Bearer <apiKey>.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
        return 'addevent';
    }

    /**
     * Get short metadata describing the integration.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'AddEvent',
            'description' => 'Calendar and event management',
            'icon' => 'ph:calendar',
            'logo' => 'simple-icons:addevent',
        ];
    }

    /**
     * Get full integration metadata for discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'AddEvent',
            'description' => 'Create, search, retrieve, update, and delete AddEvent calendars and events.',
            'icon' => 'ph:calendar',
            'logo' => 'simple-icons:addevent',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.addevent.com/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'AddEvent API key',
                'hint' => 'Find the API token in your AddEvent account settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.addevent.com/calevent/v2',
                'hint' => 'Calendar and Events API v2 base URL.',
                'default' => 'https://api.addevent.com/calevent/v2',
            ],
        ];
    }

    /**
     * Test AddEvent credentials against the search events endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = $this->normalizeBaseUrl((string) ($config['url'] ?? 'https://api.addevent.com/calevent/v2'));

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No AddEvent API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/events', ['page_size' => 1]);

            if (! $response->successful()) {
                return ['success' => false, 'error' => 'AddEvent API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => 'Connected to AddEvent Calendar and Events API v2.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'addevent_list_events' => [
                'class' => AddEventListEvents::class,
                'type' => 'read',
                'name' => 'Search Events',
                'description' => 'Search events created in AddEvent.',
                'icon' => 'ph:calendar',
            ],
            'addevent_get_event' => [
                'class' => AddEventGetEvent::class,
                'type' => 'read',
                'name' => 'Retrieve Event',
                'description' => 'Retrieve a specific AddEvent event.',
                'icon' => 'ph:calendar',
            ],
            'addevent_create_event' => [
                'class' => AddEventCreateEvent::class,
                'type' => 'write',
                'name' => 'Create Event',
                'description' => 'Create a new AddEvent event.',
                'icon' => 'ph:calendar-plus',
            ],
            'addevent_update_event' => [
                'class' => AddEventUpdateEvent::class,
                'type' => 'write',
                'name' => 'Update Event',
                'description' => 'Patch an existing AddEvent event.',
                'icon' => 'ph:pencil-simple',
            ],
            'addevent_delete_event' => [
                'class' => AddEventDeleteEvent::class,
                'type' => 'write',
                'name' => 'Delete Event',
                'description' => 'Delete an AddEvent event.',
                'icon' => 'ph:trash',
            ],
            'addevent_list_calendars' => [
                'class' => AddEventListCalendars::class,
                'type' => 'read',
                'name' => 'Search Calendars',
                'description' => 'Search AddEvent calendars.',
                'icon' => 'ph:calendar-dots',
            ],
            'addevent_get_calendar' => [
                'class' => AddEventGetCalendar::class,
                'type' => 'read',
                'name' => 'Retrieve Calendar',
                'description' => 'Retrieve a specific AddEvent calendar.',
                'icon' => 'ph:calendar-dots',
            ],
            'addevent_create_calendar' => [
                'class' => AddEventCreateCalendar::class,
                'type' => 'write',
                'name' => 'Create Calendar',
                'description' => 'Create a new AddEvent calendar.',
                'icon' => 'ph:calendar-plus',
            ],
            'addevent_list_timezones' => [
                'class' => AddEventListTimezones::class,
                'type' => 'read',
                'name' => 'List Timezones',
                'description' => 'List timezones supported by AddEvent.',
                'icon' => 'ph:globe',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/addevent.md';
    }

    /**
     * Get credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.addevent.com/calevent/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new AddEventService(
                accessToken: $creds->get('addevent', 'access_token', '', $account),
                baseUrl: $creds->get('addevent', 'url', 'https://api.addevent.com/calevent/v2', $account),
            ));
        }

        return new $class(app(AddEventService::class));
    }

    /**
     * Normalize root and legacy API URLs to the v2 Calendar and Events base URL.
     */
    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');

        return str_ends_with($baseUrl, '/calevent/v2') ? $baseUrl : $baseUrl . '/calevent/v2';
    }
}
