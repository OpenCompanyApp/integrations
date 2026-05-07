<?php

namespace OpenCompany\Integrations\EmailOctopus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusCreateContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusCreateField;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusCreateList;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusCreateTag;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusDeleteContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusDeleteField;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusDeleteList;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusDeleteTag;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaign;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportBounced;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportClicked;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportComplained;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportLinks;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportNotClicked;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportNotOpened;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportOpened;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportSent;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportSummary;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportUnsubscribed;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetList;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListCampaigns;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListContacts;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListLists;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListSubscribedContacts;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListTags;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListTaggedContacts;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusListUnsubscribedContacts;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusStartAutomation;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusUpdateContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusUpdateContactsBulk;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusUpdateField;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusUpdateList;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusUpdateTag;

/**
 * Tool catalog and configuration metadata for EmailOctopus.
 *
 * Exposes the public v1.6 API documentation surface for lists, contacts,
 * fields, tags, campaigns, reports, and automation queueing.
 */
class EmailOctopusToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Public method docs currently expose v1.6 endpoints; EmailOctopus v2 docs are dashboard-scoped.'],
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
        return 'email-octopus';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'EmailOctopus',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:emailoctopus',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'EmailOctopus',
            'description' => 'Manage EmailOctopus lists, contacts, fields, tags, campaigns, reports, and automations.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:emailoctopus',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://emailoctopus.com/api-documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your EmailOctopus API key',
                'hint' => 'Find your API key in EmailOctopus settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://emailoctopus.com/api',
                'hint' => 'Use the default URL unless you have a custom endpoint.',
                'default' => 'https://emailoctopus.com/api',
            ],
            [
                'key' => 'list_id',
                'type' => 'string',
                'label' => 'Default List ID',
                'placeholder' => 'Optional default list ID',
                'hint' => 'Used when list-scoped tools omit list_id.',
                'required' => false,
            ],
        ];
    }

    /**
     * Validate credentials with a lightweight list request.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://emailoctopus.com/api', '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders(['Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/1.6/lists', [
                'api_key' => $apiKey,
                'limit' => 1,
            ]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => "EmailOctopus API returned HTTP {$response->status()}. Check the key and URL."];
            }

            return ['success' => true, 'message' => "Connected to EmailOctopus API at {$baseUrl}."];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'list_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'emailoctopus_list_lists' => ['class' => EmailOctopusListLists::class, 'type' => 'read', 'name' => 'List Lists', 'description' => 'List EmailOctopus mailing lists.', 'icon' => 'ph:list'],
            'emailoctopus_get_list' => ['class' => EmailOctopusGetList::class, 'type' => 'read', 'name' => 'Get List', 'description' => 'Get one mailing list.', 'icon' => 'ph:list-bullets'],
            'emailoctopus_create_list' => ['class' => EmailOctopusCreateList::class, 'type' => 'write', 'name' => 'Create List', 'description' => 'Create a mailing list.', 'icon' => 'ph:plus-circle'],
            'emailoctopus_update_list' => ['class' => EmailOctopusUpdateList::class, 'type' => 'write', 'name' => 'Update List', 'description' => 'Update a mailing list.', 'icon' => 'ph:pencil'],
            'emailoctopus_delete_list' => ['class' => EmailOctopusDeleteList::class, 'type' => 'write', 'name' => 'Delete List', 'description' => 'Delete a mailing list.', 'icon' => 'ph:trash'],
            'emailoctopus_list_tags' => ['class' => EmailOctopusListTags::class, 'type' => 'read', 'name' => 'List Tags', 'description' => 'List list tags.', 'icon' => 'ph:tag'],
            'emailoctopus_create_tag' => ['class' => EmailOctopusCreateTag::class, 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a list tag.', 'icon' => 'ph:tag'],
            'emailoctopus_update_tag' => ['class' => EmailOctopusUpdateTag::class, 'type' => 'write', 'name' => 'Update Tag', 'description' => 'Update a list tag.', 'icon' => 'ph:tag'],
            'emailoctopus_delete_tag' => ['class' => EmailOctopusDeleteTag::class, 'type' => 'write', 'name' => 'Delete Tag', 'description' => 'Delete a list tag.', 'icon' => 'ph:trash'],
            'emailoctopus_list_contacts' => ['class' => EmailOctopusListContacts::class, 'type' => 'read', 'name' => 'List Contacts', 'description' => 'List contacts in a mailing list.', 'icon' => 'ph:users'],
            'emailoctopus_list_subscribed_contacts' => ['class' => EmailOctopusListSubscribedContacts::class, 'type' => 'read', 'name' => 'List Subscribed Contacts', 'description' => 'List subscribed contacts.', 'icon' => 'ph:users'],
            'emailoctopus_list_unsubscribed_contacts' => ['class' => EmailOctopusListUnsubscribedContacts::class, 'type' => 'read', 'name' => 'List Unsubscribed Contacts', 'description' => 'List unsubscribed contacts.', 'icon' => 'ph:users'],
            'emailoctopus_list_tagged_contacts' => ['class' => EmailOctopusListTaggedContacts::class, 'type' => 'read', 'name' => 'List Tagged Contacts', 'description' => 'List contacts by tag.', 'icon' => 'ph:tags'],
            'emailoctopus_get_contact' => ['class' => EmailOctopusGetContact::class, 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Get one list contact.', 'icon' => 'ph:user'],
            'emailoctopus_create_contact' => ['class' => EmailOctopusCreateContact::class, 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Create a list contact.', 'icon' => 'ph:user-plus'],
            'emailoctopus_update_contact' => ['class' => EmailOctopusUpdateContact::class, 'type' => 'write', 'name' => 'Update Contact', 'description' => 'Update one list contact.', 'icon' => 'ph:pencil'],
            'emailoctopus_delete_contact' => ['class' => EmailOctopusDeleteContact::class, 'type' => 'write', 'name' => 'Delete Contact', 'description' => 'Delete one list contact.', 'icon' => 'ph:user-minus'],
            'emailoctopus_update_contacts_bulk' => ['class' => EmailOctopusUpdateContactsBulk::class, 'type' => 'write', 'name' => 'Update Contacts Bulk', 'description' => 'Update up to 100 contacts.', 'icon' => 'ph:users-four'],
            'emailoctopus_create_field' => ['class' => EmailOctopusCreateField::class, 'type' => 'write', 'name' => 'Create Field', 'description' => 'Create a list field.', 'icon' => 'ph:textbox'],
            'emailoctopus_update_field' => ['class' => EmailOctopusUpdateField::class, 'type' => 'write', 'name' => 'Update Field', 'description' => 'Update a list field.', 'icon' => 'ph:pencil'],
            'emailoctopus_delete_field' => ['class' => EmailOctopusDeleteField::class, 'type' => 'write', 'name' => 'Delete Field', 'description' => 'Delete a list field.', 'icon' => 'ph:trash'],
            'emailoctopus_list_campaigns' => ['class' => EmailOctopusListCampaigns::class, 'type' => 'read', 'name' => 'List Campaigns', 'description' => 'List campaigns.', 'icon' => 'ph:envelope'],
            'emailoctopus_get_campaign' => ['class' => EmailOctopusGetCampaign::class, 'type' => 'read', 'name' => 'Get Campaign', 'description' => 'Get one campaign.', 'icon' => 'ph:envelope-open'],
            'emailoctopus_get_campaign_report_summary' => ['class' => EmailOctopusGetCampaignReportSummary::class, 'type' => 'read', 'name' => 'Get Campaign Report Summary', 'description' => 'Get the campaign summary report.', 'icon' => 'ph:chart-line'],
            'emailoctopus_get_campaign_report_links' => ['class' => EmailOctopusGetCampaignReportLinks::class, 'type' => 'read', 'name' => 'Get Campaign Report Links', 'description' => 'Get the campaign links report.', 'icon' => 'ph:link'],
            'emailoctopus_get_campaign_report_bounced' => ['class' => EmailOctopusGetCampaignReportBounced::class, 'type' => 'read', 'name' => 'Get Campaign Report Bounced', 'description' => 'Get campaign bounced contacts.', 'icon' => 'ph:warning'],
            'emailoctopus_get_campaign_report_clicked' => ['class' => EmailOctopusGetCampaignReportClicked::class, 'type' => 'read', 'name' => 'Get Campaign Report Clicked', 'description' => 'Get campaign clicked contacts.', 'icon' => 'ph:cursor-click'],
            'emailoctopus_get_campaign_report_complained' => ['class' => EmailOctopusGetCampaignReportComplained::class, 'type' => 'read', 'name' => 'Get Campaign Report Complained', 'description' => 'Get campaign complained contacts.', 'icon' => 'ph:flag'],
            'emailoctopus_get_campaign_report_opened' => ['class' => EmailOctopusGetCampaignReportOpened::class, 'type' => 'read', 'name' => 'Get Campaign Report Opened', 'description' => 'Get campaign opened contacts.', 'icon' => 'ph:envelope-open'],
            'emailoctopus_get_campaign_report_sent' => ['class' => EmailOctopusGetCampaignReportSent::class, 'type' => 'read', 'name' => 'Get Campaign Report Sent', 'description' => 'Get campaign sent contacts.', 'icon' => 'ph:paper-plane-tilt'],
            'emailoctopus_get_campaign_report_unsubscribed' => ['class' => EmailOctopusGetCampaignReportUnsubscribed::class, 'type' => 'read', 'name' => 'Get Campaign Report Unsubscribed', 'description' => 'Get campaign unsubscribed contacts.', 'icon' => 'ph:user-minus'],
            'emailoctopus_get_campaign_report_not_clicked' => ['class' => EmailOctopusGetCampaignReportNotClicked::class, 'type' => 'read', 'name' => 'Get Campaign Report Not Clicked', 'description' => 'Get contacts who did not click a campaign.', 'icon' => 'ph:cursor'],
            'emailoctopus_get_campaign_report_not_opened' => ['class' => EmailOctopusGetCampaignReportNotOpened::class, 'type' => 'read', 'name' => 'Get Campaign Report Not Opened', 'description' => 'Get contacts who did not open a campaign.', 'icon' => 'ph:envelope-simple'],
            'emailoctopus_start_automation' => ['class' => EmailOctopusStartAutomation::class, 'type' => 'write', 'name' => 'Start Automation', 'description' => 'Start an automation for a contact.', 'icon' => 'ph:play-circle'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/email-octopus.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://emailoctopus.com/api'],
            ['key' => 'list_id', 'type' => 'string', 'label' => 'Default List ID', 'required' => false],
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
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): EmailOctopusService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new EmailOctopusService(
                apiKey: $creds->get('email-octopus', 'api_key', '', $account),
                baseUrl: $creds->get('email-octopus', 'url', 'https://emailoctopus.com/api', $account),
                listId: $creds->get('email-octopus', 'list_id', '', $account),
            );
        }

        return app(EmailOctopusService::class);
    }
}
