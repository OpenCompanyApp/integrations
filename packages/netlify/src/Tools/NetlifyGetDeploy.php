<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Netlify deploy by ID.
 */
class NetlifyGetDeploy implements Tool
{
    /**
     * @param  NetlifyService  $service  The Netlify REST API client.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_get_deploy';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Netlify deploy, including its state, build log, and commit details.';
    }

    public function parameters(): array
    {
        return [
            'deploy_id' => ['type' => 'string', 'required' => true, 'description' => 'The deploy identifier.'],
        ];
    }

    /**
     * Fetch and normalize a deploy.
     *
     * @param  array<string, mixed>  $args  Tool arguments (deploy_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Netlify integration is not configured.');
            }

            $deployId = $args['deploy_id'] ?? '';
            if (empty($deployId)) {
                return ToolResult::error('deploy_id is required.');
            }

            $deploy = $this->service->getDeploy($deployId);

            return ToolResult::success([
                'id' => $deploy['id'] ?? null,
                'site_id' => $deploy['site_id'] ?? null,
                'state' => $deploy['state'] ?? null,
                'branch' => $deploy['branch'] ?? null,
                'commit_ref' => $deploy['commit_ref'] ?? null,
                'title' => $deploy['title'] ?? null,
                'review_id' => $deploy['review_id'] ?? null,
                'created_at' => $deploy['created_at'] ?? null,
                'updated_at' => $deploy['updated_at'] ?? null,
                'published_at' => $deploy['published_at'] ?? null,
                'deploy_time' => $deploy['deploy_time'] ?? null,
                'deploy_url' => $deploy['deploy_url'] ?? null,
                'ssl_url' => $deploy['ssl_url'] ?? null,
                'log_url' => $deploy['log_url'] ?? null,
                'error_message' => $deploy['error_message'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
