<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Unlink a LINE rich menu from a user.
 *
 * Removes the per-user rich menu assignment.
 */
class LineUnlinkRichMenuFromUser implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_unlink_rich_menu_from_user';
    }

    public function description(): string
    {
        return 'Unlink a rich menu from a LINE user.';
    }

    public function parameters(): array
    {
        return ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID.']];
    }

    /**
     * Unlink rich menu from a user.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->unlinkRichMenuFromUser((string) ($args['user_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
