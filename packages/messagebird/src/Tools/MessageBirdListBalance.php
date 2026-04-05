<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MessageBirdListBalance implements Tool
{
    public function __construct(
        private MessageBirdService $service,
    ) {}

    public function name(): string
    {
        return 'messagebird_list_balance';
    }

    public function description(): string
    {
        return 'Check your MessageBird account balance. Returns the available amount and payment type (prepaid or postpaid).';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            $result = $this->service->listBalance();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
