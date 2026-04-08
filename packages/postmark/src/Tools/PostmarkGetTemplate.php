<?php

namespace OpenCompany\Integrations\Postmark\Tools;

use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific Postmark email template.
 *
 * Returns template info including subject, HTML body, text body, and associated layout template.
 */
class PostmarkGetTemplate implements Tool
{
    /**
     * @param  PostmarkService  $service  The Postmark API client
     */
    public function __construct(
        private PostmarkService $service,
    ) {}

    public function name(): string
    {
        return 'postmark_get_template';
    }

    public function description(): string
    {
        return 'Get details for a Postmark email template including subject, HTML body, and text body.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The Postmark template ID to look up.'],
        ];
    }

    /**
     * Get details for a specific Postmark template.
     *
     * @param  array<string, mixed>  $args  Tool arguments (template_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Postmark integration is not configured.');
            }

            $templateId = $args['template_id'] ?? '';

            if (empty($templateId)) {
                return ToolResult::error('template_id is required.');
            }

            $result = $this->service->getTemplate($templateId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
