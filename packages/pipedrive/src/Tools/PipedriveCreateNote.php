<?php

namespace OpenCompany\Integrations\Pipedrive\Tools;

use OpenCompany\Integrations\Pipedrive\PipedriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a note in Pipedrive CRM.
 *
 * Supports attaching notes to deals, persons, and organizations.
 */
class PipedriveCreateNote implements Tool
{
    /**
     * @param  PipedriveService  $service  The Pipedrive API client
     */
    public function __construct(
        private PipedriveService $service,
    ) {}

    public function name(): string
    {
        return 'pipedrive_create_note';
    }

    public function description(): string
    {
        return 'Create a note in Pipedrive CRM attached to a deal, person, or organization. Requires content and at least one associated object ID.';
    }

    public function parameters(): array
    {
        return [
            'content'   => ['type' => 'string', 'required' => true, 'description' => 'Note content (supports HTML).'],
            'deal_id'   => ['type' => 'integer', 'description' => 'ID of the deal to attach the note to.'],
            'person_id' => ['type' => 'integer', 'description' => 'ID of the person to attach the note to.'],
            'org_id'    => ['type' => 'integer', 'description' => 'ID of the organization to attach the note to.'],
        ];
    }

    /**
     * Create a Pipedrive note attached to a deal, person, or organization.
     *
     * @param  array<string, mixed>  $args  Tool arguments (content, deal_id, person_id, org_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pipedrive integration is not configured.');
            }

            $content = $args['content'] ?? '';
            if (empty($content)) {
                return ToolResult::error('content is required.');
            }

            $data = ['content' => $content];

            if (! empty($args['deal_id'])) {
                $data['deal_id'] = (int) $args['deal_id'];
            }
            if (! empty($args['person_id'])) {
                $data['person_id'] = (int) $args['person_id'];
            }
            if (! empty($args['org_id'])) {
                $data['org_id'] = (int) $args['org_id'];
            }

            if (empty($args['deal_id']) && empty($args['person_id']) && empty($args['org_id'])) {
                return ToolResult::error('At least one associated object ID is required (deal_id, person_id, or org_id).');
            }

            $result = $this->service->createNote($data);
            $note = $result['data'] ?? $result;

            return ToolResult::success($note);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
