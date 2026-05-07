<?php

namespace OpenCompany\Integrations\OpenFigi\Tools;

/**
 * List enum values for OpenFIGI mapping job fields.
 */
class OpenFigiMappingValues extends AbstractOpenFigiTool
{
    protected const NAME = 'openfigi_mapping_values';
    protected const DESCRIPTION = 'Get current enum values for an OpenFIGI mapping job property.';
    protected const METHOD = 'mappingValues';
    protected const REQUIRED = ['key'];
    protected const PARAMETERS = [
        'key' => ['type' => 'string', 'required' => true, 'description' => 'Mapping job property to list values for.', 'enum' => ['idType', 'exchCode', 'micCode', 'currency', 'marketSecDes', 'securityType', 'securityType2', 'stateCode']],
    ];
}
