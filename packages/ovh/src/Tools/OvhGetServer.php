<?php

namespace OpenCompany\Integrations\Ovh\Tools;

use OpenCompany\Integrations\Ovh\OvhService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class OvhGetServer implements Tool
{
    public function __construct(
        private OvhService $service,
    ) {}

    public function name(): string
    {
        return 'ovh_get_server';
    }

    public function description(): string
    {
        return 'Get details for a specific OVH dedicated server by service name. Returns full server information including hardware, network, and OS details.';
    }

    public function parameters(): array
    {
        return [
            'service_name' => ['type' => 'string', 'required' => true, 'description' => 'The dedicated server service name (e.g., "ns123456.ip-1-2-3.eu").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OVH integration is not configured.');
            }

            $serviceName = $args['service_name'] ?? '';
            if (empty($serviceName)) {
                return ToolResult::error('The "service_name" parameter is required.');
            }

            $result = $this->service->getServer($serviceName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
