<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\Integrations\Fellow\FellowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a note for a specific Fellow meeting.
 */
class FellowCreateNote implements Tool
{
    /**
     * Create a new FellowCreateNote tool instance.
     */
    public function __construct(
        private FellowService $service,
    ) {}

    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_create_note';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create a note for a specific Fellow meeting. Use this to add meeting notes, summaries, or talking points.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The Fellow meeting UUID.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The note content in plain text or markdown.'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the note.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fellow integration is not configured.');
            }

            $meetingId = $args['meeting_id'] ?? '';
            $content = $args['content'] ?? '';

            if (empty($meetingId)) {
                return ToolResult::error('meeting_id is required.');
            }

            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $data = ['content' => $content];

            if (isset($args['title'])) {
                $data['title'] = $args['title'];
            }

            $result = $this->service->createNote($meetingId, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
