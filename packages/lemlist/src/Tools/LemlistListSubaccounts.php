<?php

namespace OpenCompany\Integrations\Lemlist\Tools;

use OpenCompany\Integrations\Lemlist\LemlistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: List all sub-accounts in the Lemlist account.
 *
 * Returns sub-account details including names, statuses, and usage information.
 */
class LemlistListSubaccounts implements Tool
{
    public function __construct(
        private LemlistService $service,
    ) {}

    public function name(): string
    {
        return 'lemlist_list_subaccounts';
    }

    public function description(): string
    {
        return 'List all sub-accounts in Lemlist. Returns sub-account names, statuses, and usage details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lemlist integration is not configured.');
            }

            $result = $this->service->listSubaccounts();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
