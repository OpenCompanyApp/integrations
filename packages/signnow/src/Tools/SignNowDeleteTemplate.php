<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a SignNow template.
 */
class SignNowDeleteTemplate extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_delete_template';
    }

    public function description(): string
    {
        return 'Delete a SignNow template by ID.';
    }

    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'Template ID.'],
        ];
    }

    /**
     * Delete a template.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['template_id'])) {
                return ToolResult::error('template_id is required.');
            }

            return ToolResult::success($this->service->deleteTemplate((string) $args['template_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
