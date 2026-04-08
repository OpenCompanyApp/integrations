<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single application from Ashby ATS.
 *
 * Retrieves full application details including candidate information,
 * application status, and associated job data.
 */
class AshbyGetApplication implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_get_application';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific job application in Ashby, including candidate details, status, and evaluation data.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The application ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Application ID is required.');
            }

            $result = $this->service->getApplication($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
