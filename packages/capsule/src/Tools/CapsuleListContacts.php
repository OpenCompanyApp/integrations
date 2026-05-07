<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts (parties) from Capsule CRM.
 *
 * Supports pagination via `page` and `per_page` parameters.
 * Returns people and organisations from the authenticated account.
 */
class CapsuleListContacts implements Tool
{
    /**
     * @param  CapsuleService  $service  The Capsule CRM API client.
     */
    public function __construct(
        private CapsuleService $service,
    ) {}

    public function name(): string
    {
        return 'capsule_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts (people and organisations) from Capsule CRM. Returns paginated results with contact details.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of contacts per page, max 100 (default: 50).'],
        ];
    }

    /**
     * List Capsule CRM parties.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Capsule CRM integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;

            $result = $this->service->listContacts($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
