<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Lead.
 *
 * Retrieves a single lead by its ID, including all associated contacts,
 * addresses, and custom field values.
 *
 * @see https://developer.close.com/resources/leads/#read-a-lead
 */
class CloseGetLead implements Tool
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
        return 'close_get_lead';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single lead in Close CRM, including contacts, addresses, custom fields, and associated information.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The lead ID (e.g., "lead_abc123XYZ").'],
        ];
    }

    /**
     * Execute the get lead tool.
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

            $result = $this->service->getLead($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
