<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GFormsListResponses implements Tool
{
    public function __construct(
        private GoogleFormsService $service,
    ) {}

    public function name(): string
    {
        return 'gforms_list_responses';
    }

    public function description(): string
    {
        return 'List responses submitted to a Google Form. Returns answers, timestamps, and respondent metadata. Supports pagination and filtering by date.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID to list responses for.'],
            'pageSize' => ['type' => 'integer', 'description' => 'Maximum number of responses to return per page.'],
            'pageToken' => ['type' => 'string', 'description' => 'Token from a previous response to fetch the next page.'],
            'filter' => ['type' => 'string', 'description' => 'Filter expression. Example: "timestamp >= 1234567890" to filter by submission time (Unix epoch).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Forms integration is not configured.');
            }

            $result = $this->service->listResponses(
                formId: $args['id'],
                pageSize: isset($args['pageSize']) ? (int) $args['pageSize'] : null,
                pageToken: $args['pageToken'] ?? null,
                filter: $args['filter'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
