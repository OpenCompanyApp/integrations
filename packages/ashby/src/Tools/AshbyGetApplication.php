<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

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
        return 'Get detailed information about a specific application in Ashby, including candidate details, application form answers, current stage, evaluation scores, and activity history.';
    }

    public function parameters(): array
    {
        return [
            'application_id' => ['type' => 'string', 'required' => true, 'description' => 'The Ashby application ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $result = $this->service->getApplication([
                'applicationId' => $args['application_id'],
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
