<?php

namespace OpenCompany\Integrations\Vonage;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vonage\Tools\VonageSendSms;
use OpenCompany\Integrations\Vonage\Tools\VonageListMessages;
use OpenCompany\Integrations\Vonage\Tools\VonageGetAccountBalance;
use OpenCompany\Integrations\Vonage\Tools\VonageListNumbers;
use OpenCompany\Integrations\Vonage\Tools\VonageListApplications;
use OpenCompany\Integrations\Vonage\Tools\VonageVerifyRequest;
use OpenCompany\Integrations\Vonage\Tools\VonageVerifyCheck;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Vonage\Tools\VonageListSms;
class VonageToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'vonage';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Vonage',
            'description' => 'Vonage Nexmo communications integration for Laravel — SMS, verify, and account manageme…',
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
            'name' => 'Vonage',
            'description' => 'Vonage (Nexmo) communications integration for Laravel — SMS, verify, and account management.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'other',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration settings.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'text',
                'label' => 'API Key',
                'placeholder' => 'Enter your Vonage API key',
                'hint' => 'Find your API key in the Vonage Dashboard under "API Settings"',
                'required' => true,
            ],
            [
                'key' => 'api_secret',
                'type' => 'secret',
                'label' => 'API Secret',
                'placeholder' => 'Enter your Vonage API secret',
                'hint' => 'Find your API secret in the Vonage Dashboard under "API Settings"',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Vonage API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $apiSecret = $config['api_secret'] ?? '';

        if (empty($apiKey) || empty($apiSecret)) {
            return ['success' => false, 'error' => 'API key and secret are required'];
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->acceptJson()
                ->get('https://rest.nexmo.com/account/get-balance', [
                    'api_key' => $apiKey,
                    'api_secret' => $apiSecret,
                ]);

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['error_title'] ?? $json['error_text'] ?? "HTTP {$response->status()}";

                return ['success' => false, 'error' => "Authentication failed: {$error}"];
            }

            $json = $response->json();
            $balance = $json['value'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Vonage API. Account balance: {$balance}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'api_secret' => 'required|string',
        ];
    }

    /**
     * Get the tool definitions provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
        public function tools(): array
    {
        return [
            'vonage_get_account_balance' => [
                'class' => VonageGetAccountBalance::class,
                'type' => 'read',
                'name' => 'Get Account Balance',
                'description' => 'Get the current balance of your Vonage account.',
                'icon' => 'ph:wrench',
            ],
            'vonage_list_applications' => [
                'class' => VonageListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List Vonage applications configured on your account. Applications define how Vonage handles calls and messages.',
                'icon' => 'ph:wrench',
            ],
            'vonage_list_messages' => [
                'class' => VonageListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'Search and list SMS messages from your Vonage account. Requires a date in YYYY-MM-DD format. Optionally filter by recipient number.',
                'icon' => 'ph:wrench',
            ],
            'vonage_list_numbers' => [
                'class' => VonageListNumbers::class,
                'type' => 'read',
                'name' => 'List Numbers',
                'description' => 'List phone numbers purchased on your Vonage account. Optionally filter by pattern.',
                'icon' => 'ph:wrench',
            ],
            'vonage_send_sms' => [
                'class' => VonageSendSms::class,
                'type' => 'write',
                'name' => 'Send Sms',
                'description' => 'Send an SMS message via Vonage. Provide sender, recipient, and message text. The recipient number must be in E.164 format (e.g., 14155552671).',
                'icon' => 'ph:wrench',
            ],
            'vonage_verify_check' => [
                'class' => VonageVerifyCheck::class,
                'type' => 'read',
                'name' => 'Verify Check',
                'description' => 'Check a verification code against a Vonage Verify request. Provide the request_id from the verification and the code entered by the user.',
                'icon' => 'ph:wrench',
            ],
            'vonage_verify_request' => [
                'class' => VonageVerifyRequest::class,
                'type' => 'read',
                'name' => 'Verify Request',
                'description' => 'Send a verification code to a phone number via Vonage Verify. Returns a request_id used to check the code later.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    /**
     * Get the path to the Lua documentation file, if any.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vonage.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'text', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'API Secret', 'required' => true],
        ];
    }

    /**
     * Indicate that this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new VonageService(
                apiKey: $creds->get('vonage', 'api_key', '', $account),
                apiSecret: $creds->get('vonage', 'api_secret', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(VonageService::class));
    }
}
