<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel DFY email accounts.
 */
class InstantlyCancelDfyAccounts implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_cancel_dfy_accounts';
    }

    public function description(): string
    {
        return 'Cancel DFY email accounts.';
    }

    public function parameters(): array
    {
        return [
            'accounts' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated emails to cancel'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $accounts = $args['accounts']; if (is_string($accounts)) $accounts = array_map('trim', explode(',', $accounts)); $this->service->cancelDfyAccounts($accounts);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
