<?php

namespace OpenCompany\Integrations\BlandAI\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\BlandAI\BlandAIService;

/**
 * Create a Bland AI custom tool.
 *
 * Registers an external API tool that call agents can invoke during conversations.
 */
class BlandAICreateTool implements Tool
{
    /**
     * @param  BlandAIService  $service  The Bland AI API client
     */
    public function __construct(private BlandAIService $service) {}

    public function name(): string
    {
        return 'blandai_create_tool';
    }

    public function description(): string
    {
        return 'Create a Bland AI custom tool for call agents.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Tool name.'],
            'description' => ['type' => 'string', 'description' => 'Tool description.'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'External API URL.'],
            'method' => ['type' => 'string', 'required' => true, 'description' => 'HTTP method, usually GET or POST.'],
            'headers' => ['type' => 'object', 'description' => 'Optional request headers.'],
            'body' => ['type' => 'object', 'description' => 'Optional request body schema/defaults.'],
            'query' => ['type' => 'object', 'description' => 'Optional query schema/defaults.'],
        ];
    }

    /**
     * Create a custom tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('BlandAI integration is not configured.');
            }

            return ToolResult::success($this->service->createTool($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
