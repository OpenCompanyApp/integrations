<?php

namespace OpenCompany\Integrations\WhatsApp\Tools;

use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated WhatsApp Business user information.
 *
 * Returns the user/business ID, name, and email associated with the
 * access token currently configured for the integration.
 *
 * @see https://developers.facebook.com/docs/graph-api/reference/user
 */
class WhatsAppGetCurrentUser implements Tool
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
        return 'whatsapp_get_current_user';
    }

    /**
     * Human-readable description shown to AI agents and users.
     */
    public function description(): string
    {
        return 'Get the authenticated WhatsApp Business user info - name, email, and business ID. Useful for verifying which account is connected.';
    }

    /**
     * Define the parameters the tool accepts.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and fetch the current user from the API.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->hasAccessToken()) {
                return ToolResult::error('WhatsApp access token is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
