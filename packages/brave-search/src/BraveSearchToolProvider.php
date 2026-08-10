<?php

namespace OpenCompany\Integrations\BraveSearch;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchAnswer;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchImageSearch;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLlmContext;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLlmContextPost;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLocalDescriptions;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchLocalPois;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchNewsSearch;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchPlaceSearch;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerEnrichments;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerEntityInfo;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerFollowups;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerSearch;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerSummary;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchRelatedSummarizerTitle;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchSpellcheck;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchSuggest;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchVideoSearch;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchWebRich;
use OpenCompany\Integrations\BraveSearch\Tools\BraveSearchWebSearch;

/**
 * Tool catalog and configuration metadata for Brave Search.
 *
 * Exposes Brave Search web, media, local, LLM context, Answers, autosuggest,
 * spellcheck, rich callback, and legacy summarizer endpoints.
 */
class BraveSearchToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Brave Search requires an API key sent in the X-Subscription-Token header.'],
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
        return 'brave-search';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Brave Search',
            'description' => 'Independent web search and AI grounding APIs',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'ph:magnifying-glass',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Brave Search',
            'description' => 'Brave Search APIs for web search, LLM context, images, videos, news, places, local details, autosuggest, spellcheck, AI answers, rich results, and legacy summarizer retrieval.',
            'icon' => 'ph:magnifying-glass',
            'logo' => 'ph:magnifying-glass',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api-dashboard.search.brave.com/app/documentation',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Brave Search API key', 'hint' => 'Required for all Brave Search API endpoints.', 'required' => true],
        ];
    }

    /**
     * Verify Brave Search credentials with a lightweight spellcheck request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'Brave Search API key is required.'];
            }

            $response = Http::acceptJson()
                ->withHeaders(['X-Subscription-Token' => $apiKey, 'Accept-Encoding' => 'gzip'])
                ->timeout(20)
                ->get('https://api.search.brave.com/res/v1/spellcheck/search', ['q' => 'hello', 'country' => 'US']);

            return $response->successful()
                ? ['success' => true, 'message' => 'Brave Search API key accepted.']
                : ['success' => false, 'error' => 'Brave Search returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Brave Search API key', 'hint' => 'Required for all Brave Search API endpoints.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'brave_search_web' => ['class' => BraveSearchWebSearch::class, 'type' => 'read', 'name' => 'Web Search', 'description' => 'Search Brave web results.', 'icon' => 'ph:magnifying-glass'],
            'brave_search_web_rich' => ['class' => BraveSearchWebRich::class, 'type' => 'read', 'name' => 'Web Rich Callback', 'description' => 'Fetch rich result details from a web search callback key.', 'icon' => 'ph:sparkle'],
            'brave_search_llm_context' => ['class' => BraveSearchLlmContext::class, 'type' => 'read', 'name' => 'LLM Context', 'description' => 'Retrieve LLM-ready extracted web context with GET.', 'icon' => 'ph:brain'],
            'brave_search_llm_context_post' => ['class' => BraveSearchLlmContextPost::class, 'type' => 'read', 'name' => 'LLM Context POST', 'description' => 'Retrieve LLM-ready extracted web context with POST.', 'icon' => 'ph:brain'],
            'brave_search_images' => ['class' => BraveSearchImageSearch::class, 'type' => 'read', 'name' => 'Image Search', 'description' => 'Search Brave image results.', 'icon' => 'ph:image'],
            'brave_search_news' => ['class' => BraveSearchNewsSearch::class, 'type' => 'read', 'name' => 'News Search', 'description' => 'Search Brave news results.', 'icon' => 'ph:newspaper'],
            'brave_search_videos' => ['class' => BraveSearchVideoSearch::class, 'type' => 'read', 'name' => 'Video Search', 'description' => 'Search Brave video results.', 'icon' => 'ph:video'],
            'brave_search_places' => ['class' => BraveSearchPlaceSearch::class, 'type' => 'read', 'name' => 'Place Search', 'description' => 'Search Brave places and points of interest.', 'icon' => 'ph:map-pin'],
            'brave_search_local_pois' => ['class' => BraveSearchLocalPois::class, 'type' => 'read', 'name' => 'Local POIs', 'description' => 'Fetch details for ephemeral Brave local place IDs.', 'icon' => 'ph:map-trifold'],
            'brave_search_local_descriptions' => ['class' => BraveSearchLocalDescriptions::class, 'type' => 'read', 'name' => 'Local Descriptions', 'description' => 'Fetch AI-generated descriptions for ephemeral Brave local place IDs.', 'icon' => 'ph:text-align-left'],
            'brave_search_suggest' => ['class' => BraveSearchSuggest::class, 'type' => 'read', 'name' => 'Autosuggest', 'description' => 'Get Brave query suggestions.', 'icon' => 'ph:list-magnifying-glass'],
            'brave_search_spellcheck' => ['class' => BraveSearchSpellcheck::class, 'type' => 'read', 'name' => 'Spellcheck', 'description' => 'Get Brave spelling corrections for a query.', 'icon' => 'ph:spell-check'],
            'brave_search_answer' => ['class' => BraveSearchAnswer::class, 'type' => 'read', 'name' => 'Answer', 'description' => 'Create a Brave grounded answer through the OpenAI-compatible endpoint.', 'icon' => 'ph:chat-circle-text'],
            'brave_search_summarizer' => ['class' => BraveSearchRelatedSummarizerSearch::class, 'type' => 'read', 'name' => 'Summarizer Search', 'description' => 'Fetch a legacy summarizer search result by key.', 'icon' => 'ph:article'],
            'brave_search_summarizer_summary' => ['class' => BraveSearchRelatedSummarizerSummary::class, 'type' => 'read', 'name' => 'Summarizer Summary', 'description' => 'Fetch just the legacy summarizer summary by key.', 'icon' => 'ph:text-t'],
            'brave_search_summarizer_title' => ['class' => BraveSearchRelatedSummarizerTitle::class, 'type' => 'read', 'name' => 'Summarizer Title', 'description' => 'Fetch just the legacy summarizer title by key.', 'icon' => 'ph:text-aa'],
            'brave_search_summarizer_enrichments' => ['class' => BraveSearchRelatedSummarizerEnrichments::class, 'type' => 'read', 'name' => 'Summarizer Enrichments', 'description' => 'Fetch legacy summarizer enrichments by key.', 'icon' => 'ph:star'],
            'brave_search_summarizer_followups' => ['class' => BraveSearchRelatedSummarizerFollowups::class, 'type' => 'read', 'name' => 'Summarizer Followups', 'description' => 'Fetch legacy summarizer follow-up questions by key.', 'icon' => 'ph:question'],
            'brave_search_summarizer_entity_info' => ['class' => BraveSearchRelatedSummarizerEntityInfo::class, 'type' => 'read', 'name' => 'Summarizer Entity Info', 'description' => 'Fetch legacy summarizer entity information by key.', 'icon' => 'ph:identification-card'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Brave Search tool from the catalog class name.
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
    private function resolveService(array $context = []): BraveSearchService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BraveSearchService(apiKey: $creds->get('brave-search', 'api_key', '', $account));
        }

        return app(BraveSearchService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/brave-search.md';
    }
}
