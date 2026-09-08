<?php

namespace OpenCompany\Integrations\MailerSend;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendAddBlocklistRecipients;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendAddUnsubscribes;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendCreateDomain;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendCreateInboundRoute;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendCreateSmtpUser;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendCreateWebhook;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteDomain;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteInboundRoute;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteOnHold;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteSmtpUser;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteTemplate;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteUnsubscribes;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendDeleteWebhook;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetActivity;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetAnalyticsByDate;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetAnalyticsOpensByCountry;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetAnalyticsOpensByReadingEnvironment;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetAnalyticsOpensByUserAgent;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetCurrentUser;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetDomain;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetDomainDnsRecords;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetDomainVerificationStatus;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetInboundRoute;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetMessage;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetRecipient;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetSmtpUser;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetTemplate;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendGetWebhook;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListActivities;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListDomainRecipients;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListDomains;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListHardBounces;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListInboundRoutes;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListMessages;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListOnHold;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListRecipients;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListSmtpUsers;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListSpamComplaints;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListTemplates;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListUnsubscribes;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendListWebhooks;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendSendBulkEmail;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendSendEmail;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendUpdateDomainSettings;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendUpdateInboundRoute;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendUpdateSmtpUser;
use OpenCompany\Integrations\MailerSend\Tools\MailerSendUpdateWebhook;

/**
 * Tool provider for the MailerSend integration.
 *
 * Exposes transactional email, activity, analytics, domains, templates,
 * recipients, suppressions, webhooks, inbound routing, and SMTP user tools.
 */
class MailerSendToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'mailer-send';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'MailerSend',
            'description' => 'MailerSend integration for transactional email, analytics, domains, webhooks, inbound routing, and SMTP users.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'ph:envelope-simple',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'MailerSend',
            'description' => 'MailerSend integration for transactional email, analytics, domains, templates, recipients, suppressions, webhooks, inbound routing, and SMTP users.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'ph:envelope-simple',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mailersend.com/api/v1/',
        ];
    }

    /**
     * Configuration schema for the MailerSend integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your MailerSend API token',
                'hint' => 'Generate an API token in your MailerSend dashboard under API Tokens.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the MailerSend API.
     *
     * @param  array<string, mixed>  $config  Configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.mailersend.com/v1/domains', [
                'limit' => 1,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to MailerSend API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "MailerSend API returned HTTP {$response->status()}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * List all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'mailer_send_list_messages' => $this->tool(MailerSendListMessages::class, 'read', 'List Messages', 'List email messages from MailerSend.', 'ph:envelope'),
            'mailer_send_get_message' => $this->tool(MailerSendGetMessage::class, 'read', 'Get Message', 'Get details of a specific email message.', 'ph:envelope-open'),
            'mailer_send_send_email' => $this->tool(MailerSendSendEmail::class, 'write', 'Send Email', 'Send an email through MailerSend.', 'ph:paper-plane-tilt'),
            'mailer_send_send_bulk_email' => $this->tool(MailerSendSendBulkEmail::class, 'write', 'Send Bulk Email', 'Send multiple emails through MailerSend.', 'ph:paper-plane-right'),
            'mailer_send_list_templates' => $this->tool(MailerSendListTemplates::class, 'read', 'List Templates', 'List email templates from MailerSend.', 'ph:file'),
            'mailer_send_get_template' => $this->tool(MailerSendGetTemplate::class, 'read', 'Get Template', 'Get a MailerSend template by ID.', 'ph:file-text'),
            'mailer_send_delete_template' => $this->tool(MailerSendDeleteTemplate::class, 'write', 'Delete Template', 'Delete a MailerSend template.', 'ph:trash'),
            'mailer_send_list_domains' => $this->tool(MailerSendListDomains::class, 'read', 'List Domains', 'List configured sending domains.', 'ph:globe'),
            'mailer_send_get_domain' => $this->tool(MailerSendGetDomain::class, 'read', 'Get Domain', 'Get one sending domain.', 'ph:globe'),
            'mailer_send_create_domain' => $this->tool(MailerSendCreateDomain::class, 'write', 'Create Domain', 'Add a sending domain.', 'ph:plus-circle'),
            'mailer_send_delete_domain' => $this->tool(MailerSendDeleteDomain::class, 'write', 'Delete Domain', 'Delete a sending domain.', 'ph:trash'),
            'mailer_send_list_domain_recipients' => $this->tool(MailerSendListDomainRecipients::class, 'read', 'List Domain Recipients', 'List recipients for a domain.', 'ph:users'),
            'mailer_send_update_domain_settings' => $this->tool(MailerSendUpdateDomainSettings::class, 'write', 'Update Domain Settings', 'Update domain tracking and sending settings.', 'ph:sliders-horizontal'),
            'mailer_send_get_domain_dns_records' => $this->tool(MailerSendGetDomainDnsRecords::class, 'read', 'Get Domain DNS Records', 'Get DNS records for a domain.', 'ph:list-checks'),
            'mailer_send_get_domain_verification_status' => $this->tool(MailerSendGetDomainVerificationStatus::class, 'read', 'Get Domain Verification Status', 'Get domain verification status.', 'ph:seal-check'),
            'mailer_send_list_recipients' => $this->tool(MailerSendListRecipients::class, 'read', 'List Recipients', 'List email recipients from MailerSend.', 'ph:users'),
            'mailer_send_get_recipient' => $this->tool(MailerSendGetRecipient::class, 'read', 'Get Recipient', 'Get one recipient by ID.', 'ph:user'),
            'mailer_send_list_hard_bounces' => $this->tool(MailerSendListHardBounces::class, 'read', 'List Hard Bounces', 'List hard-bounced recipients.', 'ph:warning'),
            'mailer_send_list_spam_complaints' => $this->tool(MailerSendListSpamComplaints::class, 'read', 'List Spam Complaints', 'List spam complaint recipients.', 'ph:warning-octagon'),
            'mailer_send_list_unsubscribes' => $this->tool(MailerSendListUnsubscribes::class, 'read', 'List Unsubscribes', 'List unsubscribed recipients.', 'ph:minus-circle'),
            'mailer_send_list_on_hold' => $this->tool(MailerSendListOnHold::class, 'read', 'List On Hold', 'List recipients on hold.', 'ph:pause-circle'),
            'mailer_send_add_blocklist_recipients' => $this->tool(MailerSendAddBlocklistRecipients::class, 'write', 'Add Blocklist Recipients', 'Add recipients to the blocklist.', 'ph:prohibit'),
            'mailer_send_add_unsubscribes' => $this->tool(MailerSendAddUnsubscribes::class, 'write', 'Add Unsubscribes', 'Set recipients as unsubscribed.', 'ph:minus-circle'),
            'mailer_send_delete_unsubscribes' => $this->tool(MailerSendDeleteUnsubscribes::class, 'write', 'Delete Unsubscribes', 'Delete unsubscribe suppression entries.', 'ph:trash'),
            'mailer_send_delete_on_hold' => $this->tool(MailerSendDeleteOnHold::class, 'write', 'Delete On Hold', 'Delete on-hold suppression entries.', 'ph:trash'),
            'mailer_send_list_activities' => $this->tool(MailerSendListActivities::class, 'read', 'List Activities', 'List domain activity events.', 'ph:activity'),
            'mailer_send_get_activity' => $this->tool(MailerSendGetActivity::class, 'read', 'Get Activity', 'Get one activity event.', 'ph:activity'),
            'mailer_send_get_analytics_by_date' => $this->tool(MailerSendGetAnalyticsByDate::class, 'read', 'Get Analytics By Date', 'Get activity analytics grouped by date.', 'ph:chart-line'),
            'mailer_send_get_analytics_opens_by_country' => $this->tool(MailerSendGetAnalyticsOpensByCountry::class, 'read', 'Get Opens By Country', 'Get open analytics by country.', 'ph:map-pin'),
            'mailer_send_get_analytics_opens_by_user_agent' => $this->tool(MailerSendGetAnalyticsOpensByUserAgent::class, 'read', 'Get Opens By User Agent', 'Get open analytics by user-agent.', 'ph:browser'),
            'mailer_send_get_analytics_opens_by_reading_environment' => $this->tool(MailerSendGetAnalyticsOpensByReadingEnvironment::class, 'read', 'Get Opens By Reading Environment', 'Get open analytics by reading environment.', 'ph:devices'),
            'mailer_send_list_webhooks' => $this->tool(MailerSendListWebhooks::class, 'read', 'List Webhooks', 'List MailerSend webhooks.', 'ph:webhooks-logo'),
            'mailer_send_get_webhook' => $this->tool(MailerSendGetWebhook::class, 'read', 'Get Webhook', 'Get one MailerSend webhook.', 'ph:webhooks-logo'),
            'mailer_send_create_webhook' => $this->tool(MailerSendCreateWebhook::class, 'write', 'Create Webhook', 'Create a MailerSend webhook.', 'ph:plus-circle'),
            'mailer_send_update_webhook' => $this->tool(MailerSendUpdateWebhook::class, 'write', 'Update Webhook', 'Update a MailerSend webhook.', 'ph:pencil-simple'),
            'mailer_send_delete_webhook' => $this->tool(MailerSendDeleteWebhook::class, 'write', 'Delete Webhook', 'Delete a MailerSend webhook.', 'ph:trash'),
            'mailer_send_list_inbound_routes' => $this->tool(MailerSendListInboundRoutes::class, 'read', 'List Inbound Routes', 'List inbound email routes.', 'ph:arrow-square-in'),
            'mailer_send_get_inbound_route' => $this->tool(MailerSendGetInboundRoute::class, 'read', 'Get Inbound Route', 'Get one inbound email route.', 'ph:arrow-square-in'),
            'mailer_send_create_inbound_route' => $this->tool(MailerSendCreateInboundRoute::class, 'write', 'Create Inbound Route', 'Create an inbound email route.', 'ph:plus-circle'),
            'mailer_send_update_inbound_route' => $this->tool(MailerSendUpdateInboundRoute::class, 'write', 'Update Inbound Route', 'Update an inbound email route.', 'ph:pencil-simple'),
            'mailer_send_delete_inbound_route' => $this->tool(MailerSendDeleteInboundRoute::class, 'write', 'Delete Inbound Route', 'Delete an inbound email route.', 'ph:trash'),
            'mailer_send_list_smtp_users' => $this->tool(MailerSendListSmtpUsers::class, 'read', 'List SMTP Users', 'List SMTP users for a domain.', 'ph:users'),
            'mailer_send_get_smtp_user' => $this->tool(MailerSendGetSmtpUser::class, 'read', 'Get SMTP User', 'Get one SMTP user.', 'ph:user'),
            'mailer_send_create_smtp_user' => $this->tool(MailerSendCreateSmtpUser::class, 'write', 'Create SMTP User', 'Create an SMTP user.', 'ph:user-plus'),
            'mailer_send_update_smtp_user' => $this->tool(MailerSendUpdateSmtpUser::class, 'write', 'Update SMTP User', 'Update an SMTP user.', 'ph:pencil-simple'),
            'mailer_send_delete_smtp_user' => $this->tool(MailerSendDeleteSmtpUser::class, 'write', 'Delete SMTP User', 'Delete an SMTP user.', 'ph:trash'),
            'mailer_send_get_current_user' => $this->tool(MailerSendGetCurrentUser::class, 'read', 'Health Check', 'Verify MailerSend API connectivity.', 'ph:heartbeat'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/mailer-send.md';
    }

    /**
     * Credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the appropriate service.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the MailerSend service, including multi-account credentials.
     *
     * @param  array<string, mixed>  $context  Runtime context.
     */
    private function resolveService(array $context = []): MailerSendService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MailerSendService(
                apiToken: $creds->get('mailer-send', 'api_token', '', $account),
            );
        }

        return app(MailerSendService::class);
    }

    /**
     * Build one tool metadata entry.
     *
     * @param  class-string<Tool>  $class  Tool class.
     * @return array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}
     */
    private function tool(string $class, string $type, string $name, string $description, string $icon): array
    {
        return compact('class', 'type', 'name', 'description', 'icon');
    }
}
