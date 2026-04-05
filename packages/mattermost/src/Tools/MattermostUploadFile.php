<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to Mattermost via multipart form data.
 *
 * The uploaded file can be attached to a post using the returned file ID
 * via the file_ids parameter when creating a post.
 */
class MattermostUploadFile implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to Mattermost. The returned file ID can be attached to a post using the file_ids parameter.';
    }

    public function parameters(): array
    {
        return [
            'channel_id'   => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to associate the file with.'],
            'filename'     => ['type' => 'string', 'required' => true, 'description' => 'The name of the file to upload.'],
            'file_content' => ['type' => 'string', 'required' => true, 'description' => 'The raw content of the file (base64 encoded for binary files).'],
        ];
    }

    /**
     * Upload a file to Mattermost.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, filename, file_content)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            $filename = $args['filename'] ?? '';
            $fileContent = $args['file_content'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            if (empty($filename)) {
                return ToolResult::error('filename is required.');
            }

            if (empty($fileContent)) {
                return ToolResult::error('file_content is required.');
            }

            $result = $this->service->uploadFile($channelId, $filename, $fileContent);

            return ToolResult::success([
                'ok' => true,
                'file_infos' => $result['file_infos'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
