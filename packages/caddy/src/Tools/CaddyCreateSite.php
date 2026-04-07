<?php

namespace OpenCompany\Integrations\Caddy\Tools;

use OpenCompany\Integrations\Caddy\CaddyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CaddyCreateSite implements Tool
{
    public function __construct(
        private CaddyService $service,
    ) {}

    public function name(): string
    {
        return 'caddy_create_site';
    }

    public function description(): string
    {
        return 'Create a new site in Caddy. Specify the domain name and optional configuration parameters.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The domain name for the site (e.g., "example.com").'],
            'config' => ['type' => 'object', 'description' => 'Optional site configuration (Caddy JSON config or key-value pairs).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Caddy integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = [
                'name' => $name,
            ];

            if (isset($args['config']) && is_array($args['config'])) {
                $data['config'] = $args['config'];
            }

            $result = $this->service->createSite($data);

            $site = $result['site'] ?? $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $site['id'] ?? null,
                'name' => $site['name'] ?? $name,
                'status' => $site['status'] ?? null,
                'message' => "Site {$name} created successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
