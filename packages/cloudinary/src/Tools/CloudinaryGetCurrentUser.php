<?php

namespace OpenCompany\Integrations\Cloudinary\Tools;

use OpenCompany\Integrations\Cloudinary\CloudinaryService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Cloudinary user profile.
 *
 * Returns user details including name, email, and account information.
 * Useful for verifying credentials and displaying connection status.
 */
class CloudinaryGetCurrentUser implements Tool
{
    /**
     * Create a new CloudinaryGetCurrentUser tool instance.
     */
    public function __construct(
        private CloudinaryService $service,
    ) {}

    /**
     * The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'cloudinary_get_current_user';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Cloudinary user profile. Returns user name, email, and account details. Use this to verify that credentials are working.';
    }

    /**
     * Parameter schema for the get-current-user tool.
     *
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get-current-user request.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Cloudinary integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
