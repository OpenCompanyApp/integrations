<?php

namespace OpenCompany\Integrations\Kamatera\Tools;

use OpenCompany\Integrations\Kamatera\KamateraService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KamateraCreateServer implements Tool
{
    public function __construct(
        private KamateraService $service,
    ) {}

    public function name(): string
    {
        return 'kamatera_create_server';
    }

    public function description(): string
    {
        return 'Create a new cloud server in Kamatera. Requires a name, datacenter, image, CPU count, RAM, and disk size.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The server name.'],
            'datacenter' => ['type' => 'string', 'required' => true, 'description' => 'The datacenter ID (e.g. "IL-JER").'],
            'image' => ['type' => 'string', 'required' => true, 'description' => 'The image ID or name for the OS to install.'],
            'cpu' => ['type' => 'integer', 'required' => true, 'description' => 'Number of vCPUs.'],
            'ram' => ['type' => 'integer', 'required' => true, 'description' => 'RAM in MB.'],
            'disk' => ['type' => 'integer', 'required' => true, 'description' => 'Disk size in GB.'],
            'password' => ['type' => 'string', 'required' => false, 'description' => 'Root password for the server. Auto-generated if omitted.'],
            'network' => ['type' => 'string', 'required' => false, 'description' => 'Network ID to attach the server to.'],
            'quantity' => ['type' => 'integer', 'required' => false, 'description' => 'Number of servers to create with this configuration.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kamatera integration is not configured.');
            }

            $params = [];

            // Required fields
            $params['name'] = $args['name'];
            $params['datacenter'] = $args['datacenter'];
            $params['image'] = $args['image'];
            $params['cpu'] = (int) $args['cpu'];
            $params['ram'] = (int) $args['ram'];
            $params['disk'] = (int) $args['disk'];

            // Optional fields
            if (isset($args['password'])) {
                $params['password'] = $args['password'];
            }
            if (isset($args['network'])) {
                $params['network'] = $args['network'];
            }
            if (isset($args['quantity'])) {
                $params['quantity'] = (int) $args['quantity'];
            }

            $result = $this->service->createServer($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
