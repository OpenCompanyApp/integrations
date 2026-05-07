<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Start an agentic Firecrawl data gathering task.
 */
class FirecrawlAgent implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_agent';
    }

    public function description(): string
    {
        return 'Start a Firecrawl agent task for autonomous web navigation and data extraction.';
    }

    public function parameters(): array
    {
        return [
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Agent task prompt.'],
            'url' => ['type' => 'string', 'description' => 'Optional starting URL.'],
            'schema' => ['type' => 'object', 'description' => 'Optional JSON schema for structured output.'],
        ];
    }

    /**
     * Start an agent task.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->agent($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
