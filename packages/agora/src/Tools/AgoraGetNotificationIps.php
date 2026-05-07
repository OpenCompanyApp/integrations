<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Agora\AgoraService;

/**
 * Query Agora message notification service IPs.
 *
 * Hosts can use these IP addresses to maintain firewall allowlists for Cloud
 * Recording callback notifications.
 */
class AgoraGetNotificationIps implements Tool
{
    /**
     * @param  AgoraService  $service  The Agora Cloud Recording API client.
     */
    public function __construct(
        private AgoraService $service,
    ) {}

    public function name(): string
    {
        return 'agora_get_notification_ips';
    }

    public function description(): string
    {
        return 'Fetch Agora message notification service IP addresses for firewall allowlists.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Query notification service IP addresses.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Agora integration is not configured.');
            }

            return ToolResult::success($this->service->getNotificationIps());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
