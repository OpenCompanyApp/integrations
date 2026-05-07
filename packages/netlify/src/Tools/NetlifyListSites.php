<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Netlify sites available to the account.
 */
class NetlifyListSites implements Tool
{
    /**
     * @param  NetlifyService  $service  The Netlify REST API client.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_list_sites';
    }

    public function description(): string
    {
        return 'List all Netlify sites. Returns site IDs, names, URLs, and build status. Use this to discover site identifiers needed for deploy and form operations.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'description' => 'Filter by site name.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of sites per page (default: 30).'],
        ];
    }

    /**
     * List and normalize sites.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, page, per_page).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $params = [];
            if (isset($args['name'])) {
                $params['name'] = $args['name'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listSites($params);

            $sites = array_map(function (array $site): array {
                return [
                    'id' => $site['id'] ?? null,
                    'name' => $site['name'] ?? null,
                    'url' => $site['url'] ?? null,
                    'ssl_url' => $site['ssl_url'] ?? null,
                    'state' => $site['state'] ?? null,
                    'updated_at' => $site['updated_at'] ?? null,
                    'build_settings' => [
                        'repo' => $site['build_settings']['repo_url'] ?? null,
                        'branch' => $site['build_settings']['repo_branch'] ?? null,
                    ],
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'sites' => $sites,
                'total' => count($sites),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
