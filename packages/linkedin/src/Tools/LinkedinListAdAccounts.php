<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List LinkedIn ad accounts.
 *
 * Returns ad account IDs, names, and statuses.
 */
class LinkedinListAdAccounts implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_list_ad_accounts';
    }

    public function description(): string
    {
        return <<<'MD'
        List LinkedIn ad accounts the authenticated user has access to.
        Returns ad account IDs, names, statuses, and currency information.
        MD;
    }

    public function parameters(): array
    {
        return [
            'count' => ['type' => 'integer', 'description' => 'Maximum number of ad accounts to return (default 10).'],
            'start' => ['type' => 'integer', 'description' => 'Pagination offset (0-based).'],
        ];
    }

    /**
     * List LinkedIn ad accounts.
     *
     * @param  array<string, mixed>  $args  Tool arguments (count, start)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $params = ['q' => 'search'];

            if (isset($args['count'])) {
                $params['count'] = (int) $args['count'];
            }
            if (isset($args['start'])) {
                $params['start'] = (int) $args['start'];
            }

            $result = $this->service->listAdAccounts($params);

            $accounts = array_map(function (array $account): array {
                return [
                    'id' => $account['id'] ?? '',
                    'name' => $account['name'] ?? '',
                    'status' => $account['status'] ?? '',
                    'currency' => $account['currency'] ?? '',
                    'type' => $account['type'] ?? '',
                ];
            }, $result['elements'] ?? []);

            $output = ['results' => $accounts];

            if (isset($result['paging'])) {
                $output['paging'] = $result['paging'];
            }

            return ToolResult::success($output);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
