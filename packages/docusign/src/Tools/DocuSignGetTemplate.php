<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific DocuSign template.
 *
 * Returns the full template definition including documents, recipients,
 * tabs (signing fields), and email settings.
 */
class DocuSignGetTemplate implements Tool
{
    /**
     * Create a new DocuSignGetTemplate tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_get_template';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details for a DocuSign template including its documents, recipient roles, signing tabs, and email settings. Use this to understand a template before creating an envelope from it.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'template_id' => ['type' => 'string', 'required' => true, 'description' => 'The template ID to retrieve.'],
        ];
    }

    /**
     * Execute the tool call.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DocuSign integration is not configured.');
            }

            $result = $this->service->getTemplate($args['template_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
