<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PostmarkGetTemplate implements Tool
{
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_get_template';
    }

    public function description(): string
    {
        return 'Get full details for a specific email template from Postmark, including the subject, HTML body, text body, and associated metadata.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The TemplateId or Alias of the template (obtained from list_templates).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $result = $this->service->getTemplate($args['template_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
