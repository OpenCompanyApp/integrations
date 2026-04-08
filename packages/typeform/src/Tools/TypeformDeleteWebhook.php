<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a webhook from a Typeform form.
 *
 * Removes a webhook identified by its tag from the specified form.
 */
class TypeformDeleteWebhook implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_delete_webhook';
    }

    public function description(): string
    {
        return 'Delete a webhook from a Typeform form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the Typeform form.'],
            'tag'     => ['type' => 'string', 'required' => true, 'description' => 'The unique tag of the webhook to delete.'],
        ];
    }

    /**
     * Delete a webhook by form ID and tag.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id, tag)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';
            $tag = $args['tag'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }
            if (empty($tag)) {
                return ToolResult::error('tag is required.');
            }

            $this->service->deleteWebhook($formId, $tag);

            return ToolResult::success([
                'message' => "Webhook '{$tag}' deleted successfully.",
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
