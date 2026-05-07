<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Call a documented Recruitee PATCH endpoint.
 */
class RecruiteeApiPatch extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_api_patch';
    public const DESCRIPTION = 'Call a documented company-scoped Recruitee PATCH endpoint relative to /c/{company_id}.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /offers/123.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];

    /**
     * Call a PATCH endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiPatch($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
