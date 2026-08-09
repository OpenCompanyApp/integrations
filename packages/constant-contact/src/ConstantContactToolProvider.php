<?php

namespace OpenCompany\Integrations\ConstantContact;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactApiGet;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactApiPost;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactCreateContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactCreateList;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactCreateOrUpdateContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactDeleteContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactDeleteList;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetAccountSummary;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetActivity;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetCampaign;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetCampaignActivity;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetContactActivitySummary;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetCurrentUser;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetEmailBouncesReport;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetEmailClicksReport;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetEmailSendsReport;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetList;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetSegment;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetUserPrivileges;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListActivities;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListCampaigns;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListContacts;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListCustomFields;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListLists;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListSegments;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListTags;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactUpdateContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactUpdateList;

/**
 * Exposes Constant Contact V3 API tools and setup metadata.
 */
class ConstantContactToolProvider implements ConfigurableIntegration, HasIntegrationCapabilities, ToolProvider
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
                'strategy' => 'oauth2_manual_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Token acquisition may happen outside this package; the host stores the resulting OAuth access token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'constant-contact';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Constant Contact',
            'description' => 'Email marketing contacts, campaigns, reports, lists, tags, segments, and account data',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:constantcontact',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Constant Contact',
            'description' => 'Constant Contact V3 API for contacts, lists, campaigns, reports, tags, custom fields, segments, activities, and account services.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:constantcontact',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.constantcontact.com/api_reference/api-reference.html',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'OAuth2 access token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'default' => 'https://api.cc.email/v3', 'required' => false],
        ];
    }

    /**
     * Test the API connection using the account summary endpoint.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.cc.email/v3'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account/summary');

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Invalid or expired access token.'];
            }

            if ($response->successful()) {
                return ['success' => true, 'message' => 'Connected to Constant Contact API.'];
            }

            return ['success' => false, 'error' => "API returned HTTP {$response->status()}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Declare all available tools for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'constantcontact_list_contacts' => $this->tool(ConstantContactListContacts::class, 'List Contacts', 'List contacts with pagination and status filtering.'),
            'constantcontact_get_contact' => $this->tool(ConstantContactGetContact::class, 'Get Contact', 'Get a contact by ID.'),
            'constantcontact_create_contact' => $this->tool(ConstantContactCreateContact::class, 'Create Contact', 'Create a contact.', 'write'),
            'constantcontact_create_or_update_contact' => $this->tool(ConstantContactCreateOrUpdateContact::class, 'Create Or Update Contact', 'Create or update a contact from a sign-up form payload.', 'write'),
            'constantcontact_update_contact' => $this->tool(ConstantContactUpdateContact::class, 'Update Contact', 'Update a contact.', 'write'),
            'constantcontact_delete_contact' => $this->tool(ConstantContactDeleteContact::class, 'Delete Contact', 'Delete a contact.', 'write'),
            'constantcontact_get_contact_activity_summary' => $this->tool(ConstantContactGetContactActivitySummary::class, 'Contact Activity Summary', 'Get campaign activity summary for a contact.'),
            'constantcontact_list_lists' => $this->tool(ConstantContactListLists::class, 'List Lists', 'List contact lists.'),
            'constantcontact_get_list' => $this->tool(ConstantContactGetList::class, 'Get List', 'Get a contact list by ID.'),
            'constantcontact_create_list' => $this->tool(ConstantContactCreateList::class, 'Create List', 'Create a contact list.', 'write'),
            'constantcontact_update_list' => $this->tool(ConstantContactUpdateList::class, 'Update List', 'Update a contact list.', 'write'),
            'constantcontact_delete_list' => $this->tool(ConstantContactDeleteList::class, 'Delete List', 'Delete a contact list.', 'write'),
            'constantcontact_list_campaigns' => $this->tool(ConstantContactListCampaigns::class, 'List Campaigns', 'List email campaigns.'),
            'constantcontact_get_campaign' => $this->tool(ConstantContactGetCampaign::class, 'Get Campaign', 'Get an email campaign by ID.'),
            'constantcontact_get_campaign_activity' => $this->tool(ConstantContactGetCampaignActivity::class, 'Get Campaign Activity', 'Get an email campaign activity by ID.'),
            'constantcontact_get_email_sends_report' => $this->tool(ConstantContactGetEmailSendsReport::class, 'Email Sends Report', 'Get sends report for a campaign activity.'),
            'constantcontact_get_email_bounces_report' => $this->tool(ConstantContactGetEmailBouncesReport::class, 'Email Bounces Report', 'Get bounces report for a campaign activity.'),
            'constantcontact_get_email_clicks_report' => $this->tool(ConstantContactGetEmailClicksReport::class, 'Email Clicks Report', 'Get clicks report for a campaign activity.'),
            'constantcontact_list_tags' => $this->tool(ConstantContactListTags::class, 'List Tags', 'List contact tags.'),
            'constantcontact_list_custom_fields' => $this->tool(ConstantContactListCustomFields::class, 'List Custom Fields', 'List contact custom fields.'),
            'constantcontact_list_segments' => $this->tool(ConstantContactListSegments::class, 'List Segments', 'List segments.'),
            'constantcontact_get_segment' => $this->tool(ConstantContactGetSegment::class, 'Get Segment', 'Get a segment by ID.'),
            'constantcontact_list_activities' => $this->tool(ConstantContactListActivities::class, 'List Activities', 'List bulk activities.'),
            'constantcontact_get_activity' => $this->tool(ConstantContactGetActivity::class, 'Get Activity', 'Get bulk activity status.'),
            'constantcontact_get_current_user' => $this->tool(ConstantContactGetCurrentUser::class, 'Get Account Summary', 'Get Constant Contact account summary details.'),
            'constantcontact_get_account_summary' => $this->tool(ConstantContactGetAccountSummary::class, 'Get Account Summary', 'Get Constant Contact account summary details.'),
            'constantcontact_get_user_privileges' => $this->tool(ConstantContactGetUserPrivileges::class, 'Get User Privileges', 'Get privileges for the current access token.'),
            'constantcontact_api_get' => $this->tool(ConstantContactApiGet::class, 'Constant Contact API GET', 'Call a read-only V3 API endpoint.'),
            'constantcontact_api_post' => $this->tool(ConstantContactApiPost::class, 'Constant Contact API POST', 'Call a V3 API POST endpoint.', 'write'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/constant-contact.md';
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with per-account credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Constant Contact service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ConstantContactService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ConstantContactService(
                accessToken: $creds->get('constant-contact', 'access_token', '', $account) ?: $creds->get('constant_contact', 'access_token', '', $account),
                baseUrl: $creds->get('constant-contact', 'url', '', $account) ?: $creds->get('constant_contact', 'url', 'https://api.cc.email/v3', $account),
            );
        }

        return app(ConstantContactService::class);
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
