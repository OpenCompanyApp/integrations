<?php

namespace OpenCompany\Integrations\Immigrant\Tools;

use OpenCompany\Integrations\Immigrant\ImmigrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: immigrant_create_application
 *
 * Creates a new immigration application with a type and applicant name,
 * optionally with additional details.
 */
class ImmigrantCreateApplication implements Tool
{
    public function __construct(
        private ImmigrantService $service,
    ) {}

    public function name(): string
    {
        return 'immigrant_create_application';
    }

    public function description(): string
    {
        return 'Create a new immigration application. Requires a type and applicant name. Optionally provide additional details.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Application type (e.g. "visa", "green_card", "citizenship").'],
            'applicant_name' => ['type' => 'string', 'required' => true, 'description' => 'Full name of the applicant.'],
            'details' => ['type' => 'object', 'description' => 'Optional additional application details (key-value pairs).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Immigrant integration is not configured.');
            }

            $type = $args['type'];
            $applicantName = $args['applicant_name'];
            $details = $args['details'] ?? null;

            $result = $this->service->createApplication($type, $applicantName, $details);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
