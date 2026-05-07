<?php

namespace OpenCompany\Integrations\GitBook;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetFile;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetOrganization;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetPage;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetPageByPath;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetSpace;
use OpenCompany\Integrations\GitBook\Tools\GitBookGetSpaceContent;
use OpenCompany\Integrations\GitBook\Tools\GitBookListFiles;
use OpenCompany\Integrations\GitBook\Tools\GitBookListOpenApiSpecs;
use OpenCompany\Integrations\GitBook\Tools\GitBookListOrganizations;
use OpenCompany\Integrations\GitBook\Tools\GitBookListPages;
use OpenCompany\Integrations\GitBook\Tools\GitBookListSpaces;
use OpenCompany\Integrations\GitBook\Tools\GitBookSearchOrganization;
use OpenCompany\Integrations\GitBook\Tools\GitBookSearchSpace;

/**
 * Tool catalog and configuration metadata for GitBook.
 *
 * Exposes read-oriented organization, space, search, content, page, file, and
 * OpenAPI specification operations from the GitBook API.
 */
class GitBookToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['GitBook API uses a Bearer token from GitBook developer settings.'],
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
        return 'gitbook';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'GitBook',
            'description' => 'Documentation spaces, pages, search, and files',
            'icon' => 'ph:book-open',
            'logo' => 'ph:book-open',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'GitBook',
            'description' => 'GitBook API for organizations, spaces, content search, current revisions, pages, files, and OpenAPI documentation metadata.',
            'icon' => 'ph:book-open',
            'logo' => 'ph:book-open',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://gitbook.com/docs/developers/gitbook-api/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'GitBook API token', 'hint' => 'Create a personal access token in GitBook developer settings.', 'required' => true],
        ];
    }

    /**
     * Verify GitBook credentials with a lightweight organizations request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['api_token'] ?? '');
            if ($token === '') {
                return ['success' => false, 'error' => 'GitBook API token is required.'];
            }

            $response = Http::acceptJson()
                ->withToken($token)
                ->timeout(20)
                ->get('https://api.gitbook.com/v1/orgs');

            return $response->successful()
                ? ['success' => true, 'message' => 'GitBook API token accepted.']
                : ['success' => false, 'error' => 'GitBook returned HTTP '.$response->status().'.'];
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
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'GitBook API token', 'hint' => 'Create a personal access token in GitBook developer settings.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'gitbook_list_organizations' => ['class' => GitBookListOrganizations::class, 'type' => 'read', 'name' => 'List Organizations', 'description' => 'List organizations visible to the token.', 'icon' => 'ph:buildings'],
            'gitbook_get_organization' => ['class' => GitBookGetOrganization::class, 'type' => 'read', 'name' => 'Get Organization', 'description' => 'Get one GitBook organization.', 'icon' => 'ph:building'],
            'gitbook_search_organization' => ['class' => GitBookSearchOrganization::class, 'type' => 'read', 'name' => 'Search Organization', 'description' => 'Search across an organization.', 'icon' => 'ph:magnifying-glass'],
            'gitbook_list_spaces' => ['class' => GitBookListSpaces::class, 'type' => 'read', 'name' => 'List Spaces', 'description' => 'List spaces in an organization.', 'icon' => 'ph:books'],
            'gitbook_get_space' => ['class' => GitBookGetSpace::class, 'type' => 'read', 'name' => 'Get Space', 'description' => 'Get one GitBook space.', 'icon' => 'ph:book'],
            'gitbook_search_space' => ['class' => GitBookSearchSpace::class, 'type' => 'read', 'name' => 'Search Space', 'description' => 'Search content in a GitBook space.', 'icon' => 'ph:magnifying-glass'],
            'gitbook_get_space_content' => ['class' => GitBookGetSpaceContent::class, 'type' => 'read', 'name' => 'Get Space Content', 'description' => 'Get the current content revision for a space.', 'icon' => 'ph:tree-structure'],
            'gitbook_list_pages' => ['class' => GitBookListPages::class, 'type' => 'read', 'name' => 'List Pages', 'description' => 'List pages in a space content revision.', 'icon' => 'ph:files'],
            'gitbook_get_page' => ['class' => GitBookGetPage::class, 'type' => 'read', 'name' => 'Get Page', 'description' => 'Get one page by ID.', 'icon' => 'ph:file-text'],
            'gitbook_get_page_by_path' => ['class' => GitBookGetPageByPath::class, 'type' => 'read', 'name' => 'Get Page By Path', 'description' => 'Get one page by path.', 'icon' => 'ph:link'],
            'gitbook_list_files' => ['class' => GitBookListFiles::class, 'type' => 'read', 'name' => 'List Files', 'description' => 'List files in a space.', 'icon' => 'ph:folder-open'],
            'gitbook_get_file' => ['class' => GitBookGetFile::class, 'type' => 'read', 'name' => 'Get File', 'description' => 'Get one file by ID.', 'icon' => 'ph:file'],
            'gitbook_list_openapi_specs' => ['class' => GitBookListOpenApiSpecs::class, 'type' => 'read', 'name' => 'List OpenAPI Specs', 'description' => 'List OpenAPI specs in a space.', 'icon' => 'ph:brackets-curly'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a GitBook tool from the catalog class name.
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
    private function resolveService(array $context = []): GitBookService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GitBookService(token: $creds->get('gitbook', 'api_token', '', $account));
        }

        return app(GitBookService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/gitbook.md';
    }
}
