<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\Integrations\Granola\GranolaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GranolaCreateNote implements Tool
{
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_create_note';
    }

    public function description(): string
    {
        return 'Create a note on a Granola meeting. Use this to add follow-up notes, action items, or comments to a meeting.';
    }

    public function parameters(): array
    {
        return [
            'meeting_id' => ['type' => 'string', 'required' => true, 'description' => 'The meeting ID to add the note to.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The note content text.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            if (empty($args['meeting_id'])) {
                return ToolResult::error('Meeting ID is required.');
            }

            if (empty($args['content'])) {
                return ToolResult::error('Note content is required.');
            }

            $result = $this->service->createNote($args['meeting_id'], [
                'content' => $args['content'],
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
