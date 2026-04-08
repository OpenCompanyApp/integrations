<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a Zoom webinar.
 *
 * Retrieves webinar information including join URL, settings,
 * and registration details by webinar ID.
 */
class ZoomGetWebinar implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_get_webinar';
    }

    public function description(): string
    {
        return 'Get details of a Zoom webinar by ID.';
    }

    public function parameters(): array
    {
        return [
            'webinar_id' => ['type' => 'string', 'required' => true, 'description' => 'The webinar ID.'],
        ];
    }

    /**
     * Retrieve a webinar by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (webinar_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $webinarId = $args['webinar_id'] ?? '';
            if (empty($webinarId)) {
                return ToolResult::error('webinar_id is required.');
            }

            $result = $this->service->getWebinar($webinarId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
