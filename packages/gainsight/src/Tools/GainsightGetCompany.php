<?php

namespace OpenCompany\Integrations\Gainsight\Tools;

use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving detailed information about a specific Gainsight company.
 *
 * Fetches full company metadata including health score, ARR, lifecycle stage,
 * CSM assignment, and custom fields.
 */
class GainsightGetCompany implements Tool
{
    /**
     * Create a new GainsightGetCompany tool instance.
     */
    public function __construct(
        private GainsightService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gainsight_get_company';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific company in Gainsight, including health score, ARR, lifecycle stage, and CSM assignment.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'companyId' => ['type' => 'string', 'required' => true, 'description' => 'The unique company identifier (Gainsight Company ID).'],
        ];
    }

    /**
     * Execute the get company tool.
     *
     * @param  array  $args  Tool arguments containing the companyId.
     * @return ToolResult The result containing company details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gainsight integration is not configured.');
            }

            $result = $this->service->getCompany($args['companyId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
