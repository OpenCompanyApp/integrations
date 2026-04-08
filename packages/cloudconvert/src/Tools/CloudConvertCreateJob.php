<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

use OpenCompany\Integrations\CloudConvert\CloudConvertService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CloudConvertCreateJob implements Tool
{
    public function __construct(
        private CloudConvertService $service,
    ) {}

    public function name(): string
    {
        return 'cloudconvert_create_job';
    }

    public function description(): string
    {
        return 'Create a new CloudConvert job. A job groups one or more tasks (import, convert, export) into a single workflow. Pass a tasks array to define the conversion pipeline.';
    }

    public function parameters(): array
    {
        return [
            'tasks' => ['type' => 'array', 'required' => true, 'description' => 'Array of task definitions. Each task is an object with "operation" (e.g., "import/url", "convert", "export/url"), optional "name", optional "input" (name of a previous task to chain from), and operation-specific parameters. Example: [{"operation": "import/url", "url": "https://example.com/file.pdf", "filename": "file.pdf"}, {"operation": "convert", "input": "import", "output_format": "png"}].'],
            'tag' => ['type' => 'string', 'description' => 'Optional tag to identify and filter the job later.'],
            'webhook_url' => ['type' => 'string', 'description' => 'Optional webhook URL called when the job finishes.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CloudConvert integration is not configured.');
            }

            $tasks = $args['tasks'] ?? [];

            if (empty($tasks)) {
                return ToolResult::error('At least one task is required to create a job.');
            }

            $result = $this->service->createJob(
                tasks: $tasks,
                tag: $args['tag'] ?? null,
                webhookUrl: $args['webhook_url'] ?? null,
            );

            $data = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $data['id'] ?? null,
                'status' => $data['status'] ?? null,
                'tag' => $data['tag'] ?? null,
                'tasks' => array_map(function (array $task): array {
                    return [
                        'id' => $task['id'] ?? null,
                        'name' => $task['name'] ?? null,
                        'operation' => $task['operation'] ?? null,
                        'status' => $task['status'] ?? null,
                    ];
                }, $data['tasks'] ?? []),
                'created_at' => $data['created_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
