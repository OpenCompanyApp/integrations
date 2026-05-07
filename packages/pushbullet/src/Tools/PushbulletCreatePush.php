<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Create a Pushbullet push.
 *
 * Supports note, link, and file push payloads.
 */
class PushbulletCreatePush implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(
        private PushbulletService $service,
    ) {}

    public function name(): string
    {
        return 'pushbullet_create_push';
    }

    public function description(): string
    {
        return 'Send a Pushbullet push. Supports note, link, and file pushes.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Push type: "note", "link", or "file".', 'enum' => ['note', 'link', 'file']],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the push notification.'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'The body text of the push notification.'],
            'url' => ['type' => 'string', 'description' => 'Required for "link" type — the URL to include in the push.'],
            'file_name' => ['type' => 'string', 'description' => 'Required for "file" type — name returned by upload-request.'],
            'file_type' => ['type' => 'string', 'description' => 'Required for "file" type — MIME type returned by upload-request.'],
            'file_url' => ['type' => 'string', 'description' => 'Required for "file" type — URL returned by upload-request after upload.'],
            'device_iden' => ['type' => 'string', 'description' => 'Target a specific device by its iden. Omit to send to all devices.'],
            'email' => ['type' => 'string', 'description' => 'Send to this email address.'],
            'channel_tag' => ['type' => 'string', 'description' => 'Send to subscribers of this channel tag.'],
            'client_iden' => ['type' => 'string', 'description' => 'Optional client identifier for idempotency.'],
        ];
    }

    /**
     * Create a push from normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
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

            if ($type === 'file' && (empty($args['file_name']) || empty($args['file_type']) || empty($args['file_url']))) {
                return ToolResult::error('file_name, file_type, and file_url are required for file pushes.');
            }

            $extra = [];
            foreach (['url', 'file_name', 'file_type', 'file_url', 'device_iden', 'email', 'channel_tag', 'client_iden'] as $field) {
                if (isset($args[$field])) {
                    $extra[$field] = $args[$field];
                }
            }

            $result = $this->service->createPush($type, $title, $body, $extra);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
