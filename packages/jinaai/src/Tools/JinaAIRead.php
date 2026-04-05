<?php

namespace OpenCompany\Integrations\JinaAI\Tools;

use OpenCompany\Integrations\JinaAI\JinaAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * JinaAIRead — Read and extract content from a URL.
 *
 * Accepts a URL and returns the extracted, clean content using Jina AI's
 * Reader endpoint.
 *
 * @see https://jina.ai/api/#reader
 */
class JinaAIRead implements Tool
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
        return 'jinaai_read';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Read and extract clean content from a URL using Jina AI Reader. Returns the main text content of a web page, stripping away navigation, ads, and other clutter. Useful for reading articles, documentation, or any web page.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The URL to read and extract content from.'],
        ];
    }

    /**
     * Execute the read tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (must contain 'url')
     * @return ToolResult The extracted content
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jina AI integration is not configured.');
            }

            $body = [
                'url' => $args['url'],
            ];

            $result = $this->service->read($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
