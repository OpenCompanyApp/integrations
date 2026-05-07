<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a DigitalOcean Droplet by ID.
 */
class DigitalOceanGetDroplet implements Tool
{
    /**
     * @param  DigitalOceanService  $service  The DigitalOcean API client.
     */
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_get_droplet';
    }

    public function description(): string
    {
        return 'Get details for a specific DigitalOcean droplet by ID. Returns full droplet information including networks, image, and region.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The droplet ID.'],
        ];
    }

    /**
     * Fetch a Droplet by numeric ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $result = $this->service->getDroplet((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
