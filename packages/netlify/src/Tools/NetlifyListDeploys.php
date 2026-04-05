<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list deploys for a Netlify site.
 *
 * Returns an array of deploy objects with status, branch, commit info, and timestamps.
 */
class NetlifyListDeploys implements Tool
{
    /**
     * Create a new NetlifyListDeploys tool instance.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'netlify_list_deploys';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'List deploys for a Netlify site. Returns deploy status, branch, commit SHA, and timestamps for each deployment.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The Netlify site ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of deploys per page (max 100, default: 20).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $siteId = $args['site_id'];
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 20;

            $result = $this->service->listDeploys($siteId, $page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
