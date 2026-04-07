<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List LinkedIn organizations (company pages) the user has access to.
 *
 * Returns organization IDs and names.
 */
class LinkedinListOrganizations implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_list_organizations';
    }

    public function description(): string
    {
        return <<<'MD'
        List LinkedIn organizations (company pages) the authenticated user has access to.
        Returns organization IDs, names, and roles.
        MD;
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of organizations to return (default 10).'],
            'start' => ['type' => 'integer', 'description' => 'Pagination offset (0-based).'],
        ];
    }

    /**
     * List LinkedIn organizations.
     *
     * @param  array<string, mixed>  $args  Tool arguments (count, start)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $params = ['q' => 'roleAssignee'];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }

            $result = $this->service->listOrganizations($params);

            $orgs = array_map(function (array $item): array {
                return [
                    'organization' => $item['organization'] ?? '',
                    'organizational_target' => $item['organizationalTarget'] ?? '',
                    'role' => $item['role'] ?? '',
                    'state' => $item['state'] ?? '',
                ];
            }, $result['elements'] ?? []);

            $output = ['results' => $orgs];

            if (isset($result['paging'])) {
                $output['paging'] = $result['paging'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
