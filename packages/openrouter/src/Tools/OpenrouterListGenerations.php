<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List generation records from OpenRouter.
 *
 * Sends a GET request to /generation with optional query parameters.
 * Returns a paginated list of generation resources.
 *
 * @see https://openrouter.ai/docs/api-reference/list-generations
 */
class OpenrouterListGenerations implements Tool
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
        return 'openrouter_list_generations';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List generation records from OpenRouter. Returns generation IDs, models used, token counts, and costs.';
    }

    /**
     * Parameter schema for the list generations request.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of generations to return per page.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of generations to skip for pagination.'],
            'order' => ['type' => 'string', 'description' => 'Sort order: "asc" or "desc" (default: "desc").'],
        ];
    }

    /**
     * Execute the list generations request.
     *
     * @param  array  $args  The query parameters.
     * @return ToolResult The paginated list of generations or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
            }

            $params = [];

            $optionalKeys = ['limit', 'offset', 'order'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listGenerations($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
