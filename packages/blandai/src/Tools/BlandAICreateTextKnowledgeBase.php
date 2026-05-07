<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Create a text knowledge base.
 *
 * Uploads text content through the current knowledge/learn endpoint.
 */
class BlandAICreateTextKnowledgeBase implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_create_text_knowledge_base';
    }

    public function description(): string
    {
        return 'Create a Bland AI text knowledge base from plain text.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Knowledge base name.'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Knowledge base text content.'],
            'description' => ['type' => 'string', 'description' => 'Optional description.'],
        ];
    }

    /**
     * Create a text knowledge base.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->createTextKnowledgeBase((string) ($args['name'] ?? ''), (string) ($args['text'] ?? ''), $args['description'] ?? null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
