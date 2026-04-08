<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Subscribe a profile to a Klaviyo list.
 */
class KlaviyoSubscribeProfile implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_subscribe_profile';
    }

    public function description(): string
    {
        return <<<'MD'
        Subscribe a profile to a Klaviyo list using their email address.
        Requires a valid list ID and the subscriber's email. Optionally provide a phone number
        and an ISO 8601 consented_at timestamp.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo list ID to subscribe the profile to.',
            ],
            'email' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The subscriber\'s email address.',
            ],
            'phone_number' => [
                'type' => 'string',
                'description' => 'Phone number in E.164 format.',
            ],
            'consented_at' => [
                'type' => 'string',
                'description' => 'ISO 8601 timestamp of when consent was given.',
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

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $email = $args['email'] ?? '';
            if (empty($email)) {
                return ToolResult::error('The "email" parameter is required.');
            }

            $result = $this->service->subscribeProfile(
                listId: $listId,
                email: $email,
                phoneNumber: $args['phone_number'] ?? null,
                consentedAt: $args['consented_at'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
