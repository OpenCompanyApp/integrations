<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a contact from ActiveCampaign.
 */
class ActiveCampaignDeleteContact implements Tool
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
        return 'activecampaign_delete_contact';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Delete a contact from ActiveCampaign. This action is permanent and cannot be undone.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign contact ID to delete.'],
        ];
    }

    /**
     * Execute the tool: delete a contact from ActiveCampaign.
     *
     * @param  array     $args The tool arguments (contact_id).
     * @return ToolResult      The result confirming deletion or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $contactId = (int) ($args['contact_id'] ?? 0);
            if ($contactId <= 0) {
                return ToolResult::error('A valid contact_id is required.');
            }

            $this->service->deleteContact($contactId);

            return ToolResult::success([
                'deleted' => true,
                'contact_id' => $contactId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
