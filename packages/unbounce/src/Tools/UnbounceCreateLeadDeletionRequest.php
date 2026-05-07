<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a lead deletion request for an Unbounce page.
 */
class UnbounceCreateLeadDeletionRequest extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_create_lead_deletion_request'; }

    public function description(): string { return 'Create a lead deletion request for an Unbounce page.'; }

    public function parameters(): array { return ['page_id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Lead deletion request payload.']]; }

    /**
     * Create a lead deletion request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createLeadDeletionRequest($this->requiredString($args, 'page_id'), $this->arrayArg($args, 'payload')));
    }
}
