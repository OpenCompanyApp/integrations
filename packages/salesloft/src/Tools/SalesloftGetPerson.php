<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Salesloft person.
 */
class SalesloftGetPerson extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_get_person';
    }

    public function description(): string
    {
        return 'Get one Salesloft person by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Person ID.'],
        ];
    }

    /**
     * Get a person.
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

            return ToolResult::success($this->service->getPerson($args['id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
