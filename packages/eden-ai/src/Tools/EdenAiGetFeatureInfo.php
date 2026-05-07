<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * Get Eden AI V3 feature discovery details.
 */
class EdenAiGetFeatureInfo extends AbstractEdenAiTool
{
    public const NAME = 'edenai_get_feature_info';
    public const DESCRIPTION = 'Get Eden AI V3 discovery details for a feature or subfeature path.';
    public const PARAMETERS = [
        'feature_path' => ['type' => 'string', 'required' => true, 'description' => 'Feature path such as text/moderation.'],
    ];

    /**
     * Get feature info.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getFeatureInfo($this->requiredString($args, 'feature_path', 'feature_path'));
    }
}
