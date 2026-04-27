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
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.clicksend.com/docs/rest/',
        ];
    }public function credentialFields(): array
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
