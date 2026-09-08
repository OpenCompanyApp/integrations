<?php

namespace OpenCompany\Integrations\Loops;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Loops\Tools\LoopsCheckContactSuppression;
use OpenCompany\Integrations\Loops\Tools\LoopsCreateContact;
use OpenCompany\Integrations\Loops\Tools\LoopsCreateContactProperty;
use OpenCompany\Integrations\Loops\Tools\LoopsDeleteContact;
use OpenCompany\Integrations\Loops\Tools\LoopsFindContact;
use OpenCompany\Integrations\Loops\Tools\LoopsListContactProperties;
use OpenCompany\Integrations\Loops\Tools\LoopsListDedicatedSendingIps;
use OpenCompany\Integrations\Loops\Tools\LoopsListMailingLists;
use OpenCompany\Integrations\Loops\Tools\LoopsListTransactionalEmails;
use OpenCompany\Integrations\Loops\Tools\LoopsRemoveContactSuppression;
use OpenCompany\Integrations\Loops\Tools\LoopsSendEvent;
use OpenCompany\Integrations\Loops\Tools\LoopsSendTransactionalEmail;
use OpenCompany\Integrations\Loops\Tools\LoopsTestApiKey;
use OpenCompany\Integrations\Loops\Tools\LoopsUpdateContact;

/**
 * Catalog provider for the Loops integration.
 *
 * Exposes current official Loops API coverage for contact management, events,
 * transactional email, contact properties, lists, suppression, and config data.
 */
class LoopsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
        return 'loops';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Loops',
            'description' => 'Email marketing and transactional email',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:loops',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Loops',
            'description' => 'Manage Loops contacts, events, transactional email, contact properties, mailing lists, suppression, and sending configuration.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:loops',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://loops.so/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Loops API key',
                'hint' => 'Generate an API key in Loops settings under API.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://app.loops.so/api/v1',
                'hint' => 'The Loops API v1 base URL.',
                'default' => 'https://app.loops.so/api/v1',
            ],
        ];
    }

    /**
     * Validate credentials with the official API-key test endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.loops.so/api/v1', '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/api-key');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Loops API returned HTTP {$response->status()}. Check the API key and URL.",
                ];
            }

            $teamName = $response->json('teamName') ?? 'Loops';

            return [
                'success' => true,
                'message' => "Connected to Loops API for {$teamName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'loops_create_contact' => ['class' => LoopsCreateContact::class, 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a Loops contact.', 'icon' => 'ph:user-plus'],
            'loops_update_contact' => ['class' => LoopsUpdateContact::class, 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update or create a Loops contact.', 'icon' => 'ph:pencil'],
            'loops_find_contact' => ['class' => LoopsFindContact::class, 'type' => 'read', 'name' => 'Find Contact', 'description' => 'Find a Loops contact by email or userId.', 'icon' => 'ph:user'],
            'loops_delete_contact' => ['class' => LoopsDeleteContact::class, 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete a Loops contact.', 'icon' => 'ph:user-minus'],
            'loops_check_contact_suppression' => ['class' => LoopsCheckContactSuppression::class, 'type' => 'read', 'name' => 'Check Contact Suppression', 'description' => 'Check whether a contact is suppressed.', 'icon' => 'ph:shield-check'],
            'loops_remove_contact_suppression' => ['class' => LoopsRemoveContactSuppression::class, 'type' => 'write', 'name' => 'Remove Contact Suppression', 'description' => 'Remove a contact from the suppression list.', 'icon' => 'ph:shield-slash'],
            'loops_create_contact_property' => ['class' => LoopsCreateContactProperty::class, 'type' => 'write', 'name' => 'Create Contact Property', 'description' => 'Create a Loops contact property.', 'icon' => 'ph:plus-circle'],
            'loops_list_contact_properties' => ['class' => LoopsListContactProperties::class, 'type' => 'read', 'name' => 'List Contact Properties', 'description' => 'List Loops contact properties.', 'icon' => 'ph:list'],
            'loops_list_mailing_lists' => ['class' => LoopsListMailingLists::class, 'type' => 'read', 'name' => 'List Mailing Lists', 'description' => 'List Loops mailing lists.', 'icon' => 'ph:list-bullets'],
            'loops_send_event' => ['class' => LoopsSendEvent::class, 'type' => 'write', 'name' => 'Send Event', 'description' => 'Send a Loops event.', 'icon' => 'ph:lightning'],
            'loops_send_transactional_email' => ['class' => LoopsSendTransactionalEmail::class, 'type' => 'write', 'name' => 'Send Transactional Email', 'description' => 'Send a Loops transactional email.', 'icon' => 'ph:paper-plane-tilt'],
            'loops_list_transactional_emails' => ['class' => LoopsListTransactionalEmails::class, 'type' => 'read', 'name' => 'List Transactional Emails', 'description' => 'List Loops transactional emails.', 'icon' => 'ph:envelope-open'],
            'loops_test_api_key' => ['class' => LoopsTestApiKey::class, 'type' => 'read', 'name' => 'Test API Key', 'description' => 'Test the configured Loops API key.', 'icon' => 'ph:key'],
            'loops_list_dedicated_sending_ips' => ['class' => LoopsListDedicatedSendingIps::class, 'type' => 'read', 'name' => 'List Dedicated Sending IPs', 'description' => 'List dedicated sending IP addresses.', 'icon' => 'ph:globe'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/loops.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://app.loops.so/api/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a Loops service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): LoopsService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new LoopsService(
                apiKey: $creds->get('loops', 'api_key', '', $account),
                baseUrl: $creds->get('loops', 'url', 'https://app.loops.so/api/v1', $account),
            );
        }

        return app(LoopsService::class);
    }

}
