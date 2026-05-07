<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft cadence memberships.
 */
class SalesloftListCadenceMemberships extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_cadence_memberships';
    }

    public function description(): string
    {
        return 'List people currently or previously in Salesloft cadences.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'cadence_id' => ['type' => 'integer', 'description' => 'Filter by cadence ID.'],
            'person_id' => ['type' => 'integer', 'description' => 'Filter by person ID.'],
        ];
    }

    /**
     * List cadence memberships.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listCadenceMemberships($this->only($args, ['page', 'per_page', 'cadence_id', 'person_id'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
