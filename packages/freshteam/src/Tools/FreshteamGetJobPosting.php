<?php

namespace OpenCompany\Integrations\Freshteam\Tools;

use OpenCompany\Integrations\Freshteam\FreshteamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshteamGetJobPosting implements Tool
{
    public function __construct(
        private FreshteamService $service,
    ) {}

    public function name(): string
    {
        return 'freshteam_get_job_posting';
    }

    public function description(): string
    {
        return 'Retrieve detailed information about a specific job posting in Freshteam by its ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The job posting ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshteam integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Job posting ID is required.');
            }

            $result = $this->service->getJobPosting((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
