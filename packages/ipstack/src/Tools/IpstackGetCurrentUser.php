<?php

namespace OpenCompany\Integrations\Ipstack\Tools;

use OpenCompany\Integrations\Ipstack\IpstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: ipstack_get_current_user
 *
 * Detects and geolocates the current requesting IP address using the
 * IPstack "check" endpoint. Useful for identifying the caller's own
 * location without needing to know their IP.
 *
 * Endpoint: GET /check
 */
class IpstackGetCurrentUser implements Tool
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
        return 'ipstack_get_current_user';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Detect and geolocate the current requesting IP address. Returns the caller\'s own IP geolocation data.';
    }

    /**
     * The input parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the current user lookup.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     * @return ToolResult The caller's geolocation data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('IPstack integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            if (empty($result)) {
                return ToolResult::success([
                    'found' => false,
                    'message' => 'Could not detect the current IP address.',
                ]);
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
