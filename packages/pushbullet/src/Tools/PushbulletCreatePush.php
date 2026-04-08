<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\Integrations\Pushbullet\PushbulletService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushbulletCreatePush implements Tool
{
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_create_push';
    }

    public function description(): string
    {
        return 'Send a push notification via Pushbullet. Supports "note" (title + body) and "link" (title + body + URL) types.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Push type: "note" for a text notification, "link" for a URL.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the push notification.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The body text of the push notification.'],
            'url' => ['type' => 'string', 'description' => 'Required for "link" type — the URL to include in the push.'],
            'device_iden' => ['type' => 'string', 'description' => 'Target a specific device by its iden. Omit to send to all devices.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            $type = $args['type'] ?? 'note';
            $title = $args['title'] ?? '';
            $body = $args['body'] ?? '';

            if (empty($title) && empty($body)) {
                return ToolResult::error('At least a title or body is required.');
            }

            if ($type === 'link' && empty($args['url'])) {
                return ToolResult::error('The "url" parameter is required for link pushes.');
            }

            $extra = [];
            if (isset($args['url'])) {
                $extra['url'] = $args['url'];
            }
            if (isset($args['device_iden'])) {
                $extra['device_iden'] = $args['device_iden'];
            }

            $result = $this->service->createPush($type, $title, $body, $extra);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
