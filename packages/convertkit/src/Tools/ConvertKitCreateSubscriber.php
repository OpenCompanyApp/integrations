<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a ConvertKit subscriber.
 *
 * Creates a new subscriber by email address. If a subscriber with the
 * given email already exists, their profile is updated with any provided
 * fields (first name, custom fields).
 */
class ConvertKitCreateSubscriber implements Tool
{
    /**
     * Create a new ConvertKitCreateSubscriber tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_create_subscriber';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Create or update a subscriber in ConvertKit by email address. Optionally set first name and custom fields.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Subscriber first name.'],
            'fields' => ['type' => 'object', 'description' => 'Custom field values as key-value pairs.'],
        ];
    }

    /**
     * Execute the tool: create or update a subscriber in ConvertKit.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $result = $this->service->createSubscriber(
                email: $args['email'],
                firstName: $args['first_name'] ?? null,
                fields: $args['fields'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
