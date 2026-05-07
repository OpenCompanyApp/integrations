<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Delete all Pushbullet pushes for the authenticated user.
 *
 * Pushbullet processes this operation asynchronously.
 */
class PushbulletDeleteAllPushes implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_delete_all_pushes'; }

    public function description(): string { return 'Delete all Pushbullet pushes for the authenticated user. This operation is asynchronous.'; }

    public function parameters(): array { return []; }

    /**
     * Delete all pushes.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $this->service->deleteAllPushes();

            return ToolResult::success(['deleted' => true]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
