<?php

namespace OpenCompany\Integrations\Plivo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Plivo\Tools\PlivoListMessages;
use OpenCompany\Integrations\Plivo\Tools\PlivoSendSms;
use OpenCompany\Integrations\Plivo\Tools\PlivoListNumbers;
use OpenCompany\Integrations\Plivo\Tools\PlivoGetNumber;
use OpenCompany\Integrations\Plivo\Tools\PlivoListCalls;
use OpenCompany\Integrations\Plivo\Tools\PlivoGetCall;
use OpenCompany\Integrations\Plivo\Tools\PlivoListApplications;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class PlivoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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




/**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'plivo';
    }

/**
     * Get application metadata for UI rendering.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Plivo',
            'description' => 'Cloud communications — SMS and voice API',
            'icon' => 'ph:chat-centered-text',
            'logo' => 'simple-icons:plivo',
        ];
    }

/**
     * Get integration metadata for the integrations catalog.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Plivo',
            'description' => 'Cloud communications platform for SMS and voice',
            'icon' => 'ph:chat-centered-text',
            'logo' => 'simple-icons:plivo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.plivo.com/docs/',
        ];
    }/**
     * Define the configuration schema for the Plivo integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'auth_id',
                'type' => 'text',
                'label' => 'Auth ID',
                'placeholder' => 'Enter your Plivo Auth ID',
                'hint' => 'Found in your Plivo console at <strong>Dashboard → Overview</strong>',
                'required' => true,
            ],
            [
                'key' => 'auth_token',
                'type' => 'secret',
                'label' => 'Auth Token',
                'placeholder' => 'Enter your Plivo Auth Token',
                'hint' => 'Found alongside the Auth ID in your Plivo console',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Plivo API using the provided configuration.
     *
     * @param  array<string, mixed>  $config  Configuration array containing `auth_id` and `auth_token`.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $authId = $config['auth_id'] ?? '';
        $authToken = $config['auth_token'] ?? '';

        if (empty($authId) || empty($authToken)) {
            return ['success' => false, 'error' => 'Auth ID and Auth Token are required.'];
        }

        try {
            $url = "https://api.plivo.com/v1/Account/{$authId}/";

            $response = Http::withBasicAuth($authId, $authToken)
                ->timeout(10)
                ->get($url);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Plivo API. Check the Auth ID and Auth Token.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Plivo API error: {$error}",
                ];
            }

            $accountName = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Plivo as \"{$accountName}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Plivo configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'auth_id' => 'nullable|string',
            'auth_token' => 'nullable|string',
        ];
    }

    /**
     * Get all available Plivo tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'plivo_list_messages' => [
                'class' => PlivoListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List SMS messages with optional filters.',
                'icon' => 'ph:envelope',
            ],
            'plivo_send_sms' => [
                'class' => PlivoSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS message to one or more recipients.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'plivo_list_numbers' => [
                'class' => PlivoListNumbers::class,
                'type' => 'read',
                'name' => 'List Numbers',
                'description' => 'List phone numbers on the Plivo account.',
                'icon' => 'ph:hash',
            ],
            'plivo_get_number' => [
                'class' => PlivoGetNumber::class,
                'type' => 'read',
                'name' => 'Get Number',
                'description' => 'Retrieve details of a specific phone number.',
                'icon' => 'ph:hash',
            ],
            'plivo_list_calls' => [
                'class' => PlivoListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List calls with optional filters and pagination.',
                'icon' => 'ph:phone-call',
            ],
            'plivo_get_call' => [
                'class' => PlivoGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Retrieve details of a specific call.',
                'icon' => 'ph:phone-call',
            ],
            'plivo_list_applications' => [
                'class' => PlivoListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List Plivo voice applications.',
                'icon' => 'ph:app-window',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/plivo.md';
    }

    /**
     * Get credential field definitions for the Plivo integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'auth_id', 'type' => 'text', 'label' => 'Auth ID', 'required' => true],
            ['key' => 'auth_token', 'type' => 'secret', 'label' => 'Auth Token', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration provider.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance with optional multi-account context.
     *
     * When an account context is provided, credentials are resolved for that
     * specific account. Otherwise, the default container-bound service is used.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context containing an `account` key for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PlivoService(
                authId: $creds->get('plivo', 'auth_id', '', $account),
                authToken: $creds->get('plivo', 'auth_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(PlivoService::class));
    }
}
