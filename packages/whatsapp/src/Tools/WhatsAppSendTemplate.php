<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a template-based message via the WhatsApp Cloud API.
 *
 * Template messages are required for initiating new conversations outside the
 * 24-hour customer-service window. The template must be pre-approved in the
 * Meta Business Manager.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#send-template-messages
 */
class WhatsAppSendTemplate implements Tool
{
    /**
     * @param  WhatsAppService  $service  WhatsApp API client.
     */
    public function __construct(
        private WhatsAppService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'whatsapp_send_template';
    }

    /**
     * Human-readable description shown to AI agents and users.
     */
    public function description(): string
    {
        return 'Send a template-based WhatsApp message. Use this to initiate new conversations outside the 24-hour window. The template must be pre-approved in the WhatsApp Business Manager.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient phone number in international format without + (e.g. "15551234567").'],
            'template_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the approved WhatsApp template (e.g. "hello_world").'],
            'language' => ['type' => 'string', 'description' => 'Language code for the template (e.g. "en_US", "en"). Defaults to "en".'],
            'components' => ['type' => 'array', 'description' => 'Template components as an array of objects with type and parameters. Pass as a JSON string or array.'],
        ];
    }

    /**
     * Execute the tool and send the template message via the API.
     *
     * @param  array{to?: string, template_name?: string, language?: string, components?: array|string}  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('WhatsApp integration is not configured.');
            }

            $to = $args['to'] ?? '';
            $templateName = $args['template_name'] ?? '';
            $language = $args['language'] ?? 'en';

            if (empty($to)) {
                return ToolResult::error('Recipient "to" is required.');
            }

            if (empty($templateName)) {
                return ToolResult::error('template_name is required.');
            }

            $components = [];
            if (isset($args['components'])) {
                $components = is_string($args['components'])
                    ? json_decode($args['components'], true) ?? []
                    : $args['components'];
            }

            $result = $this->service->sendTemplate($to, $templateName, $language, $components);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
