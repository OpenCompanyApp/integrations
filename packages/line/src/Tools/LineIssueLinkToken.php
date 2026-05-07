<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Issue a LINE account-link token.
 *
 * Creates a token for linking a provider account with a LINE user.
 */
class LineIssueLinkToken implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_issue_link_token';
    }

    public function description(): string
    {
        return 'Issue an account-link token for a LINE user.';
    }

    public function parameters(): array
    {
        return ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID.']];
    }

    /**
     * Issue link token.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->issueLinkToken((string) ($args['user_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
