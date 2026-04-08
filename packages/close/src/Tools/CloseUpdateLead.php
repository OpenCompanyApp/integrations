<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Update Lead.
 *
 * Updates an existing lead in Close CRM. Supports updating name, status,
 * custom fields, URL, and other writable lead properties.
 *
 * @see https://developer.close.com/resources/leads/#update-a-lead
 */
class CloseUpdateLead implements Tool
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
        return 'close_update_lead';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Update an existing lead in Close CRM. Provide the lead ID and the fields to update (name, status, custom fields, URL, etc.).';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id'   => ['type' => 'string', 'required' => true, 'description' => 'The lead ID to update (e.g., "lead_abc123XYZ").'],
            'name' => ['type' => 'string', 'description' => 'New company or lead name.'],
            'status_id' => ['type' => 'string', 'description' => 'New status ID to assign.'],
            'url'  => ['type' => 'string', 'description' => 'New company website URL.'],
            'custom' => ['type' => 'object', 'description' => 'Updated custom field values as an object (e.g., {"Industry": "SaaS"}).'],
        ];
    }

    /**
     * Execute the update lead tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, and fields to update).
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

            $data = [];
            foreach (['name', 'status_id', 'url', 'custom'] as $field) {
                if (isset($args[$field])) {
                    $data[$field] = $args[$field];
                }
            }

            if (empty($data)) {
                return ToolResult::error('At least one field to update must be provided.');
            }

            $result = $this->service->updateLead($id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
