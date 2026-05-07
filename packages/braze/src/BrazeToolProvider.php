<?php

namespace OpenCompany\Integrations\Braze;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Braze\Tools\BrazeApiDelete;
use OpenCompany\Integrations\Braze\Tools\BrazeApiGet;
use OpenCompany\Integrations\Braze\Tools\BrazeApiPatch;
use OpenCompany\Integrations\Braze\Tools\BrazeApiPost;
use OpenCompany\Integrations\Braze\Tools\BrazeApiPut;
use OpenCompany\Integrations\Braze\Tools\BrazeBlocklistEmails;
use OpenCompany\Integrations\Braze\Tools\BrazeCancelSegmentExport;
use OpenCompany\Integrations\Braze\Tools\BrazeChangeEmailStatus;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateCatalog;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateCatalogFields;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateCatalogItem;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateCatalogItems;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateCatalogSelection;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateContentBlock;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateEmailTemplate;
use OpenCompany\Integrations\Braze\Tools\BrazeCreatePreferenceCenter;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateScheduledMessages;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateScimUser;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateSdkAuthenticationKey;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateSendIds;
use OpenCompany\Integrations\Braze\Tools\BrazeCreateUserAlias;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCampaignTriggerSchedule;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCanvasTriggerSchedule;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCatalog;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCatalogField;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCatalogItem;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCatalogItems;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteCatalogSelection;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteScheduledMessages;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteScimUser;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteSdkAuthenticationKey;
use OpenCompany\Integrations\Braze\Tools\BrazeDeleteUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeDuplicateCampaign;
use OpenCompany\Integrations\Braze\Tools\BrazeDuplicateCanvas;
use OpenCompany\Integrations\Braze\Tools\BrazeEditCatalogItem;
use OpenCompany\Integrations\Braze\Tools\BrazeEditCatalogItems;
use OpenCompany\Integrations\Braze\Tools\BrazeExportGlobalControlGroupUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeExportUsersByIds;
use OpenCompany\Integrations\Braze\Tools\BrazeExportUsersBySegment;
use OpenCompany\Integrations\Braze\Tools\BrazeGeneratePreferenceCenterUrl;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCampaign;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCampaignAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCampaignUrlInfo;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCanvas;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCanvasAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCanvasSummary;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCanvasUrlInfo;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCatalogItem;
use OpenCompany\Integrations\Braze\Tools\BrazeGetCdiSyncStatus;
use OpenCompany\Integrations\Braze\Tools\BrazeGetContentBlock;
use OpenCompany\Integrations\Braze\Tools\BrazeGetDailyActiveUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeGetEmailTemplate;
use OpenCompany\Integrations\Braze\Tools\BrazeGetEventAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetMonthlyActiveUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeGetNewUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeGetPreferenceCenter;
use OpenCompany\Integrations\Braze\Tools\BrazeGetPurchaseQuantityAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetRevenueAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetScimUser;
use OpenCompany\Integrations\Braze\Tools\BrazeGetSegment;
use OpenCompany\Integrations\Braze\Tools\BrazeGetSegmentAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetSendAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetSessionsAnalytics;
use OpenCompany\Integrations\Braze\Tools\BrazeGetSubscriptionGroupStatus;
use OpenCompany\Integrations\Braze\Tools\BrazeGetUninstalls;
use OpenCompany\Integrations\Braze\Tools\BrazeIdentifyUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeListCampaigns;
use OpenCompany\Integrations\Braze\Tools\BrazeListCanvases;
use OpenCompany\Integrations\Braze\Tools\BrazeListCatalogItems;
use OpenCompany\Integrations\Braze\Tools\BrazeListCatalogs;
use OpenCompany\Integrations\Braze\Tools\BrazeListCdiIntegrations;
use OpenCompany\Integrations\Braze\Tools\BrazeListContentBlocks;
use OpenCompany\Integrations\Braze\Tools\BrazeListCustomAttributes;
use OpenCompany\Integrations\Braze\Tools\BrazeListEmailTemplates;
use OpenCompany\Integrations\Braze\Tools\BrazeListEvents;
use OpenCompany\Integrations\Braze\Tools\BrazeListHardBounces;
use OpenCompany\Integrations\Braze\Tools\BrazeListInvalidPhoneNumbers;
use OpenCompany\Integrations\Braze\Tools\BrazeListPreferenceCenters;
use OpenCompany\Integrations\Braze\Tools\BrazeListProducts;
use OpenCompany\Integrations\Braze\Tools\BrazeListScheduledBroadcasts;
use OpenCompany\Integrations\Braze\Tools\BrazeListSdkAuthenticationKeys;
use OpenCompany\Integrations\Braze\Tools\BrazeListSegments;
use OpenCompany\Integrations\Braze\Tools\BrazeListUnsubscribes;
use OpenCompany\Integrations\Braze\Tools\BrazeListUserSubscriptionGroups;
use OpenCompany\Integrations\Braze\Tools\BrazeMergeUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeRemoveExternalId;
use OpenCompany\Integrations\Braze\Tools\BrazeRemoveHardBounces;
use OpenCompany\Integrations\Braze\Tools\BrazeRemoveInvalidPhoneNumbers;
use OpenCompany\Integrations\Braze\Tools\BrazeRemoveSpamEmails;
use OpenCompany\Integrations\Braze\Tools\BrazeRenameExternalId;
use OpenCompany\Integrations\Braze\Tools\BrazeReplaceCatalogItem;
use OpenCompany\Integrations\Braze\Tools\BrazeReplaceCatalogItems;
use OpenCompany\Integrations\Braze\Tools\BrazeScheduleCampaignTrigger;
use OpenCompany\Integrations\Braze\Tools\BrazeScheduleCanvasTrigger;
use OpenCompany\Integrations\Braze\Tools\BrazeSearchScimUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeSendMessages;
use OpenCompany\Integrations\Braze\Tools\BrazeSendTransactionalEmail;
use OpenCompany\Integrations\Braze\Tools\BrazeSetPrimarySdkAuthenticationKey;
use OpenCompany\Integrations\Braze\Tools\BrazeSetSubscriptionGroupStatus;
use OpenCompany\Integrations\Braze\Tools\BrazeSetSubscriptionGroupStatusV2;
use OpenCompany\Integrations\Braze\Tools\BrazeStartLiveActivity;
use OpenCompany\Integrations\Braze\Tools\BrazeTrackUsers;
use OpenCompany\Integrations\Braze\Tools\BrazeTrackUsersBulk;
use OpenCompany\Integrations\Braze\Tools\BrazeTrackUsersSync;
use OpenCompany\Integrations\Braze\Tools\BrazeTriggerCampaignSend;
use OpenCompany\Integrations\Braze\Tools\BrazeTriggerCanvasSend;
use OpenCompany\Integrations\Braze\Tools\BrazeTriggerCdiSync;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateCampaignTriggerSchedule;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateCanvasTriggerSchedule;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateContentBlock;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateEmailTemplate;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateLiveActivity;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdatePreferenceCenter;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateScheduledMessages;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateScimUser;
use OpenCompany\Integrations\Braze\Tools\BrazeUpdateUserAlias;
use OpenCompany\Integrations\Braze\Tools\BrazeUploadMediaAsset;

/**
 * Tool provider for the Braze customer engagement REST API.
 *
 * Registers focused tools for campaigns, Canvases, users, messaging,
 * catalogs, templates, subscriptions, SCIM, and supporting analytics APIs.
 */
class BrazeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'braze';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Braze',
            'description' => 'Customer engagement and messaging automation',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:braze',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Braze',
            'description' => 'Lifecycle engagement platform for campaigns, messaging, users, catalogs, templates, and analytics.',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:braze',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.braze.com/docs/api/basics/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'REST API Key',
                'placeholder' => 'Enter your Braze REST API key',
                'hint' => 'Create a REST API key in Settings > APIs and Identifiers > API Keys.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'REST Endpoint',
                'placeholder' => 'https://rest.iad-01.braze.com',
                'hint' => 'Use the REST endpoint shown next to the API key for your Braze region.',
                'default' => 'https://rest.iad-01.braze.com',
            ],
        ];
    }

    /**
     * Test Braze credentials with a lightweight campaign list request.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://rest.iad-01.braze.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'API key is required.'];
        }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey])
                ->acceptJson()
                ->asJson()
                ->timeout(10)
                ->get($baseUrl . '/campaigns/list', ['limit' => 1, 'page' => 0]);

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();

                return ['success' => false, 'error' => is_string($error) ? $error : json_encode($error)];
            }

            return ['success' => true, 'message' => "Connected to Braze API at {$baseUrl}."];
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

    public function tools(): array
    {
        return [
            'braze_api_get' => [
                'class' => BrazeApiGet::class,
                'type' => 'read',
                'name' => 'Api Get',
                'description' => 'Call any Braze REST API GET endpoint with query parameters.',
                'icon' => 'ph:megaphone',
            ],
            'braze_api_post' => [
                'class' => BrazeApiPost::class,
                'type' => 'write',
                'name' => 'Api Post',
                'description' => 'Call any Braze REST API POST endpoint with a JSON payload.',
                'icon' => 'ph:megaphone',
            ],
            'braze_api_put' => [
                'class' => BrazeApiPut::class,
                'type' => 'write',
                'name' => 'Api Put',
                'description' => 'Call any Braze REST API PUT endpoint with a JSON payload.',
                'icon' => 'ph:megaphone',
            ],
            'braze_api_patch' => [
                'class' => BrazeApiPatch::class,
                'type' => 'write',
                'name' => 'Api Patch',
                'description' => 'Call any Braze REST API PATCH endpoint with a JSON payload.',
                'icon' => 'ph:megaphone',
            ],
            'braze_api_delete' => [
                'class' => BrazeApiDelete::class,
                'type' => 'write',
                'name' => 'Api Delete',
                'description' => 'Call any Braze REST API DELETE endpoint with query parameters.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_catalogs' => [
                'class' => BrazeListCatalogs::class,
                'type' => 'read',
                'name' => 'List Catalogs',
                'description' => 'List Braze catalogs.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_catalog' => [
                'class' => BrazeCreateCatalog::class,
                'type' => 'write',
                'name' => 'Create Catalog',
                'description' => 'Create a Braze catalog.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_catalog' => [
                'class' => BrazeDeleteCatalog::class,
                'type' => 'write',
                'name' => 'Delete Catalog',
                'description' => 'Delete a Braze catalog.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_catalog_items' => [
                'class' => BrazeListCatalogItems::class,
                'type' => 'read',
                'name' => 'List Catalog Items',
                'description' => 'List items in a Braze catalog.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_catalog_item' => [
                'class' => BrazeGetCatalogItem::class,
                'type' => 'read',
                'name' => 'Get Catalog Item',
                'description' => 'Get a single Braze catalog item.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_catalog_item' => [
                'class' => BrazeCreateCatalogItem::class,
                'type' => 'write',
                'name' => 'Create Catalog Item',
                'description' => 'Create a Braze catalog item.',
                'icon' => 'ph:megaphone',
            ],
            'braze_replace_catalog_item' => [
                'class' => BrazeReplaceCatalogItem::class,
                'type' => 'write',
                'name' => 'Replace Catalog Item',
                'description' => 'Replace a Braze catalog item.',
                'icon' => 'ph:megaphone',
            ],
            'braze_edit_catalog_item' => [
                'class' => BrazeEditCatalogItem::class,
                'type' => 'write',
                'name' => 'Edit Catalog Item',
                'description' => 'Edit a Braze catalog item.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_catalog_item' => [
                'class' => BrazeDeleteCatalogItem::class,
                'type' => 'write',
                'name' => 'Delete Catalog Item',
                'description' => 'Delete a Braze catalog item.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_catalog_items' => [
                'class' => BrazeCreateCatalogItems::class,
                'type' => 'write',
                'name' => 'Create Catalog Items',
                'description' => 'Create multiple Braze catalog items asynchronously.',
                'icon' => 'ph:megaphone',
            ],
            'braze_replace_catalog_items' => [
                'class' => BrazeReplaceCatalogItems::class,
                'type' => 'write',
                'name' => 'Replace Catalog Items',
                'description' => 'Replace multiple Braze catalog items asynchronously.',
                'icon' => 'ph:megaphone',
            ],
            'braze_edit_catalog_items' => [
                'class' => BrazeEditCatalogItems::class,
                'type' => 'write',
                'name' => 'Edit Catalog Items',
                'description' => 'Edit multiple Braze catalog items asynchronously.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_catalog_items' => [
                'class' => BrazeDeleteCatalogItems::class,
                'type' => 'write',
                'name' => 'Delete Catalog Items',
                'description' => 'Delete multiple Braze catalog items asynchronously.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_catalog_fields' => [
                'class' => BrazeCreateCatalogFields::class,
                'type' => 'write',
                'name' => 'Create Catalog Fields',
                'description' => 'Create Braze catalog fields.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_catalog_field' => [
                'class' => BrazeDeleteCatalogField::class,
                'type' => 'write',
                'name' => 'Delete Catalog Field',
                'description' => 'Delete a Braze catalog field.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_catalog_selection' => [
                'class' => BrazeCreateCatalogSelection::class,
                'type' => 'write',
                'name' => 'Create Catalog Selection',
                'description' => 'Create a Braze catalog selection.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_catalog_selection' => [
                'class' => BrazeDeleteCatalogSelection::class,
                'type' => 'write',
                'name' => 'Delete Catalog Selection',
                'description' => 'Delete a Braze catalog selection.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_cdi_integrations' => [
                'class' => BrazeListCdiIntegrations::class,
                'type' => 'read',
                'name' => 'List Cdi Integrations',
                'description' => 'List Braze Cloud Data Ingestion integrations.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_cdi_sync_status' => [
                'class' => BrazeGetCdiSyncStatus::class,
                'type' => 'read',
                'name' => 'Get Cdi Sync Status',
                'description' => 'Get Cloud Data Ingestion sync status.',
                'icon' => 'ph:megaphone',
            ],
            'braze_trigger_cdi_sync' => [
                'class' => BrazeTriggerCdiSync::class,
                'type' => 'write',
                'name' => 'Trigger Cdi Sync',
                'description' => 'Trigger a Cloud Data Ingestion sync.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_hard_bounces' => [
                'class' => BrazeListHardBounces::class,
                'type' => 'read',
                'name' => 'List Hard Bounces',
                'description' => 'Query hard bounced email addresses.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_unsubscribes' => [
                'class' => BrazeListUnsubscribes::class,
                'type' => 'read',
                'name' => 'List Unsubscribes',
                'description' => 'Query unsubscribed email addresses.',
                'icon' => 'ph:megaphone',
            ],
            'braze_change_email_status' => [
                'class' => BrazeChangeEmailStatus::class,
                'type' => 'write',
                'name' => 'Change Email Status',
                'description' => 'Change an email subscription status.',
                'icon' => 'ph:megaphone',
            ],
            'braze_remove_hard_bounces' => [
                'class' => BrazeRemoveHardBounces::class,
                'type' => 'write',
                'name' => 'Remove Hard Bounces',
                'description' => 'Remove email addresses from the hard bounce list.',
                'icon' => 'ph:megaphone',
            ],
            'braze_remove_spam_emails' => [
                'class' => BrazeRemoveSpamEmails::class,
                'type' => 'write',
                'name' => 'Remove Spam Emails',
                'description' => 'Remove email addresses from the spam list.',
                'icon' => 'ph:megaphone',
            ],
            'braze_blocklist_emails' => [
                'class' => BrazeBlocklistEmails::class,
                'type' => 'write',
                'name' => 'Blocklist Emails',
                'description' => 'Blocklist email addresses in Braze.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_campaigns' => [
                'class' => BrazeListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List Braze campaigns.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_campaign' => [
                'class' => BrazeGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get Braze campaign details.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_campaign_analytics' => [
                'class' => BrazeGetCampaignAnalytics::class,
                'type' => 'read',
                'name' => 'Get Campaign Analytics',
                'description' => 'Export campaign analytics over a time range.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_send_analytics' => [
                'class' => BrazeGetSendAnalytics::class,
                'type' => 'read',
                'name' => 'Get Send Analytics',
                'description' => 'Export send analytics over a time range.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_campaign_url_info' => [
                'class' => BrazeGetCampaignUrlInfo::class,
                'type' => 'read',
                'name' => 'Get Campaign Url Info',
                'description' => 'Get URL details for a campaign message variation.',
                'icon' => 'ph:megaphone',
            ],
            'braze_duplicate_campaign' => [
                'class' => BrazeDuplicateCampaign::class,
                'type' => 'write',
                'name' => 'Duplicate Campaign',
                'description' => 'Duplicate a Braze campaign.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_canvases' => [
                'class' => BrazeListCanvases::class,
                'type' => 'read',
                'name' => 'List Canvases',
                'description' => 'List Braze Canvases.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_canvas' => [
                'class' => BrazeGetCanvas::class,
                'type' => 'read',
                'name' => 'Get Canvas',
                'description' => 'Get Braze Canvas details.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_canvas_analytics' => [
                'class' => BrazeGetCanvasAnalytics::class,
                'type' => 'read',
                'name' => 'Get Canvas Analytics',
                'description' => 'Export Canvas analytics over a time range.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_canvas_summary' => [
                'class' => BrazeGetCanvasSummary::class,
                'type' => 'read',
                'name' => 'Get Canvas Summary',
                'description' => 'Export Canvas summary analytics.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_canvas_url_info' => [
                'class' => BrazeGetCanvasUrlInfo::class,
                'type' => 'read',
                'name' => 'Get Canvas Url Info',
                'description' => 'Get URL details for a Canvas step message variation.',
                'icon' => 'ph:megaphone',
            ],
            'braze_duplicate_canvas' => [
                'class' => BrazeDuplicateCanvas::class,
                'type' => 'write',
                'name' => 'Duplicate Canvas',
                'description' => 'Duplicate a Braze Canvas.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_events' => [
                'class' => BrazeListEvents::class,
                'type' => 'read',
                'name' => 'List Events',
                'description' => 'List custom events.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_event_analytics' => [
                'class' => BrazeGetEventAnalytics::class,
                'type' => 'read',
                'name' => 'Get Event Analytics',
                'description' => 'Export custom event analytics.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_custom_attributes' => [
                'class' => BrazeListCustomAttributes::class,
                'type' => 'read',
                'name' => 'List Custom Attributes',
                'description' => 'Export custom attributes.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_sessions_analytics' => [
                'class' => BrazeGetSessionsAnalytics::class,
                'type' => 'read',
                'name' => 'Get Sessions Analytics',
                'description' => 'Export app sessions by time.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_daily_active_users' => [
                'class' => BrazeGetDailyActiveUsers::class,
                'type' => 'read',
                'name' => 'Get Daily Active Users',
                'description' => 'Export daily active users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_monthly_active_users' => [
                'class' => BrazeGetMonthlyActiveUsers::class,
                'type' => 'read',
                'name' => 'Get Monthly Active Users',
                'description' => 'Export monthly active users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_new_users' => [
                'class' => BrazeGetNewUsers::class,
                'type' => 'read',
                'name' => 'Get New Users',
                'description' => 'Export daily new users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_uninstalls' => [
                'class' => BrazeGetUninstalls::class,
                'type' => 'read',
                'name' => 'Get Uninstalls',
                'description' => 'Export app uninstalls.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_products' => [
                'class' => BrazeListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'Export product IDs purchased in the app.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_revenue_analytics' => [
                'class' => BrazeGetRevenueAnalytics::class,
                'type' => 'read',
                'name' => 'Get Revenue Analytics',
                'description' => 'Export revenue data.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_purchase_quantity_analytics' => [
                'class' => BrazeGetPurchaseQuantityAnalytics::class,
                'type' => 'read',
                'name' => 'Get Purchase Quantity Analytics',
                'description' => 'Export number of purchases.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_segments' => [
                'class' => BrazeListSegments::class,
                'type' => 'read',
                'name' => 'List Segments',
                'description' => 'List Braze segments.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_segment' => [
                'class' => BrazeGetSegment::class,
                'type' => 'read',
                'name' => 'Get Segment',
                'description' => 'Get Braze segment details.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_segment_analytics' => [
                'class' => BrazeGetSegmentAnalytics::class,
                'type' => 'read',
                'name' => 'Get Segment Analytics',
                'description' => 'Export segment analytics.',
                'icon' => 'ph:megaphone',
            ],
            'braze_cancel_segment_export' => [
                'class' => BrazeCancelSegmentExport::class,
                'type' => 'write',
                'name' => 'Cancel Segment Export',
                'description' => 'Cancel user exports by segment.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_send_ids' => [
                'class' => BrazeCreateSendIds::class,
                'type' => 'write',
                'name' => 'Create Send Ids',
                'description' => 'Create send IDs for message blast tracking.',
                'icon' => 'ph:megaphone',
            ],
            'braze_send_messages' => [
                'class' => BrazeSendMessages::class,
                'type' => 'write',
                'name' => 'Send Messages',
                'description' => 'Send immediate API-only messages.',
                'icon' => 'ph:megaphone',
            ],
            'braze_send_transactional_email' => [
                'class' => BrazeSendTransactionalEmail::class,
                'type' => 'write',
                'name' => 'Send Transactional Email',
                'description' => 'Send a transactional email using API-triggered delivery.',
                'icon' => 'ph:megaphone',
            ],
            'braze_trigger_campaign_send' => [
                'class' => BrazeTriggerCampaignSend::class,
                'type' => 'write',
                'name' => 'Trigger Campaign Send',
                'description' => 'Trigger an API-triggered Braze campaign.',
                'icon' => 'ph:megaphone',
            ],
            'braze_trigger_canvas_send' => [
                'class' => BrazeTriggerCanvasSend::class,
                'type' => 'write',
                'name' => 'Trigger Canvas Send',
                'description' => 'Trigger an API-triggered Braze Canvas.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_scheduled_broadcasts' => [
                'class' => BrazeListScheduledBroadcasts::class,
                'type' => 'read',
                'name' => 'List Scheduled Broadcasts',
                'description' => 'List upcoming scheduled campaigns and Canvases.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_scheduled_messages' => [
                'class' => BrazeCreateScheduledMessages::class,
                'type' => 'write',
                'name' => 'Create Scheduled Messages',
                'description' => 'Create scheduled messages.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_scheduled_messages' => [
                'class' => BrazeUpdateScheduledMessages::class,
                'type' => 'write',
                'name' => 'Update Scheduled Messages',
                'description' => 'Update scheduled messages.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_scheduled_messages' => [
                'class' => BrazeDeleteScheduledMessages::class,
                'type' => 'write',
                'name' => 'Delete Scheduled Messages',
                'description' => 'Delete scheduled messages.',
                'icon' => 'ph:megaphone',
            ],
            'braze_schedule_campaign_trigger' => [
                'class' => BrazeScheduleCampaignTrigger::class,
                'type' => 'write',
                'name' => 'Schedule Campaign Trigger',
                'description' => 'Schedule an API-triggered campaign.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_campaign_trigger_schedule' => [
                'class' => BrazeUpdateCampaignTriggerSchedule::class,
                'type' => 'write',
                'name' => 'Update Campaign Trigger Schedule',
                'description' => 'Update a scheduled API-triggered campaign.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_campaign_trigger_schedule' => [
                'class' => BrazeDeleteCampaignTriggerSchedule::class,
                'type' => 'write',
                'name' => 'Delete Campaign Trigger Schedule',
                'description' => 'Delete a scheduled API-triggered campaign.',
                'icon' => 'ph:megaphone',
            ],
            'braze_schedule_canvas_trigger' => [
                'class' => BrazeScheduleCanvasTrigger::class,
                'type' => 'write',
                'name' => 'Schedule Canvas Trigger',
                'description' => 'Schedule an API-triggered Canvas.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_canvas_trigger_schedule' => [
                'class' => BrazeUpdateCanvasTriggerSchedule::class,
                'type' => 'write',
                'name' => 'Update Canvas Trigger Schedule',
                'description' => 'Update a scheduled API-triggered Canvas.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_canvas_trigger_schedule' => [
                'class' => BrazeDeleteCanvasTriggerSchedule::class,
                'type' => 'write',
                'name' => 'Delete Canvas Trigger Schedule',
                'description' => 'Delete a scheduled API-triggered Canvas.',
                'icon' => 'ph:megaphone',
            ],
            'braze_start_live_activity' => [
                'class' => BrazeStartLiveActivity::class,
                'type' => 'write',
                'name' => 'Start Live Activity',
                'description' => 'Start an iOS Live Activity.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_live_activity' => [
                'class' => BrazeUpdateLiveActivity::class,
                'type' => 'write',
                'name' => 'Update Live Activity',
                'description' => 'Update an iOS Live Activity.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_preference_centers' => [
                'class' => BrazeListPreferenceCenters::class,
                'type' => 'read',
                'name' => 'List Preference Centers',
                'description' => 'List Braze preference centers.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_preference_center' => [
                'class' => BrazeGetPreferenceCenter::class,
                'type' => 'read',
                'name' => 'Get Preference Center',
                'description' => 'Get a Braze preference center.',
                'icon' => 'ph:megaphone',
            ],
            'braze_generate_preference_center_url' => [
                'class' => BrazeGeneratePreferenceCenterUrl::class,
                'type' => 'read',
                'name' => 'Generate Preference Center Url',
                'description' => 'Generate a preference center URL for a user.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_preference_center' => [
                'class' => BrazeCreatePreferenceCenter::class,
                'type' => 'write',
                'name' => 'Create Preference Center',
                'description' => 'Create a Braze preference center.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_preference_center' => [
                'class' => BrazeUpdatePreferenceCenter::class,
                'type' => 'write',
                'name' => 'Update Preference Center',
                'description' => 'Update a Braze preference center.',
                'icon' => 'ph:megaphone',
            ],
            'braze_search_scim_users' => [
                'class' => BrazeSearchScimUsers::class,
                'type' => 'read',
                'name' => 'Search Scim Users',
                'description' => 'Search Braze dashboard SCIM users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_scim_user' => [
                'class' => BrazeGetScimUser::class,
                'type' => 'read',
                'name' => 'Get Scim User',
                'description' => 'Look up a Braze dashboard SCIM user.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_scim_user' => [
                'class' => BrazeCreateScimUser::class,
                'type' => 'write',
                'name' => 'Create Scim User',
                'description' => 'Create a Braze dashboard SCIM user.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_scim_user' => [
                'class' => BrazeUpdateScimUser::class,
                'type' => 'write',
                'name' => 'Update Scim User',
                'description' => 'Update a Braze dashboard SCIM user.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_scim_user' => [
                'class' => BrazeDeleteScimUser::class,
                'type' => 'write',
                'name' => 'Delete Scim User',
                'description' => 'Remove a Braze dashboard SCIM user.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_sdk_authentication_key' => [
                'class' => BrazeCreateSdkAuthenticationKey::class,
                'type' => 'write',
                'name' => 'Create Sdk Authentication Key',
                'description' => 'Create an SDK authentication key.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_sdk_authentication_keys' => [
                'class' => BrazeListSdkAuthenticationKeys::class,
                'type' => 'read',
                'name' => 'List Sdk Authentication Keys',
                'description' => 'List SDK authentication keys.',
                'icon' => 'ph:megaphone',
            ],
            'braze_set_primary_sdk_authentication_key' => [
                'class' => BrazeSetPrimarySdkAuthenticationKey::class,
                'type' => 'write',
                'name' => 'Set Primary Sdk Authentication Key',
                'description' => 'Set the primary SDK authentication key.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_sdk_authentication_key' => [
                'class' => BrazeDeleteSdkAuthenticationKey::class,
                'type' => 'write',
                'name' => 'Delete Sdk Authentication Key',
                'description' => 'Delete an SDK authentication key.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_invalid_phone_numbers' => [
                'class' => BrazeListInvalidPhoneNumbers::class,
                'type' => 'read',
                'name' => 'List Invalid Phone Numbers',
                'description' => 'Query invalid phone numbers.',
                'icon' => 'ph:megaphone',
            ],
            'braze_remove_invalid_phone_numbers' => [
                'class' => BrazeRemoveInvalidPhoneNumbers::class,
                'type' => 'write',
                'name' => 'Remove Invalid Phone Numbers',
                'description' => 'Remove invalid phone number flags.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_subscription_group_status' => [
                'class' => BrazeGetSubscriptionGroupStatus::class,
                'type' => 'read',
                'name' => 'Get Subscription Group Status',
                'description' => 'List users subscription group status.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_user_subscription_groups' => [
                'class' => BrazeListUserSubscriptionGroups::class,
                'type' => 'read',
                'name' => 'List User Subscription Groups',
                'description' => 'List subscription groups for users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_set_subscription_group_status' => [
                'class' => BrazeSetSubscriptionGroupStatus::class,
                'type' => 'write',
                'name' => 'Set Subscription Group Status',
                'description' => 'Update users subscription group status.',
                'icon' => 'ph:megaphone',
            ],
            'braze_set_subscription_group_status_v2' => [
                'class' => BrazeSetSubscriptionGroupStatusV2::class,
                'type' => 'write',
                'name' => 'Set Subscription Group Status V2',
                'description' => 'Update users subscription group status using v2 semantics.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_content_blocks' => [
                'class' => BrazeListContentBlocks::class,
                'type' => 'read',
                'name' => 'List Content Blocks',
                'description' => 'List available content blocks.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_content_block' => [
                'class' => BrazeGetContentBlock::class,
                'type' => 'read',
                'name' => 'Get Content Block',
                'description' => 'Get Content Block information.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_content_block' => [
                'class' => BrazeCreateContentBlock::class,
                'type' => 'write',
                'name' => 'Create Content Block',
                'description' => 'Create a Content Block.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_content_block' => [
                'class' => BrazeUpdateContentBlock::class,
                'type' => 'write',
                'name' => 'Update Content Block',
                'description' => 'Update a Content Block.',
                'icon' => 'ph:megaphone',
            ],
            'braze_list_email_templates' => [
                'class' => BrazeListEmailTemplates::class,
                'type' => 'read',
                'name' => 'List Email Templates',
                'description' => 'List email templates.',
                'icon' => 'ph:megaphone',
            ],
            'braze_get_email_template' => [
                'class' => BrazeGetEmailTemplate::class,
                'type' => 'read',
                'name' => 'Get Email Template',
                'description' => 'Get email template information.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_email_template' => [
                'class' => BrazeCreateEmailTemplate::class,
                'type' => 'write',
                'name' => 'Create Email Template',
                'description' => 'Create an email template.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_email_template' => [
                'class' => BrazeUpdateEmailTemplate::class,
                'type' => 'write',
                'name' => 'Update Email Template',
                'description' => 'Update an email template.',
                'icon' => 'ph:megaphone',
            ],
            'braze_create_user_alias' => [
                'class' => BrazeCreateUserAlias::class,
                'type' => 'write',
                'name' => 'Create User Alias',
                'description' => 'Create a new user alias.',
                'icon' => 'ph:megaphone',
            ],
            'braze_update_user_alias' => [
                'class' => BrazeUpdateUserAlias::class,
                'type' => 'write',
                'name' => 'Update User Alias',
                'description' => 'Update a user alias.',
                'icon' => 'ph:megaphone',
            ],
            'braze_identify_users' => [
                'class' => BrazeIdentifyUsers::class,
                'type' => 'write',
                'name' => 'Identify Users',
                'description' => 'Identify alias-only users with external IDs.',
                'icon' => 'ph:megaphone',
            ],
            'braze_track_users' => [
                'class' => BrazeTrackUsers::class,
                'type' => 'write',
                'name' => 'Track Users',
                'description' => 'Create or update users, custom events, and purchases.',
                'icon' => 'ph:megaphone',
            ],
            'braze_track_users_bulk' => [
                'class' => BrazeTrackUsersBulk::class,
                'type' => 'write',
                'name' => 'Track Users Bulk',
                'description' => 'Create or update users in bulk.',
                'icon' => 'ph:megaphone',
            ],
            'braze_track_users_sync' => [
                'class' => BrazeTrackUsersSync::class,
                'type' => 'write',
                'name' => 'Track Users Sync',
                'description' => 'Synchronously create or update users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_delete_users' => [
                'class' => BrazeDeleteUsers::class,
                'type' => 'write',
                'name' => 'Delete Users',
                'description' => 'Delete Braze users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_merge_users' => [
                'class' => BrazeMergeUsers::class,
                'type' => 'write',
                'name' => 'Merge Users',
                'description' => 'Merge Braze users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_rename_external_id' => [
                'class' => BrazeRenameExternalId::class,
                'type' => 'write',
                'name' => 'Rename External Id',
                'description' => 'Rename a user external ID.',
                'icon' => 'ph:megaphone',
            ],
            'braze_remove_external_id' => [
                'class' => BrazeRemoveExternalId::class,
                'type' => 'write',
                'name' => 'Remove External Id',
                'description' => 'Remove user external IDs.',
                'icon' => 'ph:megaphone',
            ],
            'braze_export_users_by_ids' => [
                'class' => BrazeExportUsersByIds::class,
                'type' => 'read',
                'name' => 'Export Users By Ids',
                'description' => 'Export user profiles by identifiers.',
                'icon' => 'ph:megaphone',
            ],
            'braze_export_users_by_segment' => [
                'class' => BrazeExportUsersBySegment::class,
                'type' => 'read',
                'name' => 'Export Users By Segment',
                'description' => 'Export user profiles by segment.',
                'icon' => 'ph:megaphone',
            ],
            'braze_export_global_control_group_users' => [
                'class' => BrazeExportGlobalControlGroupUsers::class,
                'type' => 'read',
                'name' => 'Export Global Control Group Users',
                'description' => 'Export global control group users.',
                'icon' => 'ph:megaphone',
            ],
            'braze_upload_media_asset' => [
                'class' => BrazeUploadMediaAsset::class,
                'type' => 'write',
                'name' => 'Upload Media Asset',
                'description' => 'Upload an asset to the Braze media library.',
                'icon' => 'ph:megaphone',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/braze.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'REST API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'REST Endpoint', 'required' => false, 'default' => 'https://rest.iad-01.braze.com'],
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
     * Resolve the correct Braze service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): BrazeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BrazeService(
                apiKey: $creds->get('braze', 'api_key', '', $account),
                baseUrl: $creds->get('braze', 'url', 'https://rest.iad-01.braze.com', $account),
            );
        }

        return app(BrazeService::class);
    }
}