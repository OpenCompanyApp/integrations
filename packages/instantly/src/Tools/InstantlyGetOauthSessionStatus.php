<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Instantly\InstantlyService;

/**
 * Get the status of a Google or Microsoft OAuth connection session.
 *
 * Sessions can be pending, successful, failed, or expired.
 */
class InstantlyGetOauthSessionStatus implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_get_oauth_session_status';
    }

    public function description(): string
    {
        return 'Get the status of a Google or Microsoft OAuth account connection session.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'OAuth session ID returned by the init endpoint'],
        ];
    }

    /**
     * Get OAuth session status.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            return ToolResult::success($this->service->getOauthSessionStatus($args['session_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
