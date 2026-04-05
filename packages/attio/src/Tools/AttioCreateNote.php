<?php

namespace OpenCompany\Integrations\Attio\Tools;

use OpenCompany\Integrations\Attio\AttioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AttioCreateNote implements Tool
{
    /**
     * Create a new AttioCreateNote tool instance.
     */
    public function __construct(
        private AttioService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'attio_create_note';
    }

    /**
     * A description of what this tool does, used by AI agents to decide when to call it.
     */
    public function description(): string
    {
        return 'Create a note attached to a record in Attio. Notes are useful for adding context, call summaries, or follow-up reminders to people, companies, or other records.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'parent_object' => ['type' => 'string', 'required' => true, 'description' => 'The parent object slug (e.g. "people", "companies").'],
            'parent_record_id' => ['type' => 'string', 'required' => true, 'description' => 'The UUID of the parent record to attach the note to.'],
            'content' => ['type' => 'string', 'required' => true, 'description' => 'The note content in plain text or markdown.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Attio integration is not configured.');
            }

            $result = $this->service->createNote(
                $args['parent_object'],
                $args['parent_record_id'],
                $args['content'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
