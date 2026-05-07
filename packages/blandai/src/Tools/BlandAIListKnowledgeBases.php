<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * List Bland AI knowledge bases.
 *
 * Retrieves current knowledge bases with optional pagination/filtering.
 */
class BlandAIListKnowledgeBases implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_list_knowledge_bases';
    }

    public function description(): string
    {
        return 'List Bland AI knowledge bases for the authenticated organization.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Optional page size.'],
            'offset' => ['type' => 'integer', 'description' => 'Optional offset.'],
            'status' => ['type' => 'string', 'description' => 'Optional status filter.'],
        ];
    }

    /**
     * List knowledge bases.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->listKnowledgeBases(array_intersect_key($args, array_flip(['limit', 'offset', 'status']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
