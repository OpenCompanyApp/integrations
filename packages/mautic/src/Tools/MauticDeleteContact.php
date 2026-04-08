<?php

namespace OpenCompany\Integrations\Mautic\Tools;

use OpenCompany\Integrations\Mautic\MauticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MauticDeleteContact — Delete a contact from Mautic.
 *
 * Calls DELETE /api/contacts/{id}/delete.
 *
 * @see https://developer.mautic.org/#delete-contact
 */
class MauticDeleteContact implements Tool
{
    /**
     * @param  MauticService  $service  The Mautic API service instance.
     */
    public function __construct(
        private MauticService $service,
    ) {}

    /**
     * The tool identifier used in the registry.
     */
    public function name(): string
    {
        return 'mautic_delete_contact';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Delete a contact from Mautic by ID. This action is permanent and cannot be undone.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The Mautic contact ID to delete.'],
        ];
    }

    /**
     * Execute the tool — delete a contact from Mautic.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mautic integration is not configured.');
            }

            $id = $args['id'] ?? null;
            if (empty($id)) {
                return ToolResult::error('Contact ID is required.');
            }

            $this->service->deleteContact((int) $id);

            return ToolResult::success("Contact {$id} has been deleted from Mautic.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
