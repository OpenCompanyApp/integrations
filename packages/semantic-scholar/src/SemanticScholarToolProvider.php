<?php

namespace OpenCompany\Integrations\SemanticScholar;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarAutocompletePapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarBatchGetAuthors;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarBatchGetPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarBulkSearchPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetAuthor;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetAuthorPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetDataset;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetDatasetDiffs;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetDatasetRelease;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetPaper;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetPaperAuthors;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetPaperCitations;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarGetPaperReferences;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarListDatasetReleases;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarRecommendForPaper;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarRecommendPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarSearchAuthors;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarSearchPapers;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarSearchSnippets;
use OpenCompany\Integrations\SemanticScholar\Tools\SemanticScholarTitleSearchPapers;

/**
 * Tool catalog and configuration metadata for Semantic Scholar.
 *
 * Exposes all official operations from the Academic Graph, Recommendations,
 * and Datasets API Swagger specifications.
 */
class SemanticScholarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Requires a Semantic Scholar API key sent as x-api-key. Dataset downloads are governed by Semantic Scholar API license terms.'],
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
        return 'semantic-scholar';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Semantic Scholar',
            'description' => 'Academic Graph, paper recommendations, and research datasets',
            'icon' => 'ph:student',
            'logo' => 'ph:student',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Semantic Scholar',
            'description' => 'Semantic Scholar APIs for papers, authors, citations, references, snippets, recommendations, and dataset download metadata.',
            'icon' => 'ph:student',
            'logo' => 'ph:student',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api.semanticscholar.org/api-docs/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Semantic Scholar API key', 'hint' => 'Required x-api-key value from Semantic Scholar.', 'required' => true],
        ];
    }

    /**
     * Verify Semantic Scholar credentials with a lightweight paper search.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::acceptJson()
                ->withHeaders(['x-api-key' => $apiKey])
                ->timeout(20)
                ->get('https://api.semanticscholar.org/graph/v1/paper/search', [
                    'query' => 'science',
                    'limit' => 1,
                    'fields' => 'title',
                ]);

            return $response->successful()
                ? ['success' => true, 'message' => 'Semantic Scholar credentials verified.']
                : ['success' => false, 'error' => 'Semantic Scholar API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function tools(): array
    {
        return [
            'semantic_scholar_search_papers' => ['class' => SemanticScholarSearchPapers::class, 'type' => 'read', 'name' => 'Search Papers', 'description' => 'Search papers by relevance.', 'icon' => 'ph:magnifying-glass'],
            'semantic_scholar_bulk_search_papers' => ['class' => SemanticScholarBulkSearchPapers::class, 'type' => 'read', 'name' => 'Bulk Search Papers', 'description' => 'Bulk search papers with token paging.', 'icon' => 'ph:list-magnifying-glass'],
            'semantic_scholar_title_search_papers' => ['class' => SemanticScholarTitleSearchPapers::class, 'type' => 'read', 'name' => 'Title Search Papers', 'description' => 'Search for papers by title.', 'icon' => 'ph:text-t'],
            'semantic_scholar_autocomplete_papers' => ['class' => SemanticScholarAutocompletePapers::class, 'type' => 'read', 'name' => 'Autocomplete Papers', 'description' => 'Suggest paper query completions.', 'icon' => 'ph:sparkle'],
            'semantic_scholar_get_paper' => ['class' => SemanticScholarGetPaper::class, 'type' => 'read', 'name' => 'Get Paper', 'description' => 'Get one paper by ID.', 'icon' => 'ph:article'],
            'semantic_scholar_batch_get_papers' => ['class' => SemanticScholarBatchGetPapers::class, 'type' => 'read', 'name' => 'Batch Get Papers', 'description' => 'Get multiple papers by ID.', 'icon' => 'ph:stack'],
            'semantic_scholar_get_paper_authors' => ['class' => SemanticScholarGetPaperAuthors::class, 'type' => 'read', 'name' => 'Paper Authors', 'description' => 'Get authors for a paper.', 'icon' => 'ph:users'],
            'semantic_scholar_get_paper_citations' => ['class' => SemanticScholarGetPaperCitations::class, 'type' => 'read', 'name' => 'Paper Citations', 'description' => 'Get papers that cite a paper.', 'icon' => 'ph:arrow-fat-lines-up'],
            'semantic_scholar_get_paper_references' => ['class' => SemanticScholarGetPaperReferences::class, 'type' => 'read', 'name' => 'Paper References', 'description' => 'Get papers referenced by a paper.', 'icon' => 'ph:link'],
            'semantic_scholar_search_authors' => ['class' => SemanticScholarSearchAuthors::class, 'type' => 'read', 'name' => 'Search Authors', 'description' => 'Search authors by name.', 'icon' => 'ph:user-list'],
            'semantic_scholar_get_author' => ['class' => SemanticScholarGetAuthor::class, 'type' => 'read', 'name' => 'Get Author', 'description' => 'Get one author by ID.', 'icon' => 'ph:user'],
            'semantic_scholar_batch_get_authors' => ['class' => SemanticScholarBatchGetAuthors::class, 'type' => 'read', 'name' => 'Batch Get Authors', 'description' => 'Get multiple authors by ID.', 'icon' => 'ph:users-three'],
            'semantic_scholar_get_author_papers' => ['class' => SemanticScholarGetAuthorPapers::class, 'type' => 'read', 'name' => 'Author Papers', 'description' => 'Get papers by an author.', 'icon' => 'ph:files'],
            'semantic_scholar_search_snippets' => ['class' => SemanticScholarSearchSnippets::class, 'type' => 'read', 'name' => 'Search Snippets', 'description' => 'Search paper text snippets.', 'icon' => 'ph:quotes'],
            'semantic_scholar_recommend_papers' => ['class' => SemanticScholarRecommendPapers::class, 'type' => 'read', 'name' => 'Recommend Papers', 'description' => 'Recommend papers from positive and negative seeds.', 'icon' => 'ph:lightbulb'],
            'semantic_scholar_recommend_for_paper' => ['class' => SemanticScholarRecommendForPaper::class, 'type' => 'read', 'name' => 'Recommend For Paper', 'description' => 'Recommend papers for one paper.', 'icon' => 'ph:lightbulb-filament'],
            'semantic_scholar_list_dataset_releases' => ['class' => SemanticScholarListDatasetReleases::class, 'type' => 'read', 'name' => 'List Dataset Releases', 'description' => 'List available dataset releases.', 'icon' => 'ph:database'],
            'semantic_scholar_get_dataset_release' => ['class' => SemanticScholarGetDatasetRelease::class, 'type' => 'read', 'name' => 'Get Dataset Release', 'description' => 'List datasets in a release.', 'icon' => 'ph:database'],
            'semantic_scholar_get_dataset' => ['class' => SemanticScholarGetDataset::class, 'type' => 'read', 'name' => 'Get Dataset', 'description' => 'Get dataset download links.', 'icon' => 'ph:download-simple'],
            'semantic_scholar_get_dataset_diffs' => ['class' => SemanticScholarGetDatasetDiffs::class, 'type' => 'read', 'name' => 'Get Dataset Diffs', 'description' => 'Get incremental diff download links.', 'icon' => 'ph:arrows-clockwise'],
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Semantic Scholar API key', 'hint' => 'Required x-api-key value from Semantic Scholar.', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Semantic Scholar tool from the catalog class name.
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
    private function resolveService(array $context = []): SemanticScholarService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SemanticScholarService(apiKey: $creds->get('semantic-scholar', 'api_key', '', $account));
        }

        return app(SemanticScholarService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/semantic-scholar.md';
    }
}
