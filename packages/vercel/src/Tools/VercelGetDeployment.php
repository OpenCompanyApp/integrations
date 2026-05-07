<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

/**
 * Retrieve a Vercel deployment by ID or URL.
 */
class VercelGetDeployment implements Tool
{
    /**
     * @param  VercelService  $service  The Vercel REST API client.
     */
    public function __construct(private VercelService $service)
    {
    }

    public function name(): string
    {
        return 'vercel_get_deployment';
    }

    public function description(): string
    {
        return 'Get details for a specific Vercel deployment by ID, including status, URL, and build logs.';
    }

    public function parameters(): array
    {
        return [
            'id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The deployment ID.',
            ],
            'team_id' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional team ID if the deployment belongs to a team.',
            ],
            'slug' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional team slug if the deployment belongs to a team.',
            ],
        ];
    }

    /**
     * Fetch a deployment by ID or hostname.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, team_id, slug).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vercel is not configured. Please set your API token.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Missing required parameter: id');
            }

            $params = array_filter([
                'teamId' => $args['team_id'] ?? null,
                'slug' => $args['slug'] ?? null,
            ], static fn ($value): bool => $value !== null && $value !== '');

            $result = $this->service->getDeployment($args['id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error('Failed to get Vercel deployment: ' . $e->getMessage());
        }
    }
}
