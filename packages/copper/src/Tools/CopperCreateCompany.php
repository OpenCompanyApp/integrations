<?php

namespace OpenCompany\Integrations\Copper\Tools;

use OpenCompany\Integrations\Copper\CopperService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a company in Copper CRM.
 */
class CopperCreateCompany implements Tool
{
    /**
     * @param  CopperService  $service  The Copper API client.
     */
    public function __construct(
        private CopperService $service,
    ) {}

    public function name(): string
    {
        return 'copper_create_company';
    }

    public function description(): string
    {
        return 'Create a new company in Copper CRM.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Company name.'],
        ];
    }

    /**
     * Create a Copper company.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Copper integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Company name is required.');
            }

            $result = $this->service->createCompany(['name' => $args['name']]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
