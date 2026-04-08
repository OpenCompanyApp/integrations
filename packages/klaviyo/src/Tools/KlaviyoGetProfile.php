<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Get a single Klaviyo profile by ID.
 */
class KlaviyoGetProfile implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_get_profile';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Klaviyo profile by its ID.
        Returns the full profile including email, phone number, name, and custom properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'profile_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo profile ID.',
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

            $result = $this->service->getProfile($profileId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
