<?php

namespace OpenCompany\Integrations\Pushbullet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreateChannel;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreateChat;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreateDevice;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreatePush;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletCreateSubscription;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletDeleteAllPushes;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletDeleteChat;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletDeleteDevice;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletDeletePush;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletDeleteSubscription;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletGetChannelInfo;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletGetCurrentUser;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListChats;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListDevices;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListPushes;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletListSubscriptions;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletPushEphemeral;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletRequestUpload;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletUpdateChat;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletUpdateDevice;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletUpdatePush;
use OpenCompany\Integrations\Pushbullet\Tools\PushbulletUpdateSubscription;

/**
 * Tool provider for the Pushbullet integration.
 *
 * Defines catalog metadata, credential setup, multi-account service resolution, and Pushbullet tool classes.
 */
class PushbulletToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
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
        return 'pushbullet';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Pushbullet',
            'description' => 'Push notifications, devices, chats, subscriptions, and channels.',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:pushbullet',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pushbullet',
            'description' => 'Send pushes and manage Pushbullet devices, chats, subscriptions, channels, ephemerals, and file uploads.',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:pushbullet',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.pushbullet.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Pushbullet access token',
                'hint' => 'Create an access token in your Pushbullet account settings under "Access Tokens".',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pushbullet.com/v2',
                'hint' => 'Use the default Pushbullet API URL unless a compatible proxy is required.',
                'default' => 'https://api.pushbullet.com/v2',
            ],
        ];
    }

    /**
     * Verify Pushbullet credentials with a current-user request.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pushbullet.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Access-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Pushbullet API returned HTTP {$response->status()}. Check your access token.",
                ];
            }

            $json = $response->json();
            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Pushbullet as {$name}.",
            ];
        } catch (\Exception $e) {
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
            'pushbullet_get_current_user' => ['class' => PushbulletGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Pushbullet user profile.', 'icon' => 'ph:user-circle'],
            'pushbullet_list_pushes' => ['class' => PushbulletListPushes::class, 'type' => 'read', 'name' => 'List Pushes', 'description' => 'List Pushbullet pushes with pagination and sync filters.', 'icon' => 'ph:list-bullets'],
            'pushbullet_create_push' => ['class' => PushbulletCreatePush::class, 'type' => 'write', 'name' => 'Create Push', 'description' => 'Send note, link, or file pushes.', 'icon' => 'ph:paper-plane-tilt'],
            'pushbullet_update_push' => ['class' => PushbulletUpdatePush::class, 'type' => 'write', 'name' => 'Update Push', 'description' => 'Update an existing push, such as dismissed state.', 'icon' => 'ph:pencil-simple'],
            'pushbullet_delete_push' => ['class' => PushbulletDeletePush::class, 'type' => 'write', 'name' => 'Delete Push', 'description' => 'Delete one push notification.', 'icon' => 'ph:trash'],
            'pushbullet_delete_all_pushes' => ['class' => PushbulletDeleteAllPushes::class, 'type' => 'write', 'name' => 'Delete All Pushes', 'description' => 'Delete all pushes asynchronously.', 'icon' => 'ph:trash-simple'],
            'pushbullet_list_devices' => ['class' => PushbulletListDevices::class, 'type' => 'read', 'name' => 'List Devices', 'description' => 'List Pushbullet devices.', 'icon' => 'ph:devices'],
            'pushbullet_create_device' => ['class' => PushbulletCreateDevice::class, 'type' => 'write', 'name' => 'Create Device', 'description' => 'Create a Pushbullet device.', 'icon' => 'ph:device-mobile'],
            'pushbullet_update_device' => ['class' => PushbulletUpdateDevice::class, 'type' => 'write', 'name' => 'Update Device', 'description' => 'Update a Pushbullet device.', 'icon' => 'ph:arrows-clockwise'],
            'pushbullet_delete_device' => ['class' => PushbulletDeleteDevice::class, 'type' => 'write', 'name' => 'Delete Device', 'description' => 'Delete a Pushbullet device.', 'icon' => 'ph:device-mobile-x'],
            'pushbullet_list_chats' => ['class' => PushbulletListChats::class, 'type' => 'read', 'name' => 'List Chats', 'description' => 'List Pushbullet chats.', 'icon' => 'ph:chats'],
            'pushbullet_create_chat' => ['class' => PushbulletCreateChat::class, 'type' => 'write', 'name' => 'Create Chat', 'description' => 'Create a Pushbullet chat.', 'icon' => 'ph:chat-plus'],
            'pushbullet_update_chat' => ['class' => PushbulletUpdateChat::class, 'type' => 'write', 'name' => 'Update Chat', 'description' => 'Update chat muted state.', 'icon' => 'ph:chat-circle-dots'],
            'pushbullet_delete_chat' => ['class' => PushbulletDeleteChat::class, 'type' => 'write', 'name' => 'Delete Chat', 'description' => 'Delete a Pushbullet chat.', 'icon' => 'ph:chat-circle-x'],
            'pushbullet_list_subscriptions' => ['class' => PushbulletListSubscriptions::class, 'type' => 'read', 'name' => 'List Subscriptions', 'description' => 'List channel subscriptions.', 'icon' => 'ph:rss'],
            'pushbullet_create_subscription' => ['class' => PushbulletCreateSubscription::class, 'type' => 'write', 'name' => 'Create Subscription', 'description' => 'Subscribe to a channel.', 'icon' => 'ph:rss-simple'],
            'pushbullet_update_subscription' => ['class' => PushbulletUpdateSubscription::class, 'type' => 'write', 'name' => 'Update Subscription', 'description' => 'Update subscription muted state.', 'icon' => 'ph:speaker-slash'],
            'pushbullet_delete_subscription' => ['class' => PushbulletDeleteSubscription::class, 'type' => 'write', 'name' => 'Delete Subscription', 'description' => 'Delete a channel subscription.', 'icon' => 'ph:rss-x'],
            'pushbullet_get_channel_info' => ['class' => PushbulletGetChannelInfo::class, 'type' => 'read', 'name' => 'Get Channel Info', 'description' => 'Get public channel information by tag.', 'icon' => 'ph:broadcast'],
            'pushbullet_create_channel' => ['class' => PushbulletCreateChannel::class, 'type' => 'write', 'name' => 'Create Channel', 'description' => 'Create a Pushbullet channel.', 'icon' => 'ph:megaphone'],
            'pushbullet_push_ephemeral' => ['class' => PushbulletPushEphemeral::class, 'type' => 'write', 'name' => 'Push Ephemeral', 'description' => 'Send a realtime ephemeral event.', 'icon' => 'ph:lightning'],
            'pushbullet_request_upload' => ['class' => PushbulletRequestUpload::class, 'type' => 'write', 'name' => 'Request Upload', 'description' => 'Request an upload URL for a file push.', 'icon' => 'ph:upload-simple'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/pushbullet.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pushbullet.com/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new PushbulletService(
                accessToken: $creds->get('pushbullet', 'access_token', '', $account),
                baseUrl: $creds->get('pushbullet', 'url', 'https://api.pushbullet.com/v2', $account),
            ));
        }

        return new $class(app(PushbulletService::class));
    }
}
