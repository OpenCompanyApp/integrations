<?php

namespace OpenCompany\Integrations\Immigrant\Tools;

use OpenCompany\Integrations\Immigrant\ImmigrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: immigrant_get_application
 *
 * Retrieves a single immigration application by its ID.
 */
class ImmigrantGetApplication implements Tool
{
    public function __construct(
        private ImmigrantService $service,
    ) {}

    public function name(): string
    {
        return 'immigrant_get_application';
    }

    public function description(): string
    {
        return 'Get details of a specific immigration application by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Immigrant application ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Immigrant integration is not configured.');
            }

            $applicationId = (string) $args['id'];
            $result = $this->service->getApplication($applicationId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
