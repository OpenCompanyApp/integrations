<?php

namespace OpenCompany\Integrations\Vero\Tools;

use OpenCompany\Integrations\Vero\VeroService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VeroIdentifyUser implements Tool
{
    public function __construct(
        private VeroService $service,
    ) {}

    public function name(): string
    {
        return 'vero_identify_user';
    }

    public function description(): string
    {
        return 'Identify or create a user in Vero. Provide a unique identity (user ID or email), along with optional profile attributes like email and name. If the user does not exist, they are created. If they already exist, their profile is updated.';
    }

    public function parameters(): array
    {
        return [
            'identity' => ['type' => 'string', 'required' => true, 'description' => 'Unique user identifier — typically a user ID or email address.'],
            'email' => ['type' => 'string', 'description' => 'The user\'s email address.'],
            'name' => ['type' => 'string', 'description' => 'The user\'s full name.'],
            'extra' => ['type' => 'object', 'description' => 'Additional user traits as key-value pairs (e.g., {"plan": "pro", "country": "US"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vero integration is not configured.');
            }

            $identity = $args['identity'];
            $email = $args['email'] ?? null;
            $name = $args['name'] ?? null;
            $extra = $args['extra'] ?? [];

            if (is_string($extra)) {
                $extra = json_decode($extra, true) ?? [];
            }

            $result = $this->service->identifyUser($identity, $email, $name, $extra);

            return ToolResult::success([
                'message' => "User '{$identity}' identified successfully.",
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
