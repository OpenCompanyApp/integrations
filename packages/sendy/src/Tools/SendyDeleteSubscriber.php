<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Sendy\SendyService;

/**
 * Delete a subscriber from a Sendy list.
 *
 * Uses Sendy's documented subscriber delete endpoint.
 */
class SendyDeleteSubscriber implements Tool
{
    /**
     * @param  SendyService  $service  The Sendy API client
     */
    public function __construct(
        private SendyService $service,
    ) {}

    public function name(): string
    {
        return 'sendy_delete_subscriber';
    }

    public function description(): string
    {
        return 'Delete a subscriber from a Sendy list by email address.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'Encrypted list ID.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address to delete.'],
        ];
    }

    /**
     * Delete a subscriber.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            $result = $this->service->deleteSubscriber((string) ($args['list_id'] ?? ''), (string) ($args['email'] ?? ''));

            return $result['status'] === 'success'
                ? ToolResult::success($result)
                : ToolResult::error($result['message']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
