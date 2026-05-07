<?php

namespace OpenCompany\Integrations\ActiveCampaign\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create an ActiveCampaign tag.
 */
class ActiveCampaignCreateTag extends AbstractActiveCampaignTool implements Tool
{
    public function name(): string { return 'activecampaign_create_tag'; }
    public function description(): string { return 'Create an ActiveCampaign tag.'; }
    public function parameters(): array { return ['tag' => ['type' => 'string', 'required' => true, 'description' => 'Tag name.'], 'description' => ['type' => 'string', 'description' => 'Optional tag description.'], 'tagType' => ['type' => 'string', 'description' => 'Optional tag type.']]; }
    /** @param array<string, mixed> $args */
    public function execute(array $args): ToolResult { return $this->run(fn (): array => $this->service->createTag($this->requiredString($args, 'tag', 'Tag'), $args['description'] ?? null, $args['tagType'] ?? null)); }
}
