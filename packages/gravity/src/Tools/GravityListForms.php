<?php

namespace OpenCompany\Integrations\Gravity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gravity\GravityService;

/**
 * List forms available in Gravity.
 *
 * Supports optional limit and offset pagination.
 */
class GravityListForms implements Tool
{
    /**
     * @param  GravityService  $service  The Gravity API client.
     */
    public function __construct(
        private GravityService $service,
    ) {}

    public function name(): string
    {
        return 'gravity_list_forms';
    }

    public function description(): string
    {
        return 'List forms available in Gravity with optional pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of forms to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * List forms.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gravity integration is not configured.');
            }

            return ToolResult::success($this->service->listForms(
                isset($args['limit']) ? (int) $args['limit'] : null,
                isset($args['offset']) ? (int) $args['offset'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
