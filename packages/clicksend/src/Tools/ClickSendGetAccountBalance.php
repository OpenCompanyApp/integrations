<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Retrieve the current ClickSend account balance.
 *
 * Returns the available balance and currency for the authenticated account.
 */
class ClickSendGetAccountBalance implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_get_account_balance';
    }

    public function description(): string
    {
        return 'Get the current ClickSend account balance.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the account balance from ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $result = $this->service->getAccountBalance();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
