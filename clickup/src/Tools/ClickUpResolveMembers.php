<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpResolveMembers implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_resolve_members';
    }

    public function description(): string
    {
        return 'Convert member names or emails to ClickUp user IDs for assigning tasks.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated names or emails to resolve to user IDs.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $queries = $args['query'] ?? '';
            if (empty($queries)) {
                return ToolResult::error('"query" parameter is required. Provide comma-separated names or emails.');
            }

            $names = is_string($queries) ? array_map('trim', explode(',', $queries)) : $queries;
            $members = $this->getAllMembers();
            $resolved = [];

            foreach ($names as $name) {
                $nameLower = strtolower($name);
                $found = null;

                foreach ($members as $m) {
                    if (strtolower($m['username'] ?? '') === $nameLower
                        || strtolower($m['email'] ?? '') === $nameLower) {
                        $found = $m['id'] ?? null;
                        break;
                    }
                }

                $resolved[] = [
                    'query' => $name,
                    'id' => $found,
                    'resolved' => $found !== null,
                ];
            }

            return ToolResult::success(['results' => $resolved]);
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
