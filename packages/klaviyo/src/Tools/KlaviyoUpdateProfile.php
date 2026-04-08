<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Update an existing Klaviyo profile.
 */
class KlaviyoUpdateProfile implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_update_profile';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing Klaviyo profile by ID.
        Provide only the fields you want to change — omitted fields are left untouched.
        Supports updating email, phone number, first name, last name, and custom properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'profile_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo profile ID to update.',
            ],
            'email' => [
                'type' => 'string',
                'description' => 'New email address for the profile.',
            ],
            'phone_number' => [
                'type' => 'string',
                'description' => 'New phone number in E.164 format.',
            ],
            'first_name' => [
                'type' => 'string',
                'description' => 'Updated first name.',
            ],
            'last_name' => [
                'type' => 'string',
                'description' => 'Updated last name.',
            ],
            'properties' => [
                'type' => 'object',
                'description' => 'Custom profile properties to update as key-value pairs.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $profileId = $args['profile_id'] ?? '';
            if (empty($profileId)) {
                return ToolResult::error('The "profile_id" parameter is required.');
            }

            $result = $this->service->updateProfile(
                profileId: $profileId,
                email: $args['email'] ?? null,
                phoneNumber: $args['phone_number'] ?? null,
                firstName: $args['first_name'] ?? null,
                lastName: $args['last_name'] ?? null,
                properties: $args['properties'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
