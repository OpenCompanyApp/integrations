<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the active subscriber count for a Sendy list.
 *
 * Keeps the historical tool name while mapping to Sendy's active-subscriber-count endpoint.
 */
class SendyListSubscribers implements Tool
{
    /**
     * @param  SendyService  $service  The Sendy API client
     */
    public function __construct(
        private SendyService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'sendy_list_subscribers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get the active subscriber count for a Sendy mailing list.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The list ID to query subscriber count for.'],
        ];
    }

    /**
     * Execute the list subscribers tool.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            $count = $this->service->listSubscribers($args['list_id']);

            return ToolResult::success([
                'list_id' => $args['list_id'],
                'subscribers' => $count,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
