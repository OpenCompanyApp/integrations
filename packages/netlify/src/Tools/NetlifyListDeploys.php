<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetlifyListDeploys implements Tool
{
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_list_deploys';
    }

    public function description(): string
    {
        return 'List deploys for a Netlify site. Returns deploy IDs, states, branches, and commit references.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site identifier.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of deploys per page (default: 30).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }

            $result = $this->service->listDeploys($siteId, $params);

            $deploys = array_map(function (array $deploy): array {
                return [
                    'id' => $deploy['id'] ?? null,
                    'state' => $deploy['state'] ?? null,
                    'branch' => $deploy['branch'] ?? null,
                    'commit_ref' => $deploy['commit_ref'] ?? null,
                    'title' => $deploy['title'] ?? null,
                    'created_at' => $deploy['created_at'] ?? null,
                    'updated_at' => $deploy['updated_at'] ?? null,
                    'deploy_time' => $deploy['deploy_time'] ?? null,
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'deploys' => $deploys,
                'total' => count($deploys),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
