<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Subscribe an email address to a ConvertKit form.
 *
 * Triggers a form subscription, which adds the subscriber to the
 * form's sequence and applies any associated automation rules.
 */
class ConvertKitSubscribeToForm implements Tool
{
    /**
     * Create a new ConvertKitSubscribeToForm tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_subscribe_to_form';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Subscribe an email address to a ConvertKit form. Use convertkit_list_forms to find form IDs.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'integer', 'required' => true, 'description' => 'The form ID to subscribe to. Use convertkit_list_forms to find form IDs.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Subscriber email address.'],
            'first_name' => ['type' => 'string', 'description' => 'Subscriber first name.'],
        ];
    }

    /**
     * Execute the tool: subscribe an email to a ConvertKit form.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            if (empty($args['form_id'])) {
                return ToolResult::error('form_id is required.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $result = $this->service->subscribeToForm(
                formId: (int) $args['form_id'],
                email: $args['email'],
                firstName: $args['first_name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
