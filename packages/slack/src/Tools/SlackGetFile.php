<?php

namespace OpenCompany\Integrations\Slack\Tools;

use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Slack file.
 */
class SlackGetFile implements Tool
{
    /**
     * @param  SlackService  $service  The Slack API client
     */
    public function __construct(
        private SlackService $service,
    ) {}

    public function name(): string
    {
        return 'slack_get_file';
    }

    public function description(): string
    {
        return 'Get detailed information about a Slack file.';
    }

    public function parameters(): array
    {
        return [
            'file' => ['type' => 'string', 'required' => true, 'description' => 'File ID.'],
        ];
    }

    /**
     * Get file info by file ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (file)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Slack integration is not configured.');
            }

            $file = $args['file'] ?? '';

            if (empty($file)) {
                return ToolResult::error('file (file ID) is required.');
            }

            $result = $this->service->getFile(['file' => $file]);

            return ToolResult::success([
                'ok' => true,
                'file' => $result['file'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
