<?php

namespace OpenCompany\Integrations\MailerLite\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MailerLite audience segments.
 */
class MailerLiteListSegments extends AbstractMailerLiteTool
{
    public function name(): string
    {
        return 'mailerlite_list_segments';
    }

    public function description(): string
    {
        return 'List audience segments with pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum rows to return.'],
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
        ];
    }

    /**
     * Execute the segments listing.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listSegments($this->only($args, ['limit', 'page'])));
    }
}
