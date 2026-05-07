<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get Strava upload processing status.
 */
class StravaGetUpload extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_get_upload';
    }

    public function description(): string
    {
        return 'Get processing status for a Strava activity upload.';
    }

    public function parameters(): array
    {
        return [
            'upload_id' => ['type' => 'integer', 'required' => true, 'description' => 'Upload ID.'],
        ];
    }

    /**
     * Get upload status.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (!isset($args['upload_id'])) {
                return ToolResult::error('upload_id is required.');
            }

            return ToolResult::success($this->service->getUpload((int) $args['upload_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
