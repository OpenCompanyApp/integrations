<?php

namespace OpenCompany\Integrations\ManyChat;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatAddSubscriberTag;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatApiGet;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatApiPost;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatCreateCustomField;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatCreateSubscriber;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatCreateTag;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatFindSubscriberByName;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatGetCurrentUser;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatGetFlow;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatGetPageInfo;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatGetSubscriberInfo;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListBotFields;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListCustomFields;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListFlows;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListGrowthTools;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatListTags;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatRemoveSubscriberTag;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatRemoveTag;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatRemoveTagByName;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSendContent;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSendFlow;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSendMessage;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSetBotField;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSetSubscriberCustomField;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatUpdateSubscriber;

/**
 * Exposes Manychat tools and credential metadata to host applications.
 */
class ManyChatToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [
                    'Manychat Account Public API keys are used as Bearer tokens. Template/Profile API calls can use the optional profile_api_key.',
                ],
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
        return 'manychat';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Manychat',
            'description' => 'Chat automation',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:manychat',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Manychat',
            'description' => 'Manage Manychat bot info, flows, tags, custom fields, bot fields, sending, and subscribers.',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:manychat',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.manychat.com/swagger',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Account API Key',
                'placeholder' => 'Enter your Manychat Account Public API key',
                'hint' => 'Generate this in Manychat Settings > API.',
                'required' => true,
            ],
            [
                'key' => 'profile_api_key',
                'type' => 'secret',
                'label' => 'Profile API Key',
                'placeholder' => 'Optional Profile Public API key',
                'hint' => 'Only needed for profile/template endpoints.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.manychat.com',
                'hint' => 'Default: https://api.manychat.com.',
                'default' => 'https://api.manychat.com',
            ],
        ];
    }

    /**
     * Verify the API key by fetching page information.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = trim((string) ($config['api_key'] ?? ''));

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $service = new ManyChatService(
                apiKey: $apiKey,
                baseUrl: (string) ($config['url'] ?? 'https://api.manychat.com'),
                profileApiKey: (string) ($config['profile_api_key'] ?? ''),
            );
            $service->getPageInfo();

            return [
                'success' => true,
                'message' => 'Connected to Manychat API.',
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'profile_api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'manychat_get_page_info' => ['class' => ManyChatGetPageInfo::class, 'type' => 'read', 'name' => 'Get Page Info', 'description' => 'Get Manychat page/account information.', 'icon' => 'ph:info'],
            'manychat_get_current_user' => ['class' => ManyChatGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Compatibility alias for page/account information.', 'icon' => 'ph:user'],
            'manychat_list_flows' => ['class' => ManyChatListFlows::class, 'type' => 'read', 'name' => 'List Flows', 'description' => 'List Manychat flows.', 'icon' => 'ph:list'],
            'manychat_get_flow' => ['class' => ManyChatGetFlow::class, 'type' => 'read', 'name' => 'Get Flow', 'description' => 'Find one flow client-side from the documented getFlows response.', 'icon' => 'ph:flow-arrow'],
            'manychat_list_tags' => ['class' => ManyChatListTags::class, 'type' => 'read', 'name' => 'List Tags', 'description' => 'List bot tags.', 'icon' => 'ph:tag'],
            'manychat_create_tag' => ['class' => ManyChatCreateTag::class, 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a bot tag.', 'icon' => 'ph:tag'],
            'manychat_remove_tag' => ['class' => ManyChatRemoveTag::class, 'type' => 'write', 'name' => 'Remove Tag', 'description' => 'Remove a bot tag by ID.', 'icon' => 'ph:tag'],
            'manychat_remove_tag_by_name' => ['class' => ManyChatRemoveTagByName::class, 'type' => 'write', 'name' => 'Remove Tag By Name', 'description' => 'Remove a bot tag by name.', 'icon' => 'ph:tag'],
            'manychat_list_growth_tools' => ['class' => ManyChatListGrowthTools::class, 'type' => 'read', 'name' => 'List Growth Tools', 'description' => 'List growth tools.', 'icon' => 'ph:megaphone'],
            'manychat_list_custom_fields' => ['class' => ManyChatListCustomFields::class, 'type' => 'read', 'name' => 'List Custom Fields', 'description' => 'List custom user fields.', 'icon' => 'ph:list-bullets'],
            'manychat_create_custom_field' => ['class' => ManyChatCreateCustomField::class, 'type' => 'write', 'name' => 'Create Custom Field', 'description' => 'Create a custom user field.', 'icon' => 'ph:plus-circle'],
            'manychat_list_bot_fields' => ['class' => ManyChatListBotFields::class, 'type' => 'read', 'name' => 'List Bot Fields', 'description' => 'List bot fields.', 'icon' => 'ph:database'],
            'manychat_set_bot_field' => ['class' => ManyChatSetBotField::class, 'type' => 'write', 'name' => 'Set Bot Field', 'description' => 'Set a bot field by ID.', 'icon' => 'ph:pencil-simple'],
            'manychat_send_message' => ['class' => ManyChatSendMessage::class, 'type' => 'write', 'name' => 'Send Message', 'description' => 'Compatibility alias for sendContent.', 'icon' => 'ph:paper-plane-tilt'],
            'manychat_send_content' => ['class' => ManyChatSendContent::class, 'type' => 'write', 'name' => 'Send Content', 'description' => 'Send content to a subscriber.', 'icon' => 'ph:paper-plane-tilt'],
            'manychat_send_flow' => ['class' => ManyChatSendFlow::class, 'type' => 'write', 'name' => 'Send Flow', 'description' => 'Send a flow to a subscriber.', 'icon' => 'ph:flow-arrow'],
            'manychat_get_subscriber_info' => ['class' => ManyChatGetSubscriberInfo::class, 'type' => 'read', 'name' => 'Get Subscriber Info', 'description' => 'Get subscriber info by ID.', 'icon' => 'ph:user-circle'],
            'manychat_find_subscriber_by_name' => ['class' => ManyChatFindSubscriberByName::class, 'type' => 'read', 'name' => 'Find Subscriber By Name', 'description' => 'Find subscribers by name.', 'icon' => 'ph:magnifying-glass'],
            'manychat_add_subscriber_tag' => ['class' => ManyChatAddSubscriberTag::class, 'type' => 'write', 'name' => 'Add Subscriber Tag', 'description' => 'Add a tag to a subscriber.', 'icon' => 'ph:tag'],
            'manychat_remove_subscriber_tag' => ['class' => ManyChatRemoveSubscriberTag::class, 'type' => 'write', 'name' => 'Remove Subscriber Tag', 'description' => 'Remove a tag from a subscriber.', 'icon' => 'ph:tag'],
            'manychat_set_subscriber_custom_field' => ['class' => ManyChatSetSubscriberCustomField::class, 'type' => 'write', 'name' => 'Set Subscriber Custom Field', 'description' => 'Set one subscriber custom field.', 'icon' => 'ph:pencil-simple'],
            'manychat_create_subscriber' => ['class' => ManyChatCreateSubscriber::class, 'type' => 'write', 'name' => 'Create Subscriber', 'description' => 'Create a subscriber.', 'icon' => 'ph:user-plus'],
            'manychat_update_subscriber' => ['class' => ManyChatUpdateSubscriber::class, 'type' => 'write', 'name' => 'Update Subscriber', 'description' => 'Update a subscriber.', 'icon' => 'ph:user-gear'],
            'manychat_api_get' => ['class' => ManyChatApiGet::class, 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a documented GET endpoint.', 'icon' => 'ph:terminal-window'],
            'manychat_api_post' => ['class' => ManyChatApiPost::class, 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a documented POST endpoint.', 'icon' => 'ph:terminal-window'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/manychat.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Account API Key', 'required' => true],
            ['key' => 'profile_api_key', 'type' => 'secret', 'label' => 'Profile API Key', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.manychat.com'],
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
     * Resolve the Manychat service for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): ManyChatService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ManyChatService(
                apiKey: $creds->get('manychat', 'api_key', '', $account),
                baseUrl: $creds->get('manychat', 'url', 'https://api.manychat.com', $account),
                profileApiKey: $creds->get('manychat', 'profile_api_key', '', $account),
            );
        }

        return app(ManyChatService::class);
    }
}
