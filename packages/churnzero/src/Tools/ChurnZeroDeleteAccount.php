<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;

/**
 * Delete a ChurnZero account by external identifier.
 *
 * Account deletion can cascade to contacts and event history in ChurnZero.
 */
class ChurnZeroDeleteAccount implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero HTTP API client.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    public function name(): string
    {
        return 'churnzero_delete_account';
    }

    public function description(): string
    {
        return 'Delete a ChurnZero account by account_external_id. This action is destructive and may affect related contacts.';
    }

    public function parameters(): array
    {
        return [
            'account_external_id' => ['type' => 'string', 'required' => true, 'description' => 'Account identifier from your source system.'],
        ];
    }

    /**
     * Delete a ChurnZero account.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            return ToolResult::success($this->service->deleteAccount((string) $args['account_external_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
