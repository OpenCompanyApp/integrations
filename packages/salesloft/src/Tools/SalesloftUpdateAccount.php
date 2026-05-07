<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Salesloft account.
 */
class SalesloftUpdateAccount extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_update_account';
    }

    public function description(): string
    {
        return 'Update a Salesloft account by ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Account update payload.'],
        ];
    }

    /**
     * Update an account.
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

            return ToolResult::success($this->service->updateAccount($args['id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
