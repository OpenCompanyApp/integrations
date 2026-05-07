<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * Call a documented Recruitee DELETE endpoint.
 */
class RecruiteeApiDelete extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_api_delete';
    public const DESCRIPTION = 'Call a documented company-scoped Recruitee DELETE endpoint relative to /c/{company_id}.';
    public const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'Endpoint path, such as /candidates/123.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
    ];

    /**
     * Call a DELETE endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->apiDelete($this->requiredString($args, 'path', 'path'), $this->arrayArg($args, 'body'));
    }
}
