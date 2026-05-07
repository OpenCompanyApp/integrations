<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Crawl a website through Tavily and return extracted page content.
 *
 * Covers Tavily's graph traversal controls, path/domain filters, extraction
 * options, and usage reporting for crawl requests.
 */
class TavilyCrawl extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_crawl';
    }

    public function description(): string
    {
        return 'Crawl a website with Tavily and return extracted content from discovered pages. Use for documentation ingestion, RAG source collection, and targeted site extraction.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'Root URL to begin the crawl.'],
            'instructions' => ['type' => 'string', 'description' => 'Natural language crawl instructions. Increases mapping cost when supplied.'],
            'chunks_per_source' => ['type' => 'integer', 'description' => 'Chunks per source when instructions are supplied. Range: 1-5.'],
            'max_depth' => ['type' => 'integer', 'description' => 'Maximum crawl depth. Range: 1-5.'],
            'max_breadth' => ['type' => 'integer', 'description' => 'Maximum links to follow per level. Range: 1-500.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of links to process.'],
            'select_paths' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex path patterns to include.'],
            'select_domains' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex domain patterns to include.'],
            'exclude_paths' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex path patterns to exclude.'],
            'exclude_domains' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex domain patterns to exclude.'],
            'allow_external' => ['type' => 'boolean', 'description' => 'Whether external links may appear in final results.'],
            'include_images' => ['type' => 'boolean', 'description' => 'Include images in crawl results.'],
            'extract_depth' => ['type' => 'string', 'enum' => ['basic', 'advanced'], 'description' => 'Extraction depth for crawled pages.'],
            'format' => ['type' => 'string', 'enum' => ['markdown', 'text'], 'description' => 'Output format for raw_content.'],
            'include_favicon' => ['type' => 'boolean', 'description' => 'Include favicon URL for each result.'],
            'timeout' => ['type' => 'number', 'description' => 'Crawl timeout in seconds. Range: 10-150.'],
            'include_usage' => ['type' => 'boolean', 'description' => 'Include credit usage details.'],
        ];
    }

    /**
     * Execute the Tavily Crawl API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Tavily Crawl request parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tavily integration is not configured.');
            }

            $this->assertEnum('extract_depth', $args['extract_depth'] ?? null, ['basic', 'advanced']);
            $this->assertEnum('format', $args['format'] ?? null, ['markdown', 'text']);

            $payload = $this->only($args, [
                'url',
                'instructions',
                'chunks_per_source',
                'max_depth',
                'max_breadth',
                'limit',
                'select_paths',
                'select_domains',
                'exclude_paths',
                'exclude_domains',
                'allow_external',
                'include_images',
                'extract_depth',
                'format',
                'include_favicon',
                'timeout',
                'include_usage',
            ]);
            $payload['url'] = $this->requireString($args, 'url');

            return ToolResult::success($this->service->crawl($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
