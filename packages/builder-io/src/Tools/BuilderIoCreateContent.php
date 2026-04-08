<?php

namespace OpenCompany\Integrations\BuilderIo\Tools;

use OpenCompany\Integrations\BuilderIo\BuilderIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new content entry in Builder.io.
 */
class BuilderIoCreateContent implements Tool
{
    /**
     * @param  BuilderIoService  $service  The Builder.io API client
     */
    public function __construct(
        private BuilderIoService $service,
    ) {}

    public function name(): string
    {
        return 'builder_io_create_content';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new content entry in Builder.io for a given model.
        Provide the model name and a JSON object with the content data.
        The entry is created as a draft by default.
        MD;
    }

    public function parameters(): array
    {
        return [
            'model_name' => ['type' => 'string', 'required' => true, 'description' => 'The model name for the new content entry (e.g. "page", "blog-post").'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name/title of the new content entry.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of content data. E.g. {"blocks": [], "title": "My Page"}.'],
        ];
    }

    /**
     * Create a content entry.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model_name, name, data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Builder.io integration is not configured.');
            }

            $modelName = $args['model_name'] ?? '';

            if (empty($modelName)) {
                return ToolResult::error('model_name is required.');
            }

            $name = $args['name'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $dataRaw = $args['data'] ?? '';
            if (empty($dataRaw)) {
                return ToolResult::error('data is required.');
            }

            $data = is_string($dataRaw) ? json_decode($dataRaw, true) : $dataRaw;
            if (json_last_error() !== JSON_ERROR_NONE) {
                return ToolResult::error('Invalid JSON in data: ' . json_last_error_msg());
            }

            $body = [
                'name' => $name,
                'data' => $data,
            ];

            $result = $this->service->createContent($modelName, $body);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'model' => $result['modelId'] ?? $result['model'] ?? null,
                'created_at' => $result['createdDate'] ?? $result['created_at'] ?? null,
                'data' => $result['data'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
