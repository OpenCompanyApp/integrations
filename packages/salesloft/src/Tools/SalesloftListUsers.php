<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft users.
 */
class SalesloftListUsers extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_users';
    }

    public function description(): string
    {
        return 'List Salesloft users with pagination and official filters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'email' => ['type' => 'string', 'description' => 'Filter by email.'],
        ];
    }

    /**
     * List users.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listUsers($this->only($args, ['page', 'per_page', 'email'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
