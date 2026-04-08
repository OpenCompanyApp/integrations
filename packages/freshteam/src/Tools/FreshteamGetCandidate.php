<?php

namespace OpenCompany\Integrations\Freshteam\Tools;

use OpenCompany\Integrations\Freshteam\FreshteamService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class FreshteamGetCandidate implements Tool
{
    public function __construct(
        private FreshteamService $service,
    ) {}

    public function name(): string
    {
        return 'freshteam_get_candidate';
    }

    public function description(): string
    {
        return 'Retrieve detailed information about a specific candidate in Freshteam by their ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The candidate ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshteam integration is not configured.');
            }

            if (!isset($args['id'])) {
                return ToolResult::error('Candidate ID is required.');
            }

            $result = $this->service->getCandidate((int) $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
