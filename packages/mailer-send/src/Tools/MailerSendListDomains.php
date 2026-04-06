<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

use OpenCompany\Integrations\MailerSend\MailerSendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailerSendListDomains implements Tool
{
    /**
     * Create a new MailerSendListDomains tool instance.
     */
    public function __construct(
        private MailerSendService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'mailer_send_list_domains';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List sending domains configured in your MailerSend account. Returns domain names, verification statuses, and related settings.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of domains to return per page (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'verified' => ['type' => 'boolean', 'description' => 'Filter domains by verification status. Pass true for verified only, false for unverified only.'],
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
            $verified = $args['verified'] ?? null;

            $result = $this->service->listDomains($limit, $page, $verified);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
