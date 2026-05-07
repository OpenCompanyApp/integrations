<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Resolve an IP address location through Phantombuster.
 */
class PhantombusterGetIpLocation extends AbstractPhantombusterTool implements Tool
{
    public function name(): string
    {
        return 'phantombuster_get_ip_location';
    }

    public function description(): string
    {
        return 'Retrieve the country metadata for an IPv4 or IPv6 address.';
    }

    public function parameters(): array
    {
        return [
            'ip' => ['type' => 'string', 'required' => true, 'description' => 'IPv4 or IPv6 address.'],
        ];
    }

    /**
     * Resolve an IP location.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['ip'])) {
                return ToolResult::error('ip is required.');
            }

            return ToolResult::success($this->service->getIpLocation((string) $args['ip']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
