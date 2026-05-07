<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Trigger an audit for a catalog checklist template.
 *
 * Maps to the official Rootly endpoint post /v1/catalog_checklist_templates/{id}/trigger.
 */
class RootlyTriggerCatalogChecklistTemplate extends AbstractRootlyTool
{
    protected const NAME = 'rootly_trigger_catalog_checklist_template';
    protected const DESCRIPTION = 'Trigger an audit for a catalog checklist template

Official Rootly endpoint: POST /v1/catalog_checklist_templates/{id}/trigger

Triggers an audit for all applicable entities of the checklist template';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/catalog_checklist_templates/{id}/trigger';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
