<?php

namespace OpenCompany\Integrations\EdenAi\Tools;

/**
 * List Eden AI V3 LLM models.
 */
class EdenAiListModels extends AbstractEdenAiTool
{
    public const NAME = 'edenai_list_models';
    public const DESCRIPTION = 'List Eden AI V3 LLM models and capabilities.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * List models.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listModels($this->arrayArg($args, 'params'));
    }
}
