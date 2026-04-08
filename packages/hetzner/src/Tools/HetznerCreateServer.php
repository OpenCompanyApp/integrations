<?php

namespace OpenCompany\Integrations\Hetzner\Tools;

use OpenCompany\Integrations\Hetzner\HetznerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Hetzner Cloud server.
 *
 * Creates a new server with the specified name, server type, and image.
 * Optionally specify a location and additional options such as SSH keys
 * and networks.
 */
class HetznerCreateServer implements Tool
{
    public function __construct(
        private HetznerService $service,
    ) {}

    public function name(): string
    {
        return 'hetzner_create_server';
    }

    public function description(): string
    {
        return 'Create a new Hetzner Cloud server with specified name, type, and image.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Server name (must be unique per project).'],
            'server_type' => ['type' => 'string', 'required' => true, 'description' => 'Server type name or ID (e.g., "cx22", "cx32").'],
            'image' => ['type' => 'string', 'required' => true, 'description' => 'Image name or ID (e.g., "ubuntu-24.04", "debian-12").'],
            'location' => ['type' => 'string', 'description' => 'Location name (e.g., "fsn1", "nbg1", "hel1"). Optional if datacenter is set.'],
            'ssh_keys' => ['type' => 'array', 'description' => 'Array of SSH key names or IDs to inject into the server.'],
            'networks' => ['type' => 'array', 'description' => 'Array of network IDs to attach the server to.'],
            'labels' => ['type' => 'object', 'description' => 'Key-value labels to apply to the server.'],
            'user_data' => ['type' => 'string', 'description' => 'Cloud-init user data (YAML) for server initialization.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Hetzner Cloud integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Server name is required.');
            }

            if (empty($args['server_type'])) {
                return ToolResult::error('Server type is required.');
            }

            if (empty($args['image'])) {
                return ToolResult::error('Image is required.');
            }

            $location = isset($args['location']) ? (string) $args['location'] : '';

            $options = [];
            if (isset($args['ssh_keys'])) {
                $options['ssh_keys'] = $args['ssh_keys'];
            }
            if (isset($args['networks'])) {
                $options['networks'] = $args['networks'];
            }
            if (isset($args['labels'])) {
                $options['labels'] = $args['labels'];
            }
            if (isset($args['user_data'])) {
                $options['user_data'] = $args['user_data'];
            }

            $result = $this->service->createServer(
                (string) $args['name'],
                (string) $args['server_type'],
                (string) $args['image'],
                $location,
                $options,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
