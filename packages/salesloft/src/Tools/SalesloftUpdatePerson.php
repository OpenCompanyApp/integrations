<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Salesloft person.
 */
class SalesloftUpdatePerson extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_update_person';
    }

    public function description(): string
    {
        return 'Update a Salesloft person by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Person ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Person update payload.'],
        ];
    }

    /**
     * Update a person.
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

            return ToolResult::success($this->service->updatePerson($args['id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
