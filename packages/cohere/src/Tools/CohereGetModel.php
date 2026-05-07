<?php

namespace OpenCompany\Integrations\Cohere\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve one Cohere model by name.
 *
 * Returns metadata such as endpoint compatibility, context length, features,
 * deprecation state, and sampling defaults.
 */
class CohereGetModel extends AbstractCohereTool implements Tool
{
    public function name(): string
    {
        return 'cohere_get_model';
    }

    public function description(): string
    {
        return 'Get Cohere model metadata including compatible endpoints, deprecation state, context length, features, and sampling defaults.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model name to retrieve.'],
        ];
    }

    /**
     * Execute the Cohere Get Model API call.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing model.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cohere integration is not configured.');
            }

            return ToolResult::success($this->service->getModel($this->requireString($args, 'model')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
