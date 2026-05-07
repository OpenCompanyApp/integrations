<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Line\LineService;

/**
 * Link a LINE rich menu to a user.
 *
 * Sets a per-user rich menu override.
 */
class LineLinkRichMenuToUser implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(private LineService $service) {}

    public function name(): string
    {
        return 'line_link_rich_menu_to_user';
    }

    public function description(): string
    {
        return 'Link a LINE rich menu to a specific user.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'LINE user ID.'],
            'rich_menu_id' => ['type' => 'string', 'required' => true, 'description' => 'Rich menu ID.'],
        ];
    }

    /**
     * Link rich menu to user.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            return ToolResult::success($this->service->linkRichMenuToUser((string) ($args['user_id'] ?? ''), (string) ($args['rich_menu_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
