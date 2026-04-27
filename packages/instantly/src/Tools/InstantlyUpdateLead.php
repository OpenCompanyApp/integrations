<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a lead.
 */
class InstantlyUpdateLead implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_lead';
    }

    public function description(): string
    {
        return 'Update a lead.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Lead ID'],
            'first_name' => ['type' => 'string', 'required' => false, 'description' => 'First name'],
            'last_name' => ['type' => 'string', 'required' => false, 'description' => 'Last name'],
            'company_name' => ['type' => 'string', 'required' => false, 'description' => 'Company'],
            'website' => ['type' => 'string', 'required' => false, 'description' => 'Website'],
            'phone' => ['type' => 'string', 'required' => false, 'description' => 'Phone'],
            'personalization' => ['type' => 'string', 'required' => false, 'description' => 'Personalization text'],
            'lt_interest_status' => ['type' => 'integer', 'required' => false, 'description' => 'Interest status'],
            'pl_value_lead' => ['type' => 'string', 'required' => false, 'description' => 'Potential value'],
            'assigned_to' => ['type' => 'string', 'required' => false, 'description' => 'User ID to assign'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $id = $args['id']; $fields = ['first_name','last_name','company_name','website','phone','personalization','lt_interest_status','pl_value_lead','assigned_to']; $result = $this->service->updateLead($id, array_intersect_key($args, array_flip($fields)));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
