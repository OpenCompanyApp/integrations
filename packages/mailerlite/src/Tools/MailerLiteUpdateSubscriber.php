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
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber ID.'],
            'name' => ['type' => 'string', 'description' => 'Updated subscriber name.'],
            'fields' => ['type' => 'object', 'description' => 'Updated custom fields as key-value pairs.'],
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
            $name = $args['name'] ?? null;
            $fields = $args['fields'] ?? [];

            $result = $this->service->updateSubscriber($id, $name, $fields);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
