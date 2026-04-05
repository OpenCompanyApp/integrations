<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create and send (or save as draft) a DocuSign envelope.
 *
 * Accepts the full envelope definition including documents, recipients,
 * and email settings. Supports both template-based and document-based envelopes.
 */
class DocuSignCreateEnvelope implements Tool
{
    /**
     * Create a new DocuSignCreateEnvelope tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_create_envelope';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Create a new DocuSign envelope for electronic signature. You can create from a template (pass template_id) or from scratch with inline documents and recipients. Set status to "sent" to send immediately or "created" to save as a draft.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'envelope_definition' => [
                'type' => 'object',
                'required' => true,
                'description' => 'The full envelope definition JSON object. Required fields: documents (or templateId), recipients (signers, cc, etc.), emailSubject, and status ("sent" or "created"). See DocuSign eSignature REST API docs for full schema.',
            ],
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

            $definition = $args['envelope_definition'] ?? [];

            if (empty($definition)) {
                return ToolResult::error('envelope_definition is required and must be a non-empty object.');
            }

            if (empty($definition['emailSubject'])) {
                return ToolResult::error('envelope_definition.emailSubject is required.');
            }

            if (empty($definition['status'])) {
                $definition['status'] = 'sent';
            }

            $result = $this->service->createEnvelope($definition);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
