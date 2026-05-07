<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Salesloft task.
 */
class SalesloftUpdateTask extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_update_task';
    }

    public function description(): string
    {
        return 'Update a Salesloft task by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Task ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Task update payload.'],
        ];
    }

    /**
     * Update a task.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['id'])) {
                return ToolResult::error('id is required.');
            }
            $payload = $this->payload($args);
            if ($payload === null) {
                return ToolResult::error('payload is required.');
            }

            return ToolResult::success($this->service->updateTask($args['id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
