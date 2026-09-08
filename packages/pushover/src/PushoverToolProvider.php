<?php

namespace OpenCompany\Integrations\Pushover;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pushover\Tools\PushoverAddGroupUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverAddTeamUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverAssignLicense;
use OpenCompany\Integrations\Pushover\Tools\PushoverCancelReceipt;
use OpenCompany\Integrations\Pushover\Tools\PushoverCancelReceiptsByTag;
use OpenCompany\Integrations\Pushover\Tools\PushoverCreateGroup;
use OpenCompany\Integrations\Pushover\Tools\PushoverDisableGroupUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverEnableGroupUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetApplicationLimits;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetCurrentUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetGroup;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetLicenseCredits;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetReceipt;
use OpenCompany\Integrations\Pushover\Tools\PushoverGetTeam;
use OpenCompany\Integrations\Pushover\Tools\PushoverListGroups;
use OpenCompany\Integrations\Pushover\Tools\PushoverListSounds;
use OpenCompany\Integrations\Pushover\Tools\PushoverMigrateSubscriptionUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverRemoveGroupUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverRemoveTeamUser;
use OpenCompany\Integrations\Pushover\Tools\PushoverRenameGroup;
use OpenCompany\Integrations\Pushover\Tools\PushoverSendMessage;
use OpenCompany\Integrations\Pushover\Tools\PushoverUpdateGlance;
use OpenCompany\Integrations\Pushover\Tools\PushoverValidateUser;

/**
 * Exposes the Pushover API as agent-callable tools.
 *
 * Handles credential schema, catalog metadata, connection testing, and multi-account service resolution.
 */
class PushoverToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'pushover';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Pushover',
            'description' => 'Push notifications',
            'icon' => 'ph:bell-ringing',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pushover',
            'description' => 'Send push notifications, emergency alerts, group messages, subscription migrations, glances, and license assignments',
            'icon' => 'ph:bell-ringing',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://pushover.net/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Application API Key (Token)',
                'placeholder' => 'Enter your Pushover application API key',
                'hint' => 'Create an application at <a href="https://pushover.net/apps" target="_blank">pushover.net/apps</a> to get an API token',
                'required' => true,
            ],
            [
                'key' => 'user_key',
                'type' => 'secret',
                'label' => 'User Key',
                'placeholder' => 'Enter your Pushover user or group key',
                'hint' => 'Found on your Pushover dashboard homepage. Use a delivery group key here when the default target is a group.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pushover.net/1',
                'hint' => 'Override only if using a Pushover-compatible service.',
                'default' => 'https://api.pushover.net/1',
            ],
            [
                'key' => 'team_token',
                'type' => 'secret',
                'label' => 'Team API Token',
                'placeholder' => 'Enter your optional Pushover Teams API token',
                'hint' => 'Required only for team membership tools. This is different from an application API token.',
                'required' => false,
            ],
        ];
    }

    /**
     * Validate Pushover credentials with the lightweight users/validate endpoint.
     *
     * @param  array<string, mixed>  $config  Credential form values (api_key, user_key, url).
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $userKey = $config['user_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pushover.net/1', '/');

        if (empty($apiKey) || empty($userKey)) {
            return ['success' => false, 'error' => 'API key and user key are required.'];
        }

        try {
            $response = Http::asForm()
                ->timeout(10)
                ->post($baseUrl . '/users/validate.json', [
                    'user' => $userKey,
                    'token' => $apiKey,
                ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Pushover API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! ($json['status'] ?? false)) {
                $errors = $json['errors'] ?? ['Invalid credentials'];

                return [
                    'success' => false,
                    'error' => implode('; ', $errors),
                ];
            }

            $devices = $json['devices'] ?? [];
            $deviceSummary = $devices === [] ? 'no device list returned' : count($devices) . ' device(s)';

            return [
                'success' => true,
                'message' => "Connected to Pushover API successfully ({$deviceSummary}).",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'user_key' => 'nullable|string',
            'url' => 'nullable|url',
            'team_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'pushover_send_message' => $this->tool(PushoverSendMessage::class, 'write', 'Send Message', 'Send a push notification message, including emergency receipts and optional formatting.', 'ph:paper-plane-tilt'),
            'pushover_get_application_limits' => $this->tool(PushoverGetApplicationLimits::class, 'read', 'Get Application Limits', 'Get monthly app message quota and reset information.', 'ph:gauge'),
            'pushover_list_sounds' => $this->tool(PushoverListSounds::class, 'read', 'List Sounds', 'List available notification sounds.', 'ph:speaker-high'),
            'pushover_get_current_user' => $this->tool(PushoverGetCurrentUser::class, 'read', 'Get Current User', 'Validate the configured user key and return devices/licenses.', 'ph:user-check'),
            'pushover_validate_user' => $this->tool(PushoverValidateUser::class, 'read', 'Validate User', 'Validate a user/group key and optional device.', 'ph:check-circle'),
            'pushover_get_receipt' => $this->tool(PushoverGetReceipt::class, 'read', 'Get Receipt', 'Get emergency message acknowledgement and retry status.', 'ph:receipt'),
            'pushover_cancel_receipt' => $this->tool(PushoverCancelReceipt::class, 'write', 'Cancel Receipt', 'Cancel retries for one emergency message receipt.', 'ph:x-circle'),
            'pushover_cancel_receipts_by_tag' => $this->tool(PushoverCancelReceiptsByTag::class, 'write', 'Cancel Receipts By Tag', 'Cancel retries for active emergency messages with a tag.', 'ph:tag'),
            'pushover_migrate_subscription_user' => $this->tool(PushoverMigrateSubscriptionUser::class, 'write', 'Migrate Subscription User', 'Migrate a legacy user key into a subscription-scoped user key.', 'ph:arrows-clockwise'),
            'pushover_get_team' => $this->tool(PushoverGetTeam::class, 'read', 'Get Team', 'Show Pushover team information and users.', 'ph:building-office'),
            'pushover_add_team_user' => $this->tool(PushoverAddTeamUser::class, 'write', 'Add Team User', 'Add a user to a Pushover team.', 'ph:user-plus'),
            'pushover_remove_team_user' => $this->tool(PushoverRemoveTeamUser::class, 'write', 'Remove Team User', 'Remove a user from a Pushover team.', 'ph:user-minus'),
            'pushover_update_glance' => $this->tool(PushoverUpdateGlance::class, 'write', 'Update Glance', 'Update Pushover glance/widget data.', 'ph:watch'),
            'pushover_create_group' => $this->tool(PushoverCreateGroup::class, 'write', 'Create Group', 'Create a Pushover delivery group.', 'ph:users-three'),
            'pushover_list_groups' => $this->tool(PushoverListGroups::class, 'read', 'List Groups', 'List manageable delivery groups.', 'ph:list-bullets'),
            'pushover_get_group' => $this->tool(PushoverGetGroup::class, 'read', 'Get Group', 'Get one delivery group and its members.', 'ph:users'),
            'pushover_add_group_user' => $this->tool(PushoverAddGroupUser::class, 'write', 'Add Group User', 'Add a user/device to a delivery group.', 'ph:user-plus'),
            'pushover_remove_group_user' => $this->tool(PushoverRemoveGroupUser::class, 'write', 'Remove Group User', 'Remove a user/device from a delivery group.', 'ph:user-minus'),
            'pushover_disable_group_user' => $this->tool(PushoverDisableGroupUser::class, 'write', 'Disable Group User', 'Temporarily disable a delivery group member.', 'ph:user-focus'),
            'pushover_enable_group_user' => $this->tool(PushoverEnableGroupUser::class, 'write', 'Enable Group User', 'Re-enable a disabled delivery group member.', 'ph:user-check'),
            'pushover_rename_group' => $this->tool(PushoverRenameGroup::class, 'write', 'Rename Group', 'Rename a delivery group.', 'ph:pencil-simple'),
            'pushover_get_license_credits' => $this->tool(PushoverGetLicenseCredits::class, 'read', 'Get License Credits', 'Get remaining prepaid license credits.', 'ph:certificate'),
            'pushover_assign_license' => $this->tool(PushoverAssignLicense::class, 'write', 'Assign License', 'Assign a prepaid license credit to a user or email.', 'ph:seal-check'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/pushover.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Application API Key', 'required' => true],
            ['key' => 'user_key', 'type' => 'secret', 'label' => 'User Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false],
            ['key' => 'team_token', 'type' => 'secret', 'label' => 'Team API Token', 'required' => false],
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
     * Resolve the Pushover service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Optional tool context containing an account key.
     */
    private function resolveService(array $context = []): PushoverService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PushoverService(
                apiKey: $creds->get('pushover', 'api_key', '', $account),
                userKey: $creds->get('pushover', 'user_key', '', $account),
                baseUrl: $creds->get('pushover', 'url', 'https://api.pushover.net/1', $account),
                teamToken: $creds->get('pushover', 'team_token', '', $account),
            );
        }

        return app(PushoverService::class);
    }

    /**
     * Build a catalog metadata entry for a Pushover tool.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}
     */
    private function tool(string $class, string $type, string $name, string $description, string $icon): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => $icon,
        ];
    }
}
