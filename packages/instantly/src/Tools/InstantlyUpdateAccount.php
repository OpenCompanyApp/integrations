<?php

namespace OpenCompany\Integrations\Instantly\Tools;

use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an email account. Modify daily limit, tracking domain, signature, and more.
 */
class InstantlyUpdateAccount implements Tool
{
    /**
     * @param  InstantlyService  $service  The Instantly API client
     */
    public function __construct(
        private InstantlyService $service,
    ) {}

    public function name(): string
    {
        return 'instantly_update_account';
    }

    public function description(): string
    {
        return 'Update an email account. Modify daily limit, tracking domain, signature, and more.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'Account email'],
            'first_name' => ['type' => 'string', 'required' => false, 'description' => 'First name'],
            'last_name' => ['type' => 'string', 'required' => false, 'description' => 'Last name'],
            'daily_limit' => ['type' => 'integer', 'required' => false, 'description' => 'Daily sending limit'],
            'tracking_domain_name' => ['type' => 'string', 'required' => false, 'description' => 'Tracking domain'],
            'enable_slow_ramp' => ['type' => 'boolean', 'required' => false, 'description' => 'Enable slow ramp up'],
            'sending_gap' => ['type' => 'integer', 'required' => false, 'description' => 'Minutes between emails (0-1440)'],
            'signature' => ['type' => 'string', 'required' => false, 'description' => 'Email signature'],
            'remove_tracking_domain' => ['type' => 'boolean', 'required' => false, 'description' => 'Remove tracking domain'],
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

            $email = $args['email']; $fields = ['first_name','last_name','daily_limit','tracking_domain_name','enable_slow_ramp','sending_gap','signature','remove_tracking_domain']; $result = $this->service->updateAccount($email, array_intersect_key($args, array_flip($fields)));

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
