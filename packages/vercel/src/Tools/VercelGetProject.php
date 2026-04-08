<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

class VercelGetProject implements Tool
{
    public function __construct(private VercelService $service)
    {
    }

    public function name(): string
    {
        return 'vercel_get_project';
    }

    public function description(): string
    {
        return 'Get details for a specific Vercel project by ID, including framework, domains, and settings.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The project ID.',
            ],
            'team_id' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional team ID if the project belongs to a team.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vercel is not configured. Please set your API token.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Missing required parameter: id');
            }

            $result = $this->service->getProject($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error('Failed to get Vercel project: ' . $e->getMessage());
        }
    }
}
