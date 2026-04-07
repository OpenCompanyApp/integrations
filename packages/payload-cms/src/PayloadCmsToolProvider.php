<?php

namespace OpenCompany\Integrations\PayloadCms;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PayloadCms\Tools\ListCollections;
use OpenCompany\Integrations\PayloadCms\Tools\GetCollection;
use OpenCompany\Integrations\PayloadCms\Tools\CreateDocument;
use OpenCompany\Integrations\PayloadCms\Tools\ListDocuments;
use OpenCompany\Integrations\PayloadCms\Tools\GetDocument;
use OpenCompany\Integrations\PayloadCms\Tools\ListUsers;
use OpenCompany\Integrations\PayloadCms\Tools\GetCurrentUser;

/**
 * Registers all available Payload CMS tools and provides integration metadata, configuration schema, and connection testing.
 */
class PayloadCmsToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'payload-cms';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'cms, headless, content',
            'description' => 'Headless CMS',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:payloadcms',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Payload CMS',
            'description' => 'Collections, documents, and user management for your headless CMS',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:payloadcms',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://payloadcms.com/docs/rest-api/overview',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'your-payload-api-token',
                'hint' => 'Generate an API key at <a href="https://payloadcms.com/docs/authentication/api-keys" target="_blank">Payload CMS → API Keys</a>.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Base URL',
                'placeholder' => 'https://api.payloadcms.com/api',
                'hint' => 'The base URL of your Payload CMS REST API.',
                'required' => false,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = $config['base_url'] ?? 'https://api.payloadcms.com/api';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'API token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/users/me');

            if ($response->successful()) {
                $data = $response->json();
                $email = $data['user']['email'] ?? $data['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Payload CMS as \"{$email}\".",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $body['error'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Payload CMS API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            // Collections
            'payload_cms_list_collections' => [
                'class' => ListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all collections in the Payload CMS instance.',
                'icon' => 'ph:list',
            ],
            'payload_cms_get_collection' => [
                'class' => GetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details about a specific collection by slug.',
                'icon' => 'ph:folder-open',
            ],
            // Documents
            'payload_cms_list_documents' => [
                'class' => ListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents in a collection with optional filtering and pagination.',
                'icon' => 'ph:list-bullets',
            ],
            'payload_cms_get_document' => [
                'class' => GetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get a single document by ID from a collection.',
                'icon' => 'ph:file-text',
            ],
            'payload_cms_create_document' => [
                'class' => CreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Create a new document in a collection.',
                'icon' => 'ph:plus-circle',
            ],
            // Users
            'payload_cms_list_users' => [
                'class' => ListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Payload CMS instance.',
                'icon' => 'ph:users',
            ],
            'payload_cms_get_current_user' => [
                'class' => GetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/payload-cms.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Base URL', 'required' => false],
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
     * Resolve the PayloadCmsService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): PayloadCmsService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new PayloadCmsService(
                apiToken: $creds->get('payload-cms', 'api_token', '', $account),
                baseUrl: $creds->get('payload-cms', 'base_url', 'https://api.payloadcms.com/api', $account),
            );
        }

        return app(PayloadCmsService::class);
    }
}
