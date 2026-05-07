<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create (trigger) a new deploy for a Netlify site.
 *
 * Starts a new deploy, optionally with a title, branch, or other settings.
 */
class NetlifyCreateDeploy implements Tool
{
    /**
     * Create a new NetlifyCreateDeploy tool instance.
     *
     * @param  NetlifyService  $service  The Netlify REST API client.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'netlify_create_deploy';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'Trigger a new deploy for a Netlify site. Optionally specify a title, branch, or framework override.';
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
            'title' => ['type' => 'string', 'description' => 'Title for the deploy.'],
            'branch' => ['type' => 'string', 'description' => 'Branch to deploy (e.g., "main", "staging"). Defaults to the site\'s production branch.'],
            'framework' => ['type' => 'string', 'description' => 'Framework override (e.g., "nextjs", "nuxt", "hugo", "gatsby").'],
            'body' => ['type' => 'object', 'description' => 'Additional deploy configuration fields.'],
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
            $body = $args['body'] ?? [];

            if (isset($args['branch'])) {
                $body['branch'] = $args['branch'];
            }

            if (isset($args['framework'])) {
                $body['framework'] = $args['framework'];
            }

            $query = [];
            if (isset($args['title'])) {
                $query['title'] = $args['title'];
            }

            $result = $this->service->createDeploy($siteId, $body, $query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
