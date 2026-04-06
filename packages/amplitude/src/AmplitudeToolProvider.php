<?php

namespace OpenCompany\Integrations\Amplitude;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListEvents;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetEvent;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListUsers;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetUser;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListProperties;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListGroups;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetCurrentUser;

/**
 * AmplitudeToolProvider — registers Amplitude analytics tools with the integration core.
 *
 * Implements ConfigurableIntegration for multi-account support, config schema
 * definition, connection testing, and credential field declaration.
 */
class AmplitudeToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'amplitude';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'events, users, properties, groups',
            'description' => 'Product analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:amplitude',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Amplitude Analytics',
            'description' => 'Product analytics platform for tracking user behavior and events',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:amplitude',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://amplitude.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Amplitude API key',
                'hint' => 'Generate an API key in your Amplitude account settings under "Manage Data → API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://amplitude.com',
                'hint' => 'Use <code>https://amplitude.com</code> for the standard cloud, or your custom domain',
                'default' => 'https://amplitude.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://amplitude.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/2/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Amplitude API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Amplitude API returned an error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Amplitude API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url'     => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'amplitude_list_events' => [
                'class' => AmplitudeListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List events from Amplitude, optionally filtered by user, device, or time range.',
                'icon' => 'ph:list-bullets',
            ],
            'amplitude_get_event' => [
                'class' => AmplitudeGetEvent::class,
                'type' => 'read',
                'name' => 'Get Event',
                'description' => 'Retrieve a single event by its ID.',
                'icon' => 'ph:eye',
            ],
            'amplitude_list_users' => [
                'class' => AmplitudeListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'Search for users in Amplitude by query.',
                'icon' => 'ph:users',
            ],
            'amplitude_get_user' => [
                'class' => AmplitudeGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a user profile by user ID or device ID.',
                'icon' => 'ph:user',
            ],
            'amplitude_list_properties' => [
                'class' => AmplitudeListProperties::class,
                'type' => 'read',
                'name' => 'List Properties',
                'description' => 'List available event or user properties.',
                'icon' => 'ph:sliders',
            ],
            'amplitude_list_groups' => [
                'class' => AmplitudeListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'Search for groups in Amplitude by query.',
                'icon' => 'ph:users-three',
            ],
            'amplitude_get_current_user' => [
                'class' => AmplitudeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Amplitude user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/amplitude.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Amplitude URL', 'required' => false, 'default' => 'https://amplitude.com'],
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

            $service = new AmplitudeService(
                apiKey: $creds->get('amplitude', 'api_key', '', $account),
                baseUrl: $creds->get('amplitude', 'url', 'https://amplitude.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AmplitudeService::class));
    }
}
