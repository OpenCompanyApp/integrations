<?php

namespace OpenCompany\Integrations\Phrase\Tools;

use OpenCompany\Integrations\Phrase\PhraseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated Phrase user's profile.
 */
class PhraseGetCurrentUser implements Tool
{
    /**
     * @param  PhraseService  $service  The Phrase API client
     */
    public function __construct(
        private PhraseService $service,
    ) {}

    public function name(): string
    {
        return 'phrase_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the current authenticated Phrase user's profile, including username,
        name, email, and account details.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the current user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Phrase integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'username' => $result['username'] ?? '',
                'first_name' => $result['first_name'] ?? '',
                'last_name' => $result['last_name'] ?? '',
                'email' => $result['email'] ?? '',
                'created_at' => $result['created_at'] ?? null,
                'updated_at' => $result['updated_at'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
