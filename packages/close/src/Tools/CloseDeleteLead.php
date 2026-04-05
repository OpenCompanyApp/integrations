<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Delete Lead.
 *
 * Deletes a lead from Close CRM. This action is permanent and also removes
 * all associated contacts, activities, and tasks.
 *
 * @see https://developer.close.com/resources/leads/#delete-a-lead
 */
class CloseDeleteLead implements Tool
{
    /**
     * @param  CloseService  $service  The Close API service instance.
     */
    public function __construct(
        private CloseService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'close_delete_lead';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Permanently delete a lead from Close CRM. This removes the lead and all associated contacts, activities, and tasks.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The lead ID to delete (e.g., "lead_abc123XYZ").'],
        ];
    }

    /**
     * Execute the delete lead tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the lead ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Close integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Lead ID is required.');
            }

            $this->service->deleteLead($id);

            return ToolResult::success("Lead '{$id}' has been permanently deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
