<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft accounts.
 */
class SalesloftListAccounts extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_accounts';
    }

    public function description(): string
    {
        return 'List Salesloft accounts with pagination and common filters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'domain' => ['type' => 'string', 'description' => 'Filter by domain.'],
        ];
    }

    /**
     * List accounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listAccounts($this->only($args, ['page', 'per_page', 'domain'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
