<?php

namespace OpenCompany\Integrations\Venmo\Tools;

use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Venmo user by ID.
 *
 * Returns user profile details including username, display name, and profile picture.
 */
class VenmoGetUser implements Tool
{
    /**
     * @param  VenmoService  $service  The Venmo API client
     */
    public function __construct(
        private VenmoService $service,
    ) {}

    public function name(): string
    {
        return 'venmo_get_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a Venmo user by ID.
        Returns user profile details including username, display name, and profile picture.
        MD;
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Venmo user ID.'],
        ];
    }

    /**
     * Retrieve a Venmo user by ID with profile details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Venmo integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $result = $this->service->getUser($id);
            $user = $result['data'] ?? $result;

            return ToolResult::success([
                'id' => $user['id'] ?? '',
                'username' => $user['username'] ?? '',
                'display_name' => $user['display_name'] ?? '',
                'first_name' => $user['first_name'] ?? null,
                'last_name' => $user['last_name'] ?? null,
                'email' => $user['email'] ?? null,
                'phone' => $user['phone'] ?? null,
                'profile_picture_url' => $user['profile_picture_url'] ?? null,
                'about' => $user['about'] ?? null,
                'date_joined' => $user['date_joined'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
