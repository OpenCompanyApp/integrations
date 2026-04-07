<?php

namespace OpenCompany\Integrations\Openrouter\Tools;

use OpenCompany\Integrations\Openrouter\OpenrouterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List available AI models on OpenRouter.
 *
 * Sends a GET request to /models and returns the full list
 * of model resources with identifiers, pricing, and capabilities.
 *
 * @see https://openrouter.ai/docs/api-reference/list-models
 */
class OpenrouterListModels implements Tool
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
        return 'openrouter_list_models';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List available AI models on OpenRouter. Returns model identifiers, names, pricing, context lengths, and capabilities.';
    }

    /**
     * Parameter schema — no parameters required.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the list models request.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The list of models or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OpenRouter integration is not configured.');
            }

            $result = $this->service->listModels();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
