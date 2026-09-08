<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for VBOUT.
 *
 * Exposes the official VBOUT OpenAPI operation surface for email marketing,
 * social media, users, goals, webhooks, account setup, settings, and templates.
 */
class VboutToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['VBOUT uses an API user key sent as the key query parameter.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'vbout';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'VBOUT',
            'description' => 'Email marketing, CRM, automation, goals, webhooks, and social posting',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vbout',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'VBOUT',
            'description' => 'Manage VBOUT email marketing, contacts, lists, campaigns, social posts, users, goals, webhooks, settings, and automation templates.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:vbout',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.vbout.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Verify VBOUT credentials with the account profile endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.vbout.com/1'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl.'/App/Me', ['key' => $apiKey]);

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Authentication failed (HTTP '.$response->status().'). Check your API key.'];
            }

            return ['success' => true, 'message' => 'Connected to VBOUT API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'url' => 'nullable|url'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vbout.com/1'],
        ];
    }

    public function tools(): array
    {
        return [
            'vbout_get_current_user' => ['class' => __NAMESPACE__.'\\Tools\\VboutGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Call the VBOUT Get Current User endpoint. Authentication: Required Response Formats: XML | JSON Particular endpoint Including All Possible Endpoints\' responses', 'icon' => 'ph:list'],
            'vbout_social_media_channels' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaChannels', 'type' => 'read', 'name' => 'Social Media Channels', 'description' => 'Call the VBOUT Social Media Channels endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_social_media_calendar' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaCalendar', 'type' => 'read', 'name' => 'Social Media Calendar', 'description' => 'Call the VBOUT Social Media Calendar endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_social_media_stats' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaStats', 'type' => 'read', 'name' => 'Social Media Stats', 'description' => 'Call the VBOUT Social Media Stats endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_social_media_get_post' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaGetPost', 'type' => 'read', 'name' => 'Social Media Post', 'description' => 'Call the VBOUT Social Media Post endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_social_media_add_post' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaAddPost', 'type' => 'write', 'name' => 'Social Media Add Post', 'description' => 'Call the VBOUT Social Media Add Post endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_social_media_edit_post' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaEditPost', 'type' => 'write', 'name' => 'Social Media Edit Post', 'description' => 'Call the VBOUT Social Media Edit Post endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_social_media_delete_post' => ['class' => __NAMESPACE__.'\\Tools\\VboutSocialMediaDeletePost', 'type' => 'write', 'name' => 'Social Media Delete Post', 'description' => 'Call the VBOUT Social Media Delete Post endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_list_campaigns' => ['class' => __NAMESPACE__.'\\Tools\\VboutListCampaigns', 'type' => 'read', 'name' => 'List Campaigns', 'description' => 'Call the VBOUT List Campaigns endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_get_campaign' => ['class' => __NAMESPACE__.'\\Tools\\VboutGetCampaign', 'type' => 'read', 'name' => 'Get Campaign', 'description' => 'Call the VBOUT Get Campaign endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_stats' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingStats', 'type' => 'read', 'name' => 'Email Marketing Stats', 'description' => 'Call the VBOUT Email Marketing Stats endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_add_campaign' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingAddCampaign', 'type' => 'write', 'name' => 'Email Marketing Add Campaign', 'description' => 'Call the VBOUT Email Marketing Add Campaign endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_edit_campaign' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingEditCampaign', 'type' => 'write', 'name' => 'Email Marketing Edit Campaign', 'description' => 'Call the VBOUT Email Marketing Edit Campaign endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_delete_campaign' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingDeleteCampaign', 'type' => 'write', 'name' => 'Email Marketing Delete Campaign', 'description' => 'Call the VBOUT Email Marketing Delete Campaign endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_list_contacts' => ['class' => __NAMESPACE__.'\\Tools\\VboutListContacts', 'type' => 'read', 'name' => 'List Contacts', 'description' => 'Call the VBOUT List Contacts endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_get_contacts_by_phone_number' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetContactsByPhoneNumber', 'type' => 'read', 'name' => 'Email Marketing Contacts By Phone Number', 'description' => 'Call the VBOUT Email Marketing Contacts By Phone Number endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_get_contact_by_email' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetContactByEmail', 'type' => 'read', 'name' => 'Email Marketing Contact By Email', 'description' => 'Call the VBOUT Email Marketing Contact By Email endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_get_contact' => ['class' => __NAMESPACE__.'\\Tools\\VboutGetContact', 'type' => 'read', 'name' => 'Get Contact', 'description' => 'Call the VBOUT Get Contact endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_create_contact' => ['class' => __NAMESPACE__.'\\Tools\\VboutCreateContact', 'type' => 'write', 'name' => 'Create Contact', 'description' => 'Call the VBOUT Create Contact endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_edit_contact' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingEditContact', 'type' => 'write', 'name' => 'Email Marketing Edit Contact', 'description' => 'Call the VBOUT Email Marketing Edit Contact endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_sync_contact' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingSyncContact', 'type' => 'write', 'name' => 'Email Marketing Sync Contact', 'description' => 'Call the VBOUT Email Marketing Sync Contact endpoint. Authentication: Required Response Formats: XML | JSON Note: All emails having the same email text available in the provided list will be updated if exists (case email is not required).', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_delete_contact' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingDeleteContact', 'type' => 'write', 'name' => 'Email Marketing Delete Contact', 'description' => 'Call the VBOUT Email Marketing Delete Contact endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_move_contact' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingMoveContact', 'type' => 'write', 'name' => 'Email Marketing Move Contact', 'description' => 'Call the VBOUT Email Marketing Move Contact endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_get_contact_timeline' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetContactTimeline', 'type' => 'read', 'name' => 'Email Marketing Contact Timeline', 'description' => 'Call the VBOUT Email Marketing Contact Timeline endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_get_contact_timeline_by_email_address' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetContactTimelineByEmailAddress', 'type' => 'read', 'name' => 'Email Marketing Contact Timeline By Email Address', 'description' => 'Call the VBOUT Email Marketing Contact Timeline By Email Address endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_get_audiences' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetAudiences', 'type' => 'read', 'name' => 'Email Marketing Audiences', 'description' => 'Call the VBOUT Email Marketing Audiences endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_email_marketing_get_lists' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetLists', 'type' => 'read', 'name' => 'Email Marketing Lists', 'description' => 'Call the VBOUT Email Marketing Lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_email_marketing_get_list' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetList', 'type' => 'read', 'name' => 'Email Marketing List', 'description' => 'Call the VBOUT Email Marketing List endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_email_marketing_add_list' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingAddList', 'type' => 'write', 'name' => 'Email Marketing Add List', 'description' => 'Call the VBOUT Email Marketing Add List endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_editlist' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingEditlist', 'type' => 'write', 'name' => 'Email Marketing Edit List', 'description' => 'Call the VBOUT Email Marketing Edit List endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_delete_list' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingDeleteList', 'type' => 'write', 'name' => 'Email Marketing Delete List', 'description' => 'Call the VBOUT Email Marketing Delete List endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_add_activity' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingAddActivity', 'type' => 'write', 'name' => 'Email Marketing Add Activity', 'description' => 'Call the VBOUT Email Marketing Add Activity endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_add_tag' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingAddTag', 'type' => 'write', 'name' => 'Email Marketing Add Tag', 'description' => 'Call the VBOUT Email Marketing Add Tag endpoint. Authentication: Required Response Formats: XML | JSON Note: List of tags can be sent as a batch, separated by a comma. Either email or id can be used.', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_remove_tag' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingRemoveTag', 'type' => 'write', 'name' => 'Email Marketing Remove Tag', 'description' => 'Call the VBOUT Email Marketing Remove Tag endpoint. Authentication: Required Response Formats: XML | JSON Note: List of tags can be sent as a batch, separated by a comma. Either email or id can be used', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_get_coupon' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetCoupon', 'type' => 'read', 'name' => 'Email Marketing Coupon', 'description' => 'Call the VBOUT Email Marketing Coupon endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_user_lists' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserLists', 'type' => 'read', 'name' => 'User Lists', 'description' => 'Call the VBOUT User Lists endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_user_managers' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserManagers', 'type' => 'read', 'name' => 'User Managers', 'description' => 'Call the VBOUT User Managers endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_user_status' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserStatus', 'type' => 'write', 'name' => 'User Status', 'description' => 'Call the VBOUT User Status endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_user_add' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserAdd', 'type' => 'write', 'name' => 'User Add', 'description' => 'Call the VBOUT User Add endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_user_edit' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserEdit', 'type' => 'write', 'name' => 'User Edit', 'description' => 'Call the VBOUT User Edit endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_user_delete' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserDelete', 'type' => 'write', 'name' => 'User Delete', 'description' => 'Call the VBOUT User Delete endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_user_groups' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserGroups', 'type' => 'read', 'name' => 'User Groups', 'description' => 'Call the VBOUT User Groups endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_user_group_delete' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserGroupDelete', 'type' => 'write', 'name' => 'User Group Delete', 'description' => 'Call the VBOUT User Group Delete endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_user_group_status' => ['class' => __NAMESPACE__.'\\Tools\\VboutUserGroupStatus', 'type' => 'read', 'name' => 'User Group Status', 'description' => 'Call the VBOUT User Group Status endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_goal_lists' => ['class' => __NAMESPACE__.'\\Tools\\VboutGoalLists', 'type' => 'read', 'name' => 'Goal Lists', 'description' => 'Call the VBOUT Goal Lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_goal_list_by_domain' => ['class' => __NAMESPACE__.'\\Tools\\VboutGoalListByDomain', 'type' => 'read', 'name' => 'Goal List By Domain', 'description' => 'Call the VBOUT Goal List By Domain endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_goal_show' => ['class' => __NAMESPACE__.'\\Tools\\VboutGoalShow', 'type' => 'read', 'name' => 'Goal Show', 'description' => 'Call the VBOUT Goal Show endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_goal_add' => ['class' => __NAMESPACE__.'\\Tools\\VboutGoalAdd', 'type' => 'write', 'name' => 'Goal Add', 'description' => 'Call the VBOUT Goal Add endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_goal_edit' => ['class' => __NAMESPACE__.'\\Tools\\VboutGoalEdit', 'type' => 'write', 'name' => 'Goal Edit', 'description' => 'Call the VBOUT Goal Edit endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_goal_delete' => ['class' => __NAMESPACE__.'\\Tools\\VboutGoalDelete', 'type' => 'write', 'name' => 'Goal Delete', 'description' => 'Call the VBOUT Goal Delete endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_web_hook_lists' => ['class' => __NAMESPACE__.'\\Tools\\VboutWebHookLists', 'type' => 'read', 'name' => 'Web Hook lists', 'description' => 'Call the VBOUT Web Hook lists endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_webhook_show' => ['class' => __NAMESPACE__.'\\Tools\\VboutWebhookShow', 'type' => 'read', 'name' => 'Webhook Show', 'description' => 'Call the VBOUT Webhook Show endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_webhook_add' => ['class' => __NAMESPACE__.'\\Tools\\VboutWebhookAdd', 'type' => 'write', 'name' => 'Webhook Add', 'description' => 'Call the VBOUT Webhook Add endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_webhook_edit' => ['class' => __NAMESPACE__.'\\Tools\\VboutWebhookEdit', 'type' => 'write', 'name' => 'Webhook Edit', 'description' => 'Call the VBOUT Webhook Edit endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_webhook_delete' => ['class' => __NAMESPACE__.'\\Tools\\VboutWebhookDelete', 'type' => 'write', 'name' => 'Webhook Delete', 'description' => 'Call the VBOUT Webhook Delete endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_register_create_account' => ['class' => __NAMESPACE__.'\\Tools\\VboutRegisterCreateAccount', 'type' => 'write', 'name' => 'Register Create Account', 'description' => 'Call the VBOUT Register Create Account endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_account_get_sub_account_auto_login' => ['class' => __NAMESPACE__.'\\Tools\\VboutAccountGetSubAccountAutoLogin', 'type' => 'write', 'name' => 'Account Subscriber Account Auto Login', 'description' => 'Call the VBOUT Account Subscriber Account Auto Login endpoint. Authentication: Required Response Formats: XML | JSON Note: It should work with Agencies only.', 'icon' => 'ph:pencil-simple'],
            'vbout_settings_custom_shortcodes' => ['class' => __NAMESPACE__.'\\Tools\\VboutSettingsCustomShortcodes', 'type' => 'read', 'name' => 'Settings Custom Short codes', 'description' => 'Call the VBOUT Settings Custom Short codes endpoint. Authentication: Required Response Formats: XML | JSON Parameters: None', 'icon' => 'ph:list'],
            'vbout_settings_add_custom_shortcode' => ['class' => __NAMESPACE__.'\\Tools\\VboutSettingsAddCustomShortcode', 'type' => 'write', 'name' => 'Settings Add Custom Short Code', 'description' => 'Call the VBOUT Settings Add Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_settings_edit_custom_short_code' => ['class' => __NAMESPACE__.'\\Tools\\VboutSettingsEditCustomShortCode', 'type' => 'write', 'name' => 'Settings Edit Custom Short Code', 'description' => 'Call the VBOUT Settings Edit Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_settings_delete_custom_shortcode' => ['class' => __NAMESPACE__.'\\Tools\\VboutSettingsDeleteCustomShortcode', 'type' => 'write', 'name' => 'Settings Delete Custom Short Code', 'description' => 'Call the VBOUT Settings Delete Custom Short Code endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_email_marketing_get_email_templates' => ['class' => __NAMESPACE__.'\\Tools\\VboutEmailMarketingGetEmailTemplates', 'type' => 'read', 'name' => 'Email Marketing Get Email Templates', 'description' => 'Call the VBOUT Email Marketing Get Email Templates endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_automation_get_guides' => ['class' => __NAMESPACE__.'\\Tools\\VboutAutomationGetGuides', 'type' => 'read', 'name' => 'Automation Get Guides', 'description' => 'Call the VBOUT Automation Get Guides endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_automation_create_automation_from_guide' => ['class' => __NAMESPACE__.'\\Tools\\VboutAutomationCreateAutomationFromGuide', 'type' => 'write', 'name' => 'Automation Create Automation From Guide', 'description' => 'Call the VBOUT Automation Create Automation From Guide endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_pipeline_get_board_guide_categories' => ['class' => __NAMESPACE__.'\\Tools\\VboutPipelineGetBoardGuideCategories', 'type' => 'read', 'name' => 'Pipeline Get Board Guide Categories', 'description' => 'Call the VBOUT Pipeline Get Board Guide Categories endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_pipeline_get_board_guides' => ['class' => __NAMESPACE__.'\\Tools\\VboutPipelineGetBoardGuides', 'type' => 'read', 'name' => 'Pipeline Get Board Guides', 'description' => 'Call the VBOUT Pipeline Get Board Guides endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_pipeline_create_board_from_guide' => ['class' => __NAMESPACE__.'\\Tools\\VboutPipelineCreateBoardFromGuide', 'type' => 'write', 'name' => 'Pipeline Create Board From Guide', 'description' => 'Call the VBOUT Pipeline Create Board From Guide endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
            'vbout_aichatbot_aichatbottemplates' => ['class' => __NAMESPACE__.'\\Tools\\VboutAIchatbotAichatbottemplates', 'type' => 'read', 'name' => 'AIchatbot aichatbottemplates', 'description' => 'Call the VBOUT AIchatbot aichatbottemplates endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_aichatbot_categories' => ['class' => __NAMESPACE__.'\\Tools\\VboutAIchatbotCategories', 'type' => 'read', 'name' => 'AIchatbot categories', 'description' => 'Call the VBOUT AIchatbot categories endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_aichatbot_tags' => ['class' => __NAMESPACE__.'\\Tools\\VboutAIchatbotTags', 'type' => 'read', 'name' => 'AIchatbot tags', 'description' => 'Call the VBOUT AIchatbot tags endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:list'],
            'vbout_aichatbot_copy' => ['class' => __NAMESPACE__.'\\Tools\\VboutAIchatbotCopy', 'type' => 'write', 'name' => 'AIchatbot copy', 'description' => 'Call the VBOUT AIchatbot copy endpoint. Authentication: Required Response Formats: XML | JSON', 'icon' => 'ph:pencil-simple'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/vbout.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a VBOUT tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): VboutService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new VboutService(
                apiKey: $creds->get('vbout', 'api_key', '', $account),
                baseUrl: $creds->get('vbout', 'url', 'https://api.vbout.com/1', $account),
            );
        }

        return app(VboutService::class);
    }
}