<?php

namespace OpenCompany\Integrations\Crossref\Tools;

/** Get Crossref prefix steward details. */
class CrossrefGetPrefix extends AbstractCrossrefTool
{
    protected const NAME = 'crossref_get_prefix';
    protected const DESCRIPTION = 'Get the Crossref member steward for a DOI prefix.';
    protected const PATH = 'prefixes/{prefix}';
    protected const PATH_PARAMS = ['prefix'];
    protected const PARAMETERS = [
        'prefix' => ['type' => 'string', 'required' => true, 'description' => 'DOI prefix, such as 10.5555.'],
    ];
}
