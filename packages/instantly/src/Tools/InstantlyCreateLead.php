<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a single lead.
 */
class InstantlyCreateLead implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_lead';
    }

    public function description(): string
    {
        return 'Create a single lead.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Lead email'],
            'campaign_id' => ['type' => 'string', 'required' => false, 'description' => 'Campaign ID'],
            'list_id' => ['type' => 'string', 'required' => false, 'description' => 'List ID'],
            'first_name' => ['type' => 'string', 'required' => false, 'description' => 'First name'],
            'last_name' => ['type' => 'string', 'required' => false, 'description' => 'Last name'],
            'company_name' => ['type' => 'string', 'required' => false, 'description' => 'Company'],
            'website' => ['type' => 'string', 'required' => false, 'description' => 'Website'],
            'phone' => ['type' => 'string', 'required' => false, 'description' => 'Phone'],
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

            $result = $fields = ['email','campaign_id','list_id','first_name','last_name','company_name','website','phone']; $this->service->createLead(array_intersect_key($args, array_flip($fields)));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
