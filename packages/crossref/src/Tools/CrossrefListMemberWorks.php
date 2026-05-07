<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** List Crossref works for a member. */
class CrossrefListMemberWorks extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_list_member_works';
    protected const DESCRIPTION = 'List Crossref works associated with a member ID.';
    protected const PATH = 'members/{id}/works';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Crossref member ID.'],
    ];
}
