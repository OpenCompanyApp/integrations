<?php

namespace OpenCompany\Integrations\DocuSign\Tools;

use OpenCompany\Integrations\DocuSign\DocuSignService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific DocuSign envelope.
 *
 * Returns the full envelope details including status, recipients,
 * documents, and signing flow information.
 */
class DocuSignGetEnvelope implements Tool
{
    /**
     * Create a new DocuSignGetEnvelope tool instance.
     */
    public function __construct(
        private DocuSignService $service,
    ) {}

    /**
     * The unique tool identifier.
     */
    public function name(): string
    {
        return 'docusign_get_envelope';
    }

    /**
     * A human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get detailed information about a DocuSign envelope including status, recipients, documents, and signing history. Use this to check if an envelope has been signed or to review its details.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'envelope_id' => ['type' => 'string', 'required' => true, 'description' => 'The envelope ID to retrieve.'],
            'include' => ['type' => 'string', 'description' => 'Comma-separated list of additional data to include: "recipients", "documents", "extensions", "custom_fields", "tabs".'],
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

            $params = [];
            if (isset($args['include'])) {
                $params['include'] = $args['include'];
            }

            $result = $this->service->getEnvelope($args['envelope_id'], $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
