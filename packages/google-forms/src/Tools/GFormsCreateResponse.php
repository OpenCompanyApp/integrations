<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GFormsCreateResponse implements Tool
{
    public function __construct(
        private GoogleFormsService $service,
    ) {}

    public function name(): string
    {
        return 'gforms_create_response';
    }

    public function description(): string
    {
        return 'Submit a response to a Google Form. Provide answers keyed by question ID. Use get_form first to discover question IDs and their types.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID to submit a response to.'],
            'answers' => ['type' => 'object', 'required' => true, 'description' => 'Object mapping question IDs to answer objects. Each answer should have the format: {"textAnswers": {"answers": [{"value": "your answer"}]}}.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Forms integration is not configured.');
            }

            if (empty($args['answers'])) {
                return ToolResult::error('At least one answer is required to submit a response.');
            }

            $result = $this->service->createResponse(
                formId: $args['id'],
                answers: $args['answers'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
