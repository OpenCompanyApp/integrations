<?php

namespace OpenCompany\Integrations\Radar\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolResult;
use OpenCompany\Integrations\Radar\RadarService;

class RadarGetUser implements Tool
{
    public function __construct(private RadarService $service) {}

    public function name(): string
    {
        return 'radar_get_user';
    }

    public function description(): string
    {
        return 'Retrieve detailed information about a specific Radar user by their ID.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the user to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Radar integration is not configured.');
            }

            $result = $this->service->getUser($args['user_id']);
            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
