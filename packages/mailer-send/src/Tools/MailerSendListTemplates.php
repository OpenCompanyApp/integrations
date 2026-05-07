<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

use OpenCompany\Integrations\MailerSend\MailerSendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List MailerSend templates.
 */
class MailerSendListTemplates implements Tool
{
    /**
     * Create a new MailerSendListTemplates tool instance.
     *
     *   MailerSendService  $service  The MailerSend API client.
     */
    public function __construct(
        private MailerSendService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'mailer_send_list_templates';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List email templates available in your MailerSend account. Returns template IDs, names, and types for use when sending templated emails.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of templates to return per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerSend integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listTemplates($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
