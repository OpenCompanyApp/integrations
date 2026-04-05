<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tag a subscriber in ConvertKit.
 *
 * Subscribes an email address to a specific tag. If the subscriber
 * doesn't exist yet, they will be created automatically.
 */
class ConvertKitTagSubscriber implements Tool
{
    /**
     * Create a new ConvertKitTagSubscriber tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_tag_subscriber';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Add a tag to a subscriber by email. Creates the subscriber if they don\'t exist.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'tag_id' => ['type' => 'integer', 'required' => true, 'description' => 'The tag ID to apply. Use convertkit_list_tags to find tag IDs.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Subscriber first name (used if creating a new subscriber).'],
        ];
    }

    /**
     * Execute the tool: tag a subscriber in ConvertKit.
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

            $result = $this->service->tagSubscriber(
                tagId: (int) $args['tag_id'],
                email: $args['email'],
                firstName: $args['first_name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
