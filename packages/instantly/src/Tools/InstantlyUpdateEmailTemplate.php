<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an email template.
 */
class InstantlyUpdateEmailTemplate implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_email_template';
    }

    public function description(): string
    {
        return 'Update an email template.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID'],
            'template_name' => ['type' => 'string', 'required' => false, 'description' => 'Template name'],
            'subject' => ['type' => 'string', 'required' => false, 'description' => 'Email subject'],
            'body' => ['type' => 'string', 'required' => false, 'description' => 'Email body'],
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

            $body = []; foreach (['template_name','subject','body','category'] as $k) if (isset($args[$k])) $body[$k] = $args[$k]; $result = $this->service->updateEmailTemplate($args['id'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
