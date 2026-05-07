<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Unsubscribe an email address from a Sendy list.
 *
 * Uses Sendy's documented unsubscribe endpoint with boolean plain-text responses.
 */
class SendyUnsubscribe implements Tool
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
        return 'sendy_unsubscribe';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Unsubscribe an email address from a Sendy mailing list.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'list' => ['type' => 'string', 'required' => true, 'description' => 'The list ID to unsubscribe from.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
        ];
    }

    /**
     * Execute the unsubscribe tool.
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

            $list = $args['list'];
            $email = $args['email'];

            $result = $this->service->unsubscribe($list, $email);

            if ($result['status'] === 'success') {
                return ToolResult::success([
                    'list' => $list,
                    'email' => $email,
                    'message' => $result['message'],
                ]);
            }

            return ToolResult::error($result['message']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
