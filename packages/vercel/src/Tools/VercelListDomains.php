<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

/**
 * List domains registered in Vercel.
 */
class VercelListDomains implements Tool
{
    /**
     * @param  VercelService  $service  The Vercel REST API client.
     */
    public function __construct(private VercelService $service)
    {
    }

    public function name(): string
    {
        return 'vercel_list_domains';
    }

    public function description(): string
    {
        return 'List all domains configured in Vercel, including verification and DNS status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'required' => false,
                'description' => 'Maximum number of domains to return (default 20, max 100).',
            ],
            'team_id' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional team ID to scope domains to a specific team.',
            ],
            'slug' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional team slug to scope domains to a specific team.',
            ],
        ];
    }

    /**
     * List domains using optional pagination and team scope.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, team_id, slug).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vercel is not configured. Please set your API token.');
            }

            $params = array_filter([
                'limit' => $args['limit'] ?? null,
                'teamId' => $args['team_id'] ?? null,
                'slug' => $args['slug'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listDomains($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error('Failed to list Vercel domains: ' . $e->getMessage());
        }
    }
}
