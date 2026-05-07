<?php

namespace OpenCompany\Integrations\Capsule\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Capsule CRM opportunity.
 */
class CapsuleDeleteOpportunity extends AbstractCapsuleTool
{
    public function name(): string { return 'capsule_delete_opportunity'; }
    public function description(): string { return 'Delete a Capsule CRM opportunity.'; }
    public function parameters(): array { return ['id' => ['type' => 'integer', 'required' => true, 'description' => 'Opportunity ID.']]; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->deleteOpportunity($this->requiredInt($args, 'id'))); }
}
