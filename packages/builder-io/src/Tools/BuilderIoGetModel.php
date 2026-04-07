<?php

namespace OpenCompany\Integrations\BuilderIo\Tools;

use OpenCompany\Integrations\BuilderIo\BuilderIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single model by ID or name from Builder.io.
 */
class BuilderIoGetModel implements Tool
{
    /**
     * @param  BuilderIoService  $service  The Builder.io API client
     */
    public function __construct(
        private BuilderIoService $service,
    ) {}

    public function name(): string
    {
        return 'builder_io_get_model';
    }

    public function description(): string
    {
        return <<<'MD'
        Get detailed information about a specific Builder.io model by its ID or name.
        Returns the model definition including fields, kind, and metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'model_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID or name of the model to retrieve.'],
        ];
    }

    /**
     * Get a model by ID or name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Builder.io integration is not configured.');
            }

            $modelId = $args['model_id'] ?? '';

            if (empty($modelId)) {
                return ToolResult::error('model_id is required.');
            }

            $result = $this->service->getModel($modelId);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'kind' => $result['kind'] ?? null,
                'fields' => $result['fields'] ?? [],
                'created_at' => $result['createdDate'] ?? $result['created_at'] ?? null,
                'updated_at' => $result['lastUpdatedDate'] ?? $result['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
