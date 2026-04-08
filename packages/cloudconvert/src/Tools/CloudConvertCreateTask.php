<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertCreateTask implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_create_task';
    }

    public function description(): string
    {
        return 'Create a standalone CloudConvert task. Specify an operation (e.g., import/url, convert, export/url, capture-website, merge, optimize, thumbnail) and the operation-specific payload.';
    }

    public function parameters(): array
    {
        return [
            'operation' => ['type' => 'string', 'required' => true, 'description' => 'The task operation. Common operations: "import/url", "import/upload", "import/base64", "convert", "export/url", "export/aws-s3", "capture-website", "merge", "optimize", "thumbnail", "metadata", "archive".'],
            'payload' => ['type' => 'array', 'description' => 'Operation-specific parameters. For "convert": output_format, input_format, options (e.g., quality, density). For "import/url": url, filename. For "export/url": no extra payload needed.'],
            'name' => ['type' => 'string', 'description' => 'Optional name for the task (used to reference as input for subsequent tasks in a job).'],
            'input' => ['type' => 'string', 'description' => 'Name of a previous task whose output this task should use as input.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $operation = $args['operation'];
            $payload = $args['payload'] ?? [];

            $result = $this->service->createTask(
                operation: $operation,
                payload: $payload,
                name: $args['name'] ?? null,
                input: $args['input'] ?? null,
            );

            $data = $result['data'] ?? $result;

            return ToolResult::success($data);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
