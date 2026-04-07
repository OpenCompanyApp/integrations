<?php

namespace OpenCompany\Integrations\Telnyx;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxListPhoneNumbers;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxGetPhoneNumber;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxListMessages;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxSendSms;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxListCalls;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxGetCall;
use OpenCompany\Integrations\Telnyx\Tools\TelnyxListCallRecords;

/**
 * Tool provider for the Telnyx voice and SMS integration.
 *
 * Registers phone number management, messaging, call, and recording tools
 * with support for multi-account credential resolution.
 */
class TelnyxToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'telnyx';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'phone numbers, SMS, voice calls, recordings',
            'description' => 'Voice and SMS communications',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:telnyx',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Telnyx',
            'description' => 'Programmable voice, SMS, and phone number management',
            'icon' => 'ph:phone',
            'logo' => 'simple-icons:telnyx',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.telnyx.com/docs/api/v2/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Telnyx API key',
                'hint' => 'Generate an API key in the Telnyx portal under "Auth" > "API Keys"',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Telnyx API connection by listing phone numbers with a small page size.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.telnyx.com/v2/phone_numbers', [
                'page_size' => 1,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Telnyx API successfully.',
                ];
            }

            $error = $response->json('errors.0.detail') ?? $response->json('message') ?? "HTTP {$response->status()}";

            return ['success' => false, 'error' => "Telnyx API returned: {$error}"];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'telnyx_list_phone_numbers' => [
                'class' => TelnyxListPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Phone Numbers',
                'description' => 'List phone numbers on your Telnyx account.',
                'icon' => 'ph:phone',
            ],
            'telnyx_get_phone_number' => [
                'class' => TelnyxGetPhoneNumber::class,
                'type' => 'read',
                'name' => 'Get Phone Number',
                'description' => 'Get details for a specific phone number.',
                'icon' => 'ph:phone',
            ],
            'telnyx_list_messages' => [
                'class' => TelnyxListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List SMS and MMS messages.',
                'icon' => 'ph:chat-circle-text',
            ],
            'telnyx_send_sms' => [
                'class' => TelnyxSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS or MMS message.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'telnyx_list_calls' => [
                'class' => TelnyxListCalls::class,
                'type' => 'read',
                'name' => 'List Calls',
                'description' => 'List voice calls made on the account.',
                'icon' => 'ph:phone-call',
            ],
            'telnyx_get_call' => [
                'class' => TelnyxGetCall::class,
                'type' => 'read',
                'name' => 'Get Call',
                'description' => 'Get details for a specific call.',
                'icon' => 'ph:phone-call',
            ],
            'telnyx_list_call_records' => [
                'class' => TelnyxListCallRecords::class,
                'type' => 'read',
                'name' => 'List Call Recordings',
                'description' => 'List call recordings stored on the account.',
                'icon' => 'ph:vinyl-record',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/telnyx.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
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

            $service = new TelnyxService(
                apiKey: $creds->get('telnyx', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TelnyxService::class));
    }
}
