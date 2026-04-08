<?php

namespace OpenCompany\Integrations\SendGrid\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SendGrid\SendGridService;

/**
 * Create a new marketing list in SendGrid.
 */
class SendGridCreateList implements Tool
{
    /** @param SendGridService $service The SendGrid API client */
    public function __construct(
        private SendGridService $service,
    ) {}

    public function name(): string
    {
        return 'sendgrid_create_list';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new marketing list in SendGrid. Returns the created list with its ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'name' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The name for the new list.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('SendGrid integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $result = $this->service->createList(name: $name);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
