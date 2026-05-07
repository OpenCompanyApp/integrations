<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve annotations for articles tagging a specific entity.
 */
class EuropePmcAnnotationsByEntity extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_annotations_by_entity';
    protected const DESCRIPTION = 'Retrieve Europe PMC annotations for articles that tag a specific entity.';
    protected const API = 'annotations';
    protected const PATH = 'annotationsByEntity';
    protected const DEFAULTS = ['format' => 'JSON'];
    protected const REQUIRED = ['entity'];
    protected const PARAMETERS = [
        'entity' => ['type' => 'string', 'required' => true, 'description' => 'Entity name or URI to search for.'],
        'type' => ['type' => 'string', 'required' => false, 'description' => 'Optional annotation type filter.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
    ];
}
