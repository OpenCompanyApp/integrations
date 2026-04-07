<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: ipstack_get_connection
 *
 * Retrieves connection information for an IP address, including the ASN,
 * ISP name, and organization. Useful for identifying the network provider.
 *
 * Uses the IPstack lookup endpoint with connection fields.
 */
class IpstackGetConnection implements Tool
{
    /**
     * @param  IpstackService  $service  The IPstack API service instance.
     */
    public function __construct(
        private IpstackService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'ipstack_get_connection';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get connection and ISP information for an IP address, including ASN, ISP name, and organization.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ip' => ['type' => 'string', 'required' => true, 'description' => 'The IP address to look up connection info for (e.g., "134.201.250.155").'],
        ];
    }

    /**
     * Execute the connection lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'ip'.
     * @return ToolResult The connection data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IPstack integration is not configured.');
            }

            $ip = $args['ip'] ?? '';
            if (empty($ip)) {
                return ToolResult::error('An IP address is required.');
            }

            $result = $this->service->getConnection($ip);

            if (empty($result)) {
                return ToolResult::success([
                    'ip' => $ip,
                    'found' => false,
                    'message' => 'No connection data found for this IP address.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
