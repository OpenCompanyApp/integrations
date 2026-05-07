<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Capsule CRM opportunity.
 */
class CapsuleCreateOpportunity extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_create_opportunity'; }
    public function description(): string { return 'Create a Capsule CRM sales opportunity.'; }
    public function parameters(): array { return ['opportunity' => ['type' => 'object', 'required' => true, 'description' => 'Opportunity payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createOpportunity($this->objectArg($args, 'opportunity'))); }
}
