<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuGetNotification implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_get_notification';
    }

    public function description(): string
    {
        return 'Get details of a specific notification in Novu by its ID. Returns the full notification object including status, channel data, and content.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The notification ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Notification ID is required.');
            }

            $result = $this->service->getNotification($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
