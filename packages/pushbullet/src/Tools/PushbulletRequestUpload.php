<?php

namespace OpenCompany\Integrations\Pushbullet\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushbullet\PushbulletService;

/**
 * Request a file upload URL from Pushbullet.
 *
 * The returned file_url can be used in a file push after uploading the file contents.
 */
class PushbulletRequestUpload implements Tool
{
    /**
     * @param  PushbulletService  $service  The Pushbullet API client.
     */
    public function __construct(private PushbulletService $service) {}

    public function name(): string { return 'pushbullet_request_upload'; }

    public function description(): string { return 'Request a Pushbullet upload URL for a file push.'; }

    public function parameters(): array
    {
        return [
            'file_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the file to upload.'],
            'file_type' => ['type' => 'string', 'required' => true, 'description' => 'MIME type of the file.'],
        ];
    }

    /**
     * Request a Pushbullet file upload URL.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushbullet integration is not configured.');
            }

            return ToolResult::success($this->service->requestUpload($args['file_name'] ?? '', $args['file_type'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
