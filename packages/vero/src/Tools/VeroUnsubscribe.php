<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Unsubscribe a user from all Vero email campaigns.
 *
 * Marks the user as unsubscribed so they no longer receive any
 * email communication through Vero.
 */
class VeroUnsubscribe implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_unsubscribe';
    }

    public function description(): string
    {
        return 'Unsubscribe a user from all Vero email campaigns. The user will no longer receive any email communication.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier to unsubscribe.'],
        ];
    }

    /**
     * Execute the unsubscribe tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('User ID is required.');
            }

            $result = $this->service->unsubscribe($id);

            return ToolResult::success([
                'id' => $id,
                'status' => $result['status'] ?? 'unsubscribed',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
