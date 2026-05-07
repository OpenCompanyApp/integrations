<?php

namespace OpenCompany\Integrations\Tavily\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Tavily Research task status or completed result.
 *
 * Returns the API response unchanged so agents can inspect pending,
 * completed, or failed states and use the source list exactly as returned.
 */
class TavilyGetResearchTask extends AbstractTavilyTool implements Tool
{
    public function name(): string
    {
        return 'tavily_get_research_task';
    }

    public function description(): string
    {
        return 'Get the current status and, when complete, the content and sources for a Tavily Research task by request_id.';
    }

    public function parameters(): array
    {
        return [
            'request_id' => ['type' => 'string', 'required' => true, 'description' => 'Research task request_id returned by tavily_create_research_task.'],
        ];
    }

    /**
     * Execute the Tavily Research task retrieval API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments with request_id.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tavily integration is not configured.');
            }

            return ToolResult::success($this->service->getResearch($this->requireString($args, 'request_id')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
