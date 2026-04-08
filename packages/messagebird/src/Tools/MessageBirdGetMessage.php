<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MessageBirdGetMessage implements Tool
{
    public function __construct(
        private MessageBirdService $service,
    ) {}

    public function name(): string
    {
        return 'messagebird_get_message';
    }

    public function description(): string
    {
        return 'Retrieve details of a specific MessageBird message by its ID, including status, recipient info, and delivery timestamps.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The message ID (e.g., "a6e89f50c0d25b35a212345678901234").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $result = $this->service->getMessage($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
