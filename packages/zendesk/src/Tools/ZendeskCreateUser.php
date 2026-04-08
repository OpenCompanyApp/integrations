<?php

namespace OpenCompany\Integrations\Zendesk\Tools;

use OpenCompany\Integrations\Zendesk\ZendeskService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Zendesk user.
 */
class ZendeskCreateUser implements Tool
{
    /**
     * @param  ZendeskService  $service  The Zendesk API client
     */
    public function __construct(
        private ZendeskService $service,
    ) {}

    public function name(): string
    {
        return 'zendesk_create_user';
    }

    public function description(): string
    {
        return 'Create a new Zendesk user. Requires name and email. Optionally set role and phone.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The full name of the user.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The email address of the user.'],
            'role' => ['type' => 'string', 'description' => 'The role of the user (end-user, agent, admin). Default: end-user.'],
            'phone' => ['type' => 'string', 'description' => 'The phone number of the user.'],
        ];
    }

    /**
     * Create a Zendesk user with name, email, and optional fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, email, role, phone)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Zendesk is not configured. Missing email, API token, or subdomain.');
        }

        $name = $args['name'] ?? '';
        $email = $args['email'] ?? '';

        if (empty($name)) {
            return ToolResult::error('Name is required.');
        }

        if (empty($email)) {
            return ToolResult::error('Email is required.');
        }

        try {
            $user = [
                'name' => $name,
                'email' => $email,
            ];

            if (isset($args['role'])) {
                $user['role'] = $args['role'];
            }

            if (isset($args['phone'])) {
                $user['phone'] = $args['phone'];
            }

            $result = $this->service->createUser(['user' => $user]);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
