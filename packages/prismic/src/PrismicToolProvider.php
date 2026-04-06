<?php

namespace OpenCompany\Integrations\Prismic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Prismic\Tools\PrismicListDocuments;
use OpenCompany\Integrations\Prismic\Tools\PrismicGetDocument;
use OpenCompany\Integrations\Prismic\Tools\PrismicListTypes;
use OpenCompany\Integrations\Prismic\Tools\PrismicGetTags;
use OpenCompany\Integrations\Prismic\Tools\PrismicListRefs;
use OpenCompany\Integrations\Prismic\Tools\PrismicListLanguages;
use OpenCompany\Integrations\Prismic\Tools\PrismicGetCurrentUser;

class PrismicToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'prismic';
    }

    /**
     * Get metadata for the application display.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'documents, types, tags, refs, languages',
            'description' => 'Headless CMS',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:prismic',
        ];
    }

    /**
     * Get integration metadata for display in the integrations catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Prismic',
            'description' => 'Headless CMS for content management',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:prismic',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://prismic.io/docs/technical-reference/prismic-rest-api-v2',
        ];
    }

    /**
     * Get the configuration schema for the Prismic integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Prismic access token',
                'hint' => 'Generate a permanent access token in your Prismic repository settings under "API & Security"',
                'required' => true,
            ],
            [
                'key' => 'repository',
                'type' => 'text',
                'label' => 'Repository Name',
                'placeholder' => 'my-repo',
                'hint' => 'The repository name from your Prismic URL (e.g., <code>my-repo</code> from <code>my-repo.prismic.io</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Prismic API using the provided configuration.
     *
     * @param  array  $config  The configuration array containing access_token and repository.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $repository = $config['repository'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($repository)) {
            return ['success' => false, 'error' => 'No repository name provided'];
        }

        try {
            $baseUrl = "https://{$repository}.prismic.io/api/v2";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/documents/search', [
                'pageSize' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Prismic API at {$baseUrl}. Check the repository name.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Prismic repository \"{$repository}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the Prismic configuration.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'repository' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by the Prismic integration.
     */
    public function tools(): array
    {
        return [
            'prismic_list_documents' => [
                'class' => PrismicListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'Search and list documents from the Prismic repository.',
                'icon' => 'ph:files',
            ],
            'prismic_get_document' => [
                'class' => PrismicGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Retrieve a single document by its ID.',
                'icon' => 'ph:file-text',
            ],
            'prismic_list_types' => [
                'class' => PrismicListTypes::class,
                'type' => 'read',
                'name' => 'List Types',
                'description' => 'List all custom types defined in the repository.',
                'icon' => 'ph:article',
            ],
            'prismic_get_tags' => [
                'class' => PrismicGetTags::class,
                'type' => 'read',
                'name' => 'Get Tags',
                'description' => 'List all tags defined in the repository.',
                'icon' => 'ph:tag',
            ],
            'prismic_list_refs' => [
                'class' => PrismicListRefs::class,
                'type' => 'read',
                'name' => 'List Refs',
                'description' => 'List all refs (releases/drafts) for the repository.',
                'icon' => 'ph:git-branch',
            ],
            'prismic_list_languages' => [
                'class' => PrismicListLanguages::class,
                'type' => 'read',
                'name' => 'List Languages',
                'description' => 'List all languages configured in the repository.',
                'icon' => 'ph:translate',
            ],
            'prismic_get_current_user' => [
                'class' => PrismicGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Verify the Prismic API connection is working.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/prismic.md';
    }

    /**
     * Get the credential fields for the Prismic integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'repository', 'type' => 'text', 'label' => 'Repository Name', 'required' => true],
        ];
    }

    /**
     * Indicate that this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  string  $class   The tool class to instantiate.
     * @param  array   $context The context array, may contain an 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PrismicService(
                accessToken: $creds->get('prismic', 'access_token', '', $account),
                repository: $creds->get('prismic', 'repository', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(PrismicService::class));
    }
}
