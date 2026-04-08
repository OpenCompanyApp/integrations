<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

use OpenCompany\Integrations\Gumroad\GumroadService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GumroadGetSubscriber implements Tool
{
    public function __construct(
        private GumroadService $service,
    ) {}

    public function name(): string
    {
        return 'gumroad_get_subscriber';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Gumroad subscriber by their ID. Returns subscriber status, email, and subscription details.';
    }

    public function parameters(): array
    {
        return [
            'subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the subscriber to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gumroad integration is not configured.');
            }

            if (empty($args['subscriber_id'])) {
                return ToolResult::error('subscriber_id is required.');
            }

            $result = $this->service->getSubscriber($args['subscriber_id']);

            $subscriber = $result['subscriber'] ?? $result;

            return ToolResult::success($subscriber);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
