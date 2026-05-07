<?php

namespace OpenCompany\Integrations\EuropePmc\Tools;

/**
 * Retrieve annotations for one or more Europe PMC article IDs.
 */
class EuropePmcAnnotationsByArticleIds extends AbstractEuropePmcTool
{
    protected const NAME = 'europe_pmc_annotations_by_article_ids';
    protected const DESCRIPTION = 'Retrieve Europe PMC text-mined annotations for one or more article IDs.';
    protected const API = 'annotations';
    protected const PATH = 'annotationsByArticleIds';
    protected const DEFAULTS = ['format' => 'JSON'];
    protected const REQUIRED = ['articleIds'];
    protected const PARAMETERS = [
        'articleIds' => ['type' => ['string', 'array'], 'required' => true, 'description' => 'Article IDs such as MED:28585529 or PMC:PMC1664601.', 'items' => ['type' => 'string']],
        'type' => ['type' => 'string', 'required' => false, 'description' => 'Optional annotation type such as Chemicals, Diseases, or Gene_Proteins.'],
        'section' => ['type' => 'string', 'required' => false, 'description' => 'Optional article section filter.'],
        'provider' => ['type' => 'string', 'required' => false, 'description' => 'Optional annotation provider filter.'],
    ];
}
