<?php

namespace OpenCompany\Integrations\ApiTemplateIO\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;

/**
 * Update an APITemplate.io PDF template.
 *
 * Sends template body, CSS, and settings changes to the experimental update-template endpoint.
 */
class ApiTemplateIOUpdateTemplate implements Tool
{
    /**
     * @param  ApiTemplateIOService  $service  The APITemplate.io API client
     */
    public function __construct(
        private ApiTemplateIOService $service,
    ) {}

    public function name(): string
    {
        return 'apitemplateio_update_template';
    }

    public function description(): string
    {
        return 'Update a PDF template body, CSS, or settings. This uses APITemplate.io experimental template-management API.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID to update.'],
            'body' => ['type' => 'string', 'description' => 'Replacement HTML body.'],
            'css' => ['type' => 'string', 'description' => 'Replacement CSS.'],
            'settings' => ['type' => 'object', 'description' => 'Template settings such as custom_header or custom_footer.'],
        ];
    }

    /**
     * Update a template.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('API Template IO integration is not configured.');
            }

            $templateId = (string) ($args['template_id'] ?? '');
            if ($templateId === '') {
                return ToolResult::error('The "template_id" parameter is required.');
            }

            $fields = [];
            foreach (['body', 'css', 'settings'] as $key) {
                if (isset($args[$key])) {
                    $fields[$key] = $args[$key];
                }
            }
            if (isset($fields['settings']) && ! is_array($fields['settings'])) {
                return ToolResult::error('The "settings" parameter must be an object when provided.');
            }

            return ToolResult::success($this->service->updateTemplate($templateId, $fields));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
