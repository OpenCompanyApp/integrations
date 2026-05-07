<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive shared labels.
 */
class MissiveListSharedLabels extends AbstractMissiveTool
{
    public const NAME = 'missive_list_shared_labels';
    public const DESCRIPTION = 'List shared labels in organizations the authenticated Missive user can access.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
    ];

    /**
     * List shared labels.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listSharedLabels($this->arrayArg($args, 'params'));
    }
}
