<?php

namespace OpenCompany\Integrations\Taiga\Tools;

use OpenCompany\Integrations\Taiga\TaigaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a single Taiga user story.
 *
 * Returns the full user story including subject, description, status,
 * assigned user, points, tags, attachments, and custom fields.
 */
class TaigaGetUserStory implements Tool
{
    public function __construct(
        private TaigaService $service,
    ) {}

    public function name(): string
    {
        return 'taiga_get_user_story';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Taiga user story by its ID. Returns the full story with subject, description, status, assignee, and points.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Taiga user story ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Taiga integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getUserStory((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
