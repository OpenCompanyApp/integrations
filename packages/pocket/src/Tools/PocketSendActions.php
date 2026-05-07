<?php

namespace OpenCompany\Integrations\Pocket\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pocket\PocketService;

/**
 * Send one or more raw Pocket modify actions.
 */
class PocketSendActions implements Tool
{
    /**
     * @param  PocketService  $service  Pocket API client.
     */
    public function __construct(private PocketService $service) {}

    public function name(): string { return 'pocket_send_actions'; }

    public function description(): string { return 'Send one or more raw Pocket modify actions to /v3/send.'; }

    public function parameters(): array
    {
        return [
            'actions' => ['type' => 'array', 'required' => true, 'description' => 'Pocket modify action objects.', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Execute the Pocket send actions request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $actions = $args['actions'] ?? [];
            if (!is_array($actions) || $actions === []) {
                return ToolResult::error('actions is required.');
            }

            return ToolResult::success($this->service->sendActions($actions));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
