<?php

namespace OpenCompany\Integrations\Kimai\Tools;

use OpenCompany\Integrations\Kimai\KimaiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KimaiGetProject implements Tool
{
    public function __construct(
        private KimaiService $service,
    ) {}

    public function name(): string
    {
        return 'kimai_get_project';
    }

    public function description(): string
    {
        return 'Get details of a specific project from Kimai. Returns the full project record including name, customer, comment, budget, time budget, and visibility status.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The project ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kimai integration is not configured.');
            }

            $result = $this->service->getProject((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
