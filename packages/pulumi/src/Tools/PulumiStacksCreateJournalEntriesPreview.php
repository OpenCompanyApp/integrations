<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateJournalEntries.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}/journalentries.
 */
class PulumiStacksCreateJournalEntriesPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_create_journal_entries_preview';
    protected const DESCRIPTION = 'CreateJournalEntries

Official Pulumi Cloud endpoint: PATCH /api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}/journalentries

Creates new journal entries for the specified update. Journal entries record the progression of resource operations during an update, tracking state transitions for each resource. The include_non_activated query parameter controls whether non-activated events are included. Requires update token authentication.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'update_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `updateID` from the official Pulumi Cloud API operation. The update ID',
  ),
  'include_non_activated' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_non_activated` from the official Pulumi Cloud API operation. When true, includes events that have not yet been activated; when false or omitted, only activated events are returned',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/preview/{updateID}/journalentries';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'updateID' => 'update_id',
);
    protected const QUERY_PARAMS = array (
  'include_non_activated' => 'include_non_activated',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
