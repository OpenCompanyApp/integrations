<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get a Crossref work by DOI. */
class CrossrefGetWork extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_work';
    protected const DESCRIPTION = 'Get a single Crossref work metadata record by DOI.';
    protected const PATH = 'works/{doi}';
    protected const PATH_PARAMS = ['doi'];
    protected const PARAMETERS = [
        'doi' => ['type' => 'string', 'required' => true, 'description' => 'DOI, such as 10.1128/mbio.01735-25.'],
    ];
}
