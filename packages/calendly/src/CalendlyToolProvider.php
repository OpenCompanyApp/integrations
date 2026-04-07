<?php

namespace OpenCompany\Integrations\Calendly;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Calendly\Tools\CalendlyCreateBooking;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetCurrentUser;
use OpenCompany\Integrations\Calendly\Tools\CalendlyGetEventType;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListBookings;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListEventTypes;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListOrganizations;
use OpenCompany\Integrations\Calendly\Tools\CalendlyListUsers;

/**
 * Registers all Calendly tools and provides integration metadata.
 *
 * Exposes 7 tools covering event types, bookings, organizations,
 * and users via the ToolProvider contract.
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
            'label' => 'event types, bookings, organizations',
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
            'description' => 'Event types, bookings, organizations, and users',
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
                'key' => 'access_token',
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
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate a Personal Access Token in your Calendly integrations settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.calendly.com/v2/users/me');

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
            'access_token' => 'nullable|string',
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
            'calendly_list_event_types' => [
                'class' => CalendlyListEventTypes::class,
                'type' => 'read',
                'name' => 'List Event Types',
                'description' => 'List event types for a Calendly user or organization.',
                'icon' => 'ph:calendar-blank',
            ],
            'calendly_get_event_type' => [
                'class' => CalendlyGetEventType::class,
                'type' => 'read',
                'name' => 'Get Event Type',
                'description' => 'Get a single Calendly event type by UUID.',
                'icon' => 'ph:calendar-blank',
            ],
            'calendly_create_booking' => [
                'class' => CalendlyCreateBooking::class,
                'type' => 'write',
                'name' => 'Create Booking',
                'description' => 'Create a booking in Calendly by generating a one-off event type with a scheduling URL.',
                'icon' => 'ph:calendar-plus',
            ],
            'calendly_list_bookings' => [
                'class' => CalendlyListBookings::class,
                'type' => 'read',
                'name' => 'List Bookings',
                'description' => 'List scheduled Calendly bookings (events) with optional filters.',
                'icon' => 'ph:calendar-dots',
            ],
            'calendly_list_organizations' => [
                'class' => CalendlyListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Calendly organizations the authenticated user belongs to.',
                'icon' => 'ph:buildings',
            ],
            'calendly_list_users' => [
                'class' => CalendlyListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users (organization memberships) in a Calendly organization.',
                'icon' => 'ph:users',
            ],
            'calendly_get_current_user' => [
                'class' => CalendlyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Calendly user profile.',
                'icon' => 'ph:user',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
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
     */
    private function resolveService(array $context = []): CalendlyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new CalendlyService(
                accessToken: $creds->get('calendly', 'access_token', '', $account),
            );
        }

        return app(CalendlyService::class);
    }
}
