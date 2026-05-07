<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Tally user's profile information.
 */
class TallyGetCurrentUser extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s profile information, including name, email, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getCurrentUser());
    }
}
