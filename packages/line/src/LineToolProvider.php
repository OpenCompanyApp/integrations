<?php

namespace OpenCompany\Integrations\Line;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Line\Tools\LineBroadcastMessage;
use OpenCompany\Integrations\Line\Tools\LineClearDefaultRichMenu;
use OpenCompany\Integrations\Line\Tools\LineCreateRichMenu;
use OpenCompany\Integrations\Line\Tools\LineDeleteRichMenu;
use OpenCompany\Integrations\Line\Tools\LineGetCurrentUser;
use OpenCompany\Integrations\Line\Tools\LineGetDefaultRichMenu;
use OpenCompany\Integrations\Line\Tools\LineGetDeliveryCount;
use OpenCompany\Integrations\Line\Tools\LineGetGroupMemberCount;
use OpenCompany\Integrations\Line\Tools\LineGetGroupMemberProfile;
use OpenCompany\Integrations\Line\Tools\LineGetGroupSummary;
use OpenCompany\Integrations\Line\Tools\LineGetMessageQuota;
use OpenCompany\Integrations\Line\Tools\LineGetMessageQuotaConsumption;
use OpenCompany\Integrations\Line\Tools\LineGetNarrowcastProgress;
use OpenCompany\Integrations\Line\Tools\LineGetProfile;
use OpenCompany\Integrations\Line\Tools\LineGetRichMenu;
use OpenCompany\Integrations\Line\Tools\LineGetUserRichMenu;
use OpenCompany\Integrations\Line\Tools\LineGetWebhookEndpoint;
use OpenCompany\Integrations\Line\Tools\LineIssueLinkToken;
use OpenCompany\Integrations\Line\Tools\LineLeaveGroup;
use OpenCompany\Integrations\Line\Tools\LineLinkRichMenuToUser;
use OpenCompany\Integrations\Line\Tools\LineListFriends;
use OpenCompany\Integrations\Line\Tools\LineListGroupMemberIds;
use OpenCompany\Integrations\Line\Tools\LineListRichMenus;
use OpenCompany\Integrations\Line\Tools\LineMarkAsRead;
use OpenCompany\Integrations\Line\Tools\LineMulticastMessage;
use OpenCompany\Integrations\Line\Tools\LineNarrowcastMessage;
use OpenCompany\Integrations\Line\Tools\LineReplyMessage;
use OpenCompany\Integrations\Line\Tools\LineSendMessage;
use OpenCompany\Integrations\Line\Tools\LineSetDefaultRichMenu;
use OpenCompany\Integrations\Line\Tools\LineSetWebhookEndpoint;
use OpenCompany\Integrations\Line\Tools\LineStartLoadingAnimation;
use OpenCompany\Integrations\Line\Tools\LineTestWebhookEndpoint;
use OpenCompany\Integrations\Line\Tools\LineUnlinkRichMenuFromUser;
use OpenCompany\Integrations\Line\Tools\LineValidateMessages;
use OpenCompany\Integrations\Line\Tools\LineValidateRichMenu;

/**
 * Tool provider for the LINE Messaging API integration.
 *
 * Exposes message, webhook, profile, quota, group, rich menu, and account-link tools.
 */
class LineToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
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
        return 'line';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'LINE Messaging',
            'description' => 'LINE Official Account messaging',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:line',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'LINE Messaging',
            'description' => 'Send LINE messages and manage webhooks, followers, groups, quotas, and rich menus',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:line',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.line.biz/en/reference/messaging-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Channel Access Token', 'placeholder' => 'Enter your LINE channel access token', 'hint' => 'Issue a long-lived channel access token in the LINE Developers Console.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.line.me', 'hint' => 'Use the default LINE API host unless testing against another environment.', 'default' => 'https://api.line.me'],
        ];
    }

    /**
     * Test the API connection with the given configuration.
     *
     * @param  array<string, mixed>  $config  Configuration values
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = preg_replace('#/v2$#', '', rtrim((string) ($config['url'] ?? 'https://api.line.me'), '/')) ?: 'https://api.line.me';

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No channel access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/bot/info');

            if ($response->successful()) {
                $botInfo = $response->json();
                $displayName = $botInfo['displayName'] ?? 'Unknown';

                return ['success' => true, 'message' => "Connected to LINE as \"{$displayName}\"."];
            }

            $error = $response->json('message') ?? $response->body();

            return ['success' => false, 'error' => 'LINE API returned an error: ' . (is_string($error) ? $error : json_encode($error))];
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

    public function tools(): array
    {
        return [
            'line_reply_message' => ['class' => LineReplyMessage::class, 'type' => 'write', 'name' => 'Reply Message', 'description' => 'Reply to a webhook event.', 'icon' => 'ph:reply'],
            'line_send_message' => ['class' => LineSendMessage::class, 'type' => 'write', 'name' => 'Send Push Message', 'description' => 'Send a push message to a user, group, or room.', 'icon' => 'ph:paper-plane-tilt'],
            'line_multicast_message' => ['class' => LineMulticastMessage::class, 'type' => 'write', 'name' => 'Multicast Message', 'description' => 'Send messages to multiple users.', 'icon' => 'ph:users-three'],
            'line_narrowcast_message' => ['class' => LineNarrowcastMessage::class, 'type' => 'write', 'name' => 'Narrowcast Message', 'description' => 'Send messages to filtered recipients.', 'icon' => 'ph:funnel'],
            'line_get_narrowcast_progress' => ['class' => LineGetNarrowcastProgress::class, 'type' => 'read', 'name' => 'Get Narrowcast Progress', 'description' => 'Check narrowcast request progress.', 'icon' => 'ph:chart-line-up'],
            'line_broadcast_message' => ['class' => LineBroadcastMessage::class, 'type' => 'write', 'name' => 'Broadcast Message', 'description' => 'Broadcast to all friends.', 'icon' => 'ph:megaphone'],
            'line_mark_as_read' => ['class' => LineMarkAsRead::class, 'type' => 'write', 'name' => 'Mark As Read', 'description' => 'Mark a chat as read.', 'icon' => 'ph:checks'],
            'line_start_loading_animation' => ['class' => LineStartLoadingAnimation::class, 'type' => 'write', 'name' => 'Start Loading Animation', 'description' => 'Display a loading animation.', 'icon' => 'ph:spinner'],
            'line_get_message_quota' => ['class' => LineGetMessageQuota::class, 'type' => 'read', 'name' => 'Get Message Quota', 'description' => 'Get monthly message quota.', 'icon' => 'ph:gauge'],
            'line_get_message_quota_consumption' => ['class' => LineGetMessageQuotaConsumption::class, 'type' => 'read', 'name' => 'Get Message Quota Consumption', 'description' => 'Get monthly sent message count.', 'icon' => 'ph:chart-bar'],
            'line_get_delivery_count' => ['class' => LineGetDeliveryCount::class, 'type' => 'read', 'name' => 'Get Delivery Count', 'description' => 'Get sent message delivery counts.', 'icon' => 'ph:envelope-open'],
            'line_validate_messages' => ['class' => LineValidateMessages::class, 'type' => 'write', 'name' => 'Validate Messages', 'description' => 'Validate message objects.', 'icon' => 'ph:check-circle'],
            'line_set_webhook_endpoint' => ['class' => LineSetWebhookEndpoint::class, 'type' => 'write', 'name' => 'Set Webhook Endpoint', 'description' => 'Set webhook endpoint URL.', 'icon' => 'ph:link'],
            'line_get_webhook_endpoint' => ['class' => LineGetWebhookEndpoint::class, 'type' => 'read', 'name' => 'Get Webhook Endpoint', 'description' => 'Get webhook endpoint information.', 'icon' => 'ph:webhooks-logo'],
            'line_test_webhook_endpoint' => ['class' => LineTestWebhookEndpoint::class, 'type' => 'write', 'name' => 'Test Webhook Endpoint', 'description' => 'Test webhook delivery.', 'icon' => 'ph:plug'],
            'line_get_profile' => ['class' => LineGetProfile::class, 'type' => 'read', 'name' => 'Get Profile', 'description' => 'Get a LINE user profile.', 'icon' => 'ph:user-circle'],
            'line_list_friends' => ['class' => LineListFriends::class, 'type' => 'read', 'name' => 'List Followers', 'description' => 'List follower user IDs.', 'icon' => 'ph:users'],
            'line_get_current_user' => ['class' => LineGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Bot Info', 'description' => 'Get LINE bot information.', 'icon' => 'ph:bot'],
            'line_get_group_summary' => ['class' => LineGetGroupSummary::class, 'type' => 'read', 'name' => 'Get Group Summary', 'description' => 'Get group chat summary.', 'icon' => 'ph:chats-circle'],
            'line_get_group_member_count' => ['class' => LineGetGroupMemberCount::class, 'type' => 'read', 'name' => 'Get Group Member Count', 'description' => 'Get LINE group member count.', 'icon' => 'ph:hash'],
            'line_list_group_member_ids' => ['class' => LineListGroupMemberIds::class, 'type' => 'read', 'name' => 'List Group Member IDs', 'description' => 'List member user IDs in a group.', 'icon' => 'ph:users-four'],
            'line_get_group_member_profile' => ['class' => LineGetGroupMemberProfile::class, 'type' => 'read', 'name' => 'Get Group Member Profile', 'description' => 'Get profile for a group member.', 'icon' => 'ph:user-focus'],
            'line_leave_group' => ['class' => LineLeaveGroup::class, 'type' => 'write', 'name' => 'Leave Group', 'description' => 'Leave a LINE group.', 'icon' => 'ph:sign-out'],
            'line_create_rich_menu' => ['class' => LineCreateRichMenu::class, 'type' => 'write', 'name' => 'Create Rich Menu', 'description' => 'Create rich menu metadata.', 'icon' => 'ph:squares-four'],
            'line_validate_rich_menu' => ['class' => LineValidateRichMenu::class, 'type' => 'write', 'name' => 'Validate Rich Menu', 'description' => 'Validate rich menu metadata.', 'icon' => 'ph:clipboard-text'],
            'line_list_rich_menus' => ['class' => LineListRichMenus::class, 'type' => 'read', 'name' => 'List Rich Menus', 'description' => 'List rich menus.', 'icon' => 'ph:list-bullets'],
            'line_get_rich_menu' => ['class' => LineGetRichMenu::class, 'type' => 'read', 'name' => 'Get Rich Menu', 'description' => 'Get rich menu metadata.', 'icon' => 'ph:square'],
            'line_delete_rich_menu' => ['class' => LineDeleteRichMenu::class, 'type' => 'write', 'name' => 'Delete Rich Menu', 'description' => 'Delete a rich menu.', 'icon' => 'ph:trash'],
            'line_set_default_rich_menu' => ['class' => LineSetDefaultRichMenu::class, 'type' => 'write', 'name' => 'Set Default Rich Menu', 'description' => 'Set default rich menu.', 'icon' => 'ph:star'],
            'line_get_default_rich_menu' => ['class' => LineGetDefaultRichMenu::class, 'type' => 'read', 'name' => 'Get Default Rich Menu', 'description' => 'Get default rich menu ID.', 'icon' => 'ph:star-half'],
            'line_clear_default_rich_menu' => ['class' => LineClearDefaultRichMenu::class, 'type' => 'write', 'name' => 'Clear Default Rich Menu', 'description' => 'Clear default rich menu.', 'icon' => 'ph:eraser'],
            'line_link_rich_menu_to_user' => ['class' => LineLinkRichMenuToUser::class, 'type' => 'write', 'name' => 'Link Rich Menu To User', 'description' => 'Link a rich menu to one user.', 'icon' => 'ph:user-switch'],
            'line_get_user_rich_menu' => ['class' => LineGetUserRichMenu::class, 'type' => 'read', 'name' => 'Get User Rich Menu', 'description' => 'Get rich menu linked to a user.', 'icon' => 'ph:user-list'],
            'line_unlink_rich_menu_from_user' => ['class' => LineUnlinkRichMenuFromUser::class, 'type' => 'write', 'name' => 'Unlink Rich Menu From User', 'description' => 'Remove a per-user rich menu link.', 'icon' => 'ph:user-minus'],
            'line_issue_link_token' => ['class' => LineIssueLinkToken::class, 'type' => 'write', 'name' => 'Issue Link Token', 'description' => 'Issue an account link token.', 'icon' => 'ph:key'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/line.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Channel Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.line.me'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  string  $class  Tool class name
     * @param  array<string, mixed>  $context  Optional account context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the LINE service for default or named-account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context
     */
    private function resolveService(array $context = []): LineService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new LineService(
                accessToken: $creds->get('line', 'access_token', '', $account),
                baseUrl: $creds->get('line', 'url', 'https://api.line.me', $account),
            );
        }

        return app(LineService::class);
    }
}
