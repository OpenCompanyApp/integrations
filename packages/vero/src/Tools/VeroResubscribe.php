<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vero\VeroService;

/**
 * Resubscribe a user to Vero email campaigns.
 *
 * Reverses an unsubscribe action, allowing the user to receive
 * email communication through Vero again.
 */
class VeroResubscribe implements Tool
{
    /**
     * @param  VeroService  $service  The Vero API service instance.
     */
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_resubscribe';
    }

    public function description(): string
    {
        return 'Resubscribe a previously unsubscribed user to Vero email campaigns. The user will start receiving emails again.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier to resubscribe.'],
        ];
    }

    /**
     * Execute the resubscribe tool.
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

            $result = $this->service->resubscribe($id);

            return ToolResult::success([
                'id' => $id,
                'status' => $result['status'] ?? 200,
                'message' => $result['message'] ?? 'resubscribed',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
