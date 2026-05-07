<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a lead for an Unbounce page.
 */
class UnbounceCreateLead extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_create_lead'; }

    public function description(): string { return 'Create a lead for an Unbounce page using the official lead payload.'; }

    public function parameters(): array { return ['page_id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Lead creation payload including form_submission.']]; }

    /**
     * Create a lead.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createLead($this->requiredString($args, 'page_id'), $this->arrayArg($args, 'payload')));
    }
}
