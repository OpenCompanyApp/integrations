<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve relationship annotations between two entities.
 */
class EuropePmcAnnotationsByRelationship extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_annotations_by_relationship';
    protected const DESCRIPTION = 'Retrieve Europe PMC relationship annotations tagging both specified entities.';
    protected const API = 'annotations';
    protected const PATH = 'annotationsByRelationship';
    protected const DEFAULTS = ['format' => 'JSON'];
    protected const REQUIRED = ['entity1', 'entity2'];
    protected const PARAMETERS = [
        'entity1' => ['type' => 'string', 'required' => true, 'description' => 'First relationship entity.'],
        'entity2' => ['type' => 'string', 'required' => true, 'description' => 'Second relationship entity.'],
        'type' => ['type' => 'string', 'required' => false, 'description' => 'Optional relationship type filter.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number.'],
        'pageSize' => ['type' => 'integer', 'required' => false, 'description' => 'Page size.'],
    ];
}
