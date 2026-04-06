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

class VonageToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'vonage';
    }

    /**
     * Get application metadata for display purposes.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'sms, verify, numbers',
            'description' => 'Communications API',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:vonage',
        ];
    }

    /**
     * Get integration metadata for the marketplace UI.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Vonage',
            'description' => 'Communications platform for SMS, voice, and verification',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:vonage',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developer.vonage.com/api',
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
            'vonage_send_sms' => [
                'class' => VonageSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS message via Vonage.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'vonage_list_messages' => [
                'class' => VonageListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'Search and list SMS messages.',
                'icon' => 'ph:envelope',
            ],
            'vonage_get_account_balance' => [
                'class' => VonageGetAccountBalance::class,
                'type' => 'read',
                'name' => 'Get Account Balance',
                'description' => 'Get the current Vonage account balance.',
                'icon' => 'ph:wallet',
            ],
            'vonage_list_numbers' => [
                'class' => VonageListNumbers::class,
                'type' => 'read',
                'name' => 'List Numbers',
                'description' => 'List purchased phone numbers on the account.',
                'icon' => 'ph:phone',
            ],
            'vonage_list_applications' => [
                'class' => VonageListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List Vonage applications.',
                'icon' => 'ph:app-window',
            ],
            'vonage_verify_request' => [
                'class' => VonageVerifyRequest::class,
                'type' => 'write',
                'name' => 'Verify Request',
                'description' => 'Send a verification code to a phone number.',
                'icon' => 'ph:shield-check',
            ],
            'vonage_verify_check' => [
                'class' => VonageVerifyCheck::class,
                'type' => 'write',
                'name' => 'Verify Check',
                'description' => 'Verify a code against a verification request.',
                'icon' => 'ph:check-circle',
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
