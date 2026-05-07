<?php

namespace OpenCompany\Integrations\ManyChat\Tools;

use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new tag in the ManyChat account.
 *
 * Tags are used to categorize and segment subscribers for
 * targeted messaging and automation workflows.
 */
class ManyChatCreateTag implements Tool
{
    /**
     * @param  ManyChatService  $service  The Manychat API client.
     */
    public function __construct(
        private ManyChatService $service,
    ) {}

    public function name(): string
    {
        return 'manychat_create_tag';
    }

    public function description(): string
    {
        return 'Create a new tag in ManyChat. Tags help segment subscribers for targeted messaging and automation.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name for the new tag (e.g., "VIP Customer", "Newsletter Subscriber").'],
        ];
    }

    /**
     * Create a tag in the configured bot.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ManyChat integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->createTag($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
