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
use OpenCompany\Integrations\Sinch\Tools\SinchGetCall;
use OpenCompany\Integrations\Sinch\Tools\SinchListApplications;
use OpenCompany\Integrations\Sinch\Tools\SinchListCalls;

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
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.sinch.com/docs/sms/',
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
            'service_plan_id' => 'required|string',
            'api_token' => 'required|string',
        ];
    }

        public function tools(): array
    {
        return [
            'sinch_get_group' => [
                'class' => SinchGetGroup::class,
                'type' => 'read',
                'name' => 'Get Group',
                'description' => 'Get details for a specific group in your Sinch account.',
                'icon' => 'ph:wrench',
            ],
            'sinch_get_phone_number' => [
                'class' => SinchGetPhoneNumber::class,
                'type' => 'read',
                'name' => 'Get Phone Number',
                'description' => 'Get details for a specific phone number in your Sinch account.',
                'icon' => 'ph:wrench',
            ],
            'sinch_list_batches' => [
                'class' => SinchListBatches::class,
                'type' => 'read',
                'name' => 'List Batches',
                'description' => 'List all message batches in your Sinch account with pagination.',
                'icon' => 'ph:wrench',
            ],
            'sinch_list_groups' => [
                'class' => SinchListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List all groups in your Sinch account with pagination.',
                'icon' => 'ph:wrench',
            ],
            'sinch_list_messages' => [
                'class' => SinchListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List inbound and outbound SMS messages from Sinch. Supports filtering by direction, recipient, sender, and date range.',
                'icon' => 'ph:wrench',
            ],
            'sinch_list_phone_numbers' => [
                'class' => SinchListPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Phone Numbers',
                'description' => 'List all rented phone numbers in your Sinch account with pagination.',
                'icon' => 'ph:wrench',
            ],
            'sinch_send_sms' => [
                'class' => SinchSendSms::class,
                'type' => 'write',
                'name' => 'Send Sms',
                'description' => 'Send an SMS message to one or more recipients via Sinch. Requires sender phone number, recipient(s), and message body.',
                'icon' => 'ph:wrench',
            ],
        ];
    }



    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/sinch.md';
    }

    public function credentialFields(): array
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
