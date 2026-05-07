<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft cadences.
 */
class SalesloftListCadences extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_cadences';
    }

    public function description(): string
    {
        return 'List Salesloft cadences with pagination and filters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'owned_by_user_id' => ['type' => 'integer', 'description' => 'Filter by owner user ID.'],
        ];
    }

    /**
     * List cadences.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listCadences($this->only($args, ['page', 'per_page', 'owned_by_user_id'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
