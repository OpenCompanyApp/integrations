<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new email account via SMTP/IMAP credentials.
 */
class InstantlyCreateAccount implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_create_account';
    }

    public function description(): string
    {
        return 'Create a new email account via SMTP/IMAP credentials.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Email address'],
            'first_name' => ['type' => 'string', 'required' => false, 'description' => 'First name'],
            'last_name' => ['type' => 'string', 'required' => false, 'description' => 'Last name'],
            'smtp_host' => ['type' => 'string', 'required' => true, 'description' => 'SMTP server host'],
            'smtp_port' => ['type' => 'integer', 'required' => true, 'description' => 'SMTP port'],
            'smtp_username' => ['type' => 'string', 'required' => true, 'description' => 'SMTP username'],
            'smtp_password' => ['type' => 'string', 'required' => true, 'description' => 'SMTP password'],
            'imap_host' => ['type' => 'string', 'required' => true, 'description' => 'IMAP host'],
            'imap_port' => ['type' => 'integer', 'required' => true, 'description' => 'IMAP port'],
            'imap_username' => ['type' => 'string', 'required' => true, 'description' => 'IMAP username'],
            'imap_password' => ['type' => 'string', 'required' => true, 'description' => 'IMAP password'],
            'daily_limit' => ['type' => 'integer', 'required' => false, 'description' => 'Daily sending limit'],
        ];
    }

    /**
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Instantly integration is not configured.');
            }

            $fields = ['email','first_name','last_name','smtp_host','smtp_port','smtp_username','smtp_password','imap_host','imap_port','imap_username','imap_password','daily_limit']; $result = $this->service->createAccount(array_intersect_key($args, array_flip($fields)));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
