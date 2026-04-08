<?php

namespace OpenCompany\Integrations\Replicate\Tools;

use OpenCompany\Integrations\Replicate\ReplicateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Replicate model.
 *
 * Returns full model metadata including description, owner, default example,
 * available versions, and schema information. Use the version IDs returned
 * here to create predictions.
 */
class ReplicateGetModel implements Tool
{
    public function __construct(
        private ReplicateService $service,
    ) {}

    public function name(): string
    {
        return 'replicate_get_model';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Replicate model by owner and name, including description, versions, and input schema.';
    }

    public function parameters(): array
    {
        return [
            'model_owner' => ['type' => 'string', 'required' => true, 'description' => 'The model owner (user or organization name).'],
            'model_name' => ['type' => 'string', 'required' => true, 'description' => 'The model name.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Replicate integration is not configured.');
            }

            if (empty($args['model_owner'])) {
                return ToolResult::error('model_owner is required.');
            }

            if (empty($args['model_name'])) {
                return ToolResult::error('model_name is required.');
            }

            $result = $this->service->getModel($args['model_owner'], $args['model_name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
