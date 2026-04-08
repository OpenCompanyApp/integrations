<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to add a subscriber to a MailerLite group.
 */
class MailerLiteAddSubscriberToGroup implements Tool
{
    /**
     * Create a new add subscriber to group tool instance.
     */
    public function __construct(
        private MailerLiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mailerlite_add_subscriber_to_group';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Add a subscriber to a MailerLite group by providing the group ID and subscriber email.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'group_id' => ['type' => 'string', 'required' => true, 'description' => 'The group ID to add the subscriber to.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address.'],
            'name' => ['type' => 'string', 'description' => 'Subscriber name (used if creating a new subscriber).'],
        ];
    }

    /**
     * Execute the add subscriber to group tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerLite integration is not configured.');
            }

            $groupId = $args['group_id'];
            $email = $args['email'];
            $name = $args['name'] ?? null;

            $result = $this->service->addSubscriberToGroup($groupId, $email, $name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
