<?php

namespace OpenCompany\Integrations\CampaignMonitor;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Campaign Monitor tools and integration metadata.
 *
 * Exposes the v3.3 API surface for discovery and resolves account-scoped
 * credentials for multi-account host applications.
 */
class CampaignMonitorToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Uses HTTP Basic auth with the API key as the username.'],
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
        return 'campaign-monitor';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Campaign Monitor',
            'description' => 'Email marketing, subscribers, campaigns, and transactional email',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:campaignmonitor',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Campaign Monitor',
            'description' => 'Email marketing, subscriber lists, campaign reporting, transactional email, and webhooks',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:campaignmonitor',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.campaignmonitor.com/api/v3-3/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Campaign Monitor API key',
                'hint' => 'Find your API key in Campaign Monitor account settings under API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.createsend.com/api/v3.3',
                'hint' => 'Defaults to https://api.createsend.com/api/v3.3. Change only for a compatible proxy.',
                'default' => 'https://api.createsend.com/api/v3.3',
                'required' => false,
            ],
        ];
    }

    /**
     * Test credentials with the primary contact endpoint.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.createsend.com/api/v3.3'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/primarycontact.json');

            if (!$response->successful()) {
                $error = $response->json('Message') ?? $response->json('message') ?? "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error' => 'Campaign Monitor API rejected the credentials: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $email = $response->json('EmailAddress');

            return [
                'success' => true,
                'message' => $email ? "Connected to Campaign Monitor as {$email}." : 'Connected to Campaign Monitor.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for integration configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'campaignmonitor_get_current_user' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the account primary contact.', 'icon' => 'ph:user'],
            'campaignmonitor_list_clients' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListClients', 'type' => 'read', 'name' => 'List Clients', 'description' => 'List clients visible to the account.', 'icon' => 'ph:buildings'],
            'campaignmonitor_create_client' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorCreateClient', 'type' => 'write', 'name' => 'Create Client', 'description' => 'Create a client in the account.', 'icon' => 'ph:plus-circle'],
            'campaignmonitor_get_client' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetClient', 'type' => 'read', 'name' => 'Get Client', 'description' => 'Get client details.', 'icon' => 'ph:building'],
            'campaignmonitor_update_client' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUpdateClient', 'type' => 'write', 'name' => 'Update Client', 'description' => 'Update client details.', 'icon' => 'ph:pencil'],
            'campaignmonitor_delete_client' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteClient', 'type' => 'write', 'name' => 'Delete Client', 'description' => 'Delete a client.', 'icon' => 'ph:trash'],
            'campaignmonitor_list_countries' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCountries', 'type' => 'read', 'name' => 'List Countries', 'description' => 'List supported countries for client setup.', 'icon' => 'ph:globe'],
            'campaignmonitor_list_time_zones' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListTimeZones', 'type' => 'read', 'name' => 'List Time Zones', 'description' => 'List supported time zones for client setup.', 'icon' => 'ph:clock'],
            'campaignmonitor_get_system_date' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetSystemDate', 'type' => 'read', 'name' => 'Get System Date', 'description' => 'Get the current Campaign Monitor system date.', 'icon' => 'ph:calendar'],
            'campaignmonitor_list_lists' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListLists', 'type' => 'read', 'name' => 'List Subscriber Lists', 'description' => 'List subscriber lists for a client.', 'icon' => 'ph:list'],
            'campaignmonitor_list_lists_for_email' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListListsForEmail', 'type' => 'read', 'name' => 'List Lists for Email', 'description' => 'List subscriber lists a specific email belongs to.', 'icon' => 'ph:envelope-simple'],
            'campaignmonitor_list_client_segments' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListClientSegments', 'type' => 'read', 'name' => 'List Client Segments', 'description' => 'List segments for a client.', 'icon' => 'ph:funnel'],
            'campaignmonitor_list_client_templates' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListClientTemplates', 'type' => 'read', 'name' => 'List Client Templates', 'description' => 'List templates for a client.', 'icon' => 'ph:layout'],
            'campaignmonitor_list_client_suppression_list' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListClientSuppressionList', 'type' => 'read', 'name' => 'List Client Suppression List', 'description' => 'List suppressed email addresses for a client.', 'icon' => 'ph:prohibit'],
            'campaignmonitor_unsuppress_email' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUnsuppressEmail', 'type' => 'write', 'name' => 'Unsuppress Email', 'description' => 'Remove an email address from a client suppression list.', 'icon' => 'ph:check-circle'],
            'campaignmonitor_list_client_tags' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListClientTags', 'type' => 'read', 'name' => 'List Client Tags', 'description' => 'List campaign tags for a client.', 'icon' => 'ph:tags'],
            'campaignmonitor_list_campaigns' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaigns', 'type' => 'read', 'name' => 'List Campaigns', 'description' => 'List sent campaigns for a client.', 'icon' => 'ph:envelope'],
            'campaignmonitor_list_draft_campaigns' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListDraftCampaigns', 'type' => 'read', 'name' => 'List Draft Campaigns', 'description' => 'List draft campaigns for a client.', 'icon' => 'ph:file-dashed'],
            'campaignmonitor_list_scheduled_campaigns' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListScheduledCampaigns', 'type' => 'read', 'name' => 'List Scheduled Campaigns', 'description' => 'List scheduled campaigns for a client.', 'icon' => 'ph:calendar-check'],
            'campaignmonitor_create_campaign' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorCreateCampaign', 'type' => 'write', 'name' => 'Create Campaign', 'description' => 'Create a draft campaign for a client.', 'icon' => 'ph:plus-circle'],
            'campaignmonitor_get_campaign' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetCampaign', 'type' => 'read', 'name' => 'Get Campaign', 'description' => 'Get campaign details.', 'icon' => 'ph:envelope'],
            'campaignmonitor_delete_campaign' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteCampaign', 'type' => 'write', 'name' => 'Delete Campaign', 'description' => 'Delete a draft or scheduled campaign.', 'icon' => 'ph:trash'],
            'campaignmonitor_send_campaign' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorSendCampaign', 'type' => 'write', 'name' => 'Send Campaign', 'description' => 'Send or schedule a campaign.', 'icon' => 'ph:paper-plane-tilt'],
            'campaignmonitor_unschedule_campaign' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUnscheduleCampaign', 'type' => 'write', 'name' => 'Unschedule Campaign', 'description' => 'Unschedule a campaign and move it back to drafts.', 'icon' => 'ph:calendar-x'],
            'campaignmonitor_get_campaign_summary' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetCampaignSummary', 'type' => 'read', 'name' => 'Get Campaign Summary', 'description' => 'Get campaign summary reporting.', 'icon' => 'ph:chart-bar'],
            'campaignmonitor_get_campaign_email_client_usage' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetCampaignEmailClientUsage', 'type' => 'read', 'name' => 'Get Campaign Email Client Usage', 'description' => 'List email clients used to open a campaign.', 'icon' => 'ph:devices'],
            'campaignmonitor_get_campaign_lists_and_segments' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetCampaignListsAndSegments', 'type' => 'read', 'name' => 'Get Campaign Lists and Segments', 'description' => 'List campaign recipient lists and segments.', 'icon' => 'ph:list-checks'],
            'campaignmonitor_list_campaign_recipients' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaignRecipients', 'type' => 'read', 'name' => 'List Campaign Recipients', 'description' => 'List campaign recipients.', 'icon' => 'ph:users'],
            'campaignmonitor_list_campaign_bounces' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaignBounces', 'type' => 'read', 'name' => 'List Campaign Bounces', 'description' => 'List campaign bounces.', 'icon' => 'ph:warning-circle'],
            'campaignmonitor_list_campaign_opens' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaignOpens', 'type' => 'read', 'name' => 'List Campaign Opens', 'description' => 'List campaign opens.', 'icon' => 'ph:envelope-open'],
            'campaignmonitor_list_campaign_clicks' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaignClicks', 'type' => 'read', 'name' => 'List Campaign Clicks', 'description' => 'List campaign clicks.', 'icon' => 'ph:cursor-click'],
            'campaignmonitor_list_campaign_unsubscribes' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaignUnsubscribes', 'type' => 'read', 'name' => 'List Campaign Unsubscribes', 'description' => 'List campaign unsubscribes.', 'icon' => 'ph:user-minus'],
            'campaignmonitor_list_campaign_spam_complaints' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCampaignSpamComplaints', 'type' => 'read', 'name' => 'List Campaign Spam Complaints', 'description' => 'List campaign spam complaints.', 'icon' => 'ph:warning-octagon'],
            'campaignmonitor_create_list' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorCreateList', 'type' => 'write', 'name' => 'Create List', 'description' => 'Create a subscriber list for a client.', 'icon' => 'ph:list-plus'],
            'campaignmonitor_get_list' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetList', 'type' => 'read', 'name' => 'Get List', 'description' => 'Get subscriber list details.', 'icon' => 'ph:list'],
            'campaignmonitor_update_list' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUpdateList', 'type' => 'write', 'name' => 'Update List', 'description' => 'Update a subscriber list.', 'icon' => 'ph:pencil'],
            'campaignmonitor_delete_list' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteList', 'type' => 'write', 'name' => 'Delete List', 'description' => 'Delete a subscriber list.', 'icon' => 'ph:trash'],
            'campaignmonitor_get_list_stats' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetListStats', 'type' => 'read', 'name' => 'Get List Stats', 'description' => 'Get subscriber list statistics.', 'icon' => 'ph:chart-line'],
            'campaignmonitor_list_custom_fields' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListCustomFields', 'type' => 'read', 'name' => 'List Custom Fields', 'description' => 'List custom fields for a subscriber list.', 'icon' => 'ph:list-dashes'],
            'campaignmonitor_create_custom_field' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorCreateCustomField', 'type' => 'write', 'name' => 'Create Custom Field', 'description' => 'Create a custom field on a list.', 'icon' => 'ph:textbox'],
            'campaignmonitor_update_custom_field' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUpdateCustomField', 'type' => 'write', 'name' => 'Update Custom Field', 'description' => 'Update a custom field on a list.', 'icon' => 'ph:pencil'],
            'campaignmonitor_delete_custom_field' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteCustomField', 'type' => 'write', 'name' => 'Delete Custom Field', 'description' => 'Delete a custom field from a list.', 'icon' => 'ph:trash'],
            'campaignmonitor_list_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListSubscribers', 'type' => 'read', 'name' => 'List Subscribers', 'description' => 'List active subscribers on a list.', 'icon' => 'ph:users'],
            'campaignmonitor_list_unconfirmed_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListUnconfirmedSubscribers', 'type' => 'read', 'name' => 'List Unconfirmed Subscribers', 'description' => 'List unconfirmed subscribers on a list.', 'icon' => 'ph:user-focus'],
            'campaignmonitor_list_unsubscribed_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListUnsubscribedSubscribers', 'type' => 'read', 'name' => 'List Unsubscribed Subscribers', 'description' => 'List unsubscribed subscribers on a list.', 'icon' => 'ph:user-minus'],
            'campaignmonitor_list_deleted_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListDeletedSubscribers', 'type' => 'read', 'name' => 'List Deleted Subscribers', 'description' => 'List deleted subscribers on a list.', 'icon' => 'ph:trash'],
            'campaignmonitor_list_bounced_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListBouncedSubscribers', 'type' => 'read', 'name' => 'List Bounced Subscribers', 'description' => 'List bounced subscribers on a list.', 'icon' => 'ph:warning'],
            'campaignmonitor_add_subscriber' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorAddSubscriber', 'type' => 'write', 'name' => 'Add Subscriber', 'description' => 'Add or update a subscriber on a list.', 'icon' => 'ph:user-plus'],
            'campaignmonitor_import_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorImportSubscribers', 'type' => 'write', 'name' => 'Import Subscribers', 'description' => 'Import many subscribers into a list.', 'icon' => 'ph:upload'],
            'campaignmonitor_get_subscriber' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetSubscriber', 'type' => 'read', 'name' => 'Get Subscriber', 'description' => 'Get subscriber details by email address.', 'icon' => 'ph:user'],
            'campaignmonitor_update_subscriber' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUpdateSubscriber', 'type' => 'write', 'name' => 'Update Subscriber', 'description' => 'Update subscriber details by email address.', 'icon' => 'ph:pencil'],
            'campaignmonitor_delete_subscriber' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteSubscriber', 'type' => 'write', 'name' => 'Delete Subscriber', 'description' => 'Delete a subscriber from a list.', 'icon' => 'ph:user-minus'],
            'campaignmonitor_unsubscribe_subscriber' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUnsubscribeSubscriber', 'type' => 'write', 'name' => 'Unsubscribe Subscriber', 'description' => 'Unsubscribe an email address from a list.', 'icon' => 'ph:user-minus'],
            'campaignmonitor_get_subscriber_history' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetSubscriberHistory', 'type' => 'read', 'name' => 'Get Subscriber History', 'description' => 'Get subscriber history by email address.', 'icon' => 'ph:clock-counter-clockwise'],
            'campaignmonitor_create_segment' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorCreateSegment', 'type' => 'write', 'name' => 'Create Segment', 'description' => 'Create a list segment.', 'icon' => 'ph:plus-circle'],
            'campaignmonitor_get_segment' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetSegment', 'type' => 'read', 'name' => 'Get Segment', 'description' => 'Get segment details.', 'icon' => 'ph:funnel'],
            'campaignmonitor_update_segment' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorUpdateSegment', 'type' => 'write', 'name' => 'Update Segment', 'description' => 'Update a segment.', 'icon' => 'ph:pencil'],
            'campaignmonitor_delete_segment' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteSegment', 'type' => 'write', 'name' => 'Delete Segment', 'description' => 'Delete a segment.', 'icon' => 'ph:trash'],
            'campaignmonitor_list_segment_subscribers' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListSegmentSubscribers', 'type' => 'read', 'name' => 'List Segment Subscribers', 'description' => 'List active subscribers in a segment.', 'icon' => 'ph:users-three'],
            'campaignmonitor_list_webhooks' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListWebhooks', 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List webhooks for a subscriber list.', 'icon' => 'ph:webhooks-logo'],
            'campaignmonitor_create_webhook' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorCreateWebhook', 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a webhook for a subscriber list.', 'icon' => 'ph:plus-circle'],
            'campaignmonitor_get_webhook' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetWebhook', 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Get a list webhook.', 'icon' => 'ph:webhooks-logo'],
            'campaignmonitor_test_webhook' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorTestWebhook', 'type' => 'write', 'name' => 'Test Webhook', 'description' => 'Send a test payload to a webhook.', 'icon' => 'ph:paper-plane-tilt'],
            'campaignmonitor_activate_webhook' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorActivateWebhook', 'type' => 'write', 'name' => 'Activate Webhook', 'description' => 'Activate a list webhook.', 'icon' => 'ph:toggle-right'],
            'campaignmonitor_deactivate_webhook' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeactivateWebhook', 'type' => 'write', 'name' => 'Deactivate Webhook', 'description' => 'Deactivate a list webhook.', 'icon' => 'ph:toggle-left'],
            'campaignmonitor_delete_webhook' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorDeleteWebhook', 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a list webhook.', 'icon' => 'ph:trash'],
            'campaignmonitor_list_smart_emails' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListSmartEmails', 'type' => 'read', 'name' => 'List Smart Emails', 'description' => 'List transactional smart emails.', 'icon' => 'ph:envelope-simple'],
            'campaignmonitor_get_smart_email' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetSmartEmail', 'type' => 'read', 'name' => 'Get Smart Email', 'description' => 'Get transactional smart email details.', 'icon' => 'ph:envelope-simple'],
            'campaignmonitor_send_smart_email' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorSendSmartEmail', 'type' => 'write', 'name' => 'Send Smart Email', 'description' => 'Send a transactional smart email.', 'icon' => 'ph:paper-plane-tilt'],
            'campaignmonitor_send_classic_email' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorSendClassicEmail', 'type' => 'write', 'name' => 'Send Classic Email', 'description' => 'Send a transactional classic email.', 'icon' => 'ph:paper-plane-tilt'],
            'campaignmonitor_list_classic_email_groups' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListClassicEmailGroups', 'type' => 'read', 'name' => 'List Classic Email Groups', 'description' => 'List transactional classic email groups.', 'icon' => 'ph:folders'],
            'campaignmonitor_get_transactional_statistics' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetTransactionalStatistics', 'type' => 'read', 'name' => 'Get Transactional Statistics', 'description' => 'Get transactional delivery and engagement statistics.', 'icon' => 'ph:chart-bar'],
            'campaignmonitor_list_transactional_messages' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorListTransactionalMessages', 'type' => 'read', 'name' => 'List Transactional Messages', 'description' => 'List transactional message timeline entries.', 'icon' => 'ph:list-checks'],
            'campaignmonitor_get_transactional_message' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorGetTransactionalMessage', 'type' => 'read', 'name' => 'Get Transactional Message', 'description' => 'Get transactional message details.', 'icon' => 'ph:envelope'],
            'campaignmonitor_resend_transactional_message' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorResendTransactionalMessage', 'type' => 'write', 'name' => 'Resend Transactional Message', 'description' => 'Resend a transactional message.', 'icon' => 'ph:arrow-clockwise'],
            'campaignmonitor_api_get' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorApiGet', 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Campaign Monitor API path with GET.', 'icon' => 'ph:code'],
            'campaignmonitor_api_post' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorApiPost', 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Campaign Monitor API path with POST.', 'icon' => 'ph:code'],
            'campaignmonitor_api_put' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorApiPut', 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative Campaign Monitor API path with PUT.', 'icon' => 'ph:code'],
            'campaignmonitor_api_delete' => ['class' => 'OpenCompany\\Integrations\\CampaignMonitor\\Tools\\CampaignMonitorApiDelete', 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Campaign Monitor API path with DELETE.', 'icon' => 'ph:code'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/campaign-monitor.md';
    }

    /**
     * Get credential fields needed for authentication.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.createsend.com/api/v3.3'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-scoped credentials.
     *
     * @param  string  $class  Fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context with optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the default or account-scoped API service.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): CampaignMonitorService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CampaignMonitorService(
                apiKey: $creds->get('campaign-monitor', 'api_key', '', $account),
                baseUrl: $creds->get('campaign-monitor', 'url', 'https://api.createsend.com/api/v3.3', $account),
            );
        }

        return app(CampaignMonitorService::class);
    }
}