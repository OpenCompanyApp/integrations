<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Call a documented Recruitee GET endpoint.
 */
class RecruiteeApiGet extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_api_get';
    public const DESCRIPTION = 'Call a documented company-scoped Recruitee GET endpoint relative to /c/{company_id}.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /departments or /locations.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];

    /**
     * Call a GET endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiGet($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'params'));
    }
}
