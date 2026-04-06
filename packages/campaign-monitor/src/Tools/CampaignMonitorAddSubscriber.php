<?php

namespace OpenCompany\Integrations\CampaignMonitor\Tools;

use OpenCompany\Integrations\CampaignMonitor\CampaignMonitorService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a subscriber to a Campaign Monitor subscriber list.
 */
class CampaignMonitorAddSubscriber implements Tool
{
    public function __construct(
        private CampaignMonitorService $service,
    ) {}

    public function name(): string
    {
        return 'campaignmonitor_add_subscriber';
    }

    public function description(): string
    {
        return 'Add a new subscriber to a Campaign Monitor list. The subscriber will receive a confirmation email if double opt-in is enabled.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber list ID.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s full name.'],
            'resubscribe' => ['type' => 'boolean', 'description' => 'Re-subscribe if previously unsubscribed (default: true).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Campaign Monitor integration is not configured.');
            }

            if (empty($args['list_id'])) {
                return ToolResult::error('list_id is required.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            $resubscribe = $args['resubscribe'] ?? true;

            $result = $this->service->addSubscriber(
                $args['list_id'],
                $args['email'],
                $args['name'],
                (bool) $resubscribe,
            );

            return ToolResult::success([
                'message' => "Subscriber {$args['email']} added to list.",
                'details' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
