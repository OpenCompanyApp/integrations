<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Anthropic model.
 *
 * Sends a GET request to /models/{id} and returns the model
 * resource with its capabilities and metadata.
 *
 * @see https://docs.anthropic.com/en/api/get-model
 */
class AnthropicGetModel implements Tool
{
    /**
     * @param  AnthropicService  $service  The Anthropic service instance.
     */
    public function __construct(
        private AnthropicService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'anthropic_get_model';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific Anthropic model, including its display name, creation date, and capabilities.';
    }

    /**
     * Parameter schema for the get model request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The model identifier (e.g., "claude-sonnet-4-20250514").'],
        ];
    }

    /**
     * Execute the get model request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The model resource or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Anthropic integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Model ID is required.');
            }

            $result = $this->service->getModel($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
