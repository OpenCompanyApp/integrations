<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a lead label.
 */
class InstantlyUpdateLeadLabel implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_lead_label';
    }

    public function description(): string
    {
        return 'Update a lead label.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Label ID'],
            'label_name' => ['type' => 'string', 'required' => false, 'description' => 'Label name'],
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

            $body = []; foreach (['label_name','color','icon','value'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateLeadLabel($args['id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
