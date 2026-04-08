<?php

namespace OpenCompany\Integrations\Eventbrite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteListEvents;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteGetEvent;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteCreateEvent;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteUpdateEvent;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteListAttendees;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteGetAttendee;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteListVenues;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteCreateVenue;
use OpenCompany\Integrations\Eventbrite\Tools\EventbriteGetCurrentUser;

class EventbriteToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The integration app name identifier.
     */
    public function appName(): string
    {
        return 'eventbrite';
    }

    /**
     * Short metadata for tool listings and menus.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'events, attendees, venues',
            'description' => 'Event management',
            'icon' => 'ph:ticket',
            'logo' => 'simple-icons:eventbrite',
        ];
    }

    /**
     * Full integration metadata for the integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Eventbrite',
            'description' => 'Event management and ticketing platform',
            'icon' => 'ph:ticket',
            'logo' => 'simple-icons:eventbrite',
            'category' => 'events',
            'badge' => 'verified',
            'docs_url' => 'https://www.eventbrite.com/platform/api',
        ];
    }

    /**
     * Configuration schema for the integrations UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'token',
                'type' => 'secret',
                'label' => 'Private Token',
                'placeholder' => 'Enter your Eventbrite private token',
                'hint' => 'Generate a private token in your Eventbrite account under "Account Settings > Developer Links > API Keys"',
                'required' => true,
            ],
            [
                'key' => 'organization_id',
                'type' => 'text',
                'label' => 'Organization ID',
                'placeholder' => 'e.g. 1234567890',
                'hint' => 'Your Eventbrite organization ID. Find it in the URL when viewing your organization dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.eventbriteapi.com/v3',
                'hint' => 'Override only if using an Eventbrite-compatible API.',
                'default' => 'https://www.eventbriteapi.com/v3',
            ],
        ];
    }

    /**
     * Test the connection to the Eventbrite API.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $token = $config['token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.eventbriteapi.com/v3', '/');

        if (empty($token)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me/');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Eventbrite API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Eventbrite API as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'token' => 'nullable|string',
            'organization_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available tools with metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'eventbrite_list_events' => [
                'class' => EventbriteListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events for the organization.',
                'icon' => 'ph:calendar',
            ],
            'eventbrite_get_event' => [
                'class' => EventbriteGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get full details for a single event.',
                'icon' => 'ph:calendar-dots',
            ],
            'eventbrite_create_event' => [
                'class' => EventbriteCreateEvent::class,
                'type' => 'write',
                'name' => 'Create Event',
                'description' => 'Create a new event.',
                'icon' => 'ph:plus-circle',
            ],
            'eventbrite_update_event' => [
                'class' => EventbriteUpdateEvent::class,
                'type' => 'write',
                'name' => 'Update Event',
                'description' => 'Update an existing event.',
                'icon' => 'ph:pencil',
            ],
            'eventbrite_list_attendees' => [
                'class' => EventbriteListAttendees::class,
                'type' => 'read',
                'name' => 'List Attendees',
                'description' => 'List attendees for an event.',
                'icon' => 'ph:users',
            ],
            'eventbrite_get_attendee' => [
                'class' => EventbriteGetAttendee::class,
                'type' => 'read',
                'name' => 'Get Attendee',
                'description' => 'Get details for a single attendee.',
                'icon' => 'ph:user',
            ],
            'eventbrite_list_venues' => [
                'class' => EventbriteListVenues::class,
                'type' => 'read',
                'name' => 'List Venues',
                'description' => 'List venues for the organization.',
                'icon' => 'ph:buildings',
            ],
            'eventbrite_create_venue' => [
                'class' => EventbriteCreateVenue::class,
                'type' => 'write',
                'name' => 'Create Venue',
                'description' => 'Create a new venue.',
                'icon' => 'ph:buildings',
            ],
            'eventbrite_get_current_user' => [
                'class' => EventbriteGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API docs file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/eventbrite.md';
    }

    /**
     * Credential fields for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'token', 'type' => 'secret', 'label' => 'Private Token', 'required' => true],
            ['key' => 'organization_id', 'type' => 'text', 'label' => 'Organization ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.eventbriteapi.com/v3'],
        ];
    }

    /**
     * Whether this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with multi-account context.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new EventbriteService(
                token: $creds->get('eventbrite', 'token', '', $account),
                organizationId: $creds->get('eventbrite', 'organization_id', '', $account),
                baseUrl: $creds->get('eventbrite', 'url', 'https://www.eventbriteapi.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(EventbriteService::class));
    }
}
