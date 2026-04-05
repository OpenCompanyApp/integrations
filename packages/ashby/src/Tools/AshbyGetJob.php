<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AshbyGetJob implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_get_job';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific job in Ashby, including description, requirements, compensation, and application form configuration.';
    }

    public function parameters(): array
    {
        return [
            'job_id' => ['type' => 'string', 'required' => true, 'description' => 'The Ashby job ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            $result = $this->service->getJob([
                'jobId' => $args['job_id'],
            ]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
