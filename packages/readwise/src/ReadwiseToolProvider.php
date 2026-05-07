<?php

namespace OpenCompany\Integrations\Readwise;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Readwise.
 *
 * Exposes Readwise v2 highlight/book APIs and Reader v3 document APIs for
 * agent-friendly reading, export, review, and document-management workflows.
 */
class ReadwiseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'readwise_check_auth' => ['ReadwiseCheckAuth', 'read', 'Check Auth', 'Validate the Readwise access token.', 'ph:key'],
        'readwise_list_books' => ['ReadwiseListBooks', 'read', 'List Books', 'List Readwise books.', 'ph:books'],
        'readwise_get_book' => ['ReadwiseGetBook', 'read', 'Get Book', 'Get one Readwise book.', 'ph:book-open'],
        'readwise_list_book_tags' => ['ReadwiseListBookTags', 'read', 'List Book Tags', 'List tags for a Readwise book.', 'ph:tags'],
        'readwise_create_book_tag' => ['ReadwiseCreateBookTag', 'write', 'Create Book Tag', 'Create a tag on a Readwise book.', 'ph:tag-simple'],
        'readwise_delete_book_tag' => ['ReadwiseDeleteBookTag', 'write', 'Delete Book Tag', 'Delete a tag from a Readwise book.', 'ph:tag-chevron'],
        'readwise_list_highlights' => ['ReadwiseListHighlights', 'read', 'List Highlights', 'List Readwise highlights.', 'ph:highlighter'],
        'readwise_create_highlights' => ['ReadwiseCreateHighlights', 'write', 'Create Highlights', 'Create one or more Readwise highlights.', 'ph:plus-circle'],
        'readwise_get_highlight' => ['ReadwiseGetHighlight', 'read', 'Get Highlight', 'Get one Readwise highlight.', 'ph:quotes'],
        'readwise_update_highlight' => ['ReadwiseUpdateHighlight', 'write', 'Update Highlight', 'Update a Readwise highlight.', 'ph:pencil'],
        'readwise_delete_highlight' => ['ReadwiseDeleteHighlight', 'write', 'Delete Highlight', 'Delete a Readwise highlight.', 'ph:trash'],
        'readwise_list_highlight_tags' => ['ReadwiseListHighlightTags', 'read', 'List Highlight Tags', 'List tags for a highlight.', 'ph:tags'],
        'readwise_create_highlight_tag' => ['ReadwiseCreateHighlightTag', 'write', 'Create Highlight Tag', 'Create a tag on a highlight.', 'ph:tag-simple'],
        'readwise_delete_highlight_tag' => ['ReadwiseDeleteHighlightTag', 'write', 'Delete Highlight Tag', 'Delete a tag from a highlight.', 'ph:tag-chevron'],
        'readwise_export_highlights' => ['ReadwiseExportHighlights', 'read', 'Export Highlights', 'Sync Readwise export data.', 'ph:export'],
        'readwise_get_review_queue' => ['ReadwiseGetReviewQueue', 'read', 'Get Review Queue', 'Get daily review queue items.', 'ph:cards'],
        'readwise_list_documents' => ['ReadwiseListDocuments', 'read', 'List Reader Documents', 'List Reader documents.', 'ph:article'],
        'readwise_save_document' => ['ReadwiseSaveDocument', 'write', 'Save Reader Document', 'Save a document to Reader.', 'ph:bookmark-simple'],
        'readwise_update_document' => ['ReadwiseUpdateDocument', 'write', 'Update Reader Document', 'Update a Reader document.', 'ph:pencil-simple'],
        'readwise_bulk_update_documents' => ['ReadwiseBulkUpdateDocuments', 'write', 'Bulk Update Documents', 'Bulk update Reader documents.', 'ph:stack'],
        'readwise_delete_document' => ['ReadwiseDeleteDocument', 'write', 'Delete Reader Document', 'Delete a Reader document.', 'ph:trash'],
        'readwise_list_reader_tags' => ['ReadwiseListReaderTags', 'read', 'List Reader Tags', 'List Reader tags.', 'ph:tag'],
        'readwise_api_get' => ['ReadwiseApiGet', 'read', 'API GET', 'Call a safe relative Readwise GET path.', 'ph:code'],
        'readwise_api_post' => ['ReadwiseApiPost', 'write', 'API POST', 'Call a safe relative Readwise POST path.', 'ph:code'],
        'readwise_api_patch' => ['ReadwiseApiPatch', 'write', 'API PATCH', 'Call a safe relative Readwise PATCH path.', 'ph:code'],
        'readwise_api_delete' => ['ReadwiseApiDelete', 'write', 'API DELETE', 'Call a safe relative Readwise DELETE path.', 'ph:code'],
    ];

    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_token',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Readwise uses Authorization: Token <access_token>.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'readwise'; }

    public function appMeta(): array
    {
        return ['label' => 'Readwise', 'description' => 'Highlights, books, exports, review queue, and Reader documents', 'icon' => 'ph:book-open-text', 'logo' => 'ph:book-open-text'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Readwise',
            'description' => 'Manage Readwise highlights, books, tags, exports, review queue, and Reader documents.',
            'icon' => 'ph:book-open-text',
            'logo' => 'ph:book-open-text',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://readwise.io/api_deets',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Readwise credentials with the auth endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $token = (string) ($config['access_token'] ?? '');
            if ($token === '') {
                return ['success' => false, 'error' => 'Readwise access token is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://readwise.io';
            $response = Http::withHeaders(['Authorization' => 'Token '.$token, 'Accept' => 'application/json'])
                ->timeout(20)
                ->get($baseUrl.'/api/v2/auth/');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Readwise API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Readwise API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['access_token' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Readwise access token', 'hint' => 'Readwise access token from readwise.io/access_token.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://readwise.io', 'hint' => 'Optional Readwise base URL override.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $icon];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Readwise tool instance.
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
    private function resolveService(array $context = []): ReadwiseService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ReadwiseService(
                accessToken: $creds->get('readwise', 'access_token', '', $account),
                baseUrl: $creds->get('readwise', 'url', 'https://readwise.io', $account),
            );
        }

        return app(ReadwiseService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/readwise.md';
    }
}
