<?php

namespace OpenCompany\Integrations\Front\Tools;

use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FrontGetMessage implements Tool
{
    public function __construct(
        private FrontService $service,
    ) {}

    public function name(): string
    {
        return 'front_get_message';
    }

    public function description(): string
    {
        return 'Get details for a specific Front message by ID, including sender, recipients, subject, body, and attachments.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'The Front message ID (e.g., "msg_123abc").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Front integration is not configured.');
            }

            $result = $this->service->getMessage($args['message_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
