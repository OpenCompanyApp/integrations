<?php

namespace OpenCompany\Integrations\Typefully\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Typefully\TypefullyService;

/**
 * Get the Typefully queue for a social set.
 *
 * Shows upcoming scheduled content where the API endpoint is available.
 */
class TypefullyGetQueue implements Tool
{
    /**
     * @param  TypefullyService  $service  The Typefully API client.
     */
    public function __construct(private TypefullyService $service) {}

    public function name(): string
    {
        return 'typefully_get_queue';
    }

    public function description(): string
    {
        return 'Get upcoming scheduled content for a Typefully social set.';
    }

    public function parameters(): array
    {
        return [
            'social_set_id' => ['type' => 'string', 'required' => true, 'description' => 'Typefully social set ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of queue items to return.'],
            'offset' => ['type' => 'integer', 'description' => 'Number of queue items to skip.'],
        ];
    }

    /**
     * Get the social set queue.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typefully integration is not configured.');
            }

            $socialSetId = $args['social_set_id'] ?? '';
            unset($args['social_set_id']);

            return ToolResult::success($this->service->getQueue($socialSetId, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
