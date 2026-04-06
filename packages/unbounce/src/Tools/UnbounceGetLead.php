<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class UnbounceGetLead implements Tool
{
    public function __construct(
        private UnbounceService $service,
    ) {}

    public function name(): string
    {
        return 'unbounce_get_lead';
    }

    public function description(): string
    {
        return 'Get details of a specific Unbounce lead (form submission) by its ID. Returns all submitted form field values, metadata, and conversion information.';
    }

    public function parameters(): array
    {
        return [
            'lead_id' => ['type' => 'string', 'required' => true, 'description' => 'The Unbounce lead ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            if (empty($args['lead_id'])) {
                return ToolResult::error('lead_id is required.');
            }

            $result = $this->service->getLead($args['lead_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
