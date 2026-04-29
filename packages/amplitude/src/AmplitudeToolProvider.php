<?php

namespace OpenCompany\Integrations\Amplitude;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListEvents;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetEvent;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListFunnels;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetFunnel;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeListCohorts;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetCohort;
use OpenCompany\Integrations\Amplitude\Tools\AmplitudeGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * AmplitudeToolProvider — registers Amplitude analytics tools with the integration core.
 *
 * Implements ConfigurableIntegration for multi-account support, config schema
 * definition, connection testing, and credential field declaration.
 */
class AmplitudeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'amplitude';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Amplitude Analytics',
            'description' => 'Product analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:amplitude',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Amplitude Analytics',
            'description' => 'Product analytics platform for tracking user behavior, funnels, and cohorts',
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
                'placeholder' => 'https://api.amplitude.com/v1',
                'hint' => 'Use <code>https://api.amplitude.com/v1</code> for the standard cloud, or your custom domain',
                'default' => 'https://api.amplitude.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.amplitude.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

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
            'amplitude_list_funnels' => [
                'class' => AmplitudeListFunnels::class,
                'type' => 'read',
                'name' => 'List Funnels',
                'description' => 'List funnels configured in the Amplitude project.',
                'icon' => 'ph:funnel',
            ],
            'amplitude_get_funnel' => [
                'class' => AmplitudeGetFunnel::class,
                'type' => 'read',
                'name' => 'Get Funnel',
                'description' => 'Retrieve a single funnel by its ID with conversion metrics.',
                'icon' => 'ph:funnel',
            ],
            'amplitude_list_cohorts' => [
                'class' => AmplitudeListCohorts::class,
                'type' => 'read',
                'name' => 'List Cohorts',
                'description' => 'List behavioral cohorts in the Amplitude project.',
                'icon' => 'ph:users',
            ],
            'amplitude_get_cohort' => [
                'class' => AmplitudeGetCohort::class,
                'type' => 'read',
                'name' => 'Get Cohort',
                'description' => 'Retrieve a single cohort by its ID with membership details.',
                'icon' => 'ph:user-circle',
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
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Amplitude URL', 'required' => false, 'default' => 'https://api.amplitude.com/v1'],
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
                baseUrl: $creds->get('amplitude', 'url', 'https://api.amplitude.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AmplitudeService::class));
    }
}
