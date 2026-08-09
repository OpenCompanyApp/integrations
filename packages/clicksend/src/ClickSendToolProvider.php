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

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ClickSendToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.clicksend.com/docs/rest/',
        ];
    }
        public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
    }
public function validationRules(): array
    {
        return [
            'username' => 'required|string',
            'api_key' => 'required|string',
        ];
    }

    public function tools(): array
    {
        return [
            'clicksend_get_account_balance' => [
                'class' => ClickSendGetAccountBalance::class,
                'type' => 'read',
                'name' => 'Clicksend Get Account Balance',
                'description' => 'Get the current ClickSend account balance.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_get_email_history' => [
                'class' => ClickSendGetEmailHistory::class,
                'type' => 'read',
                'name' => 'Clicksend Get Email History',
                'description' => 'Get email message history from ClickSend with pagination.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_get_sms_history' => [
                'class' => ClickSendGetSmsHistory::class,
                'type' => 'read',
                'name' => 'Clicksend Get SMS History',
                'description' => 'Get SMS message history from ClickSend. Supports date range filtering and pagination.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_get_sms_price' => [
                'class' => ClickSendGetSmsPrice::class,
                'type' => 'read',
                'name' => 'Clicksend Get SMS Price',
                'description' => 'Get pricing for SMS messages before sending. Uses the same message format as send SMS but returns cost estimates only.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_get_voice_history' => [
                'class' => ClickSendGetVoiceHistory::class,
                'type' => 'read',
                'name' => 'Clicksend Get Voice History',
                'description' => 'Get voice message history from ClickSend with pagination.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_list_contact_lists' => [
                'class' => ClickSendListContactLists::class,
                'type' => 'read',
                'name' => 'Clicksend List Contact Lists',
                'description' => 'List all contact lists from ClickSend with pagination.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_send_email' => [
                'class' => ClickSendSendEmail::class,
                'type' => 'write',
                'name' => 'Clicksend Send Email',
                'description' => 'Send an email message via ClickSend. Requires recipient, subject, and body.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_send_post_letter' => [
                'class' => ClickSendSendPostLetter::class,
                'type' => 'write',
                'name' => 'Clicksend Send Post Letter',
                'description' => 'Send a post letter via ClickSend. Provide a file URL or template ID with recipient details.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_send_sms' => [
                'class' => ClickSendSendSms::class,
                'type' => 'write',
                'name' => 'Clicksend Send SMS',
                'description' => 'Send one or more SMS messages via ClickSend. Each message requires a "to" phone number and "body" text.',
                'icon' => 'ph:wrench',
            ],
            'clicksend_send_voice' => [
                'class' => ClickSendSendVoice::class,
                'type' => 'write',
                'name' => 'Clicksend Send Voice',
                'description' => 'Send one or more voice messages via ClickSend. Each message requires a "to" phone number and "body" text.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/clicksend.md';
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
    {        return new $class($this->resolveService($context));
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
