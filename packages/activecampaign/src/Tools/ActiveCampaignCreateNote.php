<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a note on a contact in ActiveCampaign.
 */
class ActiveCampaignCreateNote implements Tool
{
    /**
     * @param ActiveCampaignService $service The ActiveCampaign service instance.
     */
    public function __construct(
        private ActiveCampaignService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier.
     */
    public function name(): string
    {
        return 'activecampaign_create_note';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a note attached to a contact in ActiveCampaign. Provide the contact ID and note text.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign contact ID to attach the note to.'],
            'note' => ['type' => 'string', 'required' => true, 'description' => 'The note text content.'],
        ];
    }

    /**
     * Execute the tool: create a note in ActiveCampaign.
     *
     * @param  array     $args The tool arguments (contact_id, note).
     * @return ToolResult      The result containing the created note or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $contactId = (int) ($args['contact_id'] ?? 0);
            $noteText = $args['note'] ?? '';

            if ($contactId <= 0) {
                return ToolResult::error('A valid contact_id is required.');
            }
            if (empty($noteText)) {
                return ToolResult::error('Note text is required.');
            }

            $result = $this->service->createNote($contactId, $noteText);
            $note = $result['note'] ?? $result;

            return ToolResult::success([
                'id' => (int) ($note['id'] ?? 0),
                'contact_id' => $contactId,
                'note' => $note['note'] ?? $noteText,
                'created' => $note['cdate'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
