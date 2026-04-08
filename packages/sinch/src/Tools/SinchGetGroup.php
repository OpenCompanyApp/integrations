<?php

namespace OpenCompany\Integrations\Sinch\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sinch\SinchService;

/**
 * Get details for a specific group from Sinch.
 *
 * Returns group information including name, member count,
 * and creation date.
 */
class SinchGetGroup implements Tool
{
    /**
     * @param  SinchService  $service  The Sinch API client
     */
    public function __construct(
        private SinchService $service,
    ) {}

    public function name(): string
    {
        return 'sinch_get_group';
    }

    public function description(): string
    {
        return 'Get details for a specific group in your Sinch account.';
    }

    public function parameters(): array
    {
        return [
            'group_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The unique identifier of the group.',
            ],
        ];
    }

    /**
     * Get a group from Sinch.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sinch integration is not configured.');
            }

            $groupId = $args['group_id'] ?? '';

            if (empty($groupId)) {
                return ToolResult::error('group_id is required.');
            }

            $result = $this->service->getGroup($groupId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
