<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontGetInbox implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_get_inbox';
    }

    public function description(): string
    {
        return 'Get details for a specific Front inbox by ID, including name, type, teammates, and default sender.';
    }

    public function parameters(): array
    {
        return [
            'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'The Front inbox ID (e.g., "inb_123abc").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->getInbox($args['inbox_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
