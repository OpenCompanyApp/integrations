<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft email activities.
 */
class SalesloftListEmails extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_emails';
    }

    public function description(): string
    {
        return 'List Salesloft email activities with pagination and filters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'person_id' => ['type' => 'integer', 'description' => 'Filter by person.'],
            'user_id' => ['type' => 'integer', 'description' => 'Filter by user.'],
        ];
    }

    /**
     * List emails.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listEmails($this->only($args, ['page', 'per_page', 'person_id', 'user_id'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
