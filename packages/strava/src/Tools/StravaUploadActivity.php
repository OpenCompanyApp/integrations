<?php

namespace OpenCompany\Integrations\Strava\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload an activity file to Strava.
 */
class StravaUploadActivity extends AbstractStravaTool implements Tool
{
    public function name(): string
    {
        return 'strava_upload_activity';
    }

    public function description(): string
    {
        return 'Upload a FIT, TCX, or GPX file to create a Strava activity for asynchronous processing.';
    }

    public function parameters(): array
    {
        return [
            'file_path' => ['type' => 'string', 'required' => true, 'description' => 'Absolute path to the activity file.'],
            'data_type' => ['type' => 'string', 'required' => true, 'enum' => ['fit', 'fit.gz', 'tcx', 'tcx.gz', 'gpx', 'gpx.gz'], 'description' => 'Upload file type.'],
            'name' => ['type' => 'string', 'description' => 'Optional activity name.'],
            'description' => ['type' => 'string', 'description' => 'Optional activity description.'],
            'trainer' => ['type' => 'integer', 'description' => 'Set to 1 for trainer activity.'],
            'commute' => ['type' => 'integer', 'description' => 'Set to 1 for commute activity.'],
            'external_id' => ['type' => 'string', 'description' => 'Optional unique external ID.'],
        ];
    }

    /**
     * Upload an activity file.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['file_path'])) {
                return ToolResult::error('file_path is required.');
            }
            if (empty($args['data_type'])) {
                return ToolResult::error('data_type is required.');
            }

            return ToolResult::success($this->service->uploadActivity(
                (string) $args['file_path'],
                (string) $args['data_type'],
                $this->only($args, ['name', 'description', 'trainer', 'commute', 'external_id'])
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
