<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Extract clean page content from supplied URLs with Tavily.
 *
 * Supports Tavily's URL extraction controls, including reranking query,
 * extraction depth, output format, images, favicon, timeout, and usage.
 */
class TavilyExtract extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_extract';
    }

    public function description(): string
    {
        return 'Extract clean markdown or text content from one or more URLs with Tavily. Use after search or map when an agent needs full page content.';
    }

    public function parameters(): array
    {
        return [
            'urls' => ['type' => ['string', 'array'], 'required' => true, 'description' => 'URL or array of URLs to extract.'],
            'query' => ['type' => 'string', 'description' => 'Optional user intent for reranking extracted content chunks.'],
            'chunks_per_source' => ['type' => 'integer', 'description' => 'Chunks per source when query is provided. Range: 1-5.'],
            'extract_depth' => ['type' => 'string', 'enum' => ['basic', 'advanced'], 'description' => 'Extraction depth. advanced retrieves more data with higher latency/cost.'],
            'include_images' => ['type' => 'boolean', 'description' => 'Include images extracted from URLs.'],
            'include_favicon' => ['type' => 'boolean', 'description' => 'Include favicon URL for each result.'],
            'format' => ['type' => 'string', 'enum' => ['markdown', 'text'], 'description' => 'Output format for raw_content.'],
            'timeout' => ['type' => 'number', 'description' => 'Extraction timeout in seconds. Range: 1-60.'],
            'include_usage' => ['type' => 'boolean', 'description' => 'Include credit usage details.'],
        ];
    }

    /**
     * Execute the Tavily Extract API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Tavily Extract request parameters.
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
                'urls',
                'query',
                'chunks_per_source',
                'extract_depth',
                'include_images',
                'include_favicon',
                'format',
                'timeout',
                'include_usage',
            ]);
            $payload['urls'] = $this->requireStringOrList($args, 'urls');

            return ToolResult::success($this->service->extract($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
