<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a custom contact field.
 */
class ActiveCampaignCreateField extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_create_field'; }
    public function description(): string { return 'Create a custom contact field.'; }
    public function parameters(): array { return ['field' => ['type' => 'object', 'required' => true, 'description' => 'ActiveCampaign field payload.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createField($this->arrayArg($args, 'field'))); }
}
