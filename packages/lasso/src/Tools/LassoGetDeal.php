<?php

namespace OpenCompany\Integrations\Lasso\Tools;

use OpenCompany\Integrations\Lasso\LassoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Get Deal.
 *
 * Retrieves a single deal (sale) by its ID from Lasso CRM.
 */
class LassoGetDeal implements Tool
{
    /**
     * @param  LassoService  $service  The Lasso API service instance.
     */
    public function __construct(
        private LassoService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'lasso_get_deal';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get full details for a single deal (sale) in Lasso CRM, including pricing, unit details, and associated contacts.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The deal ID.'],
        ];
    }

    /**
     * Execute the get deal tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments containing the deal ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Lasso CRM integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('Deal ID is required.');
            }

            $result = $this->service->getDeal($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
