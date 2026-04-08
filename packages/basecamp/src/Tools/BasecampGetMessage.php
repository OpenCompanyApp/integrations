<?php

namespace OpenCompany\Integrations\Basecamp\Tools;

use OpenCompany\Integrations\Basecamp\BasecampService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: basecamp_get_message
 *
 * Retrieves a single message (message board post) from a Basecamp project.
 *
 * @see https://github.com/basecamp/api/blob/master/sections/messages.md#get-a-message
 */
class BasecampGetMessage implements Tool
{
    /**
     * @param  BasecampService  $service  The Basecamp API service instance.
     */
    public function __construct(
        private BasecampService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'basecamp_get_message';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get a single message from a Basecamp project by ID. Returns the full message subject, content, author, and metadata.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Basecamp project ID.'],
            'message_id' => ['type' => 'integer', 'required' => true, 'description' => 'The message (board post) ID.'],
        ];
    }

    /**
     * Execute the tool — fetch a single message from Basecamp.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Basecamp integration is not configured.');
            }

            $projectId = (int) ($args['project_id'] ?? 0);
            $messageId = (int) ($args['message_id'] ?? 0);

            if ($projectId <= 0) {
                return ToolResult::error('A valid project_id is required.');
            }

            if ($messageId <= 0) {
                return ToolResult::error('A valid message_id is required.');
            }

            $result = $this->service->getMessage($projectId, $messageId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
