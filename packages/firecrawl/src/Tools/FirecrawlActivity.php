<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * List recent Firecrawl team API activity.
 */
class FirecrawlActivity implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_activity';
    }

    public function description(): string
    {
        return 'List recent Firecrawl API activity for the configured team.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum activities to return.'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor.'],
            'endpoint' => ['type' => 'string', 'description' => 'Optional endpoint filter.'],
        ];
    }

    /**
     * List recent activity.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->activity($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
