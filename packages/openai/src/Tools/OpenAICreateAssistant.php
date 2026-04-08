<?php

namespace OpenCompany\Integrations\OpenAI\Tools;

use OpenCompany\Integrations\OpenAI\OpenAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an OpenAI assistant.
 *
 * Creates a new assistant with a specified model, name, description,
 * instructions, and optional tool configurations.
 */
class OpenAICreateAssistant implements Tool
{
    /**
     * @param  OpenAIService  $service  The OpenAI API client
     */
    public function __construct(
        private OpenAIService $service,
    ) {}

    public function name(): string
    {
        return 'openai_create_assistant';
    }

    public function description(): string
    {
        return 'Create an OpenAI assistant with a model, name, instructions, and optional tools.';
    }

    public function parameters(): array
    {
        return [
            'model' => ['type' => 'string', 'required' => true, 'description' => 'Model ID (e.g., "gpt-4o").'],
            'name' => ['type' => 'string', 'description' => 'Name of the assistant.'],
            'description' => ['type' => 'string', 'description' => 'Description of the assistant.'],
            'instructions' => ['type' => 'string', 'description' => 'System instructions for the assistant.'],
            'tools' => ['type' => 'array', 'description' => 'Array of tool objects the assistant can use (e.g., code_interpreter, file_search).', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Create a new OpenAI assistant.
     *
     * @param  array<string, mixed>  $args  Tool arguments (model, name, description, instructions, tools)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('OpenAI integration is not configured.');
            }

            $model = $args['model'] ?? '';

            if (empty($model)) {
                return ToolResult::error('model is required.');
            }

            $data = ['model' => $model];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['description'])) {
                $data['description'] = $args['description'];
            }
            if (isset($args['instructions'])) {
                $data['instructions'] = $args['instructions'];
            }
            if (isset($args['tools'])) {
                $data['tools'] = $args['tools'];
            }

            $result = $this->service->createAssistant($data);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'object' => $result['object'] ?? '',
                'name' => $result['name'] ?? '',
                'model' => $result['model'] ?? $model,
                'instructions' => $result['instructions'] ?? '',
                'tools' => $result['tools'] ?? [],
                'created_at' => $result['created_at'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
