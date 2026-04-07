<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an email template.
 */
class InstantlyCreateEmailTemplate implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_email_template';
    }

    public function description(): string
    {
        return 'Create an email template.';
    }

    public function parameters(): array
    {
        return [
            'template_name' => ['type' => 'string', 'required' => true, 'description' => 'Template name'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Email subject'],
            'body' => ['type' => 'string', 'required' => true, 'description' => 'Email body'],
            'category' => ['type' => 'string', 'required' => false, 'description' => 'Category'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $result = $body = ['template_name' => $args['template_name'], 'subject' => $args['subject'], 'body' => $args['body']]; foreach (['category'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $this->service->createEmailTemplate($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
