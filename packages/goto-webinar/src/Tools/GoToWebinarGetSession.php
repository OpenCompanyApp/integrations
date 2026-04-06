<?php

namespace OpenCompany\Integrations\GoToWebinar\Tools;

use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoToWebinarGetSession implements Tool
{
    public function __construct(
        private GoToWebinarService $service,
    ) {}

    public function name(): string
    {
        return 'gotowebinar_get_session';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific webinar session, including attendance, duration, and participant statistics.';
    }

    public function parameters(): array
    {
        return [
            'webinar_id' => ['type' => 'string', 'required' => true, 'description' => 'The webinar key.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The session key (session ID).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('GoTo Webinar integration is not configured.');
            }

            if (empty($args['webinar_id'])) {
                return ToolResult::error('The webinar ID is required.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('The session ID is required.');
            }

            $result = $this->service->getSession($args['webinar_id'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
