<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to delete a subscriber from MailerLite.
 */
class MailerLiteDeleteSubscriber implements Tool
{
    /**
     * Create a new delete subscriber tool instance.
     */
    public function __construct(
        private MailerLiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mailerlite_delete_subscriber';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Delete a subscriber from MailerLite by their ID. This action is permanent.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber ID to delete.'],
        ];
    }

    /**
     * Execute the delete subscriber tool.
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
            $this->service->deleteSubscriber($id);

            return ToolResult::success([
                'deleted' => true,
                'id' => $id,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
