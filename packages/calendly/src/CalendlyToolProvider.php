<?php

namespace OpenCompany\Integrations\Calendly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Calendly\Tools\CalendlyCancelEvent;
use OpenCompany\Integrations\Calendly\Tools\CalendlyCreateOneOff;
use OpenCompany\Integrations\Calendly\Tools\CalendlyCreateSingleUseLink;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetEvent;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetEventType;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetInvitee;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetOrganization;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetUser;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListEvents;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListInvitees;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListOrganizationMemberships;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetEventTypes;

/**
 * Registers all Calendly tools and provides integration metadata.
 *
 * Exposes 12 tools covering users, event types, scheduled events,
 * invitees, organizations, and scheduling links via the ToolProvider contract.
 */
class CalendlyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Unique identifier for the Calendly integration.
     */
    public function appName(): string
    {
        return 'calendly';
    }

    /**
     * Short metadata for the system prompt and UI.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'event types, scheduled events, invitees',
            'description' => 'Scheduling',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:calendly',
        ];
    }

    /**
     * Full integration metadata for the settings UI.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Calendly',
            'description' => 'Event types, scheduled events, invitees, and organizations',
            'icon' => 'ph:calendar-check',
            'logo' => 'simple-icons:calendly',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.calendly.com/api-docs',
        ];
    }

    /**
     * Configuration schema for the Calendly integration.
     *
     * @return array<int, array{key: string, type: string, label: string, placeholder: string, hint: string, required: bool}>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'your-calendly-personal-access-token',
                'hint' => 'Generate a Personal Access Token from your Calendly <a href="https://calendly.com/integrations/api_webhooks" target="_blank">integrations page</a>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Calendly connection using the provided credentials.
     *
     * Calls GET /users/me and returns the user's name and email.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate a Personal Access Token in your Calendly integrations settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.calendly.com/users/me');

            $body = $response->json() ?? [];

            if ($response->successful() && isset($body['resource'])) {
                $name = $body['resource']['name'] ?? 'Unknown';
                $email = $body['resource']['email'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Calendly as {$name} ({$email}).",
                ];
            }

            $error = $body['message'] ?? $body['title'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Calendly API error: ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the Calendly configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * Registry of all Calendly tools.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            // User
            'calendly_get_user' => [
                'class' => CalendlyGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get the authenticated Calendly user profile.',
                'icon' => 'ph:user',
            ],
            // Event Types
            'calendly_get_event_types' => [
                'class' => CalendlyGetEventTypes::class,
                'type' => 'read',
                'name' => 'Get Event Types',
                'description' => 'List event types for a Calendly user.',
                'icon' => 'ph:calendar-blank',
            ],
            'calendly_get_event_type' => [
                'class' => CalendlyGetEventType::class,
                'type' => 'read',
                'name' => 'Get Event Type',
                'description' => 'Get a single Calendly event type by UUID.',
                'icon' => 'ph:calendar-blank',
            ],
            // Scheduled Events
            'calendly_list_events' => [
                'class' => CalendlyListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List scheduled Calendly events.',
                'icon' => 'ph:calendar-dots',
            ],
            'calendly_get_event' => [
                'class' => CalendlyGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Get a single Calendly scheduled event by UUID.',
                'icon' => 'ph:calendar-check',
            ],
            'calendly_cancel_event' => [
                'class' => CalendlyCancelEvent::class,
                'type' => 'write',
                'name' => 'Cancel Event',
                'description' => 'Cancel a scheduled Calendly event.',
                'icon' => 'ph:calendar-x',
            ],
            // Invitees
            'calendly_list_invitees' => [
                'class' => CalendlyListInvitees::class,
                'type' => 'read',
                'name' => 'List Invitees',
                'description' => 'List invitees for a scheduled Calendly event.',
                'icon' => 'ph:users',
            ],
            'calendly_get_invitee' => [
                'class' => CalendlyGetInvitee::class,
                'type' => 'read',
                'name' => 'Get Invitee',
                'description' => 'Get a single invitee for a Calendly event.',
                'icon' => 'ph:user-focus',
            ],
            // One-Off Event Types
            'calendly_create_one_off' => [
                'class' => CalendlyCreateOneOff::class,
                'type' => 'write',
                'name' => 'Create One-Off Event Type',
                'description' => 'Create a one-off Calendly event type.',
                'icon' => 'ph:plus-circle',
            ],
            // Organizations
            'calendly_list_organization_memberships' => [
                'class' => CalendlyListOrganizationMemberships::class,
                'type' => 'read',
                'name' => 'List Organization Memberships',
                'description' => 'List memberships in a Calendly organization.',
                'icon' => 'ph:buildings',
            ],
            'calendly_get_organization' => [
                'class' => CalendlyGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Get a Calendly organization by UUID.',
                'icon' => 'ph:building',
            ],
            // Scheduling Links
            'calendly_create_single_use_link' => [
                'class' => CalendlyCreateSingleUseLink::class,
                'type' => 'write',
                'name' => 'Create Single-Use Scheduling Link',
                'description' => 'Create a single-use Calendly scheduling link.',
                'icon' => 'ph:link',
            ],
        ];
    }

    /**
     * Path to Lua documentation for the Calendly integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/calendly.md';
    }

    /**
     * Credential fields for CLI setup.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
        ];
    }

    /**
     * Whether this provider is an integration (yes).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the resolved CalendlyService.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Optional context (e.g. account)
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the CalendlyService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Optional context with 'account' key
     * @return CalendlyService
     */
    private function resolveService(array $context = []): CalendlyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new CalendlyService(
                apiToken: $creds->get('calendly', 'api_token', '', $account),
            );
        }

        return app(CalendlyService::class);
    }
}
