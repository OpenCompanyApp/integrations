<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;

/**
 * Delete a ChurnZero contact by external identifiers.
 *
 * Deletion is destructive in ChurnZero, so callers should verify identifiers
 * before invoking this tool.
 */
class ChurnZeroDeleteContact implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero HTTP API client.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    public function name(): string
    {
        return 'churnzero_delete_contact';
    }

    public function description(): string
    {
        return 'Delete a ChurnZero contact by account_external_id and contact_external_id. This action is destructive.';
    }

    public function parameters(): array
    {
        return [
            'account_external_id' => ['type' => 'string', 'required' => true, 'description' => 'Account identifier from your source system.'],
            'contact_external_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact identifier from your source system.'],
        ];
    }

    /**
     * Delete a ChurnZero contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            return ToolResult::success($this->service->deleteContact(
                (string) $args['account_external_id'],
                (string) $args['contact_external_id'],
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
