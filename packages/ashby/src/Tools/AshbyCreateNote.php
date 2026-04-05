<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AshbyCreateNote implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_create_note';
    }

    public function description(): string
    {
        return 'Create a note in Ashby attached to a candidate, application, or job. Notes are visible to the hiring team and appear in activity feeds.';
    }

    public function parameters(): array
    {
        return [
            'subject_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the entity to attach the note to (candidate, application, or job ID).'],
            'subject_type' => ['type' => 'string', 'required' => true, 'description' => 'The type of entity: "candidate", "application", or "job".'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The note content (supports plain text).'],
            'visibility' => ['type' => 'string', 'description' => 'Note visibility: "team" (default) or "private".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $body = [
                'subjectId' => $args['subject_id'],
                'subjectType' => $args['subject_type'],
                'content' => $args['content'],
            ];

            if (isset($args['visibility'])) {
                $body['visibility'] = $args['visibility'];
            }

            $result = $this->service->createNote($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
