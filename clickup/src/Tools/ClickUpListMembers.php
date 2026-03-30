<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpListMembers implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_list_members';
    }

    public function description(): string
    {
        return 'Get all workspace members with their IDs, names, emails, and roles.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $members = $this->getAllMembers();

            if (empty($members)) {
                return ToolResult::success('No members found.');
            }

            $output = array_map(fn (array $m) => [
                'id' => $m['id'] ?? '',
                'username' => $m['username'] ?? '',
                'email' => $m['email'] ?? '',
                'role' => $m['role'] ?? '',
            ], $members);

            return ToolResult::success(['count' => count($output), 'members' => $output]);
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
