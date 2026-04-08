<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get a single MailerLite subscriber by ID.
 */
class MailerLiteGetSubscriber implements Tool
{
    /**
     * Create a new get subscriber tool instance.
     */
    public function __construct(
        private MailerLiteService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mailerlite_get_subscriber';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get details for a single MailerLite subscriber by their ID.';
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
        ];
    }

    /**
     * Execute the get subscriber tool.
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
            $result = $this->service->getSubscriber($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
