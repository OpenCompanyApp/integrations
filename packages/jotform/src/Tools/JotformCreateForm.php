<?php

namespace OpenCompany\Integrations\Jotform\Tools;

use OpenCompany\Integrations\Jotform\JotformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class JotformCreateForm implements Tool
{
    public function __construct(
        private JotformService $service,
    ) {}

    public function name(): string
    {
        return 'jotform_create_form';
    }

    public function description(): string
    {
        return 'Create a new form in Jotform. Provide form properties such as title, questions (fields), and other settings. Returns the created form with its ID and URL.';
    }

    public function parameters(): array
    {
        return [
            'title' => ['type' => 'string', 'required' => true, 'description' => 'The title of the form.'],
            'questions' => [
                'type' => 'array',
                'description' => 'Array of question definitions. Each question should have "type" (e.g., "control_textbox", "control_email", "control_textarea", "control_dropdown", "control_radio", "control_checkbox"), "name" (field label), and "order" (position).',
            ],
            'properties' => [
                'type' => 'object',
                'description' => 'Additional form properties (e.g., "redirect", "thankurl", "form_pagination", "height"). Pass as an object.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Jotform integration is not configured.');
            }

            $properties = [
                'title' => $args['title'],
            ];

            if (isset($args['questions']) && is_array($args['questions'])) {
                foreach ($args['questions'] as $i => $question) {
                    $key = (string) ($i + 1);
                    $properties['questions[' . $key . ']'] = $question;
                }
            }

            if (isset($args['properties']) && is_array($args['properties'])) {
                foreach ($args['properties'] as $key => $value) {
                    $properties['properties[' . $key . ']'] = $value;
                }
            }

            $result = $this->service->createForm($properties);
            $content = $result['content'] ?? $result;

            return ToolResult::success($content);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
