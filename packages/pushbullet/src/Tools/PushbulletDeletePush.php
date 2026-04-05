<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\Integrations\Pushbullet\PushbulletService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushbulletDeletePush implements Tool
{
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_delete_push';
    }

    public function description(): string
    {
        return 'Delete a push notification from Pushbullet by its unique identifier (iden).';
    }

    public function parameters(): array
    {
        return [
            'push_iden' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier (iden) of the push to delete.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $pushIden = $args['push_iden'] ?? '';
            if (empty($pushIden)) {
                return ToolResult::error('push_iden is required.');
            }

            $this->service->deletePush($pushIden);

            return ToolResult::success("Push '{$pushIden}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
