<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to Slack using the modern external upload flow.
 *
 * Handles the three-step process: get upload URL, upload content,
 * and complete the upload.
 */
class SlackUploadFile implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to Slack using the modern external upload flow. The file content is posted to a channel or as a thread reply.';
    }

    public function parameters(): array
    {
        return [
            'channel' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID to post the file to.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'File content (text).'],
            'filename' => ['type' => 'string', 'required' => true, 'description' => 'Filename with extension (e.g., "report.txt").'],
            'title' => ['type' => 'string', 'description' => 'Title of the file.'],
            'initial_comment' => ['type' => 'string', 'description' => 'Comment to include with the file post.'],
            'thread_ts' => ['type' => 'string', 'description' => 'Timestamp of the parent message to reply in a thread.'],
        ];
    }

    /**
     * Upload a file to a channel, optionally as a thread reply.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel, content, filename, title, etc.)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $channel = $args['channel'] ?? '';
            $content = $args['content'] ?? '';
            $filename = $args['filename'] ?? '';

            if (empty($channel)) {
                return ToolResult::error('channel is required.');
            }
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }
            if (empty($filename)) {
                return ToolResult::error('filename is required.');
            }

            // Step 1: Get upload URL
            $uploadInfo = $this->service->getFileUploadURL([
                'filename' => $filename,
                'length' => strlen($content),
            ]);

            $uploadUrl = $uploadInfo['upload_url'] ?? '';
            $fileId = $uploadInfo['file_id'] ?? '';

            if (empty($uploadUrl) || empty($fileId)) {
                return ToolResult::error('Failed to get upload URL from Slack.');
            }

            // Step 2: Upload file content to the external URL
            $this->service->uploadFileToURL($uploadUrl, $content, $filename);

            // Step 3: Complete the upload
            $completeData = [
                'files' => [
                    ['id' => $fileId],
                ],
                'channel_id' => $channel,
            ];

            if (isset($args['title'])) {
                $completeData['files'][0]['title'] = $args['title'];
            }
            if (isset($args['initial_comment'])) {
                $completeData['initial_comment'] = $args['initial_comment'];
            }
            if (isset($args['thread_ts'])) {
                $completeData['thread_ts'] = $args['thread_ts'];
            }

            $result = $this->service->completeUploadExternal($completeData);

            return ToolResult::success([
                'ok' => true,
                'files' => $result['files'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
