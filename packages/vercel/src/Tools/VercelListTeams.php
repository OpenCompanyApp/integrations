<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

/**
 * List Vercel teams available to the authenticated user.
 */
class VercelListTeams implements Tool
{
    /**
     * @param  VercelService  $service  The Vercel REST API client.
     */
    public function __construct(private VercelService $service)
    {
    }

    public function name(): string
    {
        return 'vercel_list_teams';
    }

    public function description(): string
    {
        return 'List all Vercel teams you belong to, including membership roles and member counts.';
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'required' => false,
                'description' => 'Maximum number of teams to return (default 20, max 100).',
            ],
        ];
    }

    /**
     * List teams using optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vercel is not configured. Please set your API token.');
            }

            $params = array_filter([
                'limit' => $args['limit'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listTeams($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error('Failed to list Vercel teams: ' . $e->getMessage());
        }
    }
}
