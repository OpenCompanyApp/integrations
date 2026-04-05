<?php

namespace OpenCompany\Integrations\Jotform\Tools;

use OpenCompany\Integrations\Jotform\JotformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class JotformListQuestions implements Tool
{
    public function __construct(
        private JotformService $service,
    ) {}

    public function name(): string
    {
        return 'jotform_list_questions';
    }

    public function description(): string
    {
        return 'List all questions (form fields) for a specific Jotform form. Returns field types, labels, names, and configuration options.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID (e.g., "231234567890123").'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jotform integration is not configured.');
            }

            $result = $this->service->listQuestions(
                formId: $args['form_id'],
                offset: isset($args['offset']) ? (int) $args['offset'] : null,
            );

            $content = $result['content'] ?? $result;

            return ToolResult::success($content);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
