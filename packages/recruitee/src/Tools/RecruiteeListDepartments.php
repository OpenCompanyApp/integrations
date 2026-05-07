<?php

namespace OpenCompany\Integrations\Recruitee\Tools;

/**
 * List departments configured in Recruitee.
 */
class RecruiteeListDepartments extends AbstractRecruiteeTool
{
    public const NAME = 'recruitee_list_departments';
    public const DESCRIPTION = 'List departments configured in Recruitee.';
    public const PARAMETERS = [];

    /**
     * List departments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listDepartments();
    }
}
