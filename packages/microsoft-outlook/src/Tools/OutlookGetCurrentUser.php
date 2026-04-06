<?php

namespace OpenCompany\Integrations\MicrosoftOutlook\Tools;

use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: outlook_get_current_user
 *
 * Gets the signed-in user's profile information via the Microsoft Graph /me endpoint.
 */
class OutlookGetCurrentUser implements Tool
{
    /**
     * @param  OutlookService  $service  The Outlook API service instance.
     */
    public function __construct(
        private OutlookService $service,
    ) {}

    /**
     * Machine-name of the tool.
     */
    public function name(): string
    {
        return 'outlook_get_current_user';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get the signed-in user\'s profile information including display name, email address, and job title. Useful for identifying which account is connected.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'select' => [
                'type'        => 'string',
                'description' => 'Comma-separated list of properties to include, e.g. "displayName,mail,jobTitle".',
            ],
        ];
    }

    /**
     * Execute the tool: get the current user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Outlook integration is not configured.');
            }

            $params = [];
            if (isset($args['select'])) {
                $params['$select'] = $args['select'];
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
