<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get the registration agency for a DOI. */
class CrossrefGetWorkAgency extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_work_agency';
    protected const DESCRIPTION = 'Get the registration agency for a DOI.';
    protected const PATH = 'works/{doi}/agency';
    protected const PATH_PARAMS = ['doi'];
    protected const PARAMETERS = [
        'doi' => ['type' => 'string', 'required' => true, 'description' => 'DOI.'],
    ];
}
