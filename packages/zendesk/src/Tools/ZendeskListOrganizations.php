<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Zendesk organizations with pagination.
 *
 * Returns a paginated list of organizations with their IDs, names, and metadata.
 */
class ZendeskListOrganizations implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_list_organizations';
    }

    public function description(): string
    {
        return <<<'MD'
        List Zendesk organizations with pagination.
        Returns organization IDs, names, and created dates.
        Use per_page and page for pagination.
        MD;
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of organizations per page (default 100, max 100).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-indexed).'],
        ];
    }

    /**
     * List Zendesk organizations with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (per_page, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            $params = [];

            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->listOrganizations($params);

            $organizations = array_map(function (array $org): array {
                return [
                    'id' => $org['id'] ?? '',
                    'name' => $org['name'] ?? '',
                    'created_at' => $org['created_at'] ?? '',
                    'updated_at' => $org['updated_at'] ?? '',
                    'domain_names' => $org['domain_names'] ?? [],
                ];
            }, $result['organizations'] ?? []);

            $output = ['results' => $organizations];

            if (isset($result['next_page'])) {
                $output['next_page'] = $result['next_page'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
