<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a contact custom field value.
 */
class ActiveCampaignUpdateFieldValue extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_update_field_value'; }
    public function description(): string { return 'Update an existing contact custom field value.'; }
    public function parameters(): array { return ['field_value_id' => ['type' => 'integer', 'required' => true], 'value' => ['type' => 'string', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->updateFieldValue($this->requiredInt($args, 'field_value_id', 'field_value_id'), $args['value'] ?? '')); }
}
