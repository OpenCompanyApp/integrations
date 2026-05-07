<?php

namespace OpenCompany\Integrations\Line\Tools;

use OpenCompany\Integrations\Line\LineService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a LINE user profile.
 *
 * Retrieves display name, picture URL, status message, and language when available.
 */
class LineGetProfile implements Tool
{
    /**
     * @param  LineService  $service  The LINE Messaging API client
     */
    public function __construct(
        private LineService $service,
    ) {}

    public function name(): string
    {
        return 'line_get_profile';
    }

    public function description(): string
    {
        return 'Get the profile information of a LINE user, including display name, profile image URL, status message, and language.';
    }

    public function parameters(): array
    {
        return [
            'user_id' => ['type' => 'string', 'required' => true, 'description' => 'The LINE user ID to look up (e.g., "U4af4980629...").'],
        ];
    }

    /**
     * Get user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LINE integration is not configured.');
            }

            $result = $this->service->getProfile($args['user_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
