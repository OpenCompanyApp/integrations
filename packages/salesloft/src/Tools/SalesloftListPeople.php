<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft people.
 */
class SalesloftListPeople extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_people';
    }

    public function description(): string
    {
        return 'List Salesloft people with pagination and common filters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'email_address' => ['type' => 'string', 'description' => 'Filter by email address.'],
            'account_id' => ['type' => 'integer', 'description' => 'Filter by account ID.'],
        ];
    }

    /**
     * List people.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listPeople($this->only($args, ['page', 'per_page', 'email_address', 'account_id'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
