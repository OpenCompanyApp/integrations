<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\Integrations\Pushover\PushoverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Validate the configured Pushover user key and return device/license metadata.
 */
class PushoverGetCurrentUser implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_current_user';
    }

    public function description(): string
    {
        return 'Validate the configured Pushover user or group key and return active devices and licenses.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Validate the configured Pushover user key.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $result = $this->service->validateUser();

            $status = $result['status'] ?? false;

            if (!$status) {
                $errors = $result['errors'] ?? ['Unknown error'];
                return ToolResult::error('Validation failed: ' . implode('; ', $errors));
            }

            return ToolResult::success([
                'valid' => true,
                'devices' => $result['devices'] ?? [],
                'licenses' => $result['licenses'] ?? ($result['license'] ?? []),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
