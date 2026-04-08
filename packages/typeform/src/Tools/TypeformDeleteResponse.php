<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Typeform response.
 *
 * Permanently removes a response from a Typeform form.
 */
class TypeformDeleteResponse implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_delete_response';
    }

    public function description(): string
    {
        return 'Delete a Typeform response permanently.';
    }

    public function parameters(): array
    {
        return [
            'form_id'     => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the Typeform form.'],
            'response_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the response to delete.'],
        ];
    }

    /**
     * Delete a response by form and response ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id, response_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';
            $responseId = $args['response_id'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }
            if (empty($responseId)) {
                return ToolResult::error('response_id is required.');
            }

            $this->service->deleteResponse($formId, $responseId);

            return ToolResult::success([
                'message' => "Response {$responseId} deleted successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
