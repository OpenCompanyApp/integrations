<?php

namespace OpenCompany\Integrations\PayPal\Tools;

use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the authenticated PayPal user's profile.
 *
 * Returns user information including name, email, and other
 * identity details from the PayPal identity endpoint.
 */
class PayPalGetCurrentUser implements Tool
{
    /**
     * Create a new PayPalGetCurrentUser tool instance.
     *
     * @param  PayPalService  $service  The PayPal API service.
     */
    public function __construct(
        private PayPalService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'paypal_get_current_user';
    }

    /**
     * A description of what this tool does, used by AI agents.
     */
    public function description(): string
    {
        return 'Get the authenticated PayPal user\'s profile information. Returns the user\'s name, email, and other account details.';
    }

    /**
     * The parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'schema' => ['type' => 'string', 'description' => 'Schema to return: "paypalv1.1" or "openid". Default: "paypalv1.1".'],
        ];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('PayPal integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
