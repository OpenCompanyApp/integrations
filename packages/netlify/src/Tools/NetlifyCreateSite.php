<?php

namespace OpenCompany\Integrations\Netlify\Tools;

use OpenCompany\Integrations\Netlify\NetlifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new Netlify site.
 *
 * Creates a site with the given name and optional configuration.
 */
class NetlifyCreateSite implements Tool
{
    /**
     * Create a new NetlifyCreateSite tool instance.
     */
    public function __construct(
        private NetlifyService $service,
    ) {}

    /**
     * Get the tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'netlify_create_site';
    }

    /**
     * Get the tool description shown to AI agents.
     */
    public function description(): string
    {
        return 'Create a new Netlify site. Provide a name and optional configuration like custom domain, build settings, or repository.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name for the site. Used as the default subdomain (e.g., "my-site" becomes my-site.netlify.app).'],
            'custom_domain' => ['type' => 'string', 'description' => 'Custom domain to assign to the site (e.g., "www.example.com").'],
            'repo' => ['type' => 'object', 'description' => 'Repository configuration for continuous deployment. Includes provider, repo path, branch, build command, and publish directory.'],
            'body' => ['type' => 'object', 'description' => 'Additional site configuration fields (e.g., password, processing_settings).'],
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

            $name = $args['name'];
            $body = $args['body'] ?? [];

            if (isset($args['custom_domain'])) {
                $body['custom_domain'] = $args['custom_domain'];
            }

            if (isset($args['repo'])) {
                $body['repo'] = $args['repo'];
            }

            $result = $this->service->createSite($name, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
