<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Update Bland AI knowledge base metadata.
 *
 * Updates name and/or description for a knowledge base.
 */
class BlandAIUpdateKnowledgeBase implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_update_knowledge_base';
    }

    public function description(): string
    {
        return 'Update a Bland AI knowledge base name and/or description.';
    }

    public function parameters(): array
    {
        return [
            'knowledge_base_id' => ['type' => 'string', 'required' => true, 'description' => 'Knowledge base ID.'],
            'name' => ['type' => 'string', 'description' => 'New knowledge base name.'],
            'description' => ['type' => 'string', 'description' => 'New description.'],
        ];
    }

    /**
     * Update knowledge base metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->updateKnowledgeBase((string) ($args['knowledge_base_id'] ?? ''), array_intersect_key($args, array_flip(['name', 'description']))));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
