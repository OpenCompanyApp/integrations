<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * List Eden AI V3 expert model features.
 */
class EdenAiListFeatures extends AbstractEdenAiTool
{
    public const NAME = 'edenai_list_features';
    public const DESCRIPTION = 'List Eden AI V3 expert model features and subfeatures.';
    public const PARAMETERS = [];

    /**
     * List features.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listFeatures();
    }
}
