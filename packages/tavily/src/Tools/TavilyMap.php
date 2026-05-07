<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Map a website with Tavily and return discovered URLs.
 *
 * Supports the official Tavily Map request controls for graph traversal,
 * path/domain filters, external link handling, timeout, and usage output.
 */
class TavilyMap extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_map';
    }

    public function description(): string
    {
        return 'Map a website with Tavily and return discovered URLs without extracting full page content. Use before targeted extract or crawl jobs.';
    }

    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'Root URL to begin mapping.'],
            'instructions' => ['type' => 'string', 'description' => 'Natural language mapping instructions. Increases cost when supplied.'],
            'max_depth' => ['type' => 'integer', 'description' => 'Maximum mapping depth. Range: 1-5.'],
            'max_breadth' => ['type' => 'integer', 'description' => 'Maximum links to follow per level. Range: 1-500.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of links to process.'],
            'select_paths' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex path patterns to include.'],
            'select_domains' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex domain patterns to include.'],
            'exclude_paths' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex path patterns to exclude.'],
            'exclude_domains' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Regex domain patterns to exclude.'],
            'allow_external' => ['type' => 'boolean', 'description' => 'Whether external links may appear in final results.'],
            'timeout' => ['type' => 'number', 'description' => 'Map timeout in seconds. Range: 10-150.'],
            'include_usage' => ['type' => 'boolean', 'description' => 'Include credit usage details.'],
        ];
    }

    /**
     * Execute the Tavily Map API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments matching Tavily Map request parameters.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tavily integration is not configured.');
            }

            $payload = $this->only($args, [
                'url',
                'instructions',
                'max_depth',
                'max_breadth',
                'limit',
                'select_paths',
                'select_domains',
                'exclude_paths',
                'exclude_domains',
                'allow_external',
                'timeout',
                'include_usage',
            ]);
            $payload['url'] = $this->requireString($args, 'url');

            return ToolResult::success($this->service->map($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
