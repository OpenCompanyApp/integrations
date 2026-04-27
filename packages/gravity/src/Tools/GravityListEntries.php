<?php

namespace OpenCompany\Integrations\Gravity\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gravity\GravityService;

/**
 * List entries for a Gravity form.
 */
class GravityListEntries implements Tool
{
    /**
     * @param  GravityService  $service  The Gravity API client.
     */
    public function __construct(
        private GravityService $service,
    ) {}

    public function name(): string
    {
        return 'gravity_list_entries';
    }

    public function description(): string
    {
        return 'List entries for a specific Gravity form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of entries to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        ];
    }

    /**
     * List form entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gravity integration is not configured.');
            }
            if (empty($args['form_id'])) {
                return ToolResult::error('Form ID is required.');
            }

            return ToolResult::success($this->service->listEntries(
                (string) $args['form_id'],
                isset($args['limit']) ? (int) $args['limit'] : null,
                isset($args['offset']) ? (int) $args['offset'] : null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
