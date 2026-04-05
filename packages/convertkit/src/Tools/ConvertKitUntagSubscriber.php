<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove a tag from a subscriber in ConvertKit.
 *
 * Unsubscribes an email address from a specific tag. The subscriber
 * record itself is not deleted — only the tag association is removed.
 */
class ConvertKitUntagSubscriber implements Tool
{
    /**
     * Create a new ConvertKitUntagSubscriber tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_untag_subscriber';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Remove a tag from a subscriber by email.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'tag_id' => ['type' => 'integer', 'required' => true, 'description' => 'The tag ID to remove. Use convertkit_list_tags to find tag IDs.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address.'],
        ];
    }

    /**
     * Execute the tool: remove a tag from a subscriber in ConvertKit.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            if (empty($args['tag_id'])) {
                return ToolResult::error('tag_id is required.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $result = $this->service->untagSubscriber(
                tagId: (int) $args['tag_id'],
                email: $args['email'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
