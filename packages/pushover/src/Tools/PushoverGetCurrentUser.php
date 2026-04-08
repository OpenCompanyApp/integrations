<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\Integrations\Pushover\PushoverService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PushoverGetCurrentUser implements Tool
{
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_current_user';
    }

    public function description(): string
    {
        return 'Validate the Pushover user credentials and retrieve account information.';
    }

    public function parameters(): array
    {
        return [];
    }

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
                'license' => $result['license'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
