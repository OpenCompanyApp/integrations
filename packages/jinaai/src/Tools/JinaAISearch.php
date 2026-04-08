<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * JinaAISearch — Search the web using Jina AI.
 *
 * Accepts a search query and returns results from Jina AI's search endpoint.
 *
 * @see https://jina.ai/api/#search
 */
class JinaAISearch implements Tool
{
    /**
     * @param  JinaAIService  $service  The Jina AI service instance
     */
    public function __construct(
        private JinaAIService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'jinaai_search';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Search the web using Jina AI. Returns search results with titles, URLs, descriptions, and extracted content. Useful for finding up-to-date information on any topic.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => true, 'description' => 'The search query string.'],
        ];
    }

    /**
     * Execute the search tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (must contain 'q')
     * @return ToolResult The search results
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            $body = [
                'q' => $args['q'],
            ];

            $result = $this->service->search($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
