<?php

namespace OpenCompany\Integrations\Granola\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Granola\GranolaService;

/**
 * Retrieve a Granola meeting note by ID.
 *
 * Returns note detail such as transcript, summary, attendees, and calendar
 * event data when the API key can access the note.
 */
class GranolaGetNote implements Tool
{
    /**
     * @param  GranolaService  $service  The Granola API client.
     */
    public function __construct(
        private GranolaService $service,
    ) {}

    public function name(): string
    {
        return 'granola_get_note';
    }

    public function description(): string
    {
        return 'Get one Granola meeting note by ID, including transcript, summary, attendees, and calendar event details when available.';
    }

    public function parameters(): array
    {
        return [
            'note_id' => ['type' => 'string', 'required' => true, 'description' => 'The Granola note ID, such as not_1d3tmYTlCICgjy.'],
        ];
    }

    /**
     * Fetch the note.
     *
     * @param  array<string, mixed>  $args  Tool arguments (note_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Granola integration is not configured.');
            }

            return ToolResult::success($this->service->getNote($args['note_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
