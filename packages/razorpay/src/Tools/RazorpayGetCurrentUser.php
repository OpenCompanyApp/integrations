<?php

namespace OpenCompany\Integrations\Razorpay\Tools;

use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get current user information from Razorpay.
 *
 * Uses the GET /items endpoint to retrieve the authenticated user's
 * account details and configuration.
 */
class RazorpayGetCurrentUser implements Tool
{
    /**
     * Create a new RazorpayGetCurrentUser tool instance.
     */
    public function __construct(
        private RazorpayService $service,
    ) {}

    /**
     * The tool name identifier.
     */
    public function name(): string
    {
        return 'razorpay_get_current_user';
    }

    /**
     * A description of what this tool does, used by the AI agent.
     */
    public function description(): string
    {
        return 'Get current user information from Razorpay. Returns details about the authenticated Razorpay account.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the current user information.
     *
     * @param  array<string, mixed>  $args  The tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Razorpay integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
