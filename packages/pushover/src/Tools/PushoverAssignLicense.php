<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Assign a prepaid Pushover license credit to a user or email address.
 */
class PushoverAssignLicense implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_assign_license';
    }

    public function description(): string
    {
        return 'Assign a prepaid Pushover license credit to an existing user key or invite an email address for a specific platform.';
    }

    public function parameters(): array
    {
        return [
            'user_key' => ['type' => 'string', 'description' => 'Existing Pushover user key to license. Required unless email is provided.'],
            'email' => ['type' => 'string', 'description' => 'Email address to invite and license. Required unless user_key is provided.'],
            'os' => ['type' => 'string', 'description' => 'Platform for the license, e.g. iOS, Android, or Desktop.'],
        ];
    }

    /**
     * Assign a license credit to a user or email address.
     *
     * @param  array<string, mixed>  $args  Tool arguments (user_key, email, os).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            $data = [];
            if (! empty($args['user_key'])) {
                $data['user'] = $args['user_key'];
            }
            if (! empty($args['email'])) {
                $data['email'] = $args['email'];
            }
            if (! empty($args['os'])) {
                $data['os'] = $args['os'];
            }

            if (empty($data['user']) && empty($data['email'])) {
                return ToolResult::error('Either user_key or email is required.');
            }

            return ToolResult::success($this->service->assignLicense($data));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
