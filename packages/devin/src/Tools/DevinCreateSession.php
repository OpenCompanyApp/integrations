<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Devin session.
 *
 * Supports current v3 organization session options and legacy v1 session
 * creation when the host is configured with a /v1 API URL.
 */
class DevinCreateSession implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_create_session';
    }

    public function description(): string
    {
        return 'Create a Devin session from a task prompt. Current v3 accounts can pass tags, repositories, playbooks, knowledge IDs, secrets, attachments, title, and user attribution options.';
    }

    public function parameters(): array
    {
        return [
            'prompt' => ['type' => 'string', 'required' => true, 'description' => 'The task description for Devin to execute. Be specific about what you want accomplished.'],
            'title' => ['type' => 'string', 'description' => 'Optional title for the session.'],
            'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional tags to attach to the session.'],
            'repos' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional repository references for v3 sessions.'],
            'playbook_id' => ['type' => 'string', 'description' => 'Optional Devin playbook ID.'],
            'child_playbook_id' => ['type' => 'string', 'description' => 'Optional child playbook ID for v3 sessions.'],
            'knowledge_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional Devin knowledge IDs.'],
            'secret_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional secret IDs Devin may use.'],
            'session_secrets' => ['type' => 'object', 'description' => 'Optional per-session secrets.'],
            'attachment_urls' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional attachment URLs for v3 session creation.'],
            'session_links' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional links to associate with the v3 session.'],
            'create_as_user_id' => ['type' => 'string', 'description' => 'Optional v3 user ID to create the session as.'],
            'max_acu_limit' => ['type' => 'number', 'description' => 'Optional maximum ACU limit.'],
            'advanced_mode' => ['type' => 'boolean', 'description' => 'Whether to enable v3 advanced mode.'],
            'bypass_approval' => ['type' => 'boolean', 'description' => 'Whether v3 may bypass approval when allowed by account policy.'],
            'idempotent' => ['type' => 'boolean', 'description' => 'Legacy v1 idempotency flag.'],
            'snapshot_id' => ['type' => 'string', 'description' => 'Legacy v1 snapshot ID.'],
            'structured_output_schema' => ['type' => 'object', 'description' => 'Optional structured output schema.'],
            'unlisted' => ['type' => 'boolean', 'description' => 'Legacy v1 unlisted-session flag.'],
        ];
    }

    /**
     * Create the session.
     *
     * @param  array<string, mixed>  $args  Tool arguments including prompt and optional session settings.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $prompt = $args['prompt'];
            unset($args['prompt']);

            $result = $this->service->createSession($prompt, $args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
