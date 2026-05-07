<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Validate a Pushover user or group key and optional device name.
 */
class PushoverValidateUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_validate_user';
    }

    public function description(): string
    {
        return 'Validate a Pushover user/group key and optional device before sending a message.';
    }

    public function parameters(): array
    {
        return [
            'user_key' => ['type' => 'string', 'description' => 'User or group key to validate. Defaults to the configured user key.'],
            'device' => ['type' => 'string', 'description' => 'Optional device name to validate for the user.'],
        ];
    }

    /**
     * Validate a Pushover user key and optional device.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_key, device).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $result = $this->service->validateUser(
                userKey: $args['user_key'] ?? null,
                device: $args['device'] ?? null,
            );

            return ToolResult::success([
                'valid' => (bool) ($result['status'] ?? false),
                'devices' => $result['devices'] ?? [],
                'licenses' => $result['licenses'] ?? [],
                'raw' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
