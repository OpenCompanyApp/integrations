<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a lead deletion request for an Unbounce page.
 */
class UnbounceGetLeadDeletionRequest extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_get_lead_deletion_request'; }

    public function description(): string { return 'Get a lead deletion request by page and request ID.'; }

    public function parameters(): array { return ['page_id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.'], 'lead_deletion_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Lead deletion request ID.']]; }

    /**
     * Get a lead deletion request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getLeadDeletionRequest($this->requiredString($args, 'page_id'), $this->requiredString($args, 'lead_deletion_request_id')));
    }
}
