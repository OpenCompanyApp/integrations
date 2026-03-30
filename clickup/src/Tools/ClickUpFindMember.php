<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpFindMember implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_find_member';
    }

    public function description(): string
    {
        return 'Find a workspace member by name or email.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Name or email to search for.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('"query" parameter is required.');
            }

            $members = $this->getAllMembers();
            $queryLower = strtolower($query);

            $matches = array_filter($members, function (array $m) use ($queryLower) {
                return str_contains(strtolower($m['username'] ?? ''), $queryLower)
                    || str_contains(strtolower($m['email'] ?? ''), $queryLower)
                    || str_contains(strtolower($m['initials'] ?? ''), $queryLower);
            });

            if (empty($matches)) {
                return ToolResult::success("No member found matching '{$query}'.");
            }

            $output = array_map(fn (array $m) => [
                'id' => $m['id'] ?? '',
                'username' => $m['username'] ?? '',
                'email' => $m['email'] ?? '',
            ], array_values($matches));

            return ToolResult::success(['matches' => $output]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function getAllMembers(): array
    {
        $response = $this->service->getMembers('');
        $teams = $response['teams'] ?? [];

        $members = [];
        foreach ($teams as $team) {
            foreach ($team['members'] ?? [] as $member) {
                $members[] = $member['user'] ?? $member;
            }
        }

        return $members;
    }
}
