<?php

namespace OpenCompany\Integrations\Actively\Tools;

use OpenCompany\Integrations\Actively\ActivelyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List contacts for an organization in Actively.
 *
 * Returns a paginated list of contacts associated with the specified organization.
 * Use the `limit` and `page` parameters to control pagination.
 */
class ActivelyListContacts implements Tool
{
    public function __construct(
        private ActivelyService $service,
    ) {}

    public function name(): string
    {
        return 'actively_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts for an organization in Actively. Returns contact details including name, email, phone, and any associated metadata. Paginate with limit and page parameters.';
    }

    public function parameters(): array
    {
        return [
            'org_id' => ['type' => 'string', 'required' => true, 'description' => 'The organization UUID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Actively integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listContacts($args['org_id'], $limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
