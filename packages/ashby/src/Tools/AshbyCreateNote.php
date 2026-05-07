<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a note on an Ashby candidate.
 */
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
            'candidateId' => ['type' => 'string', 'required' => true, 'description' => 'The candidate UUID.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The note content (supports plain text).'],
            'contentType' => ['type' => 'string', 'description' => 'Content type, such as text/plain or text/html.'],
        ];
    }

    /**
     * Create a candidate note.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $body = [
                'candidateId' => $args['candidateId'],
                'content' => $args['content'],
            ];

            if (isset($args['contentType'])) {
                $body['contentType'] = $args['contentType'];
            }

            $result = $this->service->createNote($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
