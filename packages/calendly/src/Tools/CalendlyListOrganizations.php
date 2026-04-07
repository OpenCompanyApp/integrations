<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List organizations the authenticated user belongs to.
 *
 * Retrieves all Calendly organizations for the current user,
 * supporting pagination.
 */
class CalendlyListOrganizations implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_list_organizations';
    }

    public function description(): string
    {
        return 'List Calendly organizations the authenticated user belongs to.';
    }

    public function parameters(): array
    {
        return [
            'page_token' => ['type' => 'string', 'description' => 'Pagination token from a previous response.'],
        ];
    }

    /**
     * List organizations with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page_token)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $params = [];

            if (isset($args['page_token'])) {
                $params['page_token'] = $args['page_token'];
            }

            $result = $this->service->listOrganizations($params);

            return ToolResult::success([
                'collection' => $result['collection'] ?? [],
                'pagination' => $result['pagination'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
