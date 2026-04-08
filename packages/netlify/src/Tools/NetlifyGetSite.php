<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NetlifyGetSite implements Tool
{
    public function __construct(
        private NetlifyService $service,
    ) {}

    public function name(): string
    {
        return 'netlify_get_site';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Netlify site, including its ID, name, URL, build settings, and deploy status.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The site identifier or site name (e.g., "abc123" or "mysite.netlify.app").'],
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

            $site = $this->service->getSite($siteId);

            return ToolResult::success([
                'id' => $site['id'] ?? null,
                'name' => $site['name'] ?? null,
                'url' => $site['url'] ?? null,
                'ssl_url' => $site['ssl_url'] ?? null,
                'state' => $site['state'] ?? null,
                'custom_domain' => $site['custom_domain'] ?? null,
                'domain_aliases' => $site['domain_aliases'] ?? [],
                'created_at' => $site['created_at'] ?? null,
                'updated_at' => $site['updated_at'] ?? null,
                'published_deploy' => [
                    'id' => $site['published_deploy']['id'] ?? null,
                    'state' => $site['published_deploy']['state'] ?? null,
                    'branch' => $site['published_deploy']['branch'] ?? null,
                    'commit_ref' => $site['published_deploy']['commit_ref'] ?? null,
                    'title' => $site['published_deploy']['title'] ?? null,
                ],
                'build_settings' => [
                    'repo_url' => $site['build_settings']['repo_url'] ?? null,
                    'repo_branch' => $site['build_settings']['repo_branch'] ?? null,
                    'cmd' => $site['build_settings']['cmd'] ?? null,
                    'dir' => $site['build_settings']['dir'] ?? null,
                ],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
