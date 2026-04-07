<?php

namespace OpenCompany\Integrations\Zend\Tools;

use OpenCompany\Integrations\Zend\ZendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific subscriber.
 */
class ZendGetSubscribers implements Tool
{
    public function __construct(
        private ZendService $service,
    ) {}

    public function name(): string
    {
        return 'zend_get_subscribers';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific subscriber, including email, name, and subscription status.';
    }

    public function parameters(): array
    {
        return [
            'subscriber_id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Zendesk integration is not configured.');
            }

            if (empty($args['subscriber_id'])) {
                return ToolResult::error('subscriber_id is required.');
            }

            $result = $this->service->getSubscriber($args['subscriber_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
