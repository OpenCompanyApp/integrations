<?php

namespace OpenCompany\Integrations\ClickSend;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendGetAccountBalance;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendGetEmailHistory;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendGetSmsHistory;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendGetSmsPrice;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendGetVoiceHistory;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendListContactLists;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendSendEmail;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendSendPostLetter;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendSendSms;
use OpenCompany\Integrations\ClickSend\Tools\ClickSendSendVoice;

/**
 * Registers all ClickSend tools and provides integration metadata.
 *
 * Exposes 10 tools covering SMS, email, voice, post letters,
 * contact lists, and account management via the ToolProvider contract.
 */
class ClickSendToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'clicksend';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ClickSend',
            'description' => 'SMS, email, voice, and post letter delivery platform.',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:clicksend',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ClickSend',
            'description' => 'Send SMS, email, voice messages, and post letters via ClickSend.',
            'icon' => 'ph:paper-plane-tilt',
            'logo' => 'simple-icons:clicksend',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.clicksend.com/docs/rest/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'username',
                'type' => 'text',
                'label' => 'Username',
                'placeholder' => 'your-username',
                'hint' => 'Your ClickSend account username.',
                'required' => true,
            ],
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'your-api-key',
                'hint' => 'Your ClickSend API key from account settings.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the ClickSend connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'username' and 'api_key'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $username = $config['username'] ?? '';
        $apiKey = $config['api_key'] ?? '';

        if (empty($username) || empty($apiKey)) {
            return ['success' => false, 'error' => 'ClickSend username and API key are required.'];
        }

        try {
            $response = Http::withBasicAuth($username, $apiKey)
                ->timeout(10)
                ->get('https://rest.clicksend.com/v3/account');

            $body = $response->json() ?? [];

            if ($response->successful()) {
                $data = $body['data'] ?? [];
                $email = $data['email'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to ClickSend account ({$email}).",
                ];
            }

            $error = $body['response_msg'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'ClickSend API error: ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'username' => 'nullable|string',
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // SMS
            'clicksend_send_sms' => [
                'class' => ClickSendSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send one or more SMS messages via ClickSend.',
                'icon' => 'ph:chat-circle-text',
            ],
            'clicksend_get_sms_history' => [
                'class' => ClickSendGetSmsHistory::class,
                'type' => 'read',
                'name' => 'Get SMS History',
                'description' => 'Get SMS message history with date filtering and pagination.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'clicksend_get_sms_price' => [
                'class' => ClickSendGetSmsPrice::class,
                'type' => 'read',
                'name' => 'Get SMS Price',
                'description' => 'Get pricing for SMS messages before sending.',
                'icon' => 'ph:currency-dollar',
            ],
            // Email
            'clicksend_send_email' => [
                'class' => ClickSendSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email message via ClickSend.',
                'icon' => 'ph:envelope-simple',
            ],
            'clicksend_get_email_history' => [
                'class' => ClickSendGetEmailHistory::class,
                'type' => 'read',
                'name' => 'Get Email History',
                'description' => 'Get email message history with pagination.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            // Voice
            'clicksend_send_voice' => [
                'class' => ClickSendSendVoice::class,
                'type' => 'write',
                'name' => 'Send Voice',
                'description' => 'Send one or more voice messages via ClickSend.',
                'icon' => 'ph:phone',
            ],
            'clicksend_get_voice_history' => [
                'class' => ClickSendGetVoiceHistory::class,
                'type' => 'read',
                'name' => 'Get Voice History',
                'description' => 'Get voice message history with pagination.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            // Post Letters
            'clicksend_send_post_letter' => [
                'class' => ClickSendSendPostLetter::class,
                'type' => 'write',
                'name' => 'Send Post Letter',
                'description' => 'Send a post letter via ClickSend.',
                'icon' => 'ph:envelope',
            ],
            // Account
            'clicksend_get_account_balance' => [
                'class' => ClickSendGetAccountBalance::class,
                'type' => 'read',
                'name' => 'Get Account Balance',
                'description' => 'Get the current ClickSend account balance.',
                'icon' => 'ph:wallet',
            ],
            // Contact Lists
            'clicksend_list_contact_lists' => [
                'class' => ClickSendListContactLists::class,
                'type' => 'read',
                'name' => 'List Contact Lists',
                'description' => 'List all contact lists in ClickSend.',
                'icon' => 'ph:users',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/clicksend.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'required' => true],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the resolved service.
     *
     * @param  class-string<Tool>   $class    Tool class name
     * @param  array<string, mixed> $context  Optional context with account credentials
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ClickSendService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ClickSendService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ClickSendService(
                username: $creds->get('clicksend', 'username', '', $account),
                apiKey: $creds->get('clicksend', 'api_key', '', $account),
            );
        }

        return app(ClickSendService::class);
    }
}
