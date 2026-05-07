<?php

namespace OpenCompany\Integrations\FlyIo\Tools;

use OpenCompany\Integrations\FlyIo\FlyIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Legacy helper for retrieving a Fly.io user if a host provides that endpoint.
 *
 * This tool is intentionally not exposed by the provider because the Machines
 * API docs do not currently advertise a /user resource.
 */
class FlyIoGetCurrentUser implements Tool
{
    /**
     * @param  FlyIoService  $service  The Fly.io Machines API client.
     */
    public function __construct(
        private FlyIoService $service,
    ) {}

    public function name(): string
    {
        return 'fly_io_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated Fly.io user information, including email and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the current user from legacy-compatible hosts.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Fly.io integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
