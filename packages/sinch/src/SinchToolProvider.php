<?php

namespace OpenCompany\Integrations\Sinch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Sinch\Tools\SinchListMessages;
use OpenCompany\Integrations\Sinch\Tools\SinchSendSms;
use OpenCompany\Integrations\Sinch\Tools\SinchListPhoneNumbers;
use OpenCompany\Integrations\Sinch\Tools\SinchGetPhoneNumber;
use OpenCompany\Integrations\Sinch\Tools\SinchListGroups;
use OpenCompany\Integrations\Sinch\Tools\SinchGetGroup;
use OpenCompany\Integrations\Sinch\Tools\SinchListBatches;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class SinchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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



public function appName(): string
    {
        return 'sinch';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Sinch',
            'description' => 'Cloud communications platform for SMS, voice, and verification.',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:sinch',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Sinch',
            'description' => 'Send SMS messages, manage phone numbers, groups, and batches via Sinch.',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:sinch',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://developers.sinch.com/docs/sms/',
        ];
    }public function credentialFields(): array
    {
        return [
            ['key' => 'service_plan_id', 'type' => 'text', 'label' => 'Service Plan ID', 'required' => true],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
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
     * Resolve the SinchService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): SinchService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SinchService(
                servicePlanId: $creds->get('sinch', 'service_plan_id', '', $account),
                apiToken: $creds->get('sinch', 'api_token', '', $account),
            );
        }

        return app(SinchService::class);
    }
}
