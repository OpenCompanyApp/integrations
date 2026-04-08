<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific OpenRouter generation.
 *
 * Sends a GET request to /generation with the generation ID.
 * Returns the generation resource with token usage, costs, and latency.
 *
 * @see https://openrouter.ai/docs/api-reference/get-generation
 */
class OpenrouterGetGeneration implements Tool
{
    /**
     * @param  OpenrouterService  $service  The OpenRouter service instance.
     */
    public function __construct(
        private OpenrouterService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'openrouter_get_generation';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get details for a specific OpenRouter generation, including token usage, costs, and latency.';
    }

    /**
     * Parameter schema for the get generation request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The generation identifier.'],
        ];
    }

    /**
     * Execute the get generation request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The generation details or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Generation ID is required.');
            }

            $result = $this->service->getGeneration($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
