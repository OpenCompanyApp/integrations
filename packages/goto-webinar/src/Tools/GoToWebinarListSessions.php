<?php

namespace OpenCompany\Integrations\GoToWebinar\Tools;

use OpenCompany\Integrations\GoToWebinar\GoToWebinarService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GoToWebinarListSessions implements Tool
{
    public function __construct(
        private GoToWebinarService $service,
    ) {}

    public function name(): string
    {
        return 'gotowebinar_list_sessions';
    }

    public function description(): string
    {
        return 'List all sessions for a specific webinar. Each session represents one occurrence of a webinar (useful for recurring webinars).';
    }

    public function parameters(): array
    {
        return [
            'webinar_id' => ['type' => 'string', 'required' => true, 'description' => 'The webinar key.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (0-based, default: 0).'],
            'size' => ['type' => 'integer', 'description' => 'Number of results per page (default: 20, max: 200).'],
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

            $page = isset($args['page']) ? (int) $args['page'] : 0;
            $size = isset($args['size']) ? (int) $args['size'] : 20;

            $result = $this->service->listSessions($args['webinar_id'], $page, $size);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
