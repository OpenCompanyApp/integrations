<?php

namespace OpenCompany\Integrations\DigitalOcean\Tools;

use OpenCompany\Integrations\DigitalOcean\DigitalOceanService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Start a reboot action for a DigitalOcean Droplet.
 */
class DigitalOceanRebootDroplet implements Tool
{
    /**
     * @param  DigitalOceanService  $service  The DigitalOcean API client.
     */
    public function __construct(
        private DigitalOceanService $service,
    ) {}

    public function name(): string
    {
        return 'digitalocean_reboot_droplet';
    }

    public function description(): string
    {
        return 'Reboot a DigitalOcean droplet. The droplet will be power-cycled and will be temporarily unavailable.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The droplet ID to reboot.'],
        ];
    }

    /**
     * Request a Droplet reboot action by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DigitalOcean integration is not configured.');
            }

            $id = (int) $args['id'];
            $result = $this->service->rebootDroplet($id);

            return ToolResult::success(array_merge($result, [
                'message' => "Reboot initiated for droplet {$id}.",
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
