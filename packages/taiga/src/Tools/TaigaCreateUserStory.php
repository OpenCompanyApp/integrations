<?php

namespace OpenCompany\Integrations\Taiga\Tools;

use OpenCompany\Integrations\Taiga\TaigaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new user story in a Taiga project.
 *
 * Accepts project ID, subject, and optional fields like description,
 * status, tags, assigned user, milestone, and points.
 */
class TaigaCreateUserStory implements Tool
{
    public function __construct(
        private TaigaService $service,
    ) {}

    public function name(): string
    {
        return 'taiga_create_user_story';
    }

    public function description(): string
    {
        return 'Create a new user story in a Taiga project. Requires project ID and subject. Optionally include description, tags, status, and assignee.';
    }

    public function parameters(): array
    {
        return [
            'project' => ['type' => 'integer', 'required' => true, 'description' => 'The Taiga project ID to create the story in.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The user story title / subject line.'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the user story. Supports Markdown formatting.'],
            'status' => ['type' => 'integer', 'description' => 'Status ID for the user story. Omit to use the default status.'],
            'assigned_to' => ['type' => 'integer', 'description' => 'User ID to assign the story to.'],
            'milestone' => ['type' => 'integer', 'description' => 'Milestone (sprint) ID to associate with.'],
            'tags' => ['type' => 'array', 'description' => 'Array of tag strings to apply (e.g., ["frontend", "bug"]).'],
            'points' => ['type' => 'object', 'description' => 'Story points as a mapping of role ID to point value (e.g., {"1": 3}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Taiga integration is not configured.');
            }

            if (!isset($args['project'])) {
                return ToolResult::error('The "project" parameter is required.');
            }

            if (!isset($args['subject'])) {
                return ToolResult::error('The "subject" parameter is required.');
            }

            $data = [
                'project' => (int) $args['project'],
                'subject' => $args['subject'],
            ];

            foreach (['description', 'status', 'assigned_to', 'milestone', 'tags', 'points'] as $key) {
                if (isset($args[$key])) {
                    $data[$key] = $args[$key];
                }
            }

            $result = $this->service->createUserStory($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
