<?php

namespace OpenCompany\Integrations\Contentful;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Contentful\Tools\ContentfulCreateContentType;
use OpenCompany\Integrations\Contentful\Tools\ContentfulCreateEntry;
use OpenCompany\Integrations\Contentful\Tools\ContentfulDeleteEntry;
use OpenCompany\Integrations\Contentful\Tools\ContentfulGetContentType;
use OpenCompany\Integrations\Contentful\Tools\ContentfulGetEntry;
use OpenCompany\Integrations\Contentful\Tools\ContentfulGetSpace;
use OpenCompany\Integrations\Contentful\Tools\ContentfulListAssets;
use OpenCompany\Integrations\Contentful\Tools\ContentfulListContentTypes;
use OpenCompany\Integrations\Contentful\Tools\ContentfulListEntries;
use OpenCompany\Integrations\Contentful\Tools\ContentfulPublishEntry;
use OpenCompany\Integrations\Contentful\Tools\ContentfulUnpublishEntry;
use OpenCompany\Integrations\Contentful\Tools\ContentfulUpdateEntry;

/**
 * Registers all available Contentful tools and provides integration metadata, configuration schema, and connection testing.
 */
class ContentfulToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'contentful';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'cms, content',
            'description' => 'Headless CMS',
            'icon' => 'ph:article',
            'logo' => 'simple-icons:contentful',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Contentful',
            'description' => 'Content types, entries, assets, and space management',
            'icon' => 'ph:article',
            'logo' => 'simple-icons:contentful',
            'category' => 'cms',
            'badge' => 'verified',
            'docs_url' => 'https://www.contentful.com/developers/docs/references/content-management-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Management API Token',
                'placeholder' => 'CFPAT-...',
                'hint' => 'Generate a personal access token at <a href="https://app.contentful.com/account/api-keys" target="_blank">Contentful → API Keys</a>.',
                'required' => true,
            ],
            [
                'key' => 'space_id',
                'type' => 'text',
                'label' => 'Space ID',
                'placeholder' => 'e.g. abc123xyz',
                'hint' => 'Found in Contentful → Space settings → General.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $spaceId = $config['space_id'] ?? '';

        if (empty($accessToken) || empty($spaceId)) {
            return ['success' => false, 'error' => 'Access token and Space ID are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get("https://api.contentful.com/spaces/{$spaceId}");

            if ($response->successful()) {
                $data = $response->json();
                $name = $data['name'] ?? 'Unknown space';

                return [
                    'success' => true,
                    'message' => "Connected to Contentful space \"{$name}\".",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Contentful API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'space_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Content Types
            'contentful_list_content_types' => [
                'class' => ContentfulListContentTypes::class,
                'type' => 'read',
                'name' => 'List Content Types',
                'description' => 'List all content types in the Contentful space.',
                'icon' => 'ph:list',
            ],
            'contentful_get_content_type' => [
                'class' => ContentfulGetContentType::class,
                'type' => 'read',
                'name' => 'Get Content Type',
                'description' => 'Get a single content type by ID.',
                'icon' => 'ph:file-text',
            ],
            'contentful_create_content_type' => [
                'class' => ContentfulCreateContentType::class,
                'type' => 'write',
                'name' => 'Create Content Type',
                'description' => 'Create a new content type with fields.',
                'icon' => 'ph:plus-circle',
            ],
            // Entries
            'contentful_list_entries' => [
                'class' => ContentfulListEntries::class,
                'type' => 'read',
                'name' => 'List Entries',
                'description' => 'List entries, optionally filtered by content type.',
                'icon' => 'ph:list',
            ],
            'contentful_get_entry' => [
                'class' => ContentfulGetEntry::class,
                'type' => 'read',
                'name' => 'Get Entry',
                'description' => 'Get a single entry by ID.',
                'icon' => 'ph:file-text',
            ],
            'contentful_create_entry' => [
                'class' => ContentfulCreateEntry::class,
                'type' => 'write',
                'name' => 'Create Entry',
                'description' => 'Create a new entry of a given content type.',
                'icon' => 'ph:plus-circle',
            ],
            'contentful_update_entry' => [
                'class' => ContentfulUpdateEntry::class,
                'type' => 'write',
                'name' => 'Update Entry',
                'description' => 'Update an existing entry with new field values.',
                'icon' => 'ph:pencil-simple',
            ],
            'contentful_publish_entry' => [
                'class' => ContentfulPublishEntry::class,
                'type' => 'write',
                'name' => 'Publish Entry',
                'description' => 'Publish a draft or updated entry.',
                'icon' => 'ph:rocket-launch',
            ],
            'contentful_unpublish_entry' => [
                'class' => ContentfulUnpublishEntry::class,
                'type' => 'write',
                'name' => 'Unpublish Entry',
                'description' => 'Unpublish a published entry.',
                'icon' => 'ph:arrow-counter-clockwise',
            ],
            'contentful_delete_entry' => [
                'class' => ContentfulDeleteEntry::class,
                'type' => 'write',
                'name' => 'Delete Entry',
                'description' => 'Delete an entry from the space.',
                'icon' => 'ph:trash',
            ],
            // Assets
            'contentful_list_assets' => [
                'class' => ContentfulListAssets::class,
                'type' => 'read',
                'name' => 'List Assets',
                'description' => 'List assets in the Contentful space.',
                'icon' => 'ph:image',
            ],
            // Space
            'contentful_get_space' => [
                'class' => ContentfulGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get details about the connected Contentful space.',
                'icon' => 'ph:globe',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/contentful.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'space_id', 'type' => 'text', 'label' => 'Space ID', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ContentfulService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ContentfulService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ContentfulService(
                accessToken: $creds->get('contentful', 'access_token', '', $account),
                spaceId: $creds->get('contentful', 'space_id', '', $account),
            );
        }

        return app(ContentfulService::class);
    }
}
