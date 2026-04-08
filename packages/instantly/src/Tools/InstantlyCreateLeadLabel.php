<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new lead label (custom interest status).
 */
class InstantlyCreateLeadLabel implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_lead_label';
    }

    public function description(): string
    {
        return 'Create a new lead label (custom interest status).';
    }

    public function parameters(): array
    {
        return [
            'label_name' => ['type' => 'string', 'required' => true, 'description' => 'Label name'],
            'color' => ['type' => 'string', 'required' => false, 'description' => 'Hex color'],
            'icon' => ['type' => 'string', 'required' => false, 'description' => 'Icon name'],
            'value' => ['type' => 'integer', 'required' => false, 'description' => 'Numeric value'],
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

            $result = $body = ['label_name' => $args['label_name']]; foreach (['color','icon','value'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $this->service->createLeadLabel($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
