<?php

namespace OpenCompany\Integrations\Typefully;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Typefully\Tools\TypefullyCreateDraft;
use OpenCompany\Integrations\Typefully\Tools\TypefullyCreateTag;
use OpenCompany\Integrations\Typefully\Tools\TypefullyDeleteDraft;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetCurrentUser;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetDraft;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetMedia;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetQueue;
use OpenCompany\Integrations\Typefully\Tools\TypefullyGetSocialSet;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListDrafts;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListPublished;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListScheduled;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListSocialSets;
use OpenCompany\Integrations\Typefully\Tools\TypefullyListTags;
use OpenCompany\Integrations\Typefully\Tools\TypefullyRequestMediaUpload;
use OpenCompany\Integrations\Typefully\Tools\TypefullyUpdateDraft;

/**
 * Tool provider for the Typefully integration.
 *
 * Defines v2 metadata, credential setup, multi-account service resolution, and Typefully tool classes.
 */
class TypefullyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Requires Typefully API v2 keys.'],
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
        return 'typefully';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Typefully',
            'description' => 'Social media drafts, scheduling, publishing, media, and tags.',
            'icon' => 'ph:pen-nib',
            'logo' => 'simple-icons:typefully',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Typefully',
            'description' => 'Create, schedule, publish, and manage multi-platform social content with Typefully API v2.',
            'icon' => 'ph:pen-nib',
            'logo' => 'simple-icons:typefully',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://support.typefully.com/en/articles/8718287-typefully-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Typefully API v2 key',
                'hint' => 'Generate an API v2 key in Typefully settings under API.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.typefully.com/v2',
                'hint' => 'Use the default Typefully API v2 URL unless a compatible proxy is required.',
                'default' => 'https://api.typefully.com/v2',
            ],
        ];
    }

    /**
     * Verify Typefully credentials with a v2 current-user request.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.typefully.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if (!$response->successful()) {
                $error = is_array($json) ? ($json['error'] ?? $json['message'] ?? "HTTP {$response->status()}") : "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error' => "Typefully API error: {$error}",
                ];
            }

            $handle = is_array($json) ? ($json['handle'] ?? $json['name'] ?? 'Unknown') : 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Typefully as {$handle}.",
            ];
        } catch (\Exception $e) {
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
            'typefully_get_current_user' => ['class' => TypefullyGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Typefully user profile.', 'icon' => 'ph:user'],
            'typefully_list_social_sets' => ['class' => TypefullyListSocialSets::class, 'type' => 'read', 'name' => 'List Social Sets', 'description' => 'List available Typefully social sets.', 'icon' => 'ph:users-three'],
            'typefully_get_social_set' => ['class' => TypefullyGetSocialSet::class, 'type' => 'read', 'name' => 'Get Social Set', 'description' => 'Get one Typefully social set.', 'icon' => 'ph:user-focus'],
            'typefully_list_drafts' => ['class' => TypefullyListDrafts::class, 'type' => 'read', 'name' => 'List Drafts', 'description' => 'List Typefully drafts with filters.', 'icon' => 'ph:files'],
            'typefully_list_scheduled' => ['class' => TypefullyListScheduled::class, 'type' => 'read', 'name' => 'List Scheduled', 'description' => 'List scheduled Typefully drafts.', 'icon' => 'ph:clock'],
            'typefully_list_published' => ['class' => TypefullyListPublished::class, 'type' => 'read', 'name' => 'List Published', 'description' => 'List published Typefully drafts.', 'icon' => 'ph:check-circle'],
            'typefully_get_draft' => ['class' => TypefullyGetDraft::class, 'type' => 'read', 'name' => 'Get Draft', 'description' => 'Get one Typefully draft.', 'icon' => 'ph:document-text'],
            'typefully_create_draft' => ['class' => TypefullyCreateDraft::class, 'type' => 'write', 'name' => 'Create Draft', 'description' => 'Create a multi-platform Typefully draft.', 'icon' => 'ph:pencil-simple-line'],
            'typefully_update_draft' => ['class' => TypefullyUpdateDraft::class, 'type' => 'write', 'name' => 'Update Draft', 'description' => 'Update a Typefully draft.', 'icon' => 'ph:pencil-simple'],
            'typefully_delete_draft' => ['class' => TypefullyDeleteDraft::class, 'type' => 'write', 'name' => 'Delete Draft', 'description' => 'Delete a Typefully draft.', 'icon' => 'ph:trash'],
            'typefully_request_media_upload' => ['class' => TypefullyRequestMediaUpload::class, 'type' => 'write', 'name' => 'Request Media Upload', 'description' => 'Request a presigned Typefully media upload URL.', 'icon' => 'ph:upload-simple'],
            'typefully_get_media' => ['class' => TypefullyGetMedia::class, 'type' => 'read', 'name' => 'Get Media', 'description' => 'Get Typefully media processing status.', 'icon' => 'ph:image'],
            'typefully_list_tags' => ['class' => TypefullyListTags::class, 'type' => 'read', 'name' => 'List Tags', 'description' => 'List Typefully tags.', 'icon' => 'ph:tag'],
            'typefully_create_tag' => ['class' => TypefullyCreateTag::class, 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a Typefully tag.', 'icon' => 'ph:tag-simple'],
            'typefully_get_queue' => ['class' => TypefullyGetQueue::class, 'type' => 'read', 'name' => 'Get Queue', 'description' => 'Inspect upcoming scheduled content.', 'icon' => 'ph:list-checks'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/typefully.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.typefully.com/v2'],
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

            return new $class(new TypefullyService(
                apiKey: $creds->get('typefully', 'api_key', '', $account),
                baseUrl: $creds->get('typefully', 'url', 'https://api.typefully.com/v2', $account),
            ));
        }

        return new $class(app(TypefullyService::class));
    }
}
