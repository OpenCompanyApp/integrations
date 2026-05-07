<?php

namespace OpenCompany\Integrations\Firecrawl\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

/**
 * Retrieve status and results for a Firecrawl agent job.
 */
class FirecrawlGetAgentStatus implements Tool
{
    /**
     * @param  FirecrawlService  $service  The Firecrawl API client.
     */
    public function __construct(private FirecrawlService $service) {}

    public function name(): string
    {
        return 'firecrawl_get_agent_status';
    }

    public function description(): string
    {
        return 'Check status and retrieve results for a Firecrawl agent job.';
    }

    public function parameters(): array
    {
        return ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Agent job ID.']];
    }

    /**
     * Retrieve agent status by id.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Firecrawl integration is not configured.');
            }

            return ToolResult::success($this->service->getAgentStatus((string) ($args['job_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
