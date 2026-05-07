<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to update an existing MailerLite subscriber.
 */
class MailerLiteUpdateSubscriber implements Tool
{
    /**
     * Create a new update subscriber tool instance.
     *
     * @param  MailerLiteService  $service  MailerLite API client.
     */
    public function __construct(
        private MailerLiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mailerlite_update_subscriber';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Update an existing subscriber in MailerLite. Provide the subscriber ID and fields to update.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber ID or email address.'],
            'name' => ['type' => 'string', 'description' => 'Updated subscriber name.'],
            'fields' => ['type' => 'object', 'description' => 'Updated custom fields as key-value pairs.'],
            'groups' => ['type' => 'array', 'description' => 'Complete group ID list for the subscriber. Omitted groups are removed by the API.'],
            'status' => ['type' => 'string', 'enum' => ['active', 'unsubscribed', 'unconfirmed', 'bounced', 'junk'], 'description' => 'Subscriber status.'],
            'subscribed_at' => ['type' => 'string', 'description' => 'Subscription date as yyyy-MM-dd HH:mm:ss.'],
        ];
    }

    /**
     * Execute the update subscriber tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerLite integration is not configured.');
            }

            $id = $args['id'];
            $payload = [];

            if (($args['name'] ?? null) !== null) {
                $payload['fields']['name'] = $args['name'];
            }

            if (isset($args['fields']) && is_array($args['fields'])) {
                $payload['fields'] = array_merge($payload['fields'] ?? [], $args['fields']);
            }

            foreach (['groups', 'status', 'subscribed_at'] as $key) {
                if (array_key_exists($key, $args)) {
                    $payload[$key] = $args[$key];
                }
            }

            $result = $this->service->updateSubscriber($id, $payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
