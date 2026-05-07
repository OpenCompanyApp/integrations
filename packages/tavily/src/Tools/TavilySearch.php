<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute an AI-optimized Tavily web search.
 *
 * Supports the official search request controls for depth, topic, dates,
 * answer generation, raw content, images, domains, country, and usage output.
 */
class TavilySearch extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_search';
    }

    public function description(): string
    {
        return 'Search the web with Tavily. Use for current information, source discovery, and AI-ready snippets. Supports answer generation, raw page content, images, recency/date filters, domain filters, country boosting, and usage details.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query to execute.'],
            'search_depth' => ['type' => 'string', 'enum' => ['advanced', 'basic', 'fast', 'ultra-fast'], 'description' => 'Latency/relevance tradeoff. advanced costs more and can return multiple chunks.'],
            'chunks_per_source' => ['type' => 'integer', 'description' => 'Relevant chunks per source for advanced search. Range: 1-3.'],
            'max_results' => ['type' => 'integer', 'description' => 'Maximum results to return. Range: 0-20. Default: 5.'],
            'topic' => ['type' => 'string', 'enum' => ['general', 'news', 'finance'], 'description' => 'Search topic.'],
            'time_range' => ['type' => 'string', 'enum' => ['day', 'week', 'month', 'year', 'd', 'w', 'm', 'y'], 'description' => 'Relative publish/update time range.'],
            'start_date' => ['type' => 'string', 'description' => 'Return results after this YYYY-MM-DD date.'],
            'end_date' => ['type' => 'string', 'description' => 'Return results before this YYYY-MM-DD date.'],
            'include_answer' => ['type' => ['boolean', 'string'], 'description' => 'false, true, basic, or advanced. Adds an LLM-generated answer.'],
            'include_raw_content' => ['type' => ['boolean', 'string'], 'description' => 'false, true, markdown, or text. Adds cleaned page content to results.'],
            'include_images' => ['type' => 'boolean', 'description' => 'Include query and per-result images.'],
            'include_image_descriptions' => ['type' => 'boolean', 'description' => 'Add descriptions for images when include_images is true.'],
            'include_favicon' => ['type' => 'boolean', 'description' => 'Include favicon URL for each result.'],
            'include_domains' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Only include these domains. Maximum 300 domains.'],
            'exclude_domains' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Exclude these domains. Maximum 150 domains.'],
            'country' => ['type' => 'string', 'description' => 'Boost results from a documented Tavily country value. Only applies to general topic.'],
            'auto_parameters' => ['type' => 'boolean', 'description' => 'Let Tavily select search parameters from query intent. Explicit values override auto values.'],
            'exact_match' => ['type' => 'boolean', 'description' => 'Require exact quoted phrases in results.'],
            'include_usage' => ['type' => 'boolean', 'description' => 'Include credit usage details.'],
            'safe_search' => ['type' => 'boolean', 'description' => 'Enterprise-only unsafe-content filtering. Not supported for fast or ultra-fast depth.'],
        ];
    }

    /**
     * Execute the Tavily Search API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Tavily Search request parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tavily integration is not configured.');
            }

            $this->assertEnum('search_depth', $args['search_depth'] ?? null, ['advanced', 'basic', 'fast', 'ultra-fast']);
            $this->assertEnum('topic', $args['topic'] ?? null, ['general', 'news', 'finance']);
            $this->assertEnum('time_range', $args['time_range'] ?? null, ['day', 'week', 'month', 'year', 'd', 'w', 'm', 'y']);

            $payload = $this->only($args, [
                'query',
                'search_depth',
                'chunks_per_source',
                'max_results',
                'topic',
                'time_range',
                'start_date',
                'end_date',
                'include_answer',
                'include_raw_content',
                'include_images',
                'include_image_descriptions',
                'include_favicon',
                'include_domains',
                'exclude_domains',
                'country',
                'auto_parameters',
                'exact_match',
                'include_usage',
                'safe_search',
            ]);
            $payload['query'] = $this->requireString($args, 'query');

            return ToolResult::success($this->service->search($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
