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

/**
 * Registers all Sinch tools and provides integration metadata.
 *
 * Exposes 7 tools covering SMS messaging, phone number management,
 * groups, and batch operations via the ToolProvider contract.
 */
class SinchToolProvider implements ToolProvider, ConfigurableIntegration
{
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
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'service_plan_id',
                'type' => 'text',
                'label' => 'Service Plan ID',
                'placeholder' => 'your-service-plan-id',
                'hint' => 'Your Sinch Service Plan ID from the SMS API dashboard.',
                'required' => true,
            ],
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'your-api-token',
                'hint' => 'Your Sinch API token (Bearer token) from the SMS API dashboard.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Sinch connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'service_plan_id' and 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $servicePlanId = $config['service_plan_id'] ?? '';
        $apiToken = $config['api_token'] ?? '';

        if (empty($servicePlanId) || empty($apiToken)) {
            return ['success' => false, 'error' => 'Sinch Service Plan ID and API token are required.'];
        }

        try {
            $response = Http::withToken($apiToken)
                ->timeout(10)
                ->get("https://us.sms.api.sinch.com/xms/v1/{$servicePlanId}/batches", [
                    'page' => 0,
                    'page_size' => 1,
                ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Sinch SMS API successfully.',
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Sinch API error: ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'service_plan_id' => 'nullable|string',
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Messages
            'sinch_list_messages' => [
                'class' => SinchListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List inbound and outbound SMS messages from Sinch.',
                'icon' => 'ph:chat-circle-text',
            ],
            'sinch_send_sms' => [
                'class' => SinchSendSms::class,
                'type' => 'write',
                'name' => 'Send SMS',
                'description' => 'Send an SMS message to one or more recipients via Sinch.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            // Phone Numbers
            'sinch_list_phone_numbers' => [
                'class' => SinchListPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Phone Numbers',
                'description' => 'List all rented phone numbers in your Sinch account.',
                'icon' => 'ph:device-mobile',
            ],
            'sinch_get_phone_number' => [
                'class' => SinchGetPhoneNumber::class,
                'type' => 'read',
                'name' => 'Get Phone Number',
                'description' => 'Get details for a specific phone number in Sinch.',
                'icon' => 'ph:device-mobile',
            ],
            // Groups
            'sinch_list_groups' => [
                'class' => SinchListGroups::class,
                'type' => 'read',
                'name' => 'List Groups',
                'description' => 'List all groups in your Sinch account.',
                'icon' => 'ph:users',
            ],
            'sinch_get_group' => [
                'class' => SinchGetGroup::class,
                'type' => 'read',
                'name' => 'Get Group',
                'description' => 'Get details for a specific group in Sinch.',
                'icon' => 'ph:users',
            ],
            // Batches
            'sinch_list_batches' => [
                'class' => SinchListBatches::class,
                'type' => 'read',
                'name' => 'List Batches',
                'description' => 'List all message batches in your Sinch account.',
                'icon' => 'ph:stack',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/sinch.md';
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
    {
        return new $class($this->resolveService($context));
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
