<?php

namespace OpenCompany\Integrations\Cursor\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Cursor\CursorService;

/**
 * Set a Cursor team member spend limit.
 */
class CursorSetUserSpendLimit implements Tool
{
    /**
     * @param  CursorService  $service  The Cursor Admin API client.
     */
    public function __construct(private CursorService $service) {}

    public function name(): string
    {
        return 'cursor_set_user_spend_limit';
    }

    public function description(): string
    {
        return 'Set a whole-dollar Cursor spending limit for a team member.';
    }

    public function parameters(): array
    {
        return [
            'user_email' => ['type' => 'string', 'required' => true, 'description' => 'Team member email address.'],
            'spend_limit_dollars' => ['type' => 'integer', 'required' => true, 'description' => 'Spend limit in whole dollars. Use 0 for a zero-dollar limit.'],
        ];
    }

    /**
     * Execute the tool and set a spend limit.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_email, spend_limit_dollars).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Cursor integration is not configured.');
            }
            if (empty($args['user_email']) || ! isset($args['spend_limit_dollars'])) {
                return ToolResult::error('user_email and spend_limit_dollars are required.');
            }

            return ToolResult::success($this->service->setUserSpendLimit((string) $args['user_email'], (int) $args['spend_limit_dollars']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
