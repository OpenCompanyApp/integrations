<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a contact custom field value.
 */
class ActiveCampaignCreateFieldValue extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_create_field_value'; }
    public function description(): string { return 'Create a contact custom field value.'; }
    public function parameters(): array { return ['contact_id' => ['type' => 'integer', 'required' => true], 'field_id' => ['type' => 'integer', 'required' => true], 'value' => ['type' => 'string', 'required' => true]]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createFieldValue($this->requiredInt($args, 'contact_id', 'contact_id'), $this->requiredInt($args, 'field_id', 'field_id'), $args['value'] ?? '')); }
}
