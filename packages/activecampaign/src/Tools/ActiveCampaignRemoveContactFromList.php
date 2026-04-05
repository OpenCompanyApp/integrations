<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to remove (unsubscribe) a contact from a list in ActiveCampaign.
 */
class ActiveCampaignRemoveContactFromList implements Tool
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
        return 'activecampaign_remove_contact_from_list';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Unsubscribe a contact from a list in ActiveCampaign. The contact will be removed from the specified list.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}> The parameter definitions.
     */
    public function parameters(): array
    {
        return [
            'contact_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign contact ID.'],
            'list_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ActiveCampaign list ID to unsubscribe the contact from.'],
        ];
    }

    /**
     * Execute the tool: remove a contact from a list.
     *
     * @param  array     $args The tool arguments (contact_id, list_id).
     * @return ToolResult      The result confirming the unsubscription or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ActiveCampaign integration is not configured.');
            }

            $contactId = (int) ($args['contact_id'] ?? 0);
            $listId = (int) ($args['list_id'] ?? 0);

            if ($contactId <= 0) {
                return ToolResult::error('A valid contact_id is required.');
            }
            if ($listId <= 0) {
                return ToolResult::error('A valid list_id is required.');
            }

            $result = $this->service->removeContactFromList($contactId, $listId);

            return ToolResult::success([
                'unsubscribed' => true,
                'contact_id' => $contactId,
                'list_id' => $listId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
