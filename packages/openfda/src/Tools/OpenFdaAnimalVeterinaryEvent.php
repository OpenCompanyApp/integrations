<?php

namespace OpenCompany\Integrations\OpenFda\Tools;

/**
 * Query animal and veterinary adverse event reports.
 */
class OpenFdaAnimalVeterinaryEvent extends AbstractOpenFdaDatasetTool
{
    protected const NAME = 'openfda_animal_veterinary_event';
    protected const DESCRIPTION = 'Query the openFDA animal and veterinary event endpoint.';
    protected const ENDPOINT = 'animalandveterinary/event';
}
