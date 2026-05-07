<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

use OpenCompany\Integrations\Anthropic\AnthropicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available Anthropic AI models.
 *
 * Sends a GET request to /models with optional pagination parameters.
 * Returns a paginated list of model resources.
 *
 * @see https://docs.anthropic.com/en/api/list-models
 */
class AnthropicListModels implements Tool
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
        return 'anthropic_list_models';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List available Anthropic AI models. Returns model identifiers, creation dates, and display names.';
    }

    /**
     * Parameter schema for the list models request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of models to return per page (default: 20, max: 1000).'],
            'before_id' => ['type' => 'string', 'description' => 'Model ID used for cursor-based pagination - return models before this ID.'],
            'after_id' => ['type' => 'string', 'description' => 'Model ID used for cursor-based pagination - return models after this ID.'],
        ];
    }

    /**
     * Execute the list models request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The paginated list of models or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Anthropic integration is not configured.');
            }

            $params = [];

            $optionalKeys = ['limit', 'before_id', 'after_id'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listModels($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
