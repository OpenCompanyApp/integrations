<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List memberships in a Calendly organization.
 *
 * Retrieves all memberships (users) belonging to a specific organization,
 * supporting pagination.
 */
class CalendlyListOrganizationMemberships implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_list_organization_memberships';
    }

    public function description(): string
    {
        return 'List memberships in a Calendly organization.';
    }

    public function parameters(): array
    {
        return [
            'organization_uuid' => ['type' => 'string', 'required' => true, 'description' => 'The organization UUID.'],
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        ];
    }

    /**
     * List organization memberships with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (organization_uuid, page_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $orgUuid = $args['organization_uuid'] ?? '';
            if (empty($orgUuid)) {
                return ToolResult::error('organization_uuid is required.');
            }

            $params = [];

            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }

            $result = $this->service->listOrganizationMemberships($orgUuid, $params);

            return ToolResult::success([
                'collection' => $result['collection'] ?? [],
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
