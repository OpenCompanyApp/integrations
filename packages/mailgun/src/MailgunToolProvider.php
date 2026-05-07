<?php

namespace OpenCompany\Integrations\Mailgun;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides Mailgun tools, metadata, configuration, and connection checks.
 */
class MailgunToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'basic_auth_api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Mailgun uses HTTP Basic Auth username api and the API key as password.'],
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
        return 'mailgun';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mailgun',
            'description' => 'Email delivery operations',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailgun',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailgun',
            'description' => 'Manage Mailgun sending, domains, events, stats, suppressions, routes, webhooks, mailing lists, templates, and IPs.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailgun',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.mailgun.com/docs/mailgun/api-reference/send/mailgun',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'key-...', 'hint' => 'Mailgun private API key.', 'required' => true],
            ['key' => 'domain', 'type' => 'text', 'label' => 'Sending Domain', 'placeholder' => 'mg.example.com', 'hint' => 'Default Mailgun domain used by domain-scoped tools.', 'required' => true],
        ];
    }

    /**
     * Verify Mailgun credentials with a lightweight domain lookup.
     *
     * @param  array<string, mixed>  $config  API key and sending domain.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $domain = (string) ($config['domain'] ?? '');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'API key is required.'];
        }

        if ($domain === '') {
            return ['success' => false, 'error' => 'Sending domain is required.'];
        }

        try {
            $service = new MailgunService(apiKey: $apiKey, domain: $domain);
            $result = $service->getDomain($domain);
            $name = $result['domain']['name'] ?? $domain;
            $state = $result['domain']['state'] ?? 'unknown';

            return ['success' => true, 'message' => "Connected to Mailgun. Domain: {$name} (state: {$state})."];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'mailgun_api_get' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunApiGet',
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Mailgun API GET endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'mailgun_api_post' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunApiPost',
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any Mailgun API POST endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'mailgun_api_put' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunApiPut',
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call any Mailgun API PUT endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'mailgun_api_delete' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunApiDelete',
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any Mailgun API DELETE endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'mailgun_get_current_user' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Verify API credentials by listing one domain.',
                'icon' => 'ph:user-circle',
            ],
            'mailgun_list_domains' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListDomains',
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List domains in the Mailgun account.',
                'icon' => 'ph:globe',
            ],
            'mailgun_get_domain' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetDomain',
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get a Mailgun domain and DNS records.',
                'icon' => 'ph:globe',
            ],
            'mailgun_create_domain' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateDomain',
                'type' => 'write',
                'name' => 'Create Domain',
                'description' => 'Create a Mailgun sending domain.',
                'icon' => 'ph:plus-circle',
            ],
            'mailgun_delete_domain' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteDomain',
                'type' => 'write',
                'name' => 'Delete Domain',
                'description' => 'Delete a Mailgun domain.',
                'icon' => 'ph:trash',
            ],
            'mailgun_verify_domain' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunVerifyDomain',
                'type' => 'write',
                'name' => 'Verify Domain',
                'description' => 'Trigger Mailgun domain verification.',
                'icon' => 'ph:shield-check',
            ],
            'mailgun_list_domain_ips' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListDomainIps',
                'type' => 'read',
                'name' => 'List Domain IPs',
                'description' => 'List IPs assigned to a domain.',
                'icon' => 'ph:network',
            ],
            'mailgun_add_domain_ip' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunAddDomainIp',
                'type' => 'write',
                'name' => 'Add Domain IP',
                'description' => 'Assign an IP to a domain.',
                'icon' => 'ph:network',
            ],
            'mailgun_delete_domain_ip' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteDomainIp',
                'type' => 'write',
                'name' => 'Delete Domain IP',
                'description' => 'Remove an IP from a domain.',
                'icon' => 'ph:trash',
            ],
            'mailgun_send_email' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunSendEmail',
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email with Mailgun messages API.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mailgun_send_mime' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunSendMime',
                'type' => 'write',
                'name' => 'Send MIME',
                'description' => 'Send a MIME message with Mailgun.',
                'icon' => 'ph:file-text',
            ],
            'mailgun_list_events' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListEvents',
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List message events for a domain.',
                'icon' => 'ph:activity',
            ],
            'mailgun_list_messages' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListMessages',
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'Compatibility alias for Mailgun domain events.',
                'icon' => 'ph:activity',
            ],
            'mailgun_get_stats' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetStats',
                'type' => 'read',
                'name' => 'Get Stats',
                'description' => 'Get total stats for a domain.',
                'icon' => 'ph:chart-line',
            ],
            'mailgun_list_tags' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListTags',
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List tags for a domain.',
                'icon' => 'ph:tag',
            ],
            'mailgun_get_tag' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetTag',
                'type' => 'read',
                'name' => 'Get Tag',
                'description' => 'Get one tag for a domain.',
                'icon' => 'ph:tag',
            ],
            'mailgun_delete_tag' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteTag',
                'type' => 'write',
                'name' => 'Delete Tag',
                'description' => 'Delete a tag from a domain.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_bounces' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListBounces',
                'type' => 'read',
                'name' => 'List Bounces',
                'description' => 'List Mailgun Bounces for a domain.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_get_bounce' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetBounce',
                'type' => 'read',
                'name' => 'Get Bounce',
                'description' => 'Get one Mailgun Bounce record.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_create_bounce' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateBounce',
                'type' => 'write',
                'name' => 'Create Bounce',
                'description' => 'Create a Mailgun Bounce record.',
                'icon' => 'ph:shield-plus',
            ],
            'mailgun_delete_bounce' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteBounce',
                'type' => 'write',
                'name' => 'Delete Bounce',
                'description' => 'Delete a Mailgun Bounce record.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_complaints' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListComplaints',
                'type' => 'read',
                'name' => 'List Complaints',
                'description' => 'List Mailgun Complaints for a domain.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_get_complaint' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetComplaint',
                'type' => 'read',
                'name' => 'Get Complaint',
                'description' => 'Get one Mailgun Complaint record.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_create_complaint' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateComplaint',
                'type' => 'write',
                'name' => 'Create Complaint',
                'description' => 'Create a Mailgun Complaint record.',
                'icon' => 'ph:shield-plus',
            ],
            'mailgun_delete_complaint' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteComplaint',
                'type' => 'write',
                'name' => 'Delete Complaint',
                'description' => 'Delete a Mailgun Complaint record.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_unsubscribes' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListUnsubscribes',
                'type' => 'read',
                'name' => 'List Unsubscribes',
                'description' => 'List Mailgun Unsubscribes for a domain.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_get_unsubscribe' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetUnsubscribe',
                'type' => 'read',
                'name' => 'Get Unsubscribe',
                'description' => 'Get one Mailgun Unsubscribe record.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_create_unsubscribe' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateUnsubscribe',
                'type' => 'write',
                'name' => 'Create Unsubscribe',
                'description' => 'Create a Mailgun Unsubscribe record.',
                'icon' => 'ph:shield-plus',
            ],
            'mailgun_delete_unsubscribe' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteUnsubscribe',
                'type' => 'write',
                'name' => 'Delete Unsubscribe',
                'description' => 'Delete a Mailgun Unsubscribe record.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_whitelists' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListWhitelists',
                'type' => 'read',
                'name' => 'List Allowlists',
                'description' => 'List Mailgun Allowlists for a domain.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_get_allowlist' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetAllowlist',
                'type' => 'read',
                'name' => 'Get Allowlist',
                'description' => 'Get one Mailgun Allowlist record.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_create_allowlist' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateAllowlist',
                'type' => 'write',
                'name' => 'Create Allowlist',
                'description' => 'Create a Mailgun Allowlist record.',
                'icon' => 'ph:shield-plus',
            ],
            'mailgun_delete_allowlist' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteAllowlist',
                'type' => 'write',
                'name' => 'Delete Allowlist',
                'description' => 'Delete a Mailgun Allowlist record.',
                'icon' => 'ph:trash',
            ],
            'mailgun_get_suppressions' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetSuppressions',
                'type' => 'read',
                'name' => 'Get Suppressions',
                'description' => 'Compatibility alias for listing bounces.',
                'icon' => 'ph:shield-warning',
            ],
            'mailgun_create_suppression' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateSuppression',
                'type' => 'write',
                'name' => 'Create Suppression',
                'description' => 'Compatibility alias for creating a bounce suppression.',
                'icon' => 'ph:shield-plus',
            ],
            'mailgun_list_routes' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListRoutes',
                'type' => 'read',
                'name' => 'List Routes',
                'description' => 'List account-level inbound routes.',
                'icon' => 'ph:git-fork',
            ],
            'mailgun_get_route' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetRoute',
                'type' => 'read',
                'name' => 'Get Route',
                'description' => 'Get one route by ID.',
                'icon' => 'ph:git-fork',
            ],
            'mailgun_create_route' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateRoute',
                'type' => 'write',
                'name' => 'Create Route',
                'description' => 'Create an inbound route.',
                'icon' => 'ph:git-fork',
            ],
            'mailgun_update_route' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunUpdateRoute',
                'type' => 'write',
                'name' => 'Update Route',
                'description' => 'Update an inbound route.',
                'icon' => 'ph:git-fork',
            ],
            'mailgun_delete_route' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteRoute',
                'type' => 'write',
                'name' => 'Delete Route',
                'description' => 'Delete an inbound route.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListWebhooks',
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List webhooks configured for a domain.',
                'icon' => 'ph:webhooks-logo',
            ],
            'mailgun_get_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetWebhook',
                'type' => 'read',
                'name' => 'Get Webhook',
                'description' => 'Get one webhook by event type.',
                'icon' => 'ph:webhooks-logo',
            ],
            'mailgun_create_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateWebhook',
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a webhook for a domain event.',
                'icon' => 'ph:webhooks-logo',
            ],
            'mailgun_update_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunUpdateWebhook',
                'type' => 'write',
                'name' => 'Update Webhook',
                'description' => 'Update a webhook for a domain event.',
                'icon' => 'ph:webhooks-logo',
            ],
            'mailgun_delete_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteWebhook',
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a webhook for a domain event.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_mailing_lists' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListMailingLists',
                'type' => 'read',
                'name' => 'List Mailing Lists',
                'description' => 'List mailing lists in the account.',
                'icon' => 'ph:users-three',
            ],
            'mailgun_get_mailing_list' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetMailingList',
                'type' => 'read',
                'name' => 'Get Mailing List',
                'description' => 'Get one mailing list by address.',
                'icon' => 'ph:users-three',
            ],
            'mailgun_create_mailing_list' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateMailingList',
                'type' => 'write',
                'name' => 'Create Mailing List',
                'description' => 'Create a mailing list.',
                'icon' => 'ph:users-three',
            ],
            'mailgun_update_mailing_list' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunUpdateMailingList',
                'type' => 'write',
                'name' => 'Update Mailing List',
                'description' => 'Update a mailing list.',
                'icon' => 'ph:users-three',
            ],
            'mailgun_delete_mailing_list' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteMailingList',
                'type' => 'write',
                'name' => 'Delete Mailing List',
                'description' => 'Delete a mailing list.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_members' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListMembers',
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a mailing list.',
                'icon' => 'ph:users',
            ],
            'mailgun_get_member' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetMember',
                'type' => 'read',
                'name' => 'Get Member',
                'description' => 'Get one mailing list member.',
                'icon' => 'ph:user',
            ],
            'mailgun_add_member' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunAddMember',
                'type' => 'write',
                'name' => 'Add Member',
                'description' => 'Add or update one mailing list member.',
                'icon' => 'ph:user-plus',
            ],
            'mailgun_update_member' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunUpdateMember',
                'type' => 'write',
                'name' => 'Update Member',
                'description' => 'Update one mailing list member.',
                'icon' => 'ph:user',
            ],
            'mailgun_delete_member' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteMember',
                'type' => 'write',
                'name' => 'Delete Member',
                'description' => 'Delete one mailing list member.',
                'icon' => 'ph:trash',
            ],
            'mailgun_add_member_bulk' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunAddMemberBulk',
                'type' => 'write',
                'name' => 'Add Member Bulk',
                'description' => 'Bulk add mailing list members.',
                'icon' => 'ph:users',
            ],
            'mailgun_list_templates' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListTemplates',
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List stored email templates for a domain.',
                'icon' => 'ph:files',
            ],
            'mailgun_get_template' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetTemplate',
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get one template.',
                'icon' => 'ph:file-text',
            ],
            'mailgun_create_template' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateTemplate',
                'type' => 'write',
                'name' => 'Create Template',
                'description' => 'Create an email template.',
                'icon' => 'ph:file-plus',
            ],
            'mailgun_update_template' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunUpdateTemplate',
                'type' => 'write',
                'name' => 'Update Template',
                'description' => 'Update template metadata.',
                'icon' => 'ph:file-text',
            ],
            'mailgun_delete_template' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteTemplate',
                'type' => 'write',
                'name' => 'Delete Template',
                'description' => 'Delete a template.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_template_versions' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListTemplateVersions',
                'type' => 'read',
                'name' => 'List Template Versions',
                'description' => 'List versions for a template.',
                'icon' => 'ph:git-branch',
            ],
            'mailgun_create_template_version' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunCreateTemplateVersion',
                'type' => 'write',
                'name' => 'Create Template Version',
                'description' => 'Create a template version.',
                'icon' => 'ph:git-branch',
            ],
            'mailgun_update_template_version' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunUpdateTemplateVersion',
                'type' => 'write',
                'name' => 'Update Template Version',
                'description' => 'Update a template version.',
                'icon' => 'ph:git-branch',
            ],
            'mailgun_delete_template_version' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunDeleteTemplateVersion',
                'type' => 'write',
                'name' => 'Delete Template Version',
                'description' => 'Delete a template version.',
                'icon' => 'ph:trash',
            ],
            'mailgun_list_ips' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListIps',
                'type' => 'read',
                'name' => 'List IPs',
                'description' => 'List account IPs.',
                'icon' => 'ph:network',
            ],
            'mailgun_get_ip' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunGetIp',
                'type' => 'read',
                'name' => 'Get IP',
                'description' => 'Get one IP.',
                'icon' => 'ph:network',
            ],
            'mailgun_list_ip_pools' => [
                'class' => 'OpenCompany\\Integrations\\Mailgun\\Tools\\MailgunListIpPools',
                'type' => 'read',
                'name' => 'List IP Pools',
                'description' => 'List account IP pools.',
                'icon' => 'ph:network',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailgun.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'text', 'label' => 'Sending Domain', 'required' => true],
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
     * Resolve a Mailgun service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): MailgunService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MailgunService(
                apiKey: (string) $creds->get('mailgun', 'api_key', '', $account),
                domain: (string) $creds->get('mailgun', 'domain', '', $account),
            );
        }

        return app(MailgunService::class);
    }
}