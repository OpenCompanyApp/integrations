<?php

namespace OpenCompany\Integrations\OneSignal;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides OneSignal tools and integration metadata.
 *
 * Exposes the current OneSignal REST API surface for messages, users,
 * subscriptions, segments, templates, outcomes, apps, and raw helper calls.
 */
class OneSignalToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'one-signal';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'OneSignal',
            'description' => 'Messaging and user engagement',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:onesignal',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'OneSignal',
            'description' => 'Push, email, SMS, users, subscriptions, segments, templates, and analytics',
            'icon' => 'ph:bell-ringing',
            'logo' => 'simple-icons:onesignal',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.onesignal.com/reference/rest-api-overview',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your OneSignal API key',
                'hint' => 'Use an App API key for messaging/users or an Organization API key for app administration.',
                'required' => true,
            ],
            [
                'key' => 'app_id',
                'type' => 'string',
                'label' => 'Default App ID',
                'placeholder' => '12345678-abcd-efgh-ijkl-1234567890ab',
                'hint' => 'The default OneSignal App ID. Most tools allow overriding it per call.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.onesignal.com',
                'hint' => 'Override only for tests or a compatible proxy.',
                'default' => 'https://api.onesignal.com',
            ],
        ];
    }

    /**
     * Test the connection with a lightweight message listing request.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $appId = $config['app_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.onesignal.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($appId)) {
            return ['success' => false, 'error' => 'No app ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Key ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/notifications', [
                'app_id' => $appId,
                'limit' => 1,
            ]);

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('message') ?? "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to OneSignal API.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration values.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'app_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'onesignal_list_notifications' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalListNotifications', 'type' => 'read', 'name' => 'List Messages', 'description' => 'List push, email, or SMS messages for an app.', 'icon' => 'ph:bell'],
            'onesignal_get_notification' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetNotification', 'type' => 'read', 'name' => 'Get Message', 'description' => 'Get details and optional outcome data for a message.', 'icon' => 'ph:bell'],
            'onesignal_create_notification' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateNotification', 'type' => 'write', 'name' => 'Create Message', 'description' => 'Create a push, email, or SMS message.', 'icon' => 'ph:bell-ringing'],
            'onesignal_cancel_notification' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCancelNotification', 'type' => 'write', 'name' => 'Cancel Message', 'description' => 'Cancel a scheduled or currently outgoing message.', 'icon' => 'ph:x-circle'],
            'onesignal_list_devices' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalListDevices', 'type' => 'read', 'name' => 'List Legacy Devices', 'description' => 'List legacy player/device records.', 'icon' => 'ph:device-mobile'],
            'onesignal_get_device' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetDevice', 'type' => 'read', 'name' => 'Get Legacy Device', 'description' => 'Get a legacy player/device record.', 'icon' => 'ph:device-mobile'],
            'onesignal_list_apps' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalListApps', 'type' => 'read', 'name' => 'List Apps', 'description' => 'List apps accessible with an organization API key.', 'icon' => 'ph:app-window'],
            'onesignal_get_current_app' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetCurrentApp', 'type' => 'read', 'name' => 'Get App', 'description' => 'Get details of a OneSignal app.', 'icon' => 'ph:app-window'],
            'onesignal_update_app' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalUpdateApp', 'type' => 'write', 'name' => 'Update App', 'description' => 'Update app configuration.', 'icon' => 'ph:pencil'],

            'onesignal_create_user' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateUser', 'type' => 'write', 'name' => 'Create User', 'description' => 'Create a user with aliases, properties, and subscriptions.', 'icon' => 'ph:user-plus'],
            'onesignal_get_user' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'View a user by alias.', 'icon' => 'ph:user'],
            'onesignal_update_user' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalUpdateUser', 'type' => 'write', 'name' => 'Update User', 'description' => 'Update user properties and deltas.', 'icon' => 'ph:pencil'],
            'onesignal_delete_user' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalDeleteUser', 'type' => 'write', 'name' => 'Delete User', 'description' => 'Delete a user and its subscriptions.', 'icon' => 'ph:trash'],
            'onesignal_get_user_identity' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetUserIdentity', 'type' => 'read', 'name' => 'Get User Identity', 'description' => 'Fetch all aliases for a user.', 'icon' => 'ph:identification-card'],
            'onesignal_create_or_update_alias' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateOrUpdateAlias', 'type' => 'write', 'name' => 'Create or Update Alias', 'description' => 'Create or update aliases for a user.', 'icon' => 'ph:identification-card'],
            'onesignal_delete_alias' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalDeleteAlias', 'type' => 'write', 'name' => 'Delete Alias', 'description' => 'Remove a user alias.', 'icon' => 'ph:trash'],

            'onesignal_get_identity_by_subscription' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetIdentityBySubscription', 'type' => 'read', 'name' => 'Get Identity by Subscription', 'description' => 'Fetch user identity aliases by subscription ID.', 'icon' => 'ph:identification-card'],
            'onesignal_create_alias_by_subscription' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateAliasBySubscription', 'type' => 'write', 'name' => 'Create Alias by Subscription', 'description' => 'Create aliases using a subscription ID.', 'icon' => 'ph:identification-card'],
            'onesignal_create_subscription' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateSubscription', 'type' => 'write', 'name' => 'Create Subscription', 'description' => 'Create a push, email, or SMS subscription for a user.', 'icon' => 'ph:device-mobile'],
            'onesignal_update_subscription' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalUpdateSubscription', 'type' => 'write', 'name' => 'Update Subscription', 'description' => 'Update a subscription by ID.', 'icon' => 'ph:pencil'],
            'onesignal_transfer_subscription' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalTransferSubscription', 'type' => 'write', 'name' => 'Transfer Subscription', 'description' => 'Transfer a subscription to a different user identity.', 'icon' => 'ph:arrows-left-right'],

            'onesignal_list_segments' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalListSegments', 'type' => 'read', 'name' => 'List Segments', 'description' => 'List app segments.', 'icon' => 'ph:funnel'],
            'onesignal_get_segment' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetSegment', 'type' => 'read', 'name' => 'Get Segment', 'description' => 'Get a segment and optional filters.', 'icon' => 'ph:funnel'],
            'onesignal_create_segment' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateSegment', 'type' => 'write', 'name' => 'Create Segment', 'description' => 'Create a segment with filters.', 'icon' => 'ph:plus-circle'],
            'onesignal_update_segment' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalUpdateSegment', 'type' => 'write', 'name' => 'Update Segment', 'description' => 'Update segment name or filters.', 'icon' => 'ph:pencil'],
            'onesignal_delete_segment' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalDeleteSegment', 'type' => 'write', 'name' => 'Delete Segment', 'description' => 'Delete a segment.', 'icon' => 'ph:trash'],

            'onesignal_list_templates' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalListTemplates', 'type' => 'read', 'name' => 'List Templates', 'description' => 'List message templates.', 'icon' => 'ph:files'],
            'onesignal_get_template' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalGetTemplate', 'type' => 'read', 'name' => 'Get Template', 'description' => 'Get template content and metadata.', 'icon' => 'ph:file'],
            'onesignal_create_template' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalCreateTemplate', 'type' => 'write', 'name' => 'Create Template', 'description' => 'Create a push, email, or SMS template.', 'icon' => 'ph:file-plus'],
            'onesignal_update_template' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalUpdateTemplate', 'type' => 'write', 'name' => 'Update Template', 'description' => 'Update a template.', 'icon' => 'ph:pencil'],
            'onesignal_delete_template' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalDeleteTemplate', 'type' => 'write', 'name' => 'Delete Template', 'description' => 'Delete a template.', 'icon' => 'ph:trash'],

            'onesignal_view_outcomes' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalViewOutcomes', 'type' => 'read', 'name' => 'View Outcomes', 'description' => 'View outcome analytics for an app.', 'icon' => 'ph:chart-line'],
            'onesignal_api_get' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalApiGet', 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative OneSignal API path with GET.', 'icon' => 'ph:code'],
            'onesignal_api_post' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalApiPost', 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative OneSignal API path with POST.', 'icon' => 'ph:code'],
            'onesignal_api_patch' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalApiPatch', 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative OneSignal API path with PATCH.', 'icon' => 'ph:code'],
            'onesignal_api_delete' => ['class' => 'OpenCompany\\Integrations\\OneSignal\\Tools\\OneSignalApiDelete', 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative OneSignal API path with DELETE.', 'icon' => 'ph:code'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/one-signal.md';
    }

    /**
     * Credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'app_id', 'type' => 'string', 'label' => 'App ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.onesignal.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  string  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing an optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new OneSignalService(
                apiKey: $creds->get('one-signal', 'api_key', '', $account),
                appId: $creds->get('one-signal', 'app_id', '', $account),
                baseUrl: $creds->get('one-signal', 'url', 'https://api.onesignal.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(OneSignalService::class));
    }
}
