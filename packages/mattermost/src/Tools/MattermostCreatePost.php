<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new post in a Mattermost channel.
 *
 * Supports optional file attachments via file_ids, custom properties via props,
 * and thread replies via root_id.
 */
class MattermostCreatePost implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_create_post';
    }

    public function description(): string
    {
        return 'Create a new post in a Mattermost channel. Supports file attachments, custom properties, and thread replies.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to create the post in.'],
            'message'    => ['type' => 'string', 'required' => true, 'description' => 'The message content of the post.'],
            'file_ids'   => ['type' => 'string', 'description' => 'JSON array of file IDs to attach to the post.'],
            'props'      => ['type' => 'string', 'description' => 'JSON object of custom properties for the post.'],
            'root_id'    => ['type' => 'string', 'description' => 'The parent post ID for creating a thread reply.'],
        ];
    }

    /**
     * Create a new post in a Mattermost channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, message, file_ids, props, root_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            $message = $args['message'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            if (empty($message)) {
                return ToolResult::error('message is required.');
            }

            $data = [
                'channel_id' => $channelId,
                'message' => $message,
            ];

            if (isset($args['file_ids'])) {
                $fileIds = $args['file_ids'];
                $data['file_ids'] = is_string($fileIds) ? json_decode($fileIds, true) : $fileIds;
            }

            if (isset($args['props'])) {
                $props = $args['props'];
                $data['props'] = is_string($props) ? json_decode($props, true) : $props;
            }

            if (! empty($args['root_id'])) {
                $data['root_id'] = $args['root_id'];
            }

            $result = $this->service->createPost($data);

            return ToolResult::success([
                'ok' => true,
                'id' => $result['id'] ?? '',
                'channel_id' => $result['channel_id'] ?? $channelId,
                'message' => $result['message'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
