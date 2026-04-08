<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

use OpenCompany\Integrations\AmazonSes\AmazonSesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AmazonSesCreateTemplate implements Tool
{
    public function __construct(
        private AmazonSesService $service,
    ) {}

    public function name(): string
    {
        return 'amazonses_create_template';
    }

    public function description(): string
    {
        return 'Create a new email template in Amazon SES. Templates can include HTML and plain text content with optional substitution variables (e.g., {{name}}).';
    }

    public function parameters(): array
    {
        return [
            'template_name' => ['type' => 'string', 'required' => true, 'description' => 'A unique name for the template.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'The email subject line. Supports substitution variables (e.g., "Welcome, {{name}}!").'],
            'html_content' => ['type' => 'string', 'description' => 'HTML body of the template. Supports substitution variables using {{variable}} syntax.'],
            'text_content' => ['type' => 'string', 'description' => 'Plain text body of the template. Supports substitution variables using {{variable}} syntax.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Amazon SES integration is not configured.');
            }

            $body = [
                'TemplateName' => $args['template_name'],
                'TemplateContent' => [
                    'Subject' => $args['subject'],
                ],
            ];

            if (isset($args['html_content'])) {
                $body['TemplateContent']['Html'] = $args['html_content'];
            }

            if (isset($args['text_content'])) {
                $body['TemplateContent']['Text'] = $args['text_content'];
            }

            $result = $this->service->createTemplate($body);

            return ToolResult::success([
                'message' => "Template '{$args['template_name']}' created successfully.",
                'template_name' => $args['template_name'],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
