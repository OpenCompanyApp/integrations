<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RailwayGetCurrentUser implements Tool
{
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Railway user. Useful for verifying API credentials.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Railway integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $viewer = $result['viewer'] ?? $result;

            return ToolResult::success([
                'id' => $viewer['id'] ?? '',
                'name' => $viewer['name'] ?? '',
                'email' => $viewer['email'] ?? '',
                'avatar' => $viewer['avatar'] ?? null,
                'is_verified' => $viewer['isVerified'] ?? false,
                'is_onboarded' => $viewer['isOnboarded'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
