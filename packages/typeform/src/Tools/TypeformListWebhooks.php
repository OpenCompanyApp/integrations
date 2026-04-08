<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List webhooks for a Typeform form.
 *
 * Retrieves all webhooks configured for the specified form.
 */
class TypeformListWebhooks implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_list_webhooks';
    }

    public function description(): string
    {
        return 'List all webhooks configured for a Typeform form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the Typeform form.'],
        ];
    }

    /**
     * List webhooks for a form.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }

            $result = $this->service->listWebhooks($formId);

            return ToolResult::success([
                'items' => $result['items'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
