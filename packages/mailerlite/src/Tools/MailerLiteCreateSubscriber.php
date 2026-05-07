<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new subscriber in MailerLite.
 */
class MailerLiteCreateSubscriber implements Tool
{
    /**
     * Create a new create subscriber tool instance.
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
        return 'mailerlite_create_subscriber';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Add a new subscriber to MailerLite. Provide an email address and optionally a name and custom fields.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address.'],
            'name' => ['type' => 'string', 'description' => 'Subscriber name.'],
            'fields' => ['type' => 'object', 'description' => 'Custom fields as key-value pairs.'],
            'groups' => ['type' => 'array', 'description' => 'Group IDs to add the subscriber to.'],
            'status' => ['type' => 'string', 'enum' => ['active', 'unsubscribed', 'unconfirmed', 'bounced', 'junk'], 'description' => 'Subscriber status.'],
        ];
    }

    /**
     * Execute the create subscriber tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerLite integration is not configured.');
            }

            $email = $args['email'];
            $name = $args['name'] ?? null;
            $payload = [
                'email' => $email,
            ];

            if ($name !== null) {
                $payload['fields']['name'] = $name;
            }

            if (isset($args['fields']) && is_array($args['fields'])) {
                $payload['fields'] = array_merge($payload['fields'] ?? [], $args['fields']);
            }

            foreach (['groups', 'status'] as $key) {
                if (array_key_exists($key, $args)) {
                    $payload[$key] = $args[$key];
                }
            }

            $result = $this->service->createSubscriber($payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
