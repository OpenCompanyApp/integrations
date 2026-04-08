<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Create a new profile in Klaviyo.
 */
class KlaviyoCreateProfile implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_create_profile';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new profile in Klaviyo.
        Provide at least an email address or phone number. Optionally set first name, last name,
        and custom properties. Returns the newly created profile with its Klaviyo ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The profile\'s email address.',
            ],
            'phone_number' => [
                'type' => 'string',
                'description' => 'Phone number in E.164 format (e.g. +1234567890).',
            ],
            'first_name' => [
                'type' => 'string',
                'description' => 'First name of the profile.',
            ],
            'last_name' => [
                'type' => 'string',
                'description' => 'Last name of the profile.',
            ],
            'properties' => [
                'type' => 'object',
                'description' => 'Custom profile properties as key-value pairs.',
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

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->createProfile(
                email: $email,
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
