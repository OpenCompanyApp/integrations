<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Capsule CRM opportunity.
 */
class CapsuleUpdateOpportunity extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_update_opportunity'; }
    public function description(): string { return 'Update a Capsule CRM sales opportunity.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Opportunity ID.'], 'opportunity' => ['type' => 'object', 'required' => true, 'description' => 'Opportunity update payload.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateOpportunity($this->requiredInt($args, 'id'), $this->objectArg($args, 'opportunity'))); }
}
