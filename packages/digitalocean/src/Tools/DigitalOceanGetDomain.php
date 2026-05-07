<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a DigitalOcean DNS domain by name.
 */
class DigitalOceanGetDomain implements Tool
{
    /**
     * @param  DigitalOceanService  $service  The DigitalOcean API client.
     */
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_get_domain';
    }

    public function description(): string
    {
        return 'Get details for a specific DNS domain in DigitalOcean, including zone file and TTL information.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The domain name (e.g., "example.com").'],
        ];
    }

    /**
     * Fetch a domain by its fully qualified domain name.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $result = $this->service->getDomain($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
