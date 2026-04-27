<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Update the interest status of a lead.
 *
 * Instantly submits this operation as a background job.
 */
class InstantlyUpdateLeadInterestStatus implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_lead_interest_status';
    }

    public function description(): string
    {
        return 'Update a lead interest status by lead email, optionally scoped to a campaign or list.';
    }

    public function parameters(): array
    {
        return [
            'lead_email' => ['type' => 'string', 'required' => true, 'description' => 'Lead email address'],
            'interest_value' => ['type' => 'number', 'required' => true, 'description' => 'Interest status value. Pass null to reset to Lead.'],
            'campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID to scope the update'],
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'Lead list ID to scope the update'],
            'ai_interest_value' => ['type' => 'number', 'required' => false, 'description' => 'AI interest value to set'],
            'disable_auto_interest' => ['type' => 'boolean', 'required' => false, 'description' => 'Disable automatic interest updates for this lead'],
        ];
    }

    /**
     * Update a lead interest status.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $body = [
                'lead_email' => $args['lead_email'],
                'interest_value' => $args['interest_value'],
            ];
            foreach (['campaign_id', 'list_id', 'ai_interest_value', 'disable_auto_interest'] as $key) {
                if (array_key_exists($key, $args)) {
                    $body[$key] = $args[$key];
                }
            }

            return ToolResult::success($this->service->updateLeadInterestStatus($body));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
