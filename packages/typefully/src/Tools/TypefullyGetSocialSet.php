<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Get a Typefully social set.
 *
 * Returns account and connected-platform details for the social set.
 */
class TypefullyGetSocialSet implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_get_social_set';
    }

    public function description(): string
    {
        return 'Get Typefully social set details by ID.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
        ];
    }

    /**
     * Get one social set.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            return ToolResult::success($this->service->getSocialSet($args['social_set_id'] ?? ''));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
