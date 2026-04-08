<?php

namespace OpenCompany\Integrations\MailerSend\Tools;

use OpenCompany\Integrations\MailerSend\MailerSendService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MailerSendGetCurrentUser implements Tool
{
    /**
     * Create a new MailerSendGetCurrentUser tool instance.
     */
    public function __construct(
        private MailerSendService $service,
    ) {}

    /**
     * The tool name used for registration and invocation.
     */
    public function name(): string
    {
        return 'mailer_send_get_current_user';
    }

    /**
     * A human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Verify MailerSend API connectivity by fetching a minimal list of domains. Use this as a health check to confirm the API token is valid and the service is reachable.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('MailerSend integration is not configured.');
            }

            $result = $this->service->listDomains(1, 1);

            return ToolResult::success([
                'status' => 'connected',
                'message' => 'MailerSend API is reachable and the token is valid.',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error('MailerSend health check failed: ' . $e->getMessage());
        }
    }
}
