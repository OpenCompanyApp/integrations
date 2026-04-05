<?php

namespace OpenCompany\Integrations\Typeform\Tools;

use OpenCompany\Integrations\Typeform\TypeformService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create or update a webhook for a Typeform form.
 *
 * Creates a new webhook or updates an existing one identified
 * by its tag for the specified form.
 */
class TypeformCreateWebhook implements Tool
{
    /**
     * @param  TypeformService  $service  The Typeform API client
     */
    public function __construct(
        private TypeformService $service,
    ) {}

    public function name(): string
    {
        return 'typeform_create_webhook';
    }

    public function description(): string
    {
        return 'Create or update a webhook for a Typeform form to receive response notifications.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the Typeform form.'],
            'tag'     => ['type' => 'string', 'required' => true, 'description' => 'A unique tag to identify this webhook.'],
            'url'     => ['type' => 'string', 'required' => true, 'description' => 'The endpoint URL where Typeform will send webhook events.'],
            'enabled' => ['type' => 'boolean', 'description' => 'Whether the webhook is enabled (default: true).'],
        ];
    }

    /**
     * Create or update a webhook for a form.
     *
     * @param  array<string, mixed>  $args  Tool arguments (form_id, tag, url, enabled)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Typeform integration is not configured.');
            }

            $formId = $args['form_id'] ?? '';
            $tag = $args['tag'] ?? '';
            $url = $args['url'] ?? '';

            if (empty($formId)) {
                return ToolResult::error('form_id is required.');
            }
            if (empty($tag)) {
                return ToolResult::error('tag is required.');
            }
            if (empty($url)) {
                return ToolResult::error('url is required.');
            }

            $enabled = $args['enabled'] ?? true;

            $result = $this->service->createWebhook($formId, $tag, $url, (bool) $enabled);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
