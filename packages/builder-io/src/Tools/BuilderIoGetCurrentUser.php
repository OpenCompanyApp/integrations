<?php

namespace OpenCompany\Integrations\BuilderIo\Tools;

use OpenCompany\Integrations\BuilderIo\BuilderIoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Builder.io user.
 */
class BuilderIoGetCurrentUser implements Tool
{
    /**
     * @param  BuilderIoService  $service  The Builder.io API client
     */
    public function __construct(
        private BuilderIoService $service,
    ) {}

    public function name(): string
    {
        return 'builder_io_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get information about the currently authenticated Builder.io user.
        Returns the user's name, email, and account details.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current authenticated user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Builder.io integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'email' => $result['email'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
