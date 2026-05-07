<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Cancel a Firecrawl agent job.
 */
class FirecrawlCancelAgent implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_cancel_agent';
    }

    public function description(): string
    {
        return 'Cancel a running Firecrawl agent job.';
    }

    public function parameters(): array
    {
        return ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Agent job ID.']];
    }

    /**
     * Cancel an agent job.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->cancelAgent((string) ($args['job_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
