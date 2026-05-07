<?php

namespace OpenCompany\Integrations\GoogleTranslate\Tools;

/**
 * Projects Locations Glossaries Glossary Entries List.
 *
 * Maps to the official Cloud Translation endpoint GET /v3/{+parent}/glossaryEntries.
 */
class GoogleTranslateProjectsLocationsGlossariesGlossaryEntriesList extends AbstractGoogleTranslateTool
{
    protected const NAME = 'google_translate_projects_locations_glossaries_glossary_entries_list';
    protected const DESCRIPTION = 'Projects Locations Glossaries Glossary Entries List

Official Google Cloud Translation endpoint: GET /v3/{+parent}/glossaryEntries
List the entries for the glossary.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Cloud Translation API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Translation method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A token identifying a page of results the server should return. Typically, this is the value of [ListGlossaryEntriesResponse.next_page_token] returned from the previous call. The first page is returned if `page_token`is empty or missing.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. Requested page size. The server may return fewer glossary entries than requested. If unspecified, the server picks an appropriate default.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v3/{+parent}/glossaryEntries';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
