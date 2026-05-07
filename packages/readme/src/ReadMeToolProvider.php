<?php

namespace OpenCompany\Integrations\ReadMe;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetApiDefinition;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetBranch;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetCategory;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetGuide;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetProjectMetadata;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeGetReference;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListApiDefinitions;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListApiKeys;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListBranches;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListCategories;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeListCategoryPages;
use OpenCompany\Integrations\ReadMe\Tools\ReadMeSearchDocs;

/**
 * Tool catalog and configuration metadata for ReadMe.
 *
 * Exposes branch, category, page, API definition, project, API-key, and search
 * endpoints from ReadMe's documented APIs.
 */
class ReadMeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_token',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_token'],
                'notes' => ['ReadMe API v2 uses Bearer authentication with a token from ReadMe API Keys.'],
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
        return 'readme';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ReadMe',
            'description' => 'API documentation projects, branches, pages, and search',
            'icon' => 'ph:book-open',
            'logo' => 'ph:book-open',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ReadMe',
            'description' => 'ReadMe API for project metadata, API keys, branches, categories, category pages, guides, API reference pages, API definitions, and docs search.',
            'icon' => 'ph:book-open',
            'logo' => 'ph:book-open',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.readme.com/main/reference/intro-to-the-readme-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'ReadMe API token', 'hint' => 'ReadMe API key/token used as Bearer auth.', 'required' => true],
        ];
    }

    /**
     * Verify ReadMe credentials with a lightweight branches request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['api_token'] ?? '');
            if ($token === '') {
                return ['success' => false, 'error' => 'ReadMe API token is required.'];
            }

            $response = Http::acceptJson()
                ->withToken($token)
                ->timeout(20)
                ->get('https://api.readme.com/v2/branches');

            return $response->successful()
                ? ['success' => true, 'message' => 'ReadMe API token accepted.']
                : ['success' => false, 'error' => 'ReadMe returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_token' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'ReadMe API token', 'hint' => 'ReadMe API key/token used as Bearer auth.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'readme_get_project_metadata' => ['class' => ReadMeGetProjectMetadata::class, 'type' => 'read', 'name' => 'Project Metadata', 'description' => 'Get metadata for the current ReadMe project.', 'icon' => 'ph:info'],
            'readme_list_api_keys' => ['class' => ReadMeListApiKeys::class, 'type' => 'read', 'name' => 'List API Keys', 'description' => 'List API keys for a project subdomain.', 'icon' => 'ph:key'],
            'readme_list_branches' => ['class' => ReadMeListBranches::class, 'type' => 'read', 'name' => 'List Branches', 'description' => 'List ReadMe branches.', 'icon' => 'ph:git-branch'],
            'readme_get_branch' => ['class' => ReadMeGetBranch::class, 'type' => 'read', 'name' => 'Get Branch', 'description' => 'Get one ReadMe branch.', 'icon' => 'ph:git-branch'],
            'readme_list_categories' => ['class' => ReadMeListCategories::class, 'type' => 'read', 'name' => 'List Categories', 'description' => 'List categories in a branch section.', 'icon' => 'ph:folders'],
            'readme_get_category' => ['class' => ReadMeGetCategory::class, 'type' => 'read', 'name' => 'Get Category', 'description' => 'Get one category in a branch section.', 'icon' => 'ph:folder'],
            'readme_list_category_pages' => ['class' => ReadMeListCategoryPages::class, 'type' => 'read', 'name' => 'Category Pages', 'description' => 'List pages within a category.', 'icon' => 'ph:files'],
            'readme_get_guide' => ['class' => ReadMeGetGuide::class, 'type' => 'read', 'name' => 'Get Guide', 'description' => 'Get a guide page by slug.', 'icon' => 'ph:file-text'],
            'readme_get_reference' => ['class' => ReadMeGetReference::class, 'type' => 'read', 'name' => 'Get Reference', 'description' => 'Get an API reference page by slug.', 'icon' => 'ph:brackets-curly'],
            'readme_list_api_definitions' => ['class' => ReadMeListApiDefinitions::class, 'type' => 'read', 'name' => 'List API Definitions', 'description' => 'List API definitions.', 'icon' => 'ph:database'],
            'readme_get_api_definition' => ['class' => ReadMeGetApiDefinition::class, 'type' => 'read', 'name' => 'Get API Definition', 'description' => 'Get one API definition.', 'icon' => 'ph:code'],
            'readme_search_docs' => ['class' => ReadMeSearchDocs::class, 'type' => 'read', 'name' => 'Search Docs', 'description' => 'Search ReadMe docs using the documented legacy search endpoint.', 'icon' => 'ph:magnifying-glass'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a ReadMe tool from the catalog class name.
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
    private function resolveService(array $context = []): ReadMeService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ReadMeService(apiToken: $creds->get('readme', 'api_token', '', $account));
        }

        return app(ReadMeService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/readme.md';
    }
}
