<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve annotations supplied by a specific provider.
 */
class EuropePmcAnnotationsByProvider extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_annotations_by_provider';
    protected const DESCRIPTION = 'Retrieve Europe PMC annotations supplied by a specific provider.';
    protected const API = 'annotations';
    protected const PATH = 'annotationsByProvider';
    protected const DEFAULTS = ['format' => 'JSON'];
    protected const REQUIRED = ['provider'];
    protected const PARAMETERS = [
        'provider' => ['type' => 'string', 'required' => true, 'description' => 'Annotation provider name.'],
        'type' => ['type' => 'string', 'required' => false, 'description' => 'Optional annotation type filter.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
    ];
}
