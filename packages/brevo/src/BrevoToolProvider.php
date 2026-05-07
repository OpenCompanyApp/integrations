<?php

namespace OpenCompany\Integrations\Brevo;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides Brevo tools, metadata, configuration, and connection checks.
 */
class BrevoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => ['api_key'],
                'notes' => ['Brevo API v3 uses the api-key header.'],
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
        return 'brevo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Brevo',
            'description' => 'Messaging, contacts, campaigns, and CRM',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:brevo',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Brevo',
            'description' => 'Manage Brevo contacts, lists, campaigns, transactional email and SMS, WhatsApp, senders, webhooks, eCommerce data, events, and account resources.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:brevo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.brevo.com/reference/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Brevo API key', 'hint' => 'Generate an API key in Brevo under SMTP & API > API Keys.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.brevo.com/v3', 'hint' => 'Brevo API v3 base URL.', 'default' => 'https://api.brevo.com/v3'],
        ];
    }

    /**
     * Verify Brevo credentials with a lightweight account lookup.
     *
     * @param  array<string, mixed>  $config  API key and optional base URL.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'API key is required.'];
        }

        try {
            $service = new BrevoService(
                apiKey: $apiKey,
                baseUrl: (string) ($config['url'] ?? 'https://api.brevo.com/v3'),
            );
            $account = $service->getAccount();
            $email = $account['email'] ?? $account['companyName'] ?? 'account';

            return ['success' => true, 'message' => "Connected to Brevo as {$email}."];
        } catch (Throwable $e) {
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
            'brevo_activate_ecommerce' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoActivateEcommerce',
                'type' => 'write',
                'name' => 'Activate Ecommerce',
                'description' => 'Activate eCommerce features for Brevo.',
                'icon' => 'ph:circle',
            ],
            'brevo_add_contacts_to_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoAddContactsToList',
                'type' => 'write',
                'name' => 'Add Contacts To List',
                'description' => 'Add contacts to a contact list.',
                'icon' => 'ph:users',
            ],
            'brevo_api_delete' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoApiDelete',
                'type' => 'write',
                'name' => 'Api Delete',
                'description' => 'Call any Brevo API DELETE endpoint path.',
                'icon' => 'ph:circle',
            ],
            'brevo_api_get' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoApiGet',
                'type' => 'read',
                'name' => 'Api Get',
                'description' => 'Call any Brevo API GET endpoint path.',
                'icon' => 'ph:circle',
            ],
            'brevo_api_patch' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoApiPatch',
                'type' => 'write',
                'name' => 'Api Patch',
                'description' => 'Call any Brevo API PATCH endpoint path.',
                'icon' => 'ph:circle',
            ],
            'brevo_api_post' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoApiPost',
                'type' => 'write',
                'name' => 'Api Post',
                'description' => 'Call any Brevo API POST endpoint path.',
                'icon' => 'ph:circle',
            ],
            'brevo_api_put' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoApiPut',
                'type' => 'write',
                'name' => 'Api Put',
                'description' => 'Call any Brevo API PUT endpoint path.',
                'icon' => 'ph:circle',
            ],
            'brevo_authenticate_sender_domain' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoAuthenticateSenderDomain',
                'type' => 'write',
                'name' => 'Authenticate Sender Domain',
                'description' => 'Authenticate a sender domain.',
                'icon' => 'ph:circle',
            ],
            'brevo_batch_upsert_categories' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoBatchUpsertCategories',
                'type' => 'write',
                'name' => 'Batch Upsert Categories',
                'description' => 'Batch upsert eCommerce categories.',
                'icon' => 'ph:circle',
            ],
            'brevo_batch_upsert_custom_object_records' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoBatchUpsertCustomObjectRecords',
                'type' => 'write',
                'name' => 'Batch Upsert Custom Object Records',
                'description' => 'Batch upsert custom object records.',
                'icon' => 'ph:circle',
            ],
            'brevo_batch_upsert_order_statuses' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoBatchUpsertOrderStatuses',
                'type' => 'write',
                'name' => 'Batch Upsert Order Statuses',
                'description' => 'Batch upsert eCommerce order statuses.',
                'icon' => 'ph:circle',
            ],
            'brevo_batch_upsert_products' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoBatchUpsertProducts',
                'type' => 'write',
                'name' => 'Batch Upsert Products',
                'description' => 'Batch upsert eCommerce products.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_attribute' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateAttribute',
                'type' => 'write',
                'name' => 'Create Attribute',
                'description' => 'Create a contact attribute.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_blocked_domain' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateBlockedDomain',
                'type' => 'write',
                'name' => 'Create Blocked Domain',
                'description' => 'Create a blocked SMTP domain.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_category' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateCategory',
                'type' => 'write',
                'name' => 'Create Category',
                'description' => 'Create an eCommerce category.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_contact' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateContact',
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a contact.',
                'icon' => 'ph:users',
            ],
            'brevo_create_email_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateEmailCampaign',
                'type' => 'write',
                'name' => 'Create Email Campaign',
                'description' => 'Create an email campaign.',
                'icon' => 'ph:envelope',
            ],
            'brevo_create_event' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateEvent',
                'type' => 'write',
                'name' => 'Create Event',
                'description' => 'Create a custom event.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_events_batch' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateEventsBatch',
                'type' => 'write',
                'name' => 'Create Events Batch',
                'description' => 'Create custom events in batch.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_external_feed' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateExternalFeed',
                'type' => 'write',
                'name' => 'Create External Feed',
                'description' => 'Create an external feed.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_folder' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateFolder',
                'type' => 'write',
                'name' => 'Create Folder',
                'description' => 'Create a contact folder.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_inbound_attachment_download_token' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateInboundAttachmentDownloadToken',
                'type' => 'write',
                'name' => 'Create Inbound Attachment Download Token',
                'description' => 'Create an inbound attachment download token.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateList',
                'type' => 'write',
                'name' => 'Create List',
                'description' => 'Create a contact list.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_order_status' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateOrderStatus',
                'type' => 'write',
                'name' => 'Create Order Status',
                'description' => 'Create or update an eCommerce order status.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_product' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateProduct',
                'type' => 'write',
                'name' => 'Create Product',
                'description' => 'Create an eCommerce product.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_sender' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateSender',
                'type' => 'write',
                'name' => 'Create Sender',
                'description' => 'Create a sender.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_sender_domain' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateSenderDomain',
                'type' => 'write',
                'name' => 'Create Sender Domain',
                'description' => 'Create a sender domain.',
                'icon' => 'ph:circle',
            ],
            'brevo_create_sms_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateSmsCampaign',
                'type' => 'write',
                'name' => 'Create Sms Campaign',
                'description' => 'Create an SMS campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_create_smtp_template' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateSmtpTemplate',
                'type' => 'write',
                'name' => 'Create Smtp Template',
                'description' => 'Create an SMTP template.',
                'icon' => 'ph:envelope',
            ],
            'brevo_create_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateWebhook',
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create a webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'brevo_create_whatsapp_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateWhatsAppCampaign',
                'type' => 'write',
                'name' => 'Create Whatsapp Campaign',
                'description' => 'Create a WhatsApp campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_create_whatsapp_template' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoCreateWhatsAppTemplate',
                'type' => 'write',
                'name' => 'Create Whatsapp Template',
                'description' => 'Create a WhatsApp template.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_delete_attribute' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteAttribute',
                'type' => 'write',
                'name' => 'Delete Attribute',
                'description' => 'Delete a contact attribute.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_blocked_contact' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteBlockedContact',
                'type' => 'write',
                'name' => 'Delete Blocked Contact',
                'description' => 'Unblock an SMTP contact.',
                'icon' => 'ph:users',
            ],
            'brevo_delete_blocked_domain' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteBlockedDomain',
                'type' => 'write',
                'name' => 'Delete Blocked Domain',
                'description' => 'Delete a blocked SMTP domain.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_category' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteCategory',
                'type' => 'write',
                'name' => 'Delete Category',
                'description' => 'Delete an eCommerce category.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_contact' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteContact',
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact.',
                'icon' => 'ph:users',
            ],
            'brevo_delete_email_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteEmailCampaign',
                'type' => 'write',
                'name' => 'Delete Email Campaign',
                'description' => 'Delete an email campaign.',
                'icon' => 'ph:envelope',
            ],
            'brevo_delete_external_feed' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteExternalFeed',
                'type' => 'write',
                'name' => 'Delete External Feed',
                'description' => 'Delete an external feed.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_folder' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteFolder',
                'type' => 'write',
                'name' => 'Delete Folder',
                'description' => 'Delete a contact folder.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteList',
                'type' => 'write',
                'name' => 'Delete List',
                'description' => 'Delete a contact list.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_product' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteProduct',
                'type' => 'write',
                'name' => 'Delete Product',
                'description' => 'Delete an eCommerce product.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_sender' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteSender',
                'type' => 'write',
                'name' => 'Delete Sender',
                'description' => 'Delete a sender.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_sender_domain' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteSenderDomain',
                'type' => 'write',
                'name' => 'Delete Sender Domain',
                'description' => 'Delete a sender domain.',
                'icon' => 'ph:circle',
            ],
            'brevo_delete_sms_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteSmsCampaign',
                'type' => 'write',
                'name' => 'Delete Sms Campaign',
                'description' => 'Delete an SMS campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_delete_smtp_template' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteSmtpTemplate',
                'type' => 'write',
                'name' => 'Delete Smtp Template',
                'description' => 'Delete an SMTP template.',
                'icon' => 'ph:envelope',
            ],
            'brevo_delete_transactional_email' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteTransactionalEmail',
                'type' => 'write',
                'name' => 'Delete Transactional Email',
                'description' => 'Delete a scheduled transactional email.',
                'icon' => 'ph:envelope',
            ],
            'brevo_delete_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteWebhook',
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'brevo_delete_whatsapp_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDeleteWhatsAppCampaign',
                'type' => 'write',
                'name' => 'Delete Whatsapp Campaign',
                'description' => 'Delete a WhatsApp campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_download_inbound_attachment' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoDownloadInboundAttachment',
                'type' => 'read',
                'name' => 'Download Inbound Attachment',
                'description' => 'Download an inbound attachment by download token.',
                'icon' => 'ph:circle',
            ],
            'brevo_export_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoExportContacts',
                'type' => 'write',
                'name' => 'Export Contacts',
                'description' => 'Export contacts from Brevo.',
                'icon' => 'ph:users',
            ],
            'brevo_export_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoExportWebhooks',
                'type' => 'write',
                'name' => 'Export Webhooks',
                'description' => 'Export webhook logs.',
                'icon' => 'ph:webhooks-logo',
            ],
            'brevo_get_account' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetAccount',
                'type' => 'read',
                'name' => 'Get Account',
                'description' => 'Get Brevo account information.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_category' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetCategory',
                'type' => 'read',
                'name' => 'Get Category',
                'description' => 'Get an eCommerce category.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_contact' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetContact',
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a contact by email, phone, or identifier.',
                'icon' => 'ph:users',
            ],
            'brevo_get_email_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetEmailCampaign',
                'type' => 'read',
                'name' => 'Get Email Campaign',
                'description' => 'Get an email campaign.',
                'icon' => 'ph:envelope',
            ],
            'brevo_get_email_status' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetEmailStatus',
                'type' => 'read',
                'name' => 'Get Email Status',
                'description' => 'Get transactional email status by identifier.',
                'icon' => 'ph:envelope',
            ],
            'brevo_get_external_feed' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetExternalFeed',
                'type' => 'read',
                'name' => 'Get External Feed',
                'description' => 'Get an external feed.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_folder' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetFolder',
                'type' => 'read',
                'name' => 'Get Folder',
                'description' => 'Get a contact folder.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_inbound_event' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetInboundEvent',
                'type' => 'read',
                'name' => 'Get Inbound Event',
                'description' => 'Get an inbound parsing event.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetList',
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get a contact list.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_process' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetProcess',
                'type' => 'read',
                'name' => 'Get Process',
                'description' => 'Get process status.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_product' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetProduct',
                'type' => 'read',
                'name' => 'Get Product',
                'description' => 'Get an eCommerce product.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_sender_domain' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetSenderDomain',
                'type' => 'read',
                'name' => 'Get Sender Domain',
                'description' => 'Get a sender domain.',
                'icon' => 'ph:circle',
            ],
            'brevo_get_sms_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetSmsCampaign',
                'type' => 'read',
                'name' => 'Get Sms Campaign',
                'description' => 'Get an SMS campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_get_smtp_aggregated_report' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetSmtpAggregatedReport',
                'type' => 'read',
                'name' => 'Get Smtp Aggregated Report',
                'description' => 'Get SMTP aggregated report.',
                'icon' => 'ph:envelope',
            ],
            'brevo_get_smtp_template' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetSmtpTemplate',
                'type' => 'read',
                'name' => 'Get Smtp Template',
                'description' => 'Get an SMTP template.',
                'icon' => 'ph:envelope',
            ],
            'brevo_get_transactional_email' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetTransactionalEmail',
                'type' => 'read',
                'name' => 'Get Transactional Email',
                'description' => 'Get a transactional email log by UUID.',
                'icon' => 'ph:envelope',
            ],
            'brevo_get_transactional_sms_aggregated_report' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetTransactionalSmsAggregatedReport',
                'type' => 'read',
                'name' => 'Get Transactional Sms Aggregated Report',
                'description' => 'Get transactional SMS aggregated report.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_get_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetWebhook',
                'type' => 'read',
                'name' => 'Get Webhook',
                'description' => 'Get a webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'brevo_get_whatsapp_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetWhatsAppCampaign',
                'type' => 'read',
                'name' => 'Get Whatsapp Campaign',
                'description' => 'Get a WhatsApp campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_get_whatsapp_config' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoGetWhatsAppConfig',
                'type' => 'read',
                'name' => 'Get Whatsapp Config',
                'description' => 'Get WhatsApp configuration.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_import_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoImportContacts',
                'type' => 'write',
                'name' => 'Import Contacts',
                'description' => 'Import contacts into Brevo.',
                'icon' => 'ph:users',
            ],
            'brevo_list_attributes' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListAttributes',
                'type' => 'read',
                'name' => 'List Attributes',
                'description' => 'List contact attributes.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_blocked_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListBlockedContacts',
                'type' => 'read',
                'name' => 'List Blocked Contacts',
                'description' => 'List blocked SMTP contacts.',
                'icon' => 'ph:users',
            ],
            'brevo_list_blocked_domains' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListBlockedDomains',
                'type' => 'read',
                'name' => 'List Blocked Domains',
                'description' => 'List blocked SMTP domains.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_categories' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListCategories',
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List eCommerce categories.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_contacts' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListContacts',
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Brevo.',
                'icon' => 'ph:users',
            ],
            'brevo_list_contacts_in_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListContactsInList',
                'type' => 'read',
                'name' => 'List Contacts In List',
                'description' => 'List contacts in a contact list.',
                'icon' => 'ph:users',
            ],
            'brevo_list_custom_object_records' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListCustomObjectRecords',
                'type' => 'read',
                'name' => 'List Custom Object Records',
                'description' => 'List custom object records.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_email_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListEmailCampaigns',
                'type' => 'read',
                'name' => 'List Email Campaigns',
                'description' => 'List email campaigns.',
                'icon' => 'ph:envelope',
            ],
            'brevo_list_events' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListEvents',
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List custom events.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_external_feeds' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListExternalFeeds',
                'type' => 'read',
                'name' => 'List External Feeds',
                'description' => 'List external feeds.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_folder_lists' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListFolderLists',
                'type' => 'read',
                'name' => 'List Folder Lists',
                'description' => 'List contact lists in a folder.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_folders' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListFolders',
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List contact folders.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_inbound_events' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListInboundEvents',
                'type' => 'read',
                'name' => 'List Inbound Events',
                'description' => 'List inbound parsing events.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_lists' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListLists',
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List contact lists.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_products' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListProducts',
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List eCommerce products.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_sender_domains' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListSenderDomains',
                'type' => 'read',
                'name' => 'List Sender Domains',
                'description' => 'List sender domains.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_senders' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListSenders',
                'type' => 'read',
                'name' => 'List Senders',
                'description' => 'List senders.',
                'icon' => 'ph:circle',
            ],
            'brevo_list_sms_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListSmsCampaigns',
                'type' => 'read',
                'name' => 'List Sms Campaigns',
                'description' => 'List SMS campaigns.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_list_smtp_events' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListSmtpEvents',
                'type' => 'read',
                'name' => 'List Smtp Events',
                'description' => 'List SMTP events.',
                'icon' => 'ph:envelope',
            ],
            'brevo_list_smtp_reports' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListSmtpReports',
                'type' => 'read',
                'name' => 'List Smtp Reports',
                'description' => 'List SMTP reports.',
                'icon' => 'ph:envelope',
            ],
            'brevo_list_smtp_templates' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListSmtpTemplates',
                'type' => 'read',
                'name' => 'List Smtp Templates',
                'description' => 'List SMTP templates.',
                'icon' => 'ph:envelope',
            ],
            'brevo_list_transactional_emails' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListTransactionalEmails',
                'type' => 'read',
                'name' => 'List Transactional Emails',
                'description' => 'List transactional email logs.',
                'icon' => 'ph:envelope',
            ],
            'brevo_list_transactional_sms_events' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListTransactionalSmsEvents',
                'type' => 'read',
                'name' => 'List Transactional Sms Events',
                'description' => 'List transactional SMS events.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_list_transactional_sms_reports' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListTransactionalSmsReports',
                'type' => 'read',
                'name' => 'List Transactional Sms Reports',
                'description' => 'List transactional SMS reports.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_list_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListWebhooks',
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List webhooks.',
                'icon' => 'ph:webhooks-logo',
            ],
            'brevo_list_whatsapp_campaigns' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListWhatsAppCampaigns',
                'type' => 'read',
                'name' => 'List Whatsapp Campaigns',
                'description' => 'List WhatsApp campaigns.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_list_whatsapp_events' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListWhatsAppEvents',
                'type' => 'read',
                'name' => 'List Whatsapp Events',
                'description' => 'List WhatsApp transactional events.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_list_whatsapp_templates' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoListWhatsAppTemplates',
                'type' => 'read',
                'name' => 'List Whatsapp Templates',
                'description' => 'List WhatsApp templates.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_remove_contacts_from_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoRemoveContactsFromList',
                'type' => 'write',
                'name' => 'Remove Contacts From List',
                'description' => 'Remove contacts from a contact list.',
                'icon' => 'ph:users',
            ],
            'brevo_send_email' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendEmail',
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send a transactional email.',
                'icon' => 'ph:envelope',
            ],
            'brevo_send_email_campaign_now' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendEmailCampaignNow',
                'type' => 'write',
                'name' => 'Send Email Campaign Now',
                'description' => 'Send an email campaign immediately.',
                'icon' => 'ph:envelope',
            ],
            'brevo_send_sms_campaign_now' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendSmsCampaignNow',
                'type' => 'write',
                'name' => 'Send Sms Campaign Now',
                'description' => 'Send an SMS campaign immediately.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_send_smtp_template_test' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendSmtpTemplateTest',
                'type' => 'write',
                'name' => 'Send Smtp Template Test',
                'description' => 'Send a test for an SMTP template.',
                'icon' => 'ph:envelope',
            ],
            'brevo_send_transactional_sms' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendTransactionalSms',
                'type' => 'write',
                'name' => 'Send Transactional Sms',
                'description' => 'Send a transactional SMS.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_send_whatsapp_message' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendWhatsAppMessage',
                'type' => 'write',
                'name' => 'Send Whatsapp Message',
                'description' => 'Send a transactional WhatsApp message.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_send_whatsapp_template_for_approval' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoSendWhatsAppTemplateForApproval',
                'type' => 'write',
                'name' => 'Send Whatsapp Template For Approval',
                'description' => 'Send a WhatsApp template for approval.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_update_attribute' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateAttribute',
                'type' => 'write',
                'name' => 'Update Attribute',
                'description' => 'Update a contact attribute.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_category' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateCategory',
                'type' => 'write',
                'name' => 'Update Category',
                'description' => 'Update an eCommerce category.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_contact' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateContact',
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update a contact.',
                'icon' => 'ph:users',
            ],
            'brevo_update_email_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateEmailCampaign',
                'type' => 'write',
                'name' => 'Update Email Campaign',
                'description' => 'Update an email campaign.',
                'icon' => 'ph:envelope',
            ],
            'brevo_update_external_feed' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateExternalFeed',
                'type' => 'write',
                'name' => 'Update External Feed',
                'description' => 'Update an external feed.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_folder' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateFolder',
                'type' => 'write',
                'name' => 'Update Folder',
                'description' => 'Update a contact folder.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_list' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateList',
                'type' => 'write',
                'name' => 'Update List',
                'description' => 'Update a contact list.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_product' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateProduct',
                'type' => 'write',
                'name' => 'Update Product',
                'description' => 'Update an eCommerce product.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_sender' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateSender',
                'type' => 'write',
                'name' => 'Update Sender',
                'description' => 'Update a sender.',
                'icon' => 'ph:circle',
            ],
            'brevo_update_sms_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateSmsCampaign',
                'type' => 'write',
                'name' => 'Update Sms Campaign',
                'description' => 'Update an SMS campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_update_smtp_template' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateSmtpTemplate',
                'type' => 'write',
                'name' => 'Update Smtp Template',
                'description' => 'Update an SMTP template.',
                'icon' => 'ph:envelope',
            ],
            'brevo_update_webhook' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateWebhook',
                'type' => 'write',
                'name' => 'Update Webhook',
                'description' => 'Update a webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'brevo_update_whatsapp_campaign' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUpdateWhatsAppCampaign',
                'type' => 'write',
                'name' => 'Update Whatsapp Campaign',
                'description' => 'Update a WhatsApp campaign.',
                'icon' => 'ph:chat-circle-text',
            ],
            'brevo_upload_email_campaign_image' => [
                'class' => 'OpenCompany\\Integrations\\Brevo\\Tools\\BrevoUploadEmailCampaignImage',
                'type' => 'write',
                'name' => 'Upload Email Campaign Image',
                'description' => 'Upload an image for email campaigns.',
                'icon' => 'ph:envelope',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/brevo.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.brevo.com/v3'],
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
     * Resolve a Brevo service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): BrevoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BrevoService(
                apiKey: (string) $creds->get('brevo', 'api_key', '', $account),
                baseUrl: (string) $creds->get('brevo', 'url', 'https://api.brevo.com/v3', $account),
            );
        }

        return app(BrevoService::class);
    }
}