<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: ipstack_get_timezone
 *
 * Retrieves timezone information for an IP address, including the timezone ID,
 * current date/time, UTC offset, and whether DST is active.
 *
 * Uses the IPstack lookup endpoint with timezone fields.
 */
class IpstackGetTimezone implements Tool
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
        return 'ipstack_get_timezone';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get timezone information for an IP address, including timezone ID, current time, and UTC offset.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'ip' => ['type' => 'string', 'required' => true, 'description' => 'The IP address to look up timezone for (e.g., "134.201.250.155").'],
        ];
    }

    /**
     * Execute the timezone lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing at least 'ip'.
     * @return ToolResult The timezone data or an error message.
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

            $result = $this->service->getTimezone($ip);

            if (empty($result)) {
                return ToolResult::success([
                    'ip' => $ip,
                    'found' => false,
                    'message' => 'No timezone data found for this IP address.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
