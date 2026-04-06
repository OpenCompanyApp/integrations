<?php

namespace OpenCompany\Integrations\Amplitude\Tools;

use OpenCompany\Integrations\Amplitude\AmplitudeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * AmplitudeGetUser — Retrieve a full user profile.
 *
 * Calls GET /api/2/userprofile with either a user_id or device_id.
 * Returns user properties, device info, and merge history.
 */
class AmplitudeGetUser implements Tool
{
    public function __construct(
        private AmplitudeService $service,
    ) {}

    public function name(): string
    {
        return 'amplitude_get_user';
    }

    public function description(): string
    {
        return 'Retrieve a full Amplitude user profile by user ID or device ID. Returns user properties, device information, and account history.';
    }

    public function parameters(): array
    {
        return [
            'user_id'   => ['type' => 'string', 'description' => 'The Amplitude user ID.'],
            'device_id' => ['type' => 'string', 'description' => 'The Amplitude device ID. Provide either user_id or device_id.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amplitude integration is not configured.');
            }

            $userId = $args['user_id'] ?? null;
            $deviceId = $args['device_id'] ?? null;

            if ($userId === null && $deviceId === null) {
                return ToolResult::error('Either user_id or device_id is required.');
            }

            $result = $this->service->getUser(
                userId: $userId,
                deviceId: $deviceId,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
