<?php

namespace OpenCompany\Integrations\GoToWebinar\Tools;

use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoToWebinarGetWebinar implements Tool
{
    public function __construct(
        private GoToWebinarService $service,
    ) {}

    public function name(): string
    {
        return 'gotowebinar_get_webinar';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific webinar, including schedule, registration settings, and organizer details.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The webinar key (webinar ID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GoTo Webinar integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The webinar ID is required.');
            }

            $result = $this->service->getWebinar($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
