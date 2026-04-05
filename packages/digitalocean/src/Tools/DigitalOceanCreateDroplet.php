<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DigitalOceanCreateDroplet implements Tool
{
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_create_droplet';
    }

    public function description(): string
    {
        return 'Create a new DigitalOcean droplet (virtual machine). Requires a name, region, size, and image.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The hostname for the droplet (e.g., "web-01").'],
            'region' => ['type' => 'string', 'required' => true, 'description' => 'The region slug (e.g., "nyc3", "ams3", "sgp1").'],
            'size' => ['type' => 'string', 'required' => true, 'description' => 'The size slug (e.g., "s-1vcpu-1gb", "s-2vcpu-4gb").'],
            'image' => ['type' => 'string', 'required' => true, 'description' => 'The image slug or ID (e.g., "ubuntu-24-04-x64", "debian-12-x64").'],
            'ssh_keys' => ['type' => 'array', 'description' => 'Array of SSH key IDs or fingerprints to embed.'],
            'backups' => ['type' => 'boolean', 'description' => 'Enable automated backups (default: false).'],
            'ipv6' => ['type' => 'boolean', 'description' => 'Enable IPv6 (default: false).'],
            'user_data' => ['type' => 'string', 'description' => 'Cloud-init user data script.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag names to apply.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $params = [
                'name' => $args['name'],
                'region' => $args['region'],
                'size' => $args['size'],
                'image' => $args['image'],
            ];

            // Optional parameters
            foreach (['ssh_keys', 'backups', 'ipv6', 'user_data', 'tags'] as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->createDroplet($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
