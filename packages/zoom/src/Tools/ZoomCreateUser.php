<?php

namespace OpenCompany\Integrations\Zoom\Tools;

use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Zoom user.
 *
 * Creates a new user in the Zoom account. Supports "create",
 * "autoCreate", "custCreate", and "ssoCreate" actions.
 */
class ZoomCreateUser implements Tool
{
    /**
     * @param  ZoomService  $service  The Zoom API client
     */
    public function __construct(
        private ZoomService $service,
    ) {}

    public function name(): string
    {
        return 'zoom_create_user';
    }

    public function description(): string
    {
        return 'Create a new user in the Zoom account.';
    }

    public function parameters(): array
    {
        return [
            'action'     => ['type' => 'string', 'required' => true, 'description' => 'Creation action: "create" (email invitation), "autoCreate", "custCreate", or "ssoCreate".'],
            'email'      => ['type' => 'string', 'required' => true, 'description' => 'Email address for the new user.'],
            'first_name' => ['type' => 'string', 'description' => 'First name of the user.'],
            'last_name'  => ['type' => 'string', 'description' => 'Last name of the user.'],
            'type'       => ['type' => 'integer', 'description' => 'User type: 1=Basic, 2=Licensed, 3=On-prem.'],
        ];
    }

    /**
     * Create a new user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (action, email, first_name, last_name, type)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Zoom integration is not configured.');
            }

            $action = $args['action'] ?? '';
            if (empty($action)) {
                return ToolResult::error('action is required.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('email is required.');
            }

            $data = [
                'action' => $action,
                'user_info' => [
                    'email' => $email,
                ],
            ];

            if (isset($args['first_name'])) {
                $data['user_info']['first_name'] = $args['first_name'];
            }
            if (isset($args['last_name'])) {
                $data['user_info']['last_name'] = $args['last_name'];
            }
            if (isset($args['type'])) {
                $data['user_info']['type'] = (int) $args['type'];
            }

            $result = $this->service->createUser($data);

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'email' => $result['email'] ?? $email,
                'first_name' => $result['first_name'] ?? '',
                'last_name' => $result['last_name'] ?? '',
                'type' => $result['type'] ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
