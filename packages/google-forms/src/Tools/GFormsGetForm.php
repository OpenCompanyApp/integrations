<?php

namespace OpenCompany\Integrations\GoogleForms\Tools;

use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GFormsGetForm implements Tool
{
    public function __construct(
        private GoogleFormsService $service,
    ) {}

    public function name(): string
    {
        return 'gforms_get_form';
    }

    public function description(): string
    {
        return 'Get the full details of a specific Google Form, including its questions, layout, and settings.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The form ID (found in the form URL or from list_forms).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Google Forms integration is not configured.');
            }

            $result = $this->service->getForm($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
