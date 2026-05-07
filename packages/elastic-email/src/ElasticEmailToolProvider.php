<?php

namespace OpenCompany\Integrations\ElasticEmail;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailAddContactsToList;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailApiGet;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailApiPost;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailCreateContact;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailDeleteContact;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetCampaign;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetCampaignStatistics;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetContact;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetEmailStatus;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetList;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetStatistics;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetTemplate;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListCampaigns;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListContacts;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListEmailEvents;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListEvents;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListFiles;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListListContacts;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListLists;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListSuppressions;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListTemplates;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailPauseCampaign;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailRemoveContactsFromList;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailSendBulkEmail;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailSendEmail;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailUpdateContact;

/**
 * Exposes Elastic Email API v4 tools and setup metadata.
 */
class ElasticEmailToolProvider implements ConfigurableIntegration, HasIntegrationCapabilities, ToolProvider
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
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'elastic-email';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Elastic Email',
            'description' => 'Transactional email, contacts, lists, campaigns, events, suppressions, and statistics',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:elasticemail',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Elastic Email',
            'description' => 'Elastic Email REST API v4 for email delivery, contacts, lists, campaigns, events, suppressions, templates, files, and statistics.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:elasticemail',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://elasticemail.com/developers/api-documentation/rest-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Elastic Email API key',
                'hint' => 'Generate an API key in Elastic Email under Settings > API.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.elasticemail.com/v4',
                'default' => 'https://api.elasticemail.com/v4',
            ],
        ];
    }

    /**
     * Test API credentials by loading account statistics.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.elasticemail.com/v4'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-ElasticEmail-ApiKey' => $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/statistics');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to Elastic Email API at {$baseUrl}.",
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Elastic Email API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
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

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'elasticemail_send_email' => $this->tool(ElasticEmailSendEmail::class, 'Send Transactional Email', 'Send a transactional email.', 'write'),
            'elasticemail_send_bulk_email' => $this->tool(ElasticEmailSendBulkEmail::class, 'Send Bulk Email', 'Send a bulk email with a full v4 payload.', 'write'),
            'elasticemail_get_email_status' => $this->tool(ElasticEmailGetEmailStatus::class, 'Get Email Status', 'Get delivery status for a transaction ID.'),
            'elasticemail_list_templates' => $this->tool(ElasticEmailListTemplates::class, 'List Templates', 'List email templates.'),
            'elasticemail_get_template' => $this->tool(ElasticEmailGetTemplate::class, 'Get Template', 'Get details of a template by name.'),
            'elasticemail_list_contacts' => $this->tool(ElasticEmailListContacts::class, 'List Contacts', 'List contacts.'),
            'elasticemail_get_contact' => $this->tool(ElasticEmailGetContact::class, 'Get Contact', 'Load a contact by email.'),
            'elasticemail_create_contact' => $this->tool(ElasticEmailCreateContact::class, 'Create Contact', 'Create or add a contact.', 'write'),
            'elasticemail_update_contact' => $this->tool(ElasticEmailUpdateContact::class, 'Update Contact', 'Update a contact.', 'write'),
            'elasticemail_delete_contact' => $this->tool(ElasticEmailDeleteContact::class, 'Delete Contact', 'Delete a contact.', 'write'),
            'elasticemail_list_lists' => $this->tool(ElasticEmailListLists::class, 'List Lists', 'List contact lists.'),
            'elasticemail_get_list' => $this->tool(ElasticEmailGetList::class, 'Get List', 'Get a contact list by name.'),
            'elasticemail_list_list_contacts' => $this->tool(ElasticEmailListListContacts::class, 'List List Contacts', 'List contacts in a contact list.'),
            'elasticemail_add_contacts_to_list' => $this->tool(ElasticEmailAddContactsToList::class, 'Add Contacts To List', 'Add contacts to a list.', 'write'),
            'elasticemail_remove_contacts_from_list' => $this->tool(ElasticEmailRemoveContactsFromList::class, 'Remove Contacts From List', 'Remove contacts from a list.', 'write'),
            'elasticemail_list_campaigns' => $this->tool(ElasticEmailListCampaigns::class, 'List Campaigns', 'List campaigns.'),
            'elasticemail_get_campaign' => $this->tool(ElasticEmailGetCampaign::class, 'Get Campaign', 'Get a campaign by name.'),
            'elasticemail_pause_campaign' => $this->tool(ElasticEmailPauseCampaign::class, 'Pause Campaign', 'Pause a campaign.', 'write'),
            'elasticemail_list_events' => $this->tool(ElasticEmailListEvents::class, 'List Events', 'List email events.'),
            'elasticemail_list_email_events' => $this->tool(ElasticEmailListEmailEvents::class, 'List Email Events', 'List events for a transaction ID.'),
            'elasticemail_list_suppressions' => $this->tool(ElasticEmailListSuppressions::class, 'List Suppressions', 'List unsubscribes, bounces, or complaints.'),
            'elasticemail_get_statistics' => $this->tool(ElasticEmailGetStatistics::class, 'Get Statistics', 'Get account-wide statistics.'),
            'elasticemail_get_campaign_statistics' => $this->tool(ElasticEmailGetCampaignStatistics::class, 'Get Campaign Statistics', 'Get campaign statistics.'),
            'elasticemail_list_files' => $this->tool(ElasticEmailListFiles::class, 'List Files', 'List uploaded files.'),
            'elasticemail_api_get' => $this->tool(ElasticEmailApiGet::class, 'Elastic Email API GET', 'Call a read-only API v4 endpoint.'),
            'elasticemail_api_post' => $this->tool(ElasticEmailApiPost::class, 'Elastic Email API POST', 'Call an API v4 POST endpoint.', 'write'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/elastic-email.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.elasticemail.com/v4'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve service credentials for default or account-scoped contexts.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ElasticEmailService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ElasticEmailService(
                apiKey: $creds->get('elastic-email', 'api_key', '', $account),
                baseUrl: $creds->get('elastic-email', 'url', 'https://api.elasticemail.com/v4', $account),
            );
        }

        return app(ElasticEmailService::class);
    }

    /**
     * Build standard tool metadata.
     *
     * @return array<string, mixed>
     */
    private function tool(string $class, string $name, string $description, string $type = 'read'): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => 'ph:wrench',
        ];
    }
}
