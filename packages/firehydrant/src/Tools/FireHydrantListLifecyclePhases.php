<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List phases and milestones.
 *
 * Maps to the official FireHydrant endpoint get /v1/lifecycles/phases.
 */
class FireHydrantListLifecyclePhases extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_lifecycle_phases';
    protected const DESCRIPTION = 'List phases and milestones

Official FireHydrant endpoint: GET /v1/lifecycles/phases

List all of the lifecycle phases and milestones in the organization';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/lifecycles/phases';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
