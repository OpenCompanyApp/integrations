<?php

namespace OpenCompany\Integrations\DataCite\Tools;

/** Get a DataCite provider. */
class DataCiteGetProvider extends AbstractDataCiteTool
{
    protected const NAME = 'datacite_get_provider';
    protected const DESCRIPTION = 'Get a DataCite provider, member, or consortium organization.';
    protected const PATH = 'providers/{id}';
    protected const PATH_PARAMS = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Provider ID, such as datacite.'],
    ];
}
